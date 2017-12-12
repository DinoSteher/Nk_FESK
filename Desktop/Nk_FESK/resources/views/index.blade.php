@extends('layouts.layout')

@section('title', 'EduBoard | ')

@section('content')
<div class="row">
    <div class="jumbotron">
        <h1>EduBoard</h1>
        <h2>Lorem Ipsum dolor sit amet</h2>
        <p>You must login or create account to continue.</p>
        <p>
          <a class="btn btn-primary btn-lg" href="{{ route('auth.login.form') }}" role="button">Log In</a>
          <a class="btn btn-primary btn-lg" href="{{ route('auth.register.form') }}" role="button">Create account</a>
        </p>
  </div>
</div>
@stop
