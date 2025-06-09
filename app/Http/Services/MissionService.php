<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StoreMissionRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Mission;

class MissionService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private Mission $mission) {}
    public function index()
    {
        return $this->Success(message: 'All missions', data: $this->mission::all());
    }
    public function store(StoreMissionRequest $request)
    {
        return $this->StoreAction($request, $this->mission);
    }
    public function show(Mission $mission)
    {
        return $this->Success(data: $mission);
    }
    public function update($request, $mission)
    {
        return $this->UpdateAction($request, $mission);
    }
    public function destroy(Mission $mission)
    {
        return $this->DeleteAction($mission);
    }
}
