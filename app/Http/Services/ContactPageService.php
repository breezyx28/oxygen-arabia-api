<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StoreContactPageRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\ContactPageDetail;
use Illuminate\Http\Request;

class ContactPageService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private ContactPageDetail $contactPage) {}

    public function index()
    {
        return $this->Success(message: 'All contact page details', data: $this->contactPage::all());
    }
    public function store(StoreContactPageRequest $request)
    {
        return $this->StoreAction($request, $this->contactPage);
    }
    public function show(ContactPageDetail $contactPage)
    {
        return $this->Success(data: $contactPage);
    }
    public function update($request, $contactPage)
    {
        return $this->UpdateAction($request, $contactPage);
    }
    public function destroy(ContactPageDetail $contactPage)
    {
        return $this->DeleteAction($contactPage);
    }
}
