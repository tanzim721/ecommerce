<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function view()
    {
        $products = Product::with('category')->paginate(5);
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
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'status' => 'required',
            'quantity' => 'required'
        ]);

        $filePaths = [];
        // Check if files exist in the request
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                // Store each file and get its storage path
                $path = $file->store('images', 'public');
                $filePaths[] = $path;
            }
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // $imageName = time() . '.' . $request->image->extension();
        // $request->image->move(public_path('images/products'), $imageName);
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->image = json_encode($filePaths);
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->save();
        return redirect()->route('admin.product.view')->with('message', 'Product Added Successfully');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.product.add', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required | max:50',
            'description' => ['required', 'max:400'],
            'category_id' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            'status' => 'required',
            'quantity' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $product->image = '/images/products/' . $imageName;
        }
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->save();
        return redirect()->route('admin.product.view')->with('message', 'Product Updated Successfully');
    }

    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);
            
            // Optional: Delete associated images from storage
            if ($product->image) {
                $images = json_decode($product->image);
                foreach ($images as $img) {
                    // Use Storage facade to delete files
                    Storage::delete('public/' . $img);
                }
            }
            
            // Delete the product
            $product->delete();
            
            // Redirect back to the products view page with a success message
            return redirect()->route('admin.product.view')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Product deletion error: ' . $e->getMessage());
            
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to delete the product. Please try again.');
        }
    }
}
