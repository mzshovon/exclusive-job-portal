@extends('panel.auth.layouts.app')
@section('content')
<div class="login-logo">
    <a href="#">{{ config('app.name', 'Laravel') }}</a>
  </div>
  @include('panel.layouts.alert')
  @include('panel.layouts.validation')
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      {{-- <p class="login-box-msg">Sign in as a user</p> --}}
      <img src="{{ asset('public/dist/img/icon.png') }}" alt="Exclusive Job Preparation Logo" class="brand-image-login img-circle elevation-3"
      style="opacity: .8">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        {{-- <a href="forgot-password.html">I forgot my password</a> --}}
      </p>
      <p class="mb-0 mt-2 text-center">
        <a href="{{url('register')}}" class="text-center">Register a new membership</a>
      </p>
    </div>
  </div>
@endsection
