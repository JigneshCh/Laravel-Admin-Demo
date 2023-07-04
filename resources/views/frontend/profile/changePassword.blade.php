@extends('layouts.frontend')
@section('title',trans('people.label.change_password'))

@section('content')


    <section id="basic-form-layouts">
	<div class="row">
            <div class="col-sm-12">
                <div class="content-header">   @lang('people.label.change_password') </div>
                {{-- @include('partials.page_tooltip',['model' => 'profile','page'=>'form']) --}}
            </div>
        </div>
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
                        <a href="{{ route('profile.index') }}" title="{{__('Back')}}">
                            <button class="btn-link-back"><i class="fa fa-arrow-left"
                                                                      aria-hidden="true"></i> Back </button>
                        </a>
					
	            </div>
	            <div class="card-body">
	                <div class="px-3">
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            
							{!! Form::open([
								'method' => 'PATCH',
								'class' => 'form-horizontal',
								'autocomplete'=>'off'
							]) !!}


							<div class="form-group row {{ $errors->has('current_password') ? ' has-error' : ''}}">
								{!! Form::label('current_password', trans('people.label.current_password'), ['class' => 'col-md-4 label-control']) !!}
								<div class="col-md-6">
									{!! Form::password('current_password', ['class' => 'form-control','required'=>'required']) !!}
									{!! $errors->first('current_password', '<p class="help-block">:message</p>') !!}
								</div>
							</div>

							<div class="form-group row {{ $errors->has('password') ? ' has-error' : ''}}">
								{!! Form::label('password', trans('people.label.password'), ['class' => 'col-md-4 label-control']) !!}
								<div class="col-md-6">
									{!! Form::password('password', ['class' => 'form-control','required'=>'required']) !!}
									{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
								</div>
							</div>


							<div class="form-group row {{ $errors->has('password_confirmation') ? ' has-error' : ''}}">
								{!! Form::label('password_confirmation', trans('people.label.password_confirmation'), ['class' => 'col-md-4 label-control']) !!}
								<div class="col-md-6">
									{!! Form::password('password_confirmation', ['class' => 'form-control','required'=>'required']) !!}
									{!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
								</div>
							</div>

							<div class="form-group row">
								<label for="first_name" class="col-md-4 label-control">
									
								</label>
								<div class="col-md-offset-4 col-md-4">
									{!! Form::submit(isset($submitButtonText) ? $submitButtonText : trans('people.label.change_password'), ['class' => 'btn btn-primary']) !!}
									{{ Form::reset(trans('comman.label.clear_form'), ['class' => 'btn btn-primary']) }}
								</div>
							</div>


							{!! Form::close() !!}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	

	

	
</section>

   
@endsection







					