<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Catch_;

class ProductController extends Controller
{

    public function view()
    {
        $products = Product::all();
        // dd($products);
        return view('admin.product.view', compact('products'));
    }
    public function add()
    {
        $categories = Category::all();
        return view('admin.product.add', compact('categories'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required | max:50',
            'description' => ['required', 'max:400'],
            'category_id' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'status' => 'required',
            'quantity' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/products'), $imageName);
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->image = '/images/products/' . $imageName;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->save();
        return redirect()->route('admin.product.view')->with('message', 'Product Added Successfully');
    }
}
