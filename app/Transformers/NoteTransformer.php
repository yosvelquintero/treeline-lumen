<?php
namespace App\Transformers;

use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use App\Note;

class NoteTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'links'
    ];

    public function transform(Note $note)
    {
        return [
            'id'          => (integer) $note->id,
            'title'       => $note->title,
            'description' => $note->description,
            'stamp'       => $note->stamp->format('d/m/Y')
        ];
    }

    public function includeLinks(Note $note)
    {
        $links = $note->links;

        return $this->collection($links, new LinkTransformer);
    }
}
