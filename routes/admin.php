<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Route;

/** Admin Routes */

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

/** Profile Routes */
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

/** Slider Routes */
Route::resource('slider', SliderController::class);

/** Category Routes */
Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

/** SubCategory Routes */
Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('subcategory', SubCategoryController::class);

/** ChildCategory Routes */
Route::put('childcategory/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('childcategory/get-subcategory', [ChildCategoryController::class, 'getSubCategories'])->name('child-category.get-subcategories');
Route::resource('childcategory', ChildCategoryController::class);

/** Brand Routes */
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

/** Vendor profile Routes */
Route::resource('vendor-profile', AdminVendorProfileController::class);

