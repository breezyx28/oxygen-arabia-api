<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactPageRequest;
use App\Http\Requests\Update\UpdateContactPageRequest;
use App\Http\Services\ContactPageService;
use App\Models\ContactPageDetail;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function __construct(private ContactPageService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new ContactPageDetail());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactPageRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactPageDetail $contactPageDetail)
    {
        return $this->service->show($contactPageDetail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactPageRequest $request, ContactPageDetail $contactPageDetail)
    {
        return $this->service->update($request, $contactPageDetail);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactPageDetail $contactPageDetail)
    {
        return $this->service->destroy($contactPageDetail);
    }
}
