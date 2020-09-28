<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * The encrypter implementation.
     *
     * @var \Illuminate\Contracts\Encryption\Encrypter
     */
    protected $encrypter;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Encryption\Encrypter  $encrypter
     * @return void
     */
    public function __construct(Encrypter $encrypter)
    {
        $this->encrypter = $encrypter;

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke(Request $request)
    {
        return view('home')->with([
            'token' => transform($request->user()->github_token, function (string $token) {
                return $this->encrypter->decrypt($token);
            }),
        ]);
    }
}
