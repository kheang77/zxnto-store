<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\usercontroller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    // Get up to 3 products per category so all brands show
    $categories = \App\Models\Category::orderBy('name')->get();
    $featured = \App\Models\Product::with('category')
        ->whereIn('cat_id', $categories->pluck('id'))
        ->get()
        ->groupBy('cat_id')
        ->flatMap(fn($group) => $group->take(3))
        ->values();
    return view('home', compact('featured', 'categories'));
});

Route::get('beltei/it', function () {
    return view('it');
});

// page/civil cuz vea nv in file
Route::get('page/civil', [PageController::class, 'home']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/beltei/about{data}', function ($data) {
    return view('about',compact('data'));
});

Route::get('beltei/register', function () {
    return view('register');
});


Route::post('beltei/register',[PageController::class,'getData'] );

// week5
// view simple
Route::get('beltei/display', function () {
    return view('display');
});
// view tam controller : display
Route::post('beltei/submit',[PageController::class,'ShowAvg'] );

Route::get('/master', function () {
    return view('master');
});

Route::get('/product', [ProductController::class, 'getProduct']);

Route::get('product/add', [ProductController::class, 'form_product']);

Route::post('product/save', [ProductController::class, 'saveProduct']);

Route::get('user/login', function(){
    return view('page.login');
});

Route::post('user/check',[usercontroller::class,'checklogin'] );

Route::get('user/logout', function () {
    session()->forget(['user', 'role', 'cart']);
    return redirect('/');
});

// ── ADMIN ──
use App\Http\Controllers\AdminController;
Route::prefix('admin')->group(function () {
    Route::get('/',                               [AdminController::class, 'dashboard']);
    Route::get('/products',                       [AdminController::class, 'products']);
    Route::get('/products/create',                [AdminController::class, 'createProduct']);
    Route::post('/products/store',                [AdminController::class, 'storeProduct']);
    Route::get('/products/{id}/edit',             [AdminController::class, 'editProduct']);
    Route::post('/products/{id}/update',          [AdminController::class, 'updateProduct']);
    Route::post('/products/{id}/delete',          [AdminController::class, 'deleteProduct']);
    Route::get('/categories',                     [AdminController::class, 'categories']);
    Route::post('/categories/store',              [AdminController::class, 'storeCategory']);
    Route::post('/categories/{id}/update',        [AdminController::class, 'updateCategory']);
    Route::post('/categories/{id}/delete',        [AdminController::class, 'deleteCategory']);
    Route::get('/orders',                         [AdminController::class, 'orders']);
    Route::post('/orders/{id}/status',            [AdminController::class, 'updateOrderStatus']);
});

// ── CART ──
use App\Http\Controllers\CartController;
Route::get('/cart',            [CartController::class, 'index']);
Route::post('/cart/add',       [CartController::class, 'add']);
Route::post('/cart/remove',    [CartController::class, 'remove']);
Route::post('/cart/update',    [CartController::class, 'update']);
Route::post('/cart/clear',     [CartController::class, 'clear']);

// ── CHECKOUT ──
use App\Http\Controllers\CheckoutController;
Route::get('/checkout',                    [CheckoutController::class, 'index']);
Route::post('/checkout',                   [CheckoutController::class, 'store']);
Route::get('/checkout/success/{order}',    [CheckoutController::class, 'success']);