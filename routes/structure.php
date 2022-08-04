<?php

use App\Http\Controllers\StructureController;
use Illuminate\Support\Facades\Route;



Route::get('structure', [StructureController::class, 'index']);

Route::post('structure', [StructureController::class, 'indexBack']);

Route::post('structure/check', [StructureController::class, 'check']);

Route::post('structure/add', [StructureController::class, 'store']);

Route::patch('structure/update', [StructureController::class, 'update']);

Route::delete('structure/delete', [StructureController::class, 'delete']);
