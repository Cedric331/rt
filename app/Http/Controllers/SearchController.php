<?php

namespace App\Http\Controllers;

use App\Models\ResponseType;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search (Request $request): \Illuminate\Http\JsonResponse
    {
        $array = explode(' ', $request->search);
        $search = ResponseType::with(['tags', 'structure'])
            ->where(function ($query) use ($array) {
                foreach ($array as $key => $value) {
                    if ($key > 0) {
                        $query->orWhere('titre', 'LIKE', '%'.$value.'%');
                    } else {
                        $query->where('titre', 'LIKE', '%'.$value.'%');
                    }
                }
            })
            ->orWhere(function ($query) use ($array) {
                $query->whereHas('tags', function ($query) use ($array) {
                    $query->where(function ($query) use ($array) {
                        foreach ($array as $key => $value) {
                            if ($key > 0) {
                                $query->orWhere('name', 'LIKE', '%'.$value.'%');
                            } else {
                                $query->where('name', 'LIKE', '%'.$value.'%');
                            }
                        }
                    });
                });
            })
            ->orWhere(function ($query) use ($array) {
                $query->whereHas('structure', function ($query) use ($array) {
                    $query->where(function ($query) use ($array) {
                        foreach ($array as $key => $value) {
                            if ($key > 0) {
                                $query->orWhere('name', 'LIKE', '%'.$value.'%');
                            } else {
                                $query->where('name', 'LIKE', '%'.$value.'%');
                            }
                        }
                    });
                });
            })
            ->orderBy('rating', 'DESC')
            ->get();

        return response()->json($search);
    }
}
