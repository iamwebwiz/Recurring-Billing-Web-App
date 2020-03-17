<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function it_can_visit_the_login_page(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200)->assertOk();
    }

    /** @test */
    public function it_can_log_a_user_into_the_app(): void
    {
        $user = factory(User::class)->create();

        $this->get(route('login'))->assertStatus(200)->assertOk();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(302)->assertRedirect(route('home'));
    }
}
