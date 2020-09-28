<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="d-flex flex-column min-vh-100 justify-content-center">
            <div class="text-center">
                <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Sign in') }}</a>
            </div>
        </div>
    </body>
</html>
