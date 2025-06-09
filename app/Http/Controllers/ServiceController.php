<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\Update\UpdateServiceRequest;
use App\Http\Services\ServicesService;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private ServicesService $service) {}
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new Service());
    }

    public function store(StoreServiceRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return $this->service->show($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        return $this->service->update($request, $service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        return $this->service->destroy($service);
    }
}
