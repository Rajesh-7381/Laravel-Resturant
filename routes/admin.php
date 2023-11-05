<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


// Route::get('/admin/dashboard',[AdminController::class,'index'])->middleware('auth','role:admin')->name('admin.dashboard');

// we just simpley remove(middleware('auth','role:admin')) because we add authentication routeserviceprovider instead of that
Route::group(['prefix'=>'admin','as'=>'admin.'], function() {
    // Here, we're using Route::group() to group routes that share common attributes.
    // 'prefix'=>'admin' adds a prefix 'admin' to all routes within this group.
    // 'as'=>'admin.' assigns a namespace 'admin' to the route names using route helper functions.

    Route::get('dashboard', [AdminController::class, 'index'])
        ->name('dashboard');
    // This line declares a GET route for 'admin/dashboard'.
    // [AdminController::class, 'index'] refers to the controller and method to be executed when this route is accessed.

    // The ->name('dashboard') gives this route a unique name 'admin.dashboard' that can be used in route helper functions.
    // This name can be used to generate URLs or redirects within your Laravel application.
});
