<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class ProfileService
{
    public function updateProfile(User $user, array $data): User
    {
        try {
            $user->fill($data);

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            return $user;
        } catch (Exception $e) {
            Log::error("Erro ao atualizar perfil do usuário ID {$user->id}: " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteAccount(User $user): void
    {
        try {
            Auth::logout();

            $user->delete();
        } catch (Exception $e) {
            Log::error("Erro ao excluir conta do usuário ID {$user->id}: " . $e->getMessage());
            throw $e;
        }
    }
}
