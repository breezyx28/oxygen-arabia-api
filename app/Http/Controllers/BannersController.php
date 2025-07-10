<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerStoreRequest;
use App\Http\Requests\Update\BannerUpdateRequest;
use App\Http\Services\BannersService;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function __construct(private BannersService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new Banner());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerStoreRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return $this->service->show($banner);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerUpdateRequest $request, Banner $banner)
    {
        return $this->service->update($request, $banner);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        return $this->service->destroy($banner);
    }
}
