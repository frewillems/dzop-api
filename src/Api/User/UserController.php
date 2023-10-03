<?php

namespace Api\User;

use Api\User\Resources\UserResource;
use Domain\User\Model\User;
use Support\Controller;

class UserController extends Controller
{
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }
}
