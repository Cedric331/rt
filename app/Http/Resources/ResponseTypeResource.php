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
//                 $texteStrtr = str_replace(array("È","É","Ê","Ë","è","é","ê","ë"), 'e', $texte);
//                 $texteStrtr = str_replace(array("À","Á","Â","à","Ä","Å","à","á","â","à","ä","å"), 'a', $texteStrtr);
//                 $texteStrtr = str_replace(array("Ò","Ó","Ô","Õ","Ö","Ø","ò","ó","ô","õ","ö"), 'o', $texteStrtr);
//                 $texteStrtr = str_replace(array("Ì","Í","Î","Ï","ì","í","î","ï"), 'i', $texteStrtr);
//                 $texteStrtr = str_replace(array("Ù","Ú","Û","Ü","ù","ú","û","ü"), 'u', $texteStrtr);
                 $table = array(
                     'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
                     'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                     'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
                     'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
                     'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
                     'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
                     'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
                     'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
                 );

                 $texteStrtr = strtr($texte, $table);
                 array_push($array, strtolower(mb_convert_encoding($texteStrtr, 'UTF-8')));
             }

        return $array;
    }
}
