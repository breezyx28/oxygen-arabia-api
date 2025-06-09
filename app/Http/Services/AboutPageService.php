<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StoreAboutPageRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\AboutPageDetail;
use Illuminate\Http\Request;

class AboutPageService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private AboutPageDetail $aboutPage) {}
    public function index()
    {
        return $this->Success(message: 'All about page details', data: $this->aboutPage::all());
    }
    public function store(StoreAboutPageRequest $request)
    {
        return $this->StoreAction($request, $this->aboutPage);
    }
    public function show(AboutPageDetail $aboutPage)
    {
        return $this->Success(data: $aboutPage);
    }
    public function update($request, $aboutPage)
    {
        return $this->UpdateAction($request, $aboutPage);
    }
    public function destroy(AboutPageDetail $aboutPage)
    {
        return $this->DeleteAction($aboutPage);
    }
}
