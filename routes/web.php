<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;

Route::get('/', function () { return redirect('/admin/'); });
Route::get('/s/{code}', RedirectController::class);
require __DIR__.'/auth.php';
