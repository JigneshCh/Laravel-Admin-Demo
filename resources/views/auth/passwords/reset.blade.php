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
                            <h2 class="white">{{ __('Reset Password') }}</h2>
                            <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                                {{ csrf_field() }}
								
								<input type="hidden" name="token" value="{{ $token }}">
								
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <input name="email" type="text" value="{{ old('email') }}" class="form-control"  placeholder="@lang('comman.label.email')"  >
                                        @if ($errors->has('email'))
                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong> </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <input type="password" name="password" value="" placeholder="@lang('comman.label.password')" class="form-control" >
                                         @if ($errors->has('password'))
                                         <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                         @endif
                                    </div>
                                </div>
								
								<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <input type="password" name="password_confirmation" value="" placeholder="{{ __('Confirm Password') }}" class="form-control" >
                                         @if ($errors->has('password_confirmation'))
                                         <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                         @endif
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <div class="col-md-12">
                                         <button type="submit" class="btn btn-primary"> {{ __('Reset Password') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



