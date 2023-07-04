@extends('layouts.frontend')

@section('title',trans('people.label.my_profile'))

@section('content')

    <section id="basic-form-layouts">
	<div class="row">
            <div class="col-sm-12">
                <div class="content-header">  @lang('people.label.my_profile') </div>
                {{--  @include('partials.page_tooltip',['model' => 'website','page'=>'index']) --}}
            </div>
        </div>
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
				
							<a href="{{ url('profile/edit') }}" class="btn btn-success btn-sm" title="Edit Profile">
                                <i class="fa fa-edit" aria-hidden="true"></i> @lang('people.label.edit_profile')
                            </a>
                            <a href="{{ url('profile/change-password') }}" class="btn btn-success btn-sm" title="Change Password">
                                <i class="fa fa-lock" aria-hidden="true"></i> @lang('people.label.change_password')
                            </a>
							
                       
                          
                        
                        
	            </div>
	            <div class="card-body">
	                <div class="px-3">
                           <div class="box-content ">
                               <div class="row">
                                   <div class="table-responsive">
                                         <table class="table table-borderless">
                                            <tbody>
                                                 <tr>
														<th>@lang('people.label.first_name')</th>
														<td>{{$user->first_name}}</td>
													</tr>
													
													 <tr>
														<th>@lang('people.label.last_name')</th>
														<td>{{$user->last_name}}</td>
													</tr>

													<tr>
														<th>@lang('people.label.email')</th>
														<td>{{$user->email}}</td>
													</tr>
													
													<tr>
														<th>@lang('people.label.joined')</th>
														<td>{{$user->created_at->diffForHumans()}}</td>
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