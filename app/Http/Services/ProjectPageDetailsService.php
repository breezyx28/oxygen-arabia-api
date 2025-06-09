<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StoreProjectPageDetailsRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Project;
use App\Models\ProjectPageDetail;

class ProjectPageDetailsService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private ProjectPageDetail $projectPageDetail) {}
    public function index()
    {
        return $this->Success(message: 'All projects page details', data: $this->projectPageDetail::all());
    }
    public function store(StoreProjectPageDetailsRequest $request)
    {
        return $this->StoreAction($request, $this->projectPageDetail);
    }
    public function show(ProjectPageDetail $projectPageDetail)
    {
        return $this->Success(data: $projectPageDetail);
    }
    public function update($request, $projectPageDetail)
    {
        return $this->UpdateAction($request, $projectPageDetail);
    }
    public function destroy(ProjectPageDetail $projectPageDetail)
    {
        return $this->DeleteAction($projectPageDetail);
    }
}
