<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use Illuminate\Http\Request;

class StructureController extends Controller
{

    public function store (Request $request)
    {
        if ($request->parent) {
            $structure = Structure::find($request->parent);

            $array = [];
            $childrens = json_decode($structure->childrens);

            $rand = rand(1,999);
            $store = Structure::create([
                'name' => 'Test'.$rand,
                'parent_id' => json_encode($structure->id),
            ]);

            if (is_array($childrens)) {
                $array = $childrens;
            }
            array_push($array, $store->id);
            $structure->childrens = json_encode($array);
            $structure->save();

            return response()->json(Structure::findMany(json_decode($structure->childrens)));
        } else {
            $store = Structure::create([
                'name' => 'Test'
            ]);

            $structures = $request->structures;
            if (is_array($structures)) {
                array_push($structures, $store);
            } else {
                $structures = $store;
            }

            return response()->json($structures);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check (Request $request): \Illuminate\Http\JsonResponse
    {
        $structures = Structure::find($request->id);

        return response()->json(Structure::findMany(json_decode($structures->childrens)));
    }
}
