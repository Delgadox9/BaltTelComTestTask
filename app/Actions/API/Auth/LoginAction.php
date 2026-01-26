<?php

namespace App\Actions\API\Auth;

use App\DTO\User\LoginDTO;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class LoginAction
{
    /**
     * @throws \Throwable
     */
    public function execute(LoginDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $user = User::where('email', $dto->email)->first();

            if (! $user || ! Hash::check($dto->password, $user->password)) {
                return [
                    'message' => 'Неверные данные для входа',
                ];
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'user' => new UserResource($user),
                'token' => $token,
            ];
        });
    }
}
