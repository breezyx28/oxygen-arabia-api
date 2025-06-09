<?php

namespace App\Http\Services;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Requests\StoreUsersMessagesRequest;
use App\Http\Traits\ResourcesTrait;
use App\Models\UsersMessage;

class UsersMessagesService
{
    use ResponseSchema, ResourcesTrait;

    public function __construct(private UsersMessage $usersMessage) {}
    public function index()
    {
        return $this->Success(message: 'All users messages', data: $this->usersMessage::all());
    }
    public function store(StoreUsersMessagesRequest $request)
    {
        return $this->StoreAction($request, $this->usersMessage);
    }
    public function show(UsersMessage $usersMessage)
    {
        return $this->Success(data: $usersMessage);
    }
    public function update($request, $usersMessage)
    {
        return $this->UpdateAction($request, $usersMessage);
    }
    public function destroy(UsersMessage $usersMessage)
    {
        return $this->DeleteAction($usersMessage);
    }
}
