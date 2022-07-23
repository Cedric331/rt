<?php

use App\Http\Controllers\StructureController;
use Illuminate\Support\Facades\Route;



Route::get('structure', [StructureController::class, 'index']);

Route::post('structure/check', [StructureController::class, 'check']);

Route::post('structure/add', [StructureController::class, 'store']);
