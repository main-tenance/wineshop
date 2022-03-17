<?php


namespace App\Services\Users\Handlers;


use App\Models\User;
use App\Services\Users\Repositories\UsersRepository;

class UserUpdateHandler
{
    private UsersRepository $usersRepository;


    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }


    public function handle(User $user, array $data): User
    {
        return $this->usersRepository->update($user, $data);
    }
}
