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
    public function update (Request $request): \Illuminate\Http\JsonResponse
    {
        $structure = Structure::find($request->structure['id']);
        $structure->name = $request->element;
        $structure->save();

        return response()->json($structure);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete (Request $request): \Illuminate\Http\JsonResponse
    {
        if (key_exists('childrens', $request->structure) && $request->structure['childrens']) {
            $childrens = json_decode($request->structure['childrens']);
            foreach ($childrens as $children) {
                $this->deleteChildrens($children);
            }
        }
        if (key_exists('parent_id', $request->structure) && $request->structure['parent_id']) {
            $this->deleteParent($request->structure['id'], $request->structure['parent_id']);
        }

        $structure = Structure::find($request->structure['id']);
        $responses = $structure->responses;
        foreach ($responses as $response) {
            $response->tags()->detach();
        }
        $structure->delete();

        return response()->json(true);
    }

    private function deleteParent ($id, $parent_id): void
    {
        $parent = Structure::find($parent_id);
        $childrens = json_decode($parent->childrens);
        if (($key = array_search($id, $childrens)) !== false) {
            unset($childrens[$key]);
        }
        $array = [];
        foreach ($childrens as $children) {
            array_push($array, $children);
        }
        $parent->childrens = json_encode($array);
        $parent->save();
    }

    private function deleteChildrens ($children): void
    {
            if ($children) {
                $child = Structure::find($children);
                if ($child) {
                    if (!is_null($child->childrens)) {
                        foreach (json_decode($child->childrens) as $childs) {
                            $this->deleteChildrens($childs);
                        }
                    }
                    if ($child->parent_id) {
                        $this->deleteParent($child->id, $child->parent_id);
                    }
                    $responses = $child->responses;
                    foreach ($responses as $response) {
                        $response->tags()->detach();
                    }
                    $child->delete();
                }
            }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexBack (Request $request): \Illuminate\Http\JsonResponse
    {
        $parent = Structure::find($request->parent)->parent_id;
        $parent_id = null;

        if ($parent) {
            $structure = Structure::find($parent);
            $childrens = $structure->childrens;
            $idChildren = $this->checkChildren(json_decode($childrens));
            $responseChildren = Structure::with('responses.tags')->findMany($idChildren->toArray());

            $collection = $structure->responses()->with('tags')->get();
            foreach ($responseChildren as $children) {
                foreach ($children->responses as $response) {
                    $collection->push($response);
                }
            }
            $parent_id = Structure::findMany(json_decode($childrens))->first()->parent_id;
            return response()->json(['responses' => $collection ,'structures' => Structure::findMany(json_decode($childrens)), 'parent_id' => $parent_id]);

        } else {
            return response()->json(['responses' => null,'structures' => Structure::where('parent_id', null)->get(), 'parent_id' => $parent_id]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check (Request $request): \Illuminate\Http\JsonResponse
    {
        $structure = Structure::find($request->id);

        $idChildren = $this->checkChildren(json_decode($structure->childrens));
        $responseChildren = Structure::with('responses.tags')->findMany($idChildren->toArray());

        $collection = $structure->responses()->with('tags')->get();
        foreach ($responseChildren as $children) {
            foreach ($children->responses as $response) {
                $collection->push($response);
            }
        }

        return response()->json([
            'responses' => $collection,
            'structures' => Structure::findMany(json_decode($structure->childrens))
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Support\Collection
     */
    private function checkChildren ($data): \Illuminate\Support\Collection
    {
        $collect = collect();
        $childrens = collect($data);
        while($childrens->count() > 0){
            $nextChilrdens = collect();
            foreach ($childrens as $children) {
                $collect->push($children);
                $structure = Structure::find($children);
                if ($structure->childrens && count(json_decode($structure->childrens)) > 0) {
                    foreach (json_decode($structure->childrens) as $child) {
                        if ($child) {
                            $nextChilrdens->push($child);
                        }
                    }
                }
            }
            $childrens = $nextChilrdens;
        }
        return $collect;
    }
}
