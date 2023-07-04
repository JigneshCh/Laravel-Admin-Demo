@extends('layouts.apex')

@section('title',trans('permission.label.show_permission'))

@section('content')

    <section id="basic-form-layouts">
	<div class="row">
            <div class="col-sm-12">
                <div class="content-header"> @lang('permission.label.show_permission') </div>
                {{--  @include('partials.page_tooltip',['model' => 'subject','page'=>'index']) --}}
            </div>
        </div>
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
                        <a href="{{ url('/admin/permissions') }}" title="Back">
                            <button class="btn-link-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('comman.label.back')
                            </button>
                        </a>
	                 <div class="next_previous pull-right">
                   
                             @if(Auth::user()->can('access.permission.edit'))
                                <a href="{{ url('/admin/permissions/' . $permission->id . '/edit') }}" title="Edit Permission">
                                    <button class="btn-link"><i class="fa fa-pencil-square-o"
                                                                              aria-hidden="true"></i>
                                        @lang('comman.label.edit')
                                    </button>
                                </a>
                            @endif

                            @if(Auth::user()->can('access.permission.delete'))

                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['/admin/permissions', $permission->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> '.trans('comman.label.delete'), array(
                                        'type' => 'submit',
                                        'class' => 'btn-link-dlt',
                                        'title' => 'Delete Permission',
                                        'onclick'=>"return confirm('".trans('comman.js_msg.confirm_for_delete',['item_name'=>'Permission'])."')"
                                ))!!}
                                {!! Form::close() !!}
                            @endif
                            
                          </div>  
                          
                        
                        
	            </div>
	            <div class="card-body">
	                <div class="px-3">
                           <div class="box-content ">
                               <div class="row">
                                   <div class="table-responsive">
                                       
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>@lang('comman.label.id')</th>
                                                    <th>@lang('comman.label.name')</th>
                                                    <th>@lang('comman.label.label')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td> {{ $permission->id }}</td>
                                                    <td> {{ $permission->name }} </td>
                                                    <td> {{ $permission->label }} </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        
                                    </div>
                                </div>
                            </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	

	

	
</section>


@endsection




