<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\MainRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Main;

class MainService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private Main $main) {}
    public function index()
    {
        return $this->Success(message: 'All main', data: $this->main::all());
    }
    public function store(MainRequest $request)
    {
        return $this->StoreAction($request, $this->main);
    }
    public function show(Main $main)
    {
        return $this->Success(data: $main);
    }
    public function update($request, $main)
    {
        return $this->UpdateAction($request, $main);
    }
    public function destroy(Main $main)
    {
        return $this->DeleteAction($main);
    }
}
