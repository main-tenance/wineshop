<?php


namespace App\Services\Users\Handlers;

use App\Mail\WelcomeNewUserMail;
use App\Models\User;
use App\Services\Notifications\Sms\DTOs\SmsDTO;
use App\Services\Notifications\Sms\SmsService;
use App\Services\Users\Repositories\UsersRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserCreateHandler
{
    private UsersRepository $usersRepository;
    private SmsService $smsService;

    public function __construct(
        UsersRepository $usersRepository,
        SmsService      $smsService
    )
    {
        $this->usersRepository = $usersRepository;
        $this->smsService = $smsService;
    }

    public function handle(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->usersRepository->create($data);
        $this->notification($user);

        return $user;
    }

    public function notification(User $user): void
    {
        $this->smsService->sendSms(new SmsDTO(
            env('APP_NAME'),
            env('SMS_TO'),
            __('app.welcome_sms')
        ));

        Mail::to($user)->later(now()->addSeconds(5), new WelcomeNewUserMail($user));
    }
}
