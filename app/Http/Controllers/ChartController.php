<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function resfreshChart (): \Illuminate\Http\JsonResponse
    {
        return response()->json(User::select('name', 'use_rt')->get());
    }
}
