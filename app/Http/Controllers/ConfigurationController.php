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

class ConfigurationController extends Controller
{
    public function nvrDetails(){
        return view('admin.nvr.nvr_details');
    }

    public function setNvrDetails(Request $request)
    {
        $validData = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'nvrip' => 'required',
        ]);

        if ($validData->fails()) {
           // Session::flash('alert-error', __('message.something_went_wrong'));
            return redirect()->back()->withErrors($validData)->withInput();
        }

        try {
            Nvr::create([
                'username' => $request->input('email'),
                'password' => $request->input('password'),
              //  'password' => Hash::make($request->password),
                'ip_address' => $request->input('nvrip'),
            ]);

            Session::flash('alert-success', __('message.connected_successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('####### ConfigurationController -> setNvrDetails() #######  ' . $e->getMessage());
            Session::flash('alert-error', __('message.something_went_wrong'));
            return redirect()->back()->withInput();
        }
    }


}
