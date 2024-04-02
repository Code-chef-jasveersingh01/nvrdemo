<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\NvrController;
use App\Models\Face;
use App\Models\Nvr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class FaceController extends Controller
{

    /**
     * Display the view for listing all faces.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            return view('admin.face.all_face_list');
        } catch (\Exception $e) {
            Log::error('####### FaceController -> index() #######  ' . $e->getMessage());
            Session::flash('alert-error', __('message.something_went_wrong'));
            return redirect()->back()->withInput();
        }
    }

    /**
     * Retrieve face data for DataTables listing.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataTableFaceListTable(Request $request)
    {

        #main query
        $query  = Face::query();

        #search_key filter
        if (isset($request->filterSearchKey) && !empty($request->filterSearchKey)) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->filterSearchKey . '%')
                    ->orWhere('email', 'like', '%' . $request->filterSearchKey . '%')
                    ->orWhere('phone', 'like', '%' . $request->filterSearchKey . '%');
            });
        }

        $query = $query->orderBy('created_at', 'desc');

        if (!empty($query)) {
            return DataTables::of($query)
                ->addColumn('image', function ($face) {
                    if ($face->image) {
                        return url('storage/' . $face->uuid . '/profile_image/' . $face->image);
                    } else {
                        return 'Image not found';
                    }
                })
                ->make(true);
        }
        return Datatables::of($query)->make(true);
    }

    public function getAddFaceForm(){
        return view('admin.face.add_face');
    }


     /**
     * Add a new face to the system and make api call to save it to the nvr.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function addFace(Request $request)
    {

        $validData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => Rule::requiredIf(empty($request->get('webCapturedImage')))
        ]);


        if ($validData->fails()) {
            return redirect()->back()->withErrors($validData)->withInput();
        }

        try {

            $face = new Face;
            $face->name = $request->name;
            $face->email = $request->email;
            $face->phone = $request->phone;
            $face->uuid = bin2hex(random_bytes(16));

            // Assuming the image is being uploaded as a file
            if ($request->hasFile('image') || $request->get('webCapturedImage')) {

                if(!$request->hasFile('image')){
                    $file = $request->get('webCapturedImage');
                }else{
                    $file = $request->file('image');
                }

                if (strpos($file, 'base64') !== false) {
                    $base64Image = explode(',', $file)[1];
                    $file = base64_decode($base64Image);
                    $tempFilePath = tempnam(sys_get_temp_dir(), 'image');
                    file_put_contents($tempFilePath, $file);
                    $file = new \Illuminate\Http\UploadedFile($tempFilePath, 'temp_image.jpg');
                }

                $base64Image = $this->convertToBase64($file);

                $imageData = [
                    'name'              =>    $request->name,
                    'email'             =>    $request->email,
                    'phone'             =>    $request->phone,
                    'base64Image'       =>    $base64Image,
                    'uuid'              =>    $face->uuid,
                ];

                $extension = $file->getClientOriginalExtension();
                $filename = $this->generateUuid($extension);


                //Nvr api call to save image
                $uploadImage = $this->addFaceApi($imageData);
                $apiResponse = json_decode($uploadImage->body(),true);
                $md5ImageCode = $apiResponse['data']['MD5'][0];

                if($uploadImage->status() != 200){
                    Session::flash('alert-error', __('message.something_went_wrong'));
                    return redirect()->back()->withInput();
                }

                //If image do not have a face then api call will not return md5.
                if(empty($md5ImageCode)){
                    Session::flash('alert-error', __('message.face_not_identified'));
                    return redirect()->back()->withInput();
                }

                $path = storage_path('app/public/' . $face->uuid . '/profile_image/');
                $path2 = storage_path('app/public/' . $face->uuid . '/camera_image/');
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                    File::makeDirectory($path2, 0777, true, true);
                }

                if($request->hasFile('image')){
                    $file->move($path, $filename);
                }else{
                    Image::make($request->get('webCapturedImage'))->save($path . '/' . $filename);
                }

                $face->image = $filename;
                $face->md5 = $md5ImageCode;
            }
            $face->save();

            Session::flash('alert-success', __('message.records_created_successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('####### FaceController -> addFace() #######  ' . $e->getMessage());
            Session::flash('alert-error', __('message.something_went_wrong'));
            return redirect()->back()->withInput();
        }
    }

    /**
     * Converts input data to Base64 encoding.
     *
     * @param string $input The input data to be converted to Base64.
     * @return string The Base64 encoded data.
     */
    public function convertToBase64($input)
    {
        // Check if the input is base64
        if (base64_encode(base64_decode($input, true)) === $input) {
            return $input;
        } else {
            // Assume the input is a file path and try to convert it to base64
            $type = pathinfo($input, PATHINFO_EXTENSION);
            $data = file_get_contents($input);
            $base64 = base64_encode($data);
            return $base64;
        }
    }

    /**
     * Generate unique name using current and time.
     *
     * @param string $extension also rename the image file if extension is passed.
     * @return string $filename.
     */

    public function generateUuid($extension = null)
    {
        $timestamp = Carbon::now();
        $date = $timestamp->format('Ymd');
        $time = $timestamp->format('His');

        // Combine the UUID, date, time, and extension to form the filename
        if($extension != null){
            $filename = $date.'_'.$time. '.' . $extension;
        }else{
            $filename = $date.'_'.$time;
        }

        return $filename;
    }

    /*
     * Add face to the the nvr database
     *
     * @param array  Contains the required image details
     *
     * @return api response
     *
     */

    public function addFaceApi($imageData)
    {
        try {
            $NvrController = new NvrController;
            $NvrController->nvrWebLogout();
            $NvrController->nvrWebLogin();

            $nvr = Nvr::first();

            if (!$nvr) {
                return response()->json(['error' => 'NVR details not found']);
            }

            $requestPayload = [
                'version' => '1.0',
                'data' => [
                    'MsgId' => null,
                    'Count' => 2,
                    'FaceInfo' => [
                        [
                            'Id' => -1,
                            'GrpId' => 2,
                            'Image1' => $imageData['base64Image'],
                            'Name' => $imageData['name'],
                            'IdCode' => $imageData['uuid'],
                            'Phone' => $imageData['phone'],
                            'Email' => $imageData['email'],
                        ],
                    ],
                ],
            ];

            $response = Http::withHeaders([
                'X-csrftoken' => $nvr->csrf_token,
                'Cookie' => $nvr->cookie
            ])->withBody(json_encode($requestPayload), 'application/json')->post($nvr->ip_address.'API/AI/Faces/Add');

            if($response->status() == 400)
                return $response->body();
            if($response->status() == 200)
                return $response;

        } catch (\Exception $e) {
            Log::error('####### FaceController -> addFaceApi() #######  ' . $e->getMessage());
            Session::flash('alert-error', __('message.something_went_wrong'));
            return redirect()->back()->withInput();
        }
    }
}
