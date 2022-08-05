<?php

namespace App\Http\Controllers;

use App\Models\ResponseType;
use Illuminate\Http\Request;

class ResponseTypeController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (Request $request): \Illuminate\Http\JsonResponse
    {
        $response = ResponseType::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'structure_id' => $request->parent_id
        ]);

        $tags = explode(';', $request->tags);
        foreach ($tags as $tag) {
            $response->tags()->firstOrCreate([
                'name' => $tag,
            ]);
        }
        return response()->json($response);
    }
}
