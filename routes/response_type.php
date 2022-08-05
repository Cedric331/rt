<?php

use App\Http\Controllers\ResponseTypeController;
use Illuminate\Support\Facades\Route;


Route::post('response', [ResponseTypeController::class, 'store']);
