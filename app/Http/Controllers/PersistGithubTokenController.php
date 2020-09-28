<?php

namespace App\Http\Controllers;

use App\Actions\PersistGithubTokenAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersistGithubTokenRequest;
use Illuminate\Http\Response;

class PersistGithubTokenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\PersistGithubTokenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(PersistGithubTokenRequest $request, PersistGithubTokenAction $action)
    {
        $action->handle($request->user(), $request->input('github_token'));

        return new Response('', 204);
    }
}
