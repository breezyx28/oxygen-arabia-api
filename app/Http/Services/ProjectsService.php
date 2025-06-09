<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Project;

class ProjectsService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private Project $project) {}
    public function index()
    {
        return $this->Success(message: 'All projects', data: $this->project::all());
    }
    public function store(StoreProjectRequest $request)
    {
        return $this->StoreAction($request, $this->project);
    }
    public function show(Project $project)
    {
        return $this->Success(data: $project);
    }
    public function update($request, $project)
    {
        return $this->UpdateAction($request, $project);
    }
    public function destroy(Project $project)
    {
        return $this->DeleteAction($project);
    }
}
