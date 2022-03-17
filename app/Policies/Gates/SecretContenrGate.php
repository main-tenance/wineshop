<?php


namespace App\Policies\Gates;


use App\Models\User;

class SecretContenrGate
{
    public function view(User $user)
    {
        return $user->isTester();
    }
}
