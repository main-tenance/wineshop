<?php


namespace App\Services\Users;


use App\Models\User;
use App\Services\Users\Handlers\UserCreateHandler;
use App\Services\Users\Handlers\UserUpdateHandler;
use App\Services\Users\Repositories\UsersRepository;

class UsersService
{
    private UserCreateHandler $userCreateHandler;
    private UserUpdateHandler $userUpdateHandler;
    private UsersRepository $usersRepository;

    public function __construct(
        UserCreateHandler $userCreateHandler,
        UserUpdateHandler $userUpdateHandler,
        UsersRepository   $usersRepository
    )
    {
        $this->userCreateHandler = $userCreateHandler;
        $this->userUpdateHandler = $userUpdateHandler;
        $this->usersRepository = $usersRepository;
    }


    public function storeUser(array $data): User
    {
        return $this->userCreateHandler->handle($data);
    }


    public function updateUser(User $user, array $data): User
    {
        return $this->userUpdateHandler->handle($user, $data);
    }

    public function delete(User $user): void
    {
        $this->usersRepository->delete($user);
    }

}
