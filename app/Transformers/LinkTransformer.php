<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Link;

class LinkTransformer extends TransformerAbstract
{

    public function transform(Link $link)
    {
        return [
            'id' => (integer) $link->id,
            'name' => $link->name,
            'href' => $link->href
        ];
    }
}
