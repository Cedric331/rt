<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function check (Request $request)
    {
        $structures = Structure::find($request->id);

        return response()->json(Structure::findMany(json_decode($structures->childrens)));
    }
}
