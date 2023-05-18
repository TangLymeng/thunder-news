<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function show()
    {
        $categories = Category::orderBy('category_order', 'asc')->get();
        return view('admin.category_show', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_order' => 'required',
        ]);
        $categories = new Category();

        $categories->category_name = request('category_name');
        $categories->show_on_menu = request('show_on_menu');
        $categories->category_order = request('category_order');

        $categories->save();

        return redirect()->route('admin_category_show')->with('success', 'Category Created Successfully');
    }
    public function create()
    {
        return view('admin.category_create');
    }

    public function edit($id)
    {
        $categories = Category::where('id', $id)->first();
        return view('admin.category_edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $categories = Category::where('id', $id)->first();

        $categories->category_name = $request->category_name;
        $categories->show_on_menu = $request->show_on_menu;
        $categories->category_order = $request->category_order;

        $categories->update();

        return redirect()->route('admin_category_show')->with('success', 'Category Updated Successfully');
    }

    public function destroy($id)
    {
        $categories = Category::where('id', $id)->first();
        $categories->delete();

        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
