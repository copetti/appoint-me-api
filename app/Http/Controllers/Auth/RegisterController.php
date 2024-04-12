<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\UserHasBeenTakenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResgisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class RegisterController extends Controller
{
    public function __invoke(ResgisterRequest $request): UserResource
    {

        $input = $request->validated();

        if(User::query()->whereEmail($input['email'])->exists()){
            throw new UserHasBeenTakenException();
        }

        $user = User::query()->create([
            ...$input,
            'password' => bcrypt($input['password'])
        ]);

        return new UserResource($user);
    }
}
