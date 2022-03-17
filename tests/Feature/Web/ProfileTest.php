<?php

namespace Tests\Feature\Web;

use App\Http\Routes\Web\WebRoutes;
use App\Http\Routes\Web\WebRoutesProvider;
use App\Services\Locale\LocaleService;
use Illuminate\Support\Facades\App;
use Tests\TestCase;


/**
 *
 * @group profile
 */
class ProfileTest extends TestCase
{
    public function testProfileNotAuthenticated()
    {
        $response = $this->get(WebRoutesProvider::userEdit());
        $response->assertStatus(302);
        $response->assertRedirect(WebRoutesProvider::login());
    }

    public function testProfileAuthenticated()
    {
        $this->actingAs($this->getUser())
            ->get(WebRoutesProvider::userEdit())
            ->assertStatus(200);
    }

    public function testProfileUpdate()
    {
        $user = $this->getUser();
        $this->actingAs($user)
            ->put(route(WebRoutes::USER_UPDATE, [
                'user' => $user,
                LocaleService::PARAMETER_LOCALE => App::getLocale(),
            ]), [
                'name' => $user->name,
                'login' => $user->login,
                'email' => $user->email,
                'phone' => '1234567890',
            ])
            ->assertStatus(200);
        $user->refresh();
        $this->assertEquals($user->phone, '1234567890');
    }

    public function testProfileUpdateBadEmail()
    {
        $user = $this->getUser();
        $this->actingAs($user)
            ->put(route(WebRoutes::USER_UPDATE, [
                'user' => $user,
                LocaleService::PARAMETER_LOCALE => App::getLocale(),
            ]), [
                'name' => $user->name,
                'login' => $user->login,
                'email' => 123,
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors('email');
        $user->refresh();
        $this->assertNotEquals($user->email, 123);
    }

}
