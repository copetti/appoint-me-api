<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Exceptions\UserHasBeenTakenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResgisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Str;

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
            'token' => Str::uuid(),
            'password' => bcrypt($input['password'])
        ]);

        $team = Team::query()->create([
            'token' => Str::uuid(),
            'name' => $input['first_name']. " Team"
        ]);

        setPermissionsTeamId($team->id);

        $user->assignRole('admin');

        $user->default_team_id = $team->id;
        $user->save();

        UserRegistered::dispatch($user);

        return new UserResource($user);
    }
}
