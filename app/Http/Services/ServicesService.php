<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Service;

class ServicesService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private Service $service) {}

    public function index()
    {
        return $this->Success(message: 'All services', data: $this->service::all());
    }
    public function store(StoreServiceRequest $request)
    {
        return $this->StoreAction($request, $this->service);
    }
    public function show(Service $service)
    {
        return $this->Success(data: $service);
    }
    public function update($request, $service)
    {
        return $this->UpdateAction($request, $service);
    }
    public function destroy(Service $service)
    {
        return $this->DeleteAction($service);
    }
}
