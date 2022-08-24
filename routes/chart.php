<?php

use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;



Route::get('chart/refresh', [ChartController::class, 'resfreshChart']);

Route::get('chart/reset', [ChartController::class, 'resetData']);
