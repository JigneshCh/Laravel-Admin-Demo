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
                    <div class="card-body">
                        <div class="card-block">
                            <h2 class="white">{{ __('Reset Password') }}</h2>
							
							@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif
					
					
                            <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
										<input id="email" name="email" type="text" value="{{ old('email') }}" class="form-control"  placeholder="@lang('comman.label.email')"  >
                                        @if ($errors->has('email'))
                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong> </span>
                                        @endif
                                    </div>
                                </div>

                                

                              

                                <div class="form-group">
                                    <div class="col-md-12">
                                         <button type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-left">
                            <a href='{{ route('password.request') }}' class="white txt-decoration">@lang('comman.label.forgot_password')</a>
                         </div>

                        <div class="float-right white">@lang('comman.label.have_account')  
                            <a href="{!! route('register') !!}" class="white txt-decoration">@lang('comman.label.registernow')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


