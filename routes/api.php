<?php

use App\Http\Controllers\Api\ImageApiController;
use Illuminate\Support\Facades\Route;

Route::resource('dashboard', ImageApiController::class);