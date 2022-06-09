<?php

use Illuminate\Support\Facades\Route;

Route::get("/admin", [\UI\Admin\Http\Controllers\DashboardController::class, 'index'])
    ->name('admin.dashboard.index');
