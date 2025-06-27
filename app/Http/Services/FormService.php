<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\FormsRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\Form;

class FormService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private Form $form) {}
    public function index()
    {
        return $this->Success(message: 'All form', data: $this->form::all());
    }
    public function store(FormsRequest $request)
    {
        return $this->StoreAction($request, $this->form);
    }
    public function show(Form $form)
    {
        return $this->Success(data: $form);
    }
    public function update($request, $form)
    {
        return $this->UpdateAction($request, $form);
    }
    public function destroy(Form $form)
    {
        return $this->DeleteAction($form);
    }
}
