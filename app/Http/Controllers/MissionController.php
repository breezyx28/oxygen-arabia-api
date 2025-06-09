<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMissionRequest;
use App\Http\Requests\Update\UpdateMissionRequest;
use App\Http\Services\MissionService;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function __construct(private MissionService $service) {}
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new Mission());
    }

    public function store(StoreMissionRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        return $this->service->show($mission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMissionRequest $request, Mission $mission)
    {
        return $this->service->update($request, $mission);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        return $this->service->destroy($mission);
    }
}
