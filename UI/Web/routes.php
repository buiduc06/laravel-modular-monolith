<?php

use Illuminate\Support\Facades\Route;

Route::get("/", [\UI\Web\Http\Controllers\ProductController::class, 'index'])->name('index');
Route::get("/products/{id}", [\UI\Web\Http\Controllers\ProductController::class, 'show'])->name('products.show');
