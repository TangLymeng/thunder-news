<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopAdvertisement;
use Illuminate\Http\Request;
use App\Models\HomeAdvertisement;
use Image;

class AdminAdvertisementController extends Controller
{
    public function home_ad_show()
    {
        $home_ad_data = HomeAdvertisement::where('id', 1)->first();
        return view('admin.advertisement_home_view', compact('home_ad_data'));
    }
    public function home_ad_update(Request $request)
    {
        $home_ad_data = HomeAdvertisement::where('id', 1)->first();

        if ($request->hasFile('above_search_ad')) {
            $request->validate([
                'above_search_ad' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            unlink(public_path('uploads/' . $home_ad_data->above_search_ad));

            $ext = $request->file('above_search_ad')->extension();
            $image = Image::make($request->file('above_search_ad'));
            $image->resize(1170, 100);
            $final_name = 'above_search_ad' . '.' . $ext;
            $image->save(public_path('uploads/' . $final_name));

            $home_ad_data->above_search_ad = $final_name;
        }

        if ($request->hasFile('above_footer_ad')) {
            $request->validate([
                'above_footer_ad' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            unlink(public_path('uploads/' . $home_ad_data->above_footer_ad));

            $ext = $request->file('above_footer_ad')->extension();
            $image = Image::make($request->file('above_footer_ad'));
            $image->resize(1170, 100);
            $final_name = 'above_footer_ad' . '.' . $ext;
            $image->save(public_path('uploads/' . $final_name));

            $home_ad_data->above_footer_ad = $final_name;
        }

        $home_ad_data->above_search_ad_url = $request->above_search_ad_url;
        $home_ad_data->above_search_ad_status = $request->above_search_ad_status;
        $home_ad_data->above_footer_ad_url = $request->above_footer_ad_url;
        $home_ad_data->above_footer_ad_status = $request->above_footer_ad_status;
        $home_ad_data->update();

        return redirect()->back()->with('success', 'Home Advertisement Updated Successfully');
    }

    public function top_ad_show()
    {
        $top_ad_data = TopAdvertisement::where('id', 1)->first();
        return view('admin.advertisement_top_view', compact('top_ad_data'));
    }

    public function top_ad_update(Request $request)
    {
        $top_ad_data = TopAdvertisement::where('id', 1)->first();

        if ($request->hasFile('top_ad')) {
            $request->validate([
                'top_ad' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            unlink(public_path('uploads/' . $top_ad_data->top_ad));

            $ext = $request->file('top_ad')->extension();
            $image = Image::make($request->file('top_ad'));
            $image->resize(1170, 100);
            $final_name = 'top_ad' . '.' . $ext;
            $image->save(public_path('uploads/' . $final_name));

            $top_ad_data->top_ad = $final_name;

        }
        $top_ad_data->top_ad_url = $request->top_ad_url;
        $top_ad_data->top_ad_status = $request->top_ad_status;
        $top_ad_data->update();

        return redirect()->back()->with('success', 'Top Advertisement Updated Successfully');
    }

}
