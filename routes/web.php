<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend/home/index');
});
Route::get('/', [HomeController::class, 'index'])->name('/');
