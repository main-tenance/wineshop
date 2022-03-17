<?php


namespace App\Policies\Gates;


use App\Models\User;

class UpdateSettingsGate
{
    public function update(User $user)
    {
        return $user->isManager() && $user->isTester();
    }
}
