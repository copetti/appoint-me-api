<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidPasswordResetTokenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function __invoke(ResetPasswordRequest $request): void
    {
        $input = $request->validated();

        $token = PasswordResetToken::query()
            ->whereToken($input['token'])
            ->whereDate('created_at', '>', now()->subHours(24)->toDateTimeString())
            ->first();

        if(!$token){
            throw new InvalidPasswordResetTokenException();
        }

        $user = $token->user;
        $user->password = bcrypt($input['password']);
        $user->save();

        $user->resetPasswordTokens()->delete();
    }
}
