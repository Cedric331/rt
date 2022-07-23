<?php

use App\Http\Controllers\StructureController;
use Illuminate\Support\Facades\Route;



Route::post('structure/check', [StructureController::class, 'check']);

Route::post('structure/add', [StructureController::class, 'store']);
