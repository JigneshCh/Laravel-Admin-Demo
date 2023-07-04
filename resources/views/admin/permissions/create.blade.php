@extends('layouts.apex')

@section('title',trans('permission.label.create_permission'))

@section('content')

    <section id="basic-form-layouts">
	<div class="row">
            <div class="col-sm-12">
                <div class="content-header">  @lang('permission.label.create_permission') </div>
                {{--   @include('partials.page_tooltip',['model' => 'permission','page'=>'form']) --}}
            </div>
        </div>
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
                        <a href="{{ url('/admin/permissions') }}" title="Back">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('comman.label.back')
                            </button>
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

                            {!! Form::open(['url' => '/admin/permissions', 'class' => 'form-horizontal','autocomplete'=>'off']) !!}

                            @include ('admin.permissions.form')

                            {!! Form::close() !!}
                            
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	

	

	
</section>
   
@endsection




