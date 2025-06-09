<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAboutPageRequest;
use App\Http\Requests\Update\UpdateAboutPageRequest;
use App\Http\Services\AboutPageService;
use App\Models\AboutPageDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AboutPageController extends Controller
{
    public function __construct(private AboutPageService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new AboutPageDetail());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAboutPageRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutPageDetail $aboutPageDetail)
    {
        return $this->service->show($aboutPageDetail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutPageRequest $request, AboutPageDetail $aboutPageDetail)
    {
        Log::alert('about-page', [
            'about-page' => $aboutPageDetail
        ]);

        return $this->service->update($request, $aboutPageDetail);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutPageDetail $aboutPageDetail)
    {
        return $this->service->destroy($aboutPageDetail);
    }
}
