<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Project;

class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'notes'
    ];

    public function transform(Project $project)
    {
        return [
            'id'           => (integer) $project->id,
            'status'       => $project->status->name,
            'name'         => $project->name,
            'description'  => $project->description,
            'repository'   => $project->repository,
            'url'          => $project->url,
            'active'       => (boolean) $project->is_active,
            'completed_at' => $project->completed_at,
            'updated_at'   => $project->updated_at->format('F d, Y')
        ];
    }

    public function includeNotes(Project $project)
    {
        $notes = $project->notes;

        return $this->collection($notes, new NoteTransformer);
    }
}
