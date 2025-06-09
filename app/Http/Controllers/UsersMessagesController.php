<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersMessagesRequest;
use App\Http\Requests\Update\UpdateUsersMessagesRequest;
use App\Http\Services\UsersMessagesService;
use App\Models\UsersMessage;
use Illuminate\Http\Request;

class UsersMessagesController extends Controller
{
    public function __construct(private UsersMessagesService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->index();
    }

    public function last()
    {
        return $this->LastRecord(new UsersMessage());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsersMessagesRequest $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(UsersMessage $usersMessages)
    {
        return $this->service->show($usersMessages);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersMessagesRequest $request, UsersMessage $usersMessages)
    {
        return $this->service->update($request, $usersMessages);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UsersMessage $usersMessages)
    {
        return $this->service->destroy($usersMessages);
    }
}
