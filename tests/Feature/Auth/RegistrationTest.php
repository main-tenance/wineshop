<?php

namespace Tests\Feature\Auth;

use App\Http\Routes\Web\WebRoutesProvider;
use App\Mail\WelcomeNewUserMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\Users\Handlers\UserCreateHandler;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @group register
 */

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get(WebRoutesProvider::userCreate());

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
//        $mock = $this->partialMock(UserCreateHandler::class, function (MockInterface $mock) {
//            $mock->shouldReceive('notification')->with(new User())->once();
//        });
        $response = $this->post(WebRoutesProvider::userStore(), [
            'name' => 'Test User',
            'login' => 'harry',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_mailable_content()
    {
        $user = User::factory()->create();
        $mailable = new WelcomeNewUserMail($user);
        $mailable->assertSeeInHtml('Hi, ' . $user->name);
    }
}
