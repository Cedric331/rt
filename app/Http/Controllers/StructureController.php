<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index (): \Illuminate\Http\JsonResponse
    {
        return response()->json(Structure::where('parent_id', null)->get());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->parent) {
            $structure = Structure::find($request->parent);

            $array = [];
            $childrens = json_decode($structure->childrens);

            $store = Structure::create([
                'name' => $request->element,
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
                'name' => $request->element
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
