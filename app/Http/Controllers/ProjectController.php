<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Services\ProjectsService;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private ProjectsService $service) {}
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new Project());
    }

    public function store(StoreProjectRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return $this->service->show($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        return $this->service->destroy($project);
    }
}
