@extends('emails.layouts.default')

@section('content')
    <p>Hello {{ $user->first_name }},</p>
    <p>This is your token and you can use it to reset your password <b>{{ $token }}</b></p>
@endsection