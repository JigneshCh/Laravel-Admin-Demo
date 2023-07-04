@extends('layouts.apex')
@section('title',trans('permission.label.edit_permission'))

@section('content')


    <section id="basic-form-layouts">
	<div class="row">
            <div class="col-sm-12">
                <div class="content-header">   @lang('permission.label.edit_permission')</div>
                {{-- @include('partials.page_tooltip',['model' => 'permission','page'=>'form']) --}}
            </div>
        </div>
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
                        <a href="{{ url('/admin/permissions') }}" title="{{__('Back')}}">
                            <button class="btn-link-back"><i class="fa fa-arrow-left"
                                                                      aria-hidden="true"></i> @lang('comman.label.back') </button>
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
							<div class="col-xl-6 col-sm-12">

                            {!! Form::model($permission, [
                                'method' => 'PATCH',
                                'url' => ['/admin/permissions', $permission->id],
                                'class' => 'form-horizontal',
                                'autocomplete'=>'off'
                            ]) !!}

                            @include ('admin.permissions.form', ['submitButtonText' => trans('comman.label.update')])

                            {!! Form::close() !!}
							</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	

	

	
</section>

   
@endsection


