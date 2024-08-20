<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function view()
    {
        return view('admin.product.view');
    }
    public function add()
    {
        return view('admin.product.add');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required | max:50',
            'description' => ['required', 'max:400'],
            'price' => 'required | numeric',
            'image' => 'required | image',
        ]);
        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $image_name);
        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $image_name
        ]);
    }
}
