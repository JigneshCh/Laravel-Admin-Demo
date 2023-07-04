@extends('layouts.frontend')
@section('title',trans('people.label.edit_profile'))

@section('content')


    <section id="basic-form-layouts">
	<div class="row">
            <div class="col-sm-12">
                <div class="content-header">   @lang('people.label.edit_profile') </div>
                {{-- @include('partials.page_tooltip',['model' => 'profile','page'=>'form']) --}}
            </div>
        </div>
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
                        <a href="{{ url('profile') }}" title="{{__('Back')}}">
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
                            
							{!! Form::model($user,[
								'method' => 'PATCH',
								'class' => 'form-horizontal',
								'files'=>true,
								'autocomplete'=>'off'
							]) !!}

                    <div class="form-group row {{ $errors->has('first_name') ? ' has-error' : ''}}">
                        <label for="first_name" class="col-md-4 label-control">
                            <span class="field_compulsory">*</span>@lang('people.label.first_name')
                        </label>
                        <div class="col-md-6">
                            {!! Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('last_name') ? ' has-error' : ''}}">
                        <label for="last_name" class="col-md-4 label-control">
                            <span class="field_compulsory">*</span>@lang('people.label.last_name')
                        </label>
                        <div class="col-md-6">
                            {!! Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    
                    <div class="form-group row">
						<label for="first_name" class="col-md-4 label-control">
                            
                        </label>
                        <div class="col-md-offset-4 col-md-4">
                            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : trans('people.label.update_profile'), ['class' => 'btn btn-primary']) !!}
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



@push('js')

<script>
   

    $("#timezone").select2();
    

   

   
</script>


@endpush


