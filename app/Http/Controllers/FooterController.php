<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFooterRequest;
use App\Http\Requests\Update\UpdateFooterRequest;
use App\Http\Services\FooterService;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function __construct(private FooterService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new Footer());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFooterRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Footer $hero)
    {
        return $this->service->show($hero);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFooterRequest $request, Footer $footer)
    {
        return $this->service->update($request, $footer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Footer $hero)
    {
        return $this->service->destroy($hero);
    }
}
