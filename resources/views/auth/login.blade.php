@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row login-container">
      <div class="text-center">
          <center><img width="200" src="{{ asset('assets/admin/img/logo.png')}}" class="logo img-responsive" alt=""></center>
      </div>  
    <div class="col-md-offset-3 col-md-6">
      
     <h2>Sign In</h2>
     <form class="" action="{{ route('login') }}" method="post">
        @csrf
     <div class="row">
     <div class="form-group col-md-12">
        <label class="form-label">E-mail</label>
        <div class="controls">
            <div class="input-with-icon right">                                       
                <i class=""></i>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
      </div>
      </div>
      <div class="row">
      <div class="form-group col-md-12">
        <label class="form-label">Password</label>
        <span class="help"></span>
        <div class="controls">
            <div class="input-with-icon right">                                       
                <i class=""></i>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success btn-cons  pull-right">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
