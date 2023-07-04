@extends('layouts.apex')

@section('title',trans('role.label.show_role'))

@section('content')

    <section id="basic-form-layouts">
	<div class="row">
            <div class="col-sm-12">
                <div class="content-header"> @lang('role.label.show_role') # {{$role->name}}</div>
                {{--  @include('partials.page_tooltip',['model' => 'subject','page'=>'index']) --}}
            </div>
        </div>
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
                        <a href="{{ url('/admin/roles') }}" title="Back">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('comman.label.back')
                            </button>
                        </a>
	                 <div class="next_previous pull-right">
                   
                             @if($role->id != 0)
                                @if(Auth::user()->can('access.role.edit'))
                                    <a href="{{ url('/admin/roles/' . $role->id . '/edit') }}" title="Edit Role">
                                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                                  aria-hidden="true"></i>
                                            @lang('comman.label.edit')
                                        </button>
                                    </a>
                                @endif

                            @endif
                            
                            @if($role->id != 1)

                                @if(Auth::user()->can('access.role.delete'))
                                    {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['/admin/roles', $role->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> '.trans('comman.label.delete'), array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Delete Role',
                                            'onclick'=>"return confirm('".trans('comman.js_msg.confirm_for_delete',['item_name'=>'Role'])."')"
                                    ))!!}
                                    {!! Form::close() !!}
                                @endif
                            @endif
                            
                          </div>  
                          
                        
                        
	            </div>
	            <div class="card-body">
	                <div class="px-3">
                           <div class="box-content ">
                               <div class="row">
                                   <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>

                                            <tr>
                                                <td>@lang('comman.label.id')</td>
                                                <td>{{ $role->id }}</td>
                                            </tr>
                                            <tr>

                                                <td>@lang('comman.label.name')</td>
                                                <td> {{ $role->name }} </td>
                                            </tr>
                                            <tr>

                                                <td>@lang('comman.label.label')</td>
                                                <td> {{ $role->label }} </td>
                                            </tr>
                                            <tr>

                                                <td>@lang('comman.label.label')</td>
                                                <td>
                                                    @if($role->websites)
                                                         @foreach($role->websites as $k=>$web)
                                                            {{ $web->domain }} @if(count($role->websites) != $k+1) ,  @endif
                                                         @endforeach

                                                     @endif
                                                </td>
                                            </tr>
                                            <tr>

                                                <td>@lang('permission.label.permissions')</td>
                                                <td>
                                                    @if($role->main_permission()->count() > 0)

                                                        <ul>
                                                            @foreach($role->main_permission as $p)
                                                                @if($isChecked($p->name))
                                                                    <li>{{$p->label}}</li>
                                                                    <ul>
                                                                        @foreach($p->child as $c)
                                                                            @if($isChecked($c->name))
                                                                            <li>{{$c->label}}</li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                 @endif
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        @lang('permission.label.nopermissions')
                                                    @endif

                                                </td>
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


