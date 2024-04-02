<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nvr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class NvrController extends Controller
{
    public function nvrWebLogin()
    {
        try {

            $nvr = Nvr::first();

            if (!$nvr) {
                return response()->json(['error' => 'NVR details not found']);
            }

            $response = Http::withDigestAuth($nvr->username, $nvr->password)
                ->post($nvr->ip_address.'API/Web/Login');

            if ($response->status() == 200) {
               $updateNvrConfigurations = $nvr->update([
                'csrf_token' =>  $response->header('X-csrftoken'),
                'cookie' => $response->header('Set-Cookie')
               ]);
            }

            return response()->json([
                'status' => true,
                'cookie' => $response->header('Set-Cookie'),
                'token' =>  $response->header('X-csrftoken')
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function nvrWebLogout()
    {
        try {

            $nvr = Nvr::first();

            if (!$nvr) {
                return response()->json(['error' => 'NVR details not found']);
            }

            $response = Http::withHeaders([
                'X-csrftoken' => $nvr->csrf_token,
                'Cookie' => $nvr->cookie,
                'Content-Type' => 'application/json'
            ])->post($nvr->ip_address.'API/Web/Logout');

            // $response = Http::withHeaders([
            //     'X-csrftoken' => 'f48ce1fee67f1a5ff1befd99b1c10471548ae2a0a34b4ddd4cc43d98b8abf4e0',
            //     'Cookie' => 'session=d6f38f59f4f44ac4fe08d6b7022f60dfd147f868f13e43825a524b912d93a1e1;HttpOnly;path=/',
            //     'Content-Type' => 'application/json'
            // ])->post('http://122.160.43.215:8081/API/Web/Logout');


            if($response->status() == 400)
                return $response->body();
            if($response->status() == 200)
                return $response->body();

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function nvrHeartbeat(){
        try {

            $nvr = Nvr::first();

            if (!$nvr) {
                return response()->json(['error' => 'NVR details not found']);
            }

            $response = Http::withHeaders([
                'X-csrftoken' => $nvr->csrf_token,
                'Cookie' => $nvr->cookie
            ])->withBody(json_encode([
                'version' => '1.0',
                'data' => [
                    'keep_alive' => true
                ]
            ]), 'application/json')->post($nvr->ip_address.'API/Login/Heartbeat');
            if($response->status() == 400)
                return $response->body();
            if($response->status() == 200)
                return $response->body();
        } catch (\Exception $e) {
            Log::error('####### NvrController -> nvrHeartbeat() #######  ' . $e->getMessage());
            Session::flash('alert-error', __('message.something_went_wrong'));
            return redirect()->back()->withInput();
        }
    }
}
