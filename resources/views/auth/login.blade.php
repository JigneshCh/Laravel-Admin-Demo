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
						<p>Laravel | ADMIN | ROLES | TICKET CRUD | DATATABLE LISTING WITH FILTER| MODAL RELATIONS | SELECT2 | DATERANGE PICKER | AJAX</p>
                    </div>
							@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif
							
							@if(Session::has('is_active_error'))

								<div class="alert alert-success" role="alert">
									@lang('auth.message.if_you_not_received_email'). <a href="{!! url('/resend-activation') !!}">@lang('auth.message.click_here_to_resend_activation_email').</a>
								</div>
							@endif
                    <div class="card-body">
                        <div class="card-block">
                            <h2 class="white">@lang('comman.label.login') </h2>
                            <form class='validate-form' role="form" method="POST" action="{{ url('sign-in') }}">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <input name="email" type="text" value="admin@gmail.com" class="form-control"  placeholder="@lang('comman.label.email')"  >
                                        @if ($errors->has('email'))
                                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong> </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <input type="password" name="password" value="12345678" placeholder="@lang('comman.label.password')" class="form-control" >
                                         @if ($errors->has('password'))
                                         <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                         @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0 ml-3 checkbox check_remember">
                                                <input type="checkbox" name="remember_me" class="custom-control-input "  id="remember_me" value='1' {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label float-left white" for="remember_me">@lang('comman.label.remember_me')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                         <button type="submit" class="btn btn-primary">@lang('comman.label.signin')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
					{{--
                    <div class="card-footer">
                        <div class="float-left">
                            <a href='{{ route('password.request') }}' class="white txt-decoration">@lang('comman.label.forgot_password')</a>
                         </div>

                        <div class="float-right white">@lang('comman.label.have_account')  
                            <a href="{!! route('register') !!}" class="white txt-decoration">@lang('comman.label.registernow')</a>
                        </div>
                    </div>
					--}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
