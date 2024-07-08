<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $pageTitle = 'API Setting';
        return view('admin.setting.api_setting', compact('pageTitle'));
    }

    public function apiUpdate(Request $request)
    {

        $request->validate([
            'api' => 'sometimes|max:255',
            'wallet_limit' => 'required|integer|gt:0',
            'pin' => 'sometimes|max:255',
            'wallet' => 'sometimes|max:255',
            'fixed_charge' => 'required|gte:0|numeric',
            'percent_charge' => 'required|gte:0|numeric',
        ]);

        $general = GeneralSetting::first();
        $general->api = $request->api;
        $general->wallet_limit = $request->wallet_limit;
        $general->pin = $request->pin;
        $general->wallet = $request->wallet;
        $general->fixed_charge = $request->fixed_charge;
        $general->percent_charge = $request->percent_charge;
        $general->save();

        $notify[] = ['success', 'Api info updated successfully'];
        return back()->withNotify($notify);
    }
}
