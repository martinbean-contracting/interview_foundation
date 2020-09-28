<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersistGithubTokenTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestCannotPersistToken(): void
    {
        $this
            ->putJson('/github-token', ['github_token' => 'foo'])
            ->assertUnauthorized();
    }

    public function testUserCanPersistToken(): void
    {
        $user = factory(User::class)->create();

        $this->assertNull($user->github_token);

        $this
            ->actingAs($user)
            ->putJson('/github-token', ['github_token' => 'foo'])
            ->assertSuccessful();

        $this->assertNotNull($user->fresh()->github_token);
    }

    public function testTokenIsUpdatedIfUserAlreadyHasOneSet(): void
    {
        $user = factory(User::class)->create([
            'github_token' => 'foo'
        ]);

        $this
            ->actingAs($user)
            ->putJson('/github-token', ['github_token' => 'bar'])
            ->assertSuccessful();
    }

    /**
     * @testdox github_token field is required
     */
    public function testGithubTokenFieldIsRequired(): void
    {
        $this
            ->actingAs(factory(User::class)->create())
            ->putJson('/github-token')
            ->assertJsonValidationErrors('github_token');
    }
}
