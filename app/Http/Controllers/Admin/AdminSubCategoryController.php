<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminSubCategoryController extends Controller
{
    public function show()
    {
        $sub_categories = SubCategory::with('rCategory')->orderBy('sub_category_order', 'asc')->get();
        return view('admin.sub_category_show', compact('sub_categories'));
    }
    public function create()
    {
        $categories = Category::orderBy('category_order', 'asc')->get();
        return view('admin.sub_category_create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'sub_category_name' => 'required',
            'sub_category_order' => 'required',
        ]);
        $sub_categories = new SubCategory();

        $sub_categories->sub_category_name = request('sub_category_name');
        $sub_categories->show_on_menu = request('show_on_menu');
        $sub_categories->show_on_home = request('show_on_home');
        $sub_categories->sub_category_order = request('sub_category_order');
        $sub_categories->category_id = request('category_id');

        $sub_categories->save();

        return redirect()->route('admin_sub_category_show')->with('success', 'Sub Category Created Successfully');
    }
    public function edit($id)
    {
        $categories = Category::orderBy('category_order', 'asc')->get();
        $sub_category_single = SubCategory::where('id', $id)->first();
        return view('admin.sub_category_edit', compact('categories','sub_category_single'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'sub_category_name' => 'required',
            'sub_category_order' => 'required',
        ]);
        $sub_categories = SubCategory::where('id', $id)->first();

        $sub_categories->sub_category_name = request('sub_category_name');
        $sub_categories->show_on_menu = request('show_on_menu');
        $sub_categories->show_on_home = request('show_on_home');
        $sub_categories->sub_category_order = request('sub_category_order');
        $sub_categories->category_id = request('category_id');

        $sub_categories->update();

        return redirect()->route('admin_sub_category_show')->with('success', 'Sub Category Updated Successfully');
    }
    public function destroy($id)
    {
        $sub_category_single = SubCategory::where('id', $id)->first();
        $sub_category_single->delete();

        return redirect()->route('admin_sub_category_show')->with('success', 'Sub Category Deleted Successfully');
    }
}
