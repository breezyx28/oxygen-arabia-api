<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\StoreSubserviceRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Service;
use App\Models\Subservice;

class SubServicesService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private Subservice $subservice) {}
    public function index()
    {
        return $this->Success(message: 'All sub-services', data: $this->subservice::all());
    }
    public function store(StoreSubserviceRequest $request)
    {
        return $this->StoreAction($request, $this->subservice);
    }
    public function show(Subservice $subservice)
    {
        return $this->Success(data: $subservice);
    }
    public function update($request, $subservice)
    {
        return $this->UpdateAction($request, $subservice);
    }
    public function destroy(Subservice $subservice)
    {
        return $this->DeleteAction($subservice);
    }
}
