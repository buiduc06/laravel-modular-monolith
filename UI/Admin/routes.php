<?php

use Illuminate\Support\Facades\Route;

Route::get("/admin/products", [\UI\Admin\Http\Controllers\ProductController::class, 'index'])->name('admin.products.index');
Route::get("/admin/products/{id}", [\UI\Admin\Http\Controllers\ProductController::class, 'show'])->name('admin.products.show');
