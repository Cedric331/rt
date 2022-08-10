<?php

use App\Http\Controllers\ResponseTypeController;
use Illuminate\Support\Facades\Route;


Route::post('response', [ResponseTypeController::class, 'store']);

Route::delete('response/{responseType}', [ResponseTypeController::class, 'delete']);

Route::patch('response/{responseType}', [ResponseTypeController::class, 'update']);

Route::put('response/rating', [ResponseTypeController::class, 'addRating']);
