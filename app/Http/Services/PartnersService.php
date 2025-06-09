<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Partner;

class PartnersService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private Partner $partner) {}
    public function index()
    {
        return $this->Success(message: 'All partners', data: $this->partner::all());
    }
    public function store(StorePartnerRequest $request)
    {
        return $this->StoreAction($request, $this->partner);
    }
    public function show(Partner $partner)
    {
        return $this->Success(data: $partner);
    }
    public function update($request, $partner)
    {
        return $this->UpdateAction($request, $partner);
    }
    public function destroy(Partner $partner)
    {
        return $this->DeleteAction($partner);
    }
}
