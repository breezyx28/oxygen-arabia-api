<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StoreContactRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Contact;

class ContactService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private Contact $contact) {}
    public function index()
    {
        return $this->Success(message: 'All contacts', data: $this->contact::all());
    }
    public function store(StoreContactRequest $request)
    {
        return $this->StoreAction($request, $this->contact);
    }
    public function show(Contact $contact)
    {
        return $this->Success(data: $contact);
    }
    public function update($request, $contact)
    {
        return $this->UpdateAction($request, $contact);
    }
    public function destroy(Contact $contact)
    {
        return $this->DeleteAction($contact);
    }
}
