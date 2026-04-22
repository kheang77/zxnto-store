<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    // ── MIDDLEWARE CHECK ──
    private function guard()
    {
        if (session('role') !== 'admin') {
            abort(403, 'Access denied.');
        }
    }

    // ── DASHBOARD ──
    public function dashboard()
    {
        $this->guard();
        $data['totalProducts']   = Product::count();
        $data['totalCategories'] = Category::count();
        $data['lowStock']        = Product::where('qty', '<=', 5)->count();
        $data['outOfStock']      = Product::where('qty', 0)->count();
        $data['recentProducts']  = Product::with('category')->latest()->take(5)->get();
        $data['categories']      = Category::withCount('products')->get();
        $data['totalOrders']     = \App\Models\Order::count();
        $data['pendingOrders']   = \App\Models\Order::where('status','pending')->count();
        return view('admin.dashboard', $data);
    }

    // ── PRODUCTS ──
    public function products(Request $request)
    {
        $this->guard();
        $query = Product::with('category');
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        if ($request->filled('category')) {
            $query->where('cat_id', $request->category);
        }
        $data['products']   = $query->latest()->paginate(10)->appends($request->query());
        $data['categories'] = Category::orderBy('name')->get();
        return view('admin.products', $data);
    }

    public function createProduct()
    {
        $this->guard();
        return view('admin.product_form', ['categories' => Category::orderBy('name')->get(), 'product' => null]);
    }

    public function storeProduct(Request $request)
    {
        $this->guard();
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'qty'         => 'required|integer|min:0',
            'description' => 'required|string',
            'cat_id'      => 'required|integer',
        ]);

        $img = 'default.jpg';
        if ($request->hasFile('photo')) {
            $img = $request->file('photo')->store('photos', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'qty'         => $request->qty,
            'description' => $request->description,
            'img'         => $img,
            'cat_id'      => $request->cat_id,
        ]);

        return redirect('/admin/products')->with('success', 'Product added successfully.');
    }

    public function editProduct($id)
    {
        $this->guard();
        return view('admin.product_form', [
            'product'    => Product::findOrFail($id),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function updateProduct(Request $request, $id)
    {
        $this->guard();
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'qty'         => 'required|integer|min:0',
            'description' => 'required|string',
            'cat_id'      => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $img = $product->img;
        if ($request->hasFile('photo')) {
            $img = $request->file('photo')->store('photos', 'public');
        }

        $product->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'qty'         => $request->qty,
            'description' => $request->description,
            'img'         => $img,
            'cat_id'      => $request->cat_id,
        ]);

        return redirect('/admin/products')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        $this->guard();
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Product deleted.');
    }

    // ── ORDERS ──
    public function orders()
    {
        $this->guard();
        $orders = \App\Models\Order::latest()->paginate(15);
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $this->guard();
        \App\Models\Order::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Order status updated.');
    }
    public function categories()
    {
        $this->guard();
        return view('admin.categories', ['categories' => Category::withCount('products')->latest()->paginate(15)]);
    }

    public function storeCategory(Request $request)
    {
        $this->guard();
        $request->validate(['name' => 'required|string|max:255|unique:tbl_category,name']);
        Category::create(['name' => $request->name]);
        return back()->with('success', 'Category added.');
    }

    public function updateCategory(Request $request, $id)
    {
        $this->guard();
        $request->validate(['name' => 'required|string|max:255']);
        Category::findOrFail($id)->update(['name' => $request->name]);
        return back()->with('success', 'Category updated.');
    }

    public function deleteCategory($id)
    {
        $this->guard();
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category deleted.');
    }
}
