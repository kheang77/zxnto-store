<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function getProduct(Request $request)
    {
        $data['title'] = 'Products Catalog';
        
        $query = Product::with('category');
        
        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Filter by category
        if ($request->filled('category')) {
            $query->where('cat_id', $request->category);
        }
        
        // Sort
        $sort = $request->get('sort', 'id');
        $direction = 'desc';
        switch ($sort) {
            case 'price':
                $query->orderBy('price', $direction);
                break;
            case 'name':
                $query->orderBy('name', $direction);
                break;
            default:
                $query->orderBy('id', $direction);
                break;
        }
        
        $data['product'] = $query->paginate(12);
        $data['product']->appends($request->query());
        $data['categories'] = Category::orderBy('name')->get();
        
        return view('product', $data);
    }

    public function form_product()
    {
        $data['title'] = 'Add Product';
        $data['categories'] = Category::orderBy('name')->get();
        return view('form_product', $data);
    }

    public function saveProduct(Request $request)
    {
        $img = 'default.jpg';
        if ($request->hasFile('photo')) {
            $img = $request->file('photo')->store('photos', 'public');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'description' => 'required|string',
            'cat_id' => 'required|integer',
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'qty' => $request->qty,
            'description' => $request->description,
            'img' => $img,
            'cat_id' => $request->cat_id,
        ]);
        
        return redirect('/product')->with('success', 'Product added successfully!');
    }
}

