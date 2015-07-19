<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Exception\HttpResponseException;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Transformers\ProjectTransformer;
use App\Project;

class ProjectsController extends ApiController
{

    protected $project;

    protected $validationRules = [
        'name'         => 'required|unique:projects,name|min:3',
        'description'  => 'required',
        'website'      => 'url',
        'repository'   => 'url',
        'status'       => 'required|exists:statuses,id',
        'is_active'    => 'required',
        'completed_at' => 'date_format:d/m/Y'
    ];

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * @param Manager $fractal
     * @param ProjectTransformer $projectTransformer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Manager $fractal, ProjectTransformer $projectTransformer)
    {
        $projects   = $this->project->with(['notes.links'])->get();
        $collection = new Collection($projects, $projectTransformer);
        $data       = $fractal->createData($collection)->toArray();

        return $this->respondWithCORS($data);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        // $this->validate($request, $this->validationRules);

        try {
            $this->validate($request, $this->validationRules);
        } catch (HttpResponseException $e) {
            return $this->respondWithValidationError();
        }

        $this->project->name         = $request->get('name');
        $this->project->status_id    = $request->get('status');
        $this->project->description  = $request->get('description');
        $this->project->url          = $request->get('url');
        $this->project->repository   = $request->get('repository');
        $this->project->completed_at = $request->get('completed_at');
        $this->project->is_active    = $request->get('is_active');
        $this->project->save();

        return $this->respondCreated('Project was created');
    }

    /**
     * @param $id
     * @param Manager $fractal
     * @param ProjectTransformer $projectTransformer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, Manager $fractal, ProjectTransformer $projectTransformer)
    {
        if (!$project = $this->project->with(['notes.links'])->limit(1)->find($id)) {
            return $this->respondNotFound();
        }

        $item    = new Item($project, $projectTransformer);
        $data    = $fractal->createData($item)->toArray();

        return $this->respond($data);
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return mixed
     */
    public function update($id, Request $request)
    {
        if (!$project = $this->project->with(['notes.links'])->limit(1)->find($id)) {
            return $this->respondNotFound();
        }

        // dd($this->validate($request, $this->validationRules));

        try {
            $this->validate($request, $this->validationRules);
        } catch (HttpResponseException $e) {
            return $this->respondWithValidationError();
        }

        $project->name         = $request->get('name');
        $project->status_id    = $request->get('status');
        $project->description  = $request->get('description');
        $project->url          = $request->get('url');
        $project->repository   = $request->get('repository');
        $project->is_active    = $request->get('is_active');
        $project->completed_at = $request->get('completed_at');
        $project->save();

        return $this->respondCreated('Project was updated');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (!$project = $project = $this->project->with(['notes.links'])->limit(1)->find($id)) {
            return $this->respondNotFound();
        }

        $project->delete();

        return $this->respondOk('Project was deleted');
    }
}
