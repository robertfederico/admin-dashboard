@extends('layouts.app')

@section('content')
<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Login</b>
          </div>
        <div class="card ">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to your account</p>
       
                @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input id="username" 
                            type="text" 
                            class="form-control" 
                            name="username" 
                            @if(Cookie::has('username'))
                                value="{{ Cookie::get('username') }}" 
                            @endif
                            placeholder="username"
                            required 
                            autofocus
                        >
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                      </div>

                    <div class="input-group mb-3">
                        <input type="password" 
                            class="form-control" 
                            name="password" 
                            placeholder="password"
                            @if(Cookie::has('password'))
                                value="{{ Cookie::get('password') }}" 
                            @endif
                            required autocomplete="current-password" 
                        >
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div>
  
                    <div class="row mt-3">
                        <div class="col-md-8">
                            <div class="icheck-primary">
                                <input class="form-check-input" 
                                    type="checkbox" 
                                    name="remember_me" 
                                    @if(Cookie::has('username'))
                                        {{ Cookie::get('username') ? 'checked' : '' }} 
                                    @endif
                                    id="remember">
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
