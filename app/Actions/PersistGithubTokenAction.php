<?php

namespace App\Actions;

use App\User;
use Illuminate\Contracts\Encryption\Encrypter;

class PersistGithubTokenAction
{
    /**
     * The encrypter implementation.
     *
     * @var \Illuminate\Contracts\Encryption\Encrypter
     */
    protected $encrypter;

    /**
     * Create a new action instance.
     *
     * @param  \Illuminate\Contracts\Encryption\Encrypter  $encrypter
     * @return void
     */
    public function __construct(Encrypter $encrypter)
    {
        $this->encrypter = $encrypter;
    }

    /**
     * Execute the action.
     *
     * @param  \App\User  $user
     * @param  string  $token
     * @return void
     */
    public function handle(User $user, string $token): void
    {
        $user->update([
            'github_token' => $this->encrypter->encrypt($token),
        ]);
    }
}
