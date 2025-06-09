<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectPageDetailsRequest;
use App\Http\Requests\Update\UpdateProjectPageDetailsRequest;
use App\Http\Services\ProjectPageDetailsService;
use App\Models\ProjectPageDetail;
use Illuminate\Http\Request;

class ProjectPageDetailsController extends Controller
{
    public function __construct(private ProjectPageDetailsService $service) {}
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new ProjectPageDetail());
    }

    public function store(StoreProjectPageDetailsRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectPageDetail $project)
    {
        return $this->service->show($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectPageDetailsRequest $request, ProjectPageDetail $projectPageDetail)
    {
        return $this->service->update($request, $projectPageDetail);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectPageDetail $project)
    {
        return $this->service->destroy($project);
    }
}
