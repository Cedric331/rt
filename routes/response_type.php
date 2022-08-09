<?php

use App\Http\Controllers\ResponseTypeController;
use Illuminate\Support\Facades\Route;


Route::post('response', [ResponseTypeController::class, 'store']);

Route::patch('response/{responseType}', [ResponseTypeController::class, 'update']);

Route::patch('response/rating', [ResponseTypeController::class, 'addRating']);
