<?php

namespace App\Http\Controllers;

use App\Models\ResponseType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResponseTypeController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'titre' => 'required|max:50|string',
            'contenu' => 'required|string',
            'tags' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

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
        $request->validate([
            'titre' => 'bail|required|max:50|string',
            'contenu' => 'bail|required|string',
            'tags' => 'bail|nullable|string'
        ]);

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
        $user = User::find(Auth::id());
        $user->increment('use_rt');
        $user->save();

        $response = ResponseType::find($request->id);
        $response->rating++;
        $response->save();

        return true;
    }

}
