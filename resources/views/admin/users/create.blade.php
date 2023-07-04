@extends('layouts.apex')

@section('title',trans('user.label.create_user'))

@section('content')

    <section id="basic-form-layouts">
	<div class="row">
            <div class="col-sm-12">
                <div class="content-header"> @lang('user.label.create_new_user') </div>
                {{--  @include('partials.page_tooltip',['model' => 'user','page'=>'form']) --}}
            </div>
        </div>
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
                        <a href="{{ url('/admin/users') }}" title="Back">
                            <button class="btn-link-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('comman.label.back')
                            </button>
                        </a>
	                <div class="actions pull-right">
                          
                        </div>
                        
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
	                     {!! Form::open(['url' => '/admin/users', 'class' => 'form-horizontal','files' => true,'autocomplete'=>'off']) !!}

                                @include ('admin.users.form')

                                {!! Form::close() !!}
                            
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	

	

	
</section>
   
@endsection
