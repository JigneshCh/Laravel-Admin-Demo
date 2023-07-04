@extends('layouts.apex')

@section('title',trans('user.label.show_user'))

@section('content')

    <section id="basic-form-layouts">
	<div class="row">
            <div class="col-sm-12">
                <div class="content-header"> @lang('user.label.show_user')</div>
               
            </div>
        </div>
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
                        <a href="{{ url('/admin/users') }}" title="Back">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('comman.label.back')
                            </button>
                        </a>
	                 <div class="next_previous pull-right">
                   
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
                                                <td>{{ $user->id }}</td>
                                            </tr>
                                            <tr>

                                                <td>@lang('people.label.first_name')</td>
                                                <td> {{ $user->first_name }} </td>
                                            </tr>
											
											<tr>

                                                <td>@lang('people.label.last_name')</td>
                                                <td> {{ $user->last_name }} </td>
                                            </tr>
											
											
											
                                            <tr>

                                                <td>Email</td>
                                                <td> {{ $user->email }} </td>
                                            </tr>
											
                                            
											<tr>

                                                <td>Is Email Verified</td>
                                                <td>  {{ ($user->verified && $user->verified == 1)? 'Yes':'No' }} </td>
                                            </tr>
											
											
											
											
											
											<tr>

                                                <td>Status</td>
                                                <td> {{ $user->status }} </td>
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


     