<?php

namespace App\Http\Controllers;

use App\Http\Requests\MainRequest;
use App\Http\Requests\UpdateMainRequest;
use App\Http\Services\MainService;
use App\Models\Main;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct(private MainService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new Main());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Main $main)
    {
        return $this->service->show($main);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMainRequest $request, Main $main)
    {
        return $this->service->update($request, $main);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Main $main)
    {
        return $this->service->destroy($main);
    }
}
