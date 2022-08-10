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
            if ($tag) {
                $response->tags()->firstOrCreate([
                    'name' => $tag,
                ]);
            }
        }
        return response()->json(ResponseType::with('tags')->find($response->id));
    }

    /**
     * @param Request $request
     * @param ResponseType $responseType
     * @return \Illuminate\Http\JsonResponse
     */
    public function update (Request $request, ResponseType $responseType): \Illuminate\Http\JsonResponse
    {
        $responseType->update([
            'titre' => $request->titre,
            'contenu' => $request->contenu
        ]);

        $tags = explode(';', $request->tags);
        $responseType->tags()->detach();
        foreach ($tags as $tag) {
            if ($tag) {
                $responseType->tags()->firstOrCreate([
                    'name' => $tag,
                ]);
            }
        }
        return response()->json(ResponseType::with('tags')->find($responseType->id));
    }

    /**
     * @param ResponseType $responseType
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete (ResponseType $responseType): \Illuminate\Http\JsonResponse
    {
        $delete = $responseType->delete();

        return response()->json($delete);
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
