<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormsRequest;
use App\Http\Requests\Update\UpdateFormsRequest;
use App\Http\Services\FormService;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function __construct(private FormService $service) {}

    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new Form());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormsRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        return $this->service->show($form);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormsRequest $request, Form $form)
    {
        return $this->service->update($request, $form);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        return $this->service->destroy($form);
    }
}
