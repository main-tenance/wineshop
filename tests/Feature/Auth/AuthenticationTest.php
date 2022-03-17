<?php

namespace Tests\Feature\Auth;

use App\Http\Routes\Web\WebRoutesProvider;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group auth
 */
class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get(WebRoutesProvider::login());

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $response = $this->post(WebRoutesProvider::loginStore(), [
            'login' => $user->login,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post(WebRoutesProvider::loginStore(), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }


    public function testAuthenticatedSeeName()
    {
        $user = $this->getUser();
        $this->actingAs($user)->get(WebRoutesProvider::mainIndex())
            ->assertSee($user->name);
    }

    public function testNotAuthenticatedSeeInvite()
    {
        $this->get(WebRoutesProvider::mainIndex())
            ->assertSee(__('app.login'));
    }
}
