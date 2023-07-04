{{--

@extends('layouts.apex-auth')

@section('title','Login')

@section('content')


<section id="login">
    <div class="container-fluid">
        <div class="row full-height-vh">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="card gradient-indigo-purple text-center width-400">
                    <div class="card-img overlap">
                        <img alt="element 06" class="mb-1" src="{{ asset('assets/images/logo.png') }}" width="190">
                    </div>
					@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif
                    <div class="card-body">
                        <div class="card-block">
                            <h2 class="white">{{ __('Register') }}</h2>
                            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                {{ csrf_field() }}
								
								<div class="form-group row">
                            <label for="first_name" class="col-md-12 col-form-label text-md-left">{{ __('First Name') }}</label>

                            <div class="col-md-12">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						 <div class="form-group row">
                            <label for="last_name" class="col-md-12 col-form-label text-md-left">{{ __('Last Name') }}</label>

                            <div class="col-md-12">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
						
                                
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-left">
                            <a href='{{ route('password.request') }}' class="white txt-decoration">@lang('comman.label.forgot_password')</a>
                         </div>

                        <div class="float-right white">@lang('comman.label.already_account')  
                            <a href="{!! route('login') !!}" class="white txt-decoration">@lang('comman.label.login_here')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

--}}