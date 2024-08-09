<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function view_category()
    {
        $categories = Category::all();
        return view('admin.category.category', compact('categories'));
    }
    public function add_category(Request $request)
    {
        $category = new Category();
        $category->category_name = $request->category;
        $category->save();
        toastr()->closeButton()->timeOut(4000)->addSuccess('Add category successfully.');
        return redirect()->back();
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();
        toastr()->closeButton()->timeOut(4000)->addSuccess('Delete category successfully.');
        return redirect()->back();
    }

    public function edit_category($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit_category', compact('category'));
    }

    public function update_category(Request $request, $id)
    {
        $category = Category::find($id);
        $category->category_name = $request->category;
        $category->save();
        toastr()->closeButton()->timeOut(4000)->addSuccess('Update category successfully.');
        return redirect('/category/view');
    }
}
