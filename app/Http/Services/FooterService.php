<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StoreFooterRequest;
use App\Http\Requests\StoreHeroRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private Footer $footer) {}
    public function index()
    {
        return $this->Success(message: 'All footer', data: $this->footer::all());
    }
    public function store(StoreFooterRequest $request)
    {
        return $this->StoreAction($request, $this->footer);
    }
    public function show(Footer $footer)
    {
        return $this->Success(data: $footer);
    }
    public function update($request, $footer)
    {
        return $this->UpdateAction($request, $footer);
    }
    public function destroy(Footer $footer)
    {
        return $this->DeleteAction($footer);
    }
}
