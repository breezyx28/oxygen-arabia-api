<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StoreHeroRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Hero;

class HeroService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private Hero $hero) {}
    public function index()
    {
        return $this->Success(message: 'All hero', data: $this->hero::all());
    }
    public function store(StoreHeroRequest $request)
    {
        return $this->StoreAction($request, $this->hero);
    }
    public function show(Hero $hero)
    {
        return $this->Success(data: $hero);
    }
    public function update($request, $hero)
    {
        return $this->UpdateAction($request, $hero);
    }
    public function destroy(Hero $hero)
    {
        return $this->DeleteAction($hero);
    }
}
