@extends('layouts.apex')
@section('title',trans('role.label.edit_role'))

@section('content')


    <section id="basic-form-layouts">
	<div class="row">
            <div class="col-sm-12">
                <div class="content-header">  @lang('role.label.edit_role')  # {{$role->name}}</div>
                {{-- @include('partials.page_tooltip',['model' => 'role','page'=>'form']) --}}
            </div>
        </div>
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
                        <a href="{{ url('/admin/roles') }}" title="{{__('Back')}}">
                            <button class="btn-link-back"><i class="fa fa-arrow-left"
                                                                      aria-hidden="true"></i> @lang('comman.label.back') </button>
                        </a>
	                
                        
                          <div class="next_previous pull-right">
                                <a href="javascript:document.getElementById('module_form').submit();" title="Update" class="navbar-right btn-link"> @lang('comman.label.update')</a>
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
                            
	                    {!! Form::model($role, [
                                'method' => 'PATCH',
                                'url' => ['/admin/roles', $role->id],
                                'class' => 'form-horizontal',
                                'id' => 'module_form',
                                'autocomplete'=>'off'
                            ]) !!}

                            @include ('admin.roles.form', ['submitButtonText' => trans('comman.label.update')])

                            {!! Form::close() !!}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	

	

	
</section>

   
@endsection




