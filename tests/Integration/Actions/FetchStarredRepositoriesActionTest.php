<?php

namespace Tests\Integration\Actions;

use App\Actions\FetchStarredRepositoriesAction;
use App\Entities\Github\Repository;
use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Support\Collection;
use Mockery\MockInterface;
use Tests\TestCase;

class FetchStarredRepositoriesActionTest extends TestCase
{
    /**
     * @link https://docs.github.com/en/free-pro-team@latest/rest/reference/activity#list-repositories-starred-by-the-authenticated-user
     */
    public function testCanFetchStarredRepositoriesForAuthenticatedUser(): void
    {
        $this->mock(GitHubManager::class, function (MockInterface $mock) {
            $mock->shouldReceive('authenticate')->once()->withArgs(function (string $token) {
                return $token === 'testtoken';
            });

            $mock->shouldReceive('api')->once()->with('current_user')->andReturnSelf();
            $mock->shouldReceive('starring')->once()->withNoArgs()->andReturnSelf();
            $mock->shouldReceive('all')->once()->withNoArgs()->andReturn([
                [
                    'id' => 1296269,
                    'name' => 'Hello-World',
                    'full_name' => 'octocat/Hello-World',
                ],
            ]);
        });

        /** @var \App\Actions\FetchStarredRepositoriesAction $action */
        $action = $this->app->make(FetchStarredRepositoriesAction::class);

        $result = $action->handle('testtoken');

        $this->assertIsObject($result);
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(1, $result->count());
        $this->assertIsObject($result[0]);
        $this->assertInstanceOf(Repository::class, $result[0]);
        $this->assertEquals('1296269', $result[0]->id);
        $this->assertEquals('Hello-World', $result[0]->name);
        $this->assertEquals('octocat/Hello-World', $result[0]->full_name);
    }
}
