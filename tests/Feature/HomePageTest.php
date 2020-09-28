<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestCanViewWelcomePage(): void
    {
        $this
            ->get('/')
            ->assertOk()
            ->assertViewIs('welcome');
    }

    public function testUserIsRedirectedToHomePage(): void
    {
        $this
            ->actingAs(factory(User::class)->create())
            ->get('/')
            ->assertRedirect('/home');
    }
}
