<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_category()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
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
}
