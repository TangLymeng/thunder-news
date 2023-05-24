<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SidebarAdvertisement;
use App\Models\TopAdvertisement;
use Illuminate\Http\Request;
use App\Models\HomeAdvertisement;
use App\Models\Category;
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

    public function sidebar_ad_show()
    {
        $sidebar_ad_data = SidebarAdvertisement::get();
        return view('admin.advertisement_sidebar_view', compact('sidebar_ad_data'));
    }

    public function sidebar_ad_create()
    {
        return view('admin.advertisement_sidebar_create');
    }

    public function sidebar_ad_store(Request $request)
    {

        $request->validate([
            'sidebar_ad' => 'required|image|mimes:jpg,jpeg,png,gif',
        ], [
            'sidebar_ad.required' => 'Please choose your ads image',
            'sidebar_ad.image' => 'Only image file are allowed',
            'sidebar_ad.mimes' => 'Only jpg,jpeg,png,gif file are allowed',
        ]);

        $ext = $request->file('sidebar_ad')->extension();
        $image = Image::make($request->file('sidebar_ad'));
        $image->resize(500, 266);
        $final_name = 'sidebar_ad_' . uniqid() . '.' . $ext;
        $image->save(public_path('uploads/' . $final_name));

        $sidebar_ad_data = new SidebarAdvertisement();
        $sidebar_ad_data->sidebar_ad = $final_name;
        $sidebar_ad_data->sidebar_ad_url = $request->sidebar_ad_url;
        $sidebar_ad_data->sidebar_ad_location = $request->sidebar_ad_location;
        $sidebar_ad_data->save();

        return redirect()->route('admin_sidebar_ad_show')->with('success', 'Sidebar Advertisement Inserted Successfully');
    }

    public function sidebar_ad_edit($id)
    {
        $sidebar_ad_data = SidebarAdvertisement::where('id', $id)->first();
        return view('admin.advertisement_sidebar_edit', compact('sidebar_ad_data'));
    }

    public function sidebar_ad_update(Request $request, $id)
    {
        $sidebar_ad_data = SidebarAdvertisement::where('id', $id)->first();

        if ($request->hasFile('sidebar_ad')) {
            $request->validate([
                'sidebar_ad' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            unlink(public_path('uploads/' . $sidebar_ad_data->sidebar_ad));

            $ext = $request->file('sidebar_ad')->extension();
            $image = Image::make($request->file('sidebar_ad'));
            $image->resize(500, 266);
            $final_name = 'sidebar_ad_' . uniqid() . '.' . $ext;
            $image->save(public_path('uploads/' . $final_name));

            $sidebar_ad_data->sidebar_ad = $final_name;
        }

        $sidebar_ad_data->sidebar_ad_url = $request->sidebar_ad_url;
        $sidebar_ad_data->sidebar_ad_location = $request->sidebar_ad_location;
        $sidebar_ad_data->update();

        return redirect()->route('admin_sidebar_ad_show')->with('success', 'Sidebar Advertisement Updated Successfully');
    }
    public function sidebar_ad_delete($id)
    {
        $sidebar_ad_data = SidebarAdvertisement::where('id', $id)->first();
        unlink(public_path('uploads/' . $sidebar_ad_data->sidebar_ad));
        $sidebar_ad_data->delete();
        return redirect()->route('admin_sidebar_ad_show')->with('success', 'Sidebar Advertisement Deleted Successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
           'category_name' => 'required|unique:categories',
           'category_order' => 'required',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->show_on_menu = $request->show_on_menu;
        $category->category_order = $request->category_order;
        $category->save();

        return redirect()->route('admin_category_show')->with('success', 'Category Inserted Successfully');
    }
}
