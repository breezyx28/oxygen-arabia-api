<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\BannerStoreRequest;
use App\Http\Requests\MainRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Banner;

class BannersService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private Banner $banner) {}
    public function index()
    {
        return $this->Success(message: 'All banner', data: $this->banner::all());
    }
    public function store(BannerStoreRequest $request)
    {
        return $this->StoreAction($request, $this->banner);
    }
    public function show(Banner $banner)
    {
        return $this->Success(data: $banner);
    }
    public function update($request, $banner)
    {
        return $this->UpdateAction($request, $banner);
    }
    public function destroy(Banner $banner)
    {
        return $this->DeleteAction($banner);
    }
}
