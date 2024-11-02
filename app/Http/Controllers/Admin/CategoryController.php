<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function view_category()
    {
        $categories = Category::paginate(5);
        return view('admin.category.category', compact('categories'));
    }
    public function add_category(Request $request)
    {
        $category = new Category();
        $category->name = $request->category;
        $category->save();
        return redirect()->back();
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back();
    }

    public function edit_category($id)
    {
        $category = Category::find($id);
        $categories = Category::paginate(5);
        return view('admin.category.edit_category', ['category' => $category, 'categories' => $categories]);
    }

    public function update_category(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->category;
        $category->save();
        return redirect('/category/view');
    }
}
