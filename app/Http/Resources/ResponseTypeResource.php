<?php

namespace App\Http\Resources;

use App\Models\ResponseType;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ResponseTypeResource extends ResourceCollection
{

    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function toArray($request)
    {
        $collect = collect();
        foreach ($this as $item) {
            $array = $this->filterString($item->titre);
             foreach ($item->tags as $tag) {
                 array_push($array, strtolower($tag->name));
             }
            $item['itemSearch'] = $array;
             $collect->push($item);
        }

        return $collect;
    }

    public function filterString (string $data): array
    {
        $titres = explode(' ', $data);
        $array = [];
             foreach ($titres as $titre) {
                 $caracSpeciaux = array("(", ")", "@", ":", "-", "_", "!", ".", "#", "+", "*", ",", "?", "/", "{", "}", "=", "~");
                 $texte = str_replace($caracSpeciaux, "", $titre);
                 $texteStrtr= strtr($texte, "ÀÁÂàÄÅàáâàäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏ" . "ìíîïÙÚÛÜùúûüÿÑñ", "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
                 array_push($array, strtolower(mb_convert_encoding($texteStrtr, 'UTF-8', 'UTF-8')));
             }

        return $array;
    }
}
