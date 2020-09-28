@extends('layouts.app')

@section('content')
    <div class="container">
        <app github-token="{{ $token }}"></app>
    </div>
@endsection
