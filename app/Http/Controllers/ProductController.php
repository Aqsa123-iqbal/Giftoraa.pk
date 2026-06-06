<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Main Home Page
    public function index(Request $request)
    {
        $category = $request->query('category', 'All');
        $search = $request->query('search');

        $query = Product::query();

        if ($category && $category != 'All') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        $products = $query->get();
        return view('home', compact('products', 'category'));
    }

    // Single Product Detail Page
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-detail', compact('product'));
    }

    // Admin Panel - Manage Products List
    public function adminIndex()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Add Product Form Open
    public function create()
    {
        return view('admin.products.create');
    }

    // Store Product
    public function store(Request $request)
    {
        // Validation: Sirf rules rakhein
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'recipient' => 'required|array',
            'occasion' => 'required|array',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $imageName,
            'recipient' => implode(',', $request->recipient),
            'occasion' => implode(',', $request->occasion),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added!');
    }

    // Edit Form Open
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // Update Data
    public function update(Request $request, $id) 
    {
        // 1. Validation (Validation ke andar implode na use karein)
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable',
            'recipient' => 'required|array',
            'occasion' => 'required|array',
        ]);

        $product = Product::findOrFail($id);

        // 2. Image Update logic
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        // 3. Data Update: Implode validation ke bahar aur update mein karein
        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'recipient' => implode(',', $request->recipient), 
            'occasion' => implode(',', $request->occasion),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    // Delete Product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product Deleted Successfully! 🗑️');
    }
}