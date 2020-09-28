<?php

namespace App\Actions;

use App\Entities\Github\Repository;
use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Support\Collection;

class FetchStarredRepositoriesAction
{
    /**
     * The GitHub manager instance.
     *
     * @var \GrahamCampbell\GitHub\GitHubManager
     */
    protected $github;

    /**
     * Create a new action instance.
     *
     * @param  \GrahamCampbell\GitHub\GitHubManager  $github
     * @return void
     */
    public function __construct(GitHubManager $github)
    {
        $this->github = $github;
    }

    /**
     * Execute the action.
     *
     * @param  string  $token
     * @return \Illuminate\Support\Collection
     */
    public function handle(string $token): Collection
    {
        $this->github->authenticate($token, null, 'token');

        $results = $this->github->api('current_user')->starring()->all();

        return collect($results)->mapInto(Repository::class);
    }
}
