<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/admin', function () {
//     return view('admin.index');
// })->middleware(['auth', 'role:admin'])->name('admin.index');
Route::get('/about', function () {
    return view('about.index');
})->name('about');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('/admin', function () {
    //     return view('admin.index');
    // })->name('admin.index');
    Route::get('/admin', [\App\Http\Controllers\ProductController::class, 'indexAdmin'])->name('admin.index');
    Route::get('/admin/products', [\App\Http\Controllers\ProductController::class, 'indexAdmin'])->name('admin.products.index');

    Route::get('/admin/products/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [\App\Http\Controllers\ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}',  [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/admin/payments', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('admin.payments.index');
    Route::get('/admin/customers', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.customers.index');

    Route::get('/fabric-types/create', [ProductController::class, 'createFabricType'])->name('admin.fabricTypes.create');
    Route::post('/fabric-types', [ProductController::class, 'storeFabricType'])->name('admin.fabricTypes.store');
    Route::get('/fabric-variants/create', [ProductController::class, 'createFabricVariant'])->name('admin.fabricVariants.create');
    Route::post('/fabric-variants', [ProductController::class, 'storeFabricVariant'])->name('admin.fabricVariants.store');

    Route::get('confirm-payment', [\App\Http\Controllers\AdminController::class, 'confirmPaymentIndex'])->name('admin.paymentindex');
    Route::patch('confirm-payment/{id}', [\App\Http\Controllers\AdminController::class, 'confirmPayment'])->name('admin.confirm');

    Route::get('/admin/customers', [App\Http\Controllers\ProfileController::class, 'customers'])->name('admin.customers.index');

    Route::get('/admin/sales-report', [\App\Http\Controllers\AdminController::class, 'salesReport'])->name('admin.sales-report');
});

// Route::middleware(['auth', 'role:user'])->group(function () {
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout/confirm', [CartController::class, 'confirmCheckout'])->name('checkout.confirm');

// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // routes/web.php

    Route::get('/profile/order-history', [ProfileController::class, 'orderHistory'])->name('profile.order-history')->middleware('auth');
});

Route::middleware('auth', 'role:user')->group(function () {
    Route::get('/modal/profile-update', [ProfileController::class, 'editModal'])->name('profile.editModal');
    Route::patch('/profile/modal', [ProfileController::class, 'updateProfileModal'])->name('profile.updateModal');
});


Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/carts', [CartController::class, 'index'])->name('cart.index');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::put('/cart/{id}/update', [CartController::class, 'updateCart'])->name('cart.update');



Route::delete('/cart/{id}/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/{id}/edit', [CartController::class, 'editCart'])->name('cart.edit');
Route::get('/product2', [\App\Http\Controllers\ProductController::class, 'index2'])->name('products.index2');
require __DIR__ . '/auth.php';
