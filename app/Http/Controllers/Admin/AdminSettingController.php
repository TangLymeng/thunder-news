<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $setting_data = Setting::where('id', 1)->first();
        return view('admin.setting', compact('setting_data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'news_ticker_total' => 'required',
        ]);

        $setting = Setting::where('id', 1)->first();
        $setting->news_ticker_total = $request->news_ticker_total;
        $setting->news_ticker_status = $request->news_ticker_status;
        $setting->save();

        return redirect()->route('admin_setting')->with('success', 'Setting updated successfully.');
    }
}
