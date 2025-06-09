<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHeroRequest;
use App\Http\Requests\Update\UpdateHeroRequest;
use App\Http\Services\HeroService;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function __construct(private HeroService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new Hero());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeroRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        return $this->service->show($hero);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeroRequest $request, Hero $hero)
    {
        return $this->service->update($request, $hero);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        return $this->service->destroy($hero);
    }
}
