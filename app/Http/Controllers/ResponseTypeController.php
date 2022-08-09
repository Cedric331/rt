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
        return response()->json($response->with('tags'));
    }

    /**
     * @param Request $request
     * @param ResponseType $responseType
     * @return \Illuminate\Http\JsonResponse
     */
    public function update (Request $request, ResponseType $responseType): \Illuminate\Http\JsonResponse
    {
        $update = $responseType->update([
            'titre' => $request->titre,
            'contenu' => $request->contenu
        ]);

        // Gestion des tags

        return response()->json($update);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function addRating (Request $request): bool
    {
        $response = ResponseType::find($request->id);
        $response->rating++;
        $response->save();

        return true;
    }

}
