<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubserviceRequest;
use App\Http\Requests\Update\UpdateSubserviceRequest;
use App\Http\Services\SubServicesService;
use App\Models\Subservice;
use Illuminate\Http\Request;

class SubserviceController extends Controller
{
    public function __construct(private SubServicesService $service) {}
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new Subservice());
    }

    public function store(StoreSubserviceRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subservice $Subservice)
    {
        return $this->service->show($Subservice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubserviceRequest $request, Subservice $subservice)
    {
        return $this->service->update($request, $subservice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subservice $Subservice)
    {
        return $this->service->destroy($Subservice);
    }
}
