<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\TempImagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\ProductController;
use Illuminate\Http\Request;

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
    return view('welcome');
});

Route::get('/admin/login', [AdminLoginController::class, 'index']);

Route::group(['prefix' => 'admin'], function() {
    Route::group(['middleware' => 'admin.guest'], function() {
            Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
            Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function() {
            Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
            Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

            // Categories
            Route::get('/category/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::get('/category/{categories}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('/category/{categories}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/category/{categories}', [CategoryController::class, 'destroy'])->name('categories.delete');
            Route::post('/category', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');

            // upload image
            Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');

            // Sub Category
            Route::get('/sub-category', [SubCategoryController::class, 'index'])->name('sub-categories.index');
            Route::get('/sub-category/create', [SubCategoryController::class, 'create'])->name('sub-categories.create');
            Route::post('/sub-category', [SubCategoryController::class, 'store'])->name('sub-categories.store');
            Route::get('/sub-category/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');
            Route::put('/sub-category/{subCategory}', [SubCategoryController::class, 'update'])->name('sub-categories.update');
            Route::delete('/sub-category/{subCategory}', [SubCategoryController::class, 'destroy'])->name('sub-categories.delete');

            // Brand Routes
            Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
            Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
            Route::post('/brand', [BrandController::class, 'store'])->name('brand.store');
            Route::get('/brand/{brands}/edit', [BrandController::class, 'edit'])->name('brand.edit');
            Route::put('/brand/{brands}', [BrandController::class, 'update'])->name('brand.update');
            Route::delete('/brand/{brands}', [BrandController::class, 'destroy'])->name('brand.delete');

            // Product
            Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');

            Route::get('/getSlug', function(Request $request) {
                $slug = '';
                if(!empty($request->title)) {
                    $slug = $request->title;
                }

                return response()->json([
                    'status' => true,
                    'slug' => $slug
                ]);
            })->name('getSlug');
    });
});
