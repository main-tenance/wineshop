<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
//    use DatabaseMigrations;

    /**
     * A basic browser test example.
     *
     * @return void
     *
     * @group basic
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ru')
                ->assertSee(__('app.name'));
        });
    }

    public function testLoginPopup()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ru')
                ->click('.enter');
            $browser
                ->waitFor('.login__form')
                ->assertVisible('.login__form');
        });
    }

    /**
     * @throws \Throwable
     * @group aaa
     */
    public function testLink()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/ru')
                ->clickLink('Производители')
                ->pause(1000)
//                ->assertRouteIs(route('creator.index'))
                ->assertPathIs('/ru/creators');
        });
    }

    public function testAuth()
    {
        $user = User::factory()->create();
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login/ru')
                ->type('login', $user->login)
                ->type('password', 'password')
                ->press('.btn')
                ->pause(1000)
                ->assertDontSee(__('app.login'))
                ->assertSee($user->name);
        });
    }

}
