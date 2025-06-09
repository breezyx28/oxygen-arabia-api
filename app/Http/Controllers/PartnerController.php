<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\Update\UpdatePartnerRequest;
use App\Http\Services\PartnersService;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function __construct(private PartnersService $service) {}
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new Partner());
    }

    public function store(StorePartnerRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        return $this->service->show($partner);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        return $this->service->update($request, $partner);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        return $this->service->destroy($partner);
    }
}
