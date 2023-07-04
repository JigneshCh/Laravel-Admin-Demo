@extends('layouts.frontend')

@section('title',"Ticket Detail")

@section('content')

<section id="basic-badges" class="height-725">
   
    <div class="row match-height justify-content-md-center">
        <div class="col-8 ">
            <div class="card" style="height: 600px;">
               
                <div class="card-body">
					<div class="card-block pt-3 text-center">
							<div class="clearfix">
								<h5 class="text-bold-500  font-45 primary ">{{ $item->subject }}</h5>
							</div>
							<div class="sussess">
							@if($item->status == "closed")
								<img src="{{ url('img/success.png')}}"  alt="img">
							@else
								<img src="{{ url('img/circular-clock.png')}}"  alt="img">
							@endif
							
							</div>
							<p class="line">Create By @if($item->creator)
										{{ $item->creator->full_name}}
										@endif on {{ \Carbon\Carbon::createFromFormat("Y-m-d h:i:s",$item->created_at)->format("jS M, Y") }} </p>
							<hr class="line-1">
							<p><strong>Assign to: </strong> You</p>
							@if($item->desc) <p><strong>Notes: </strong> {{$item->desc}}</p> @endif
							<p><strong>Files: </strong> <code>{{$item->total_file}}  </code> files, <code> {{$item->total_size}} </code> in total   </p>
							
							<p><strong>Expire on: </strong>{{ \Carbon\Carbon::createFromFormat("Y-m-d",$item->exp_date)->format("jS M, Y") }}  </p>
							
							<hr class="line-1">
							
							<div class="card-block ">
								@if($item->status == "closed")
									You have completed this to-do on
												
									@if($item->closed_at && $item->closed_at != "")
										{{ \Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$item->closed_at)->format("jS M, Y g:i a") }}
									@endif
									
								@else
									<a @if($item->file_url) href="{{$item->file_url}}"  @endif class="btn btn-raised btn-dark ">Click To Download Files!</a>
								@endif
								
							</div>
							
							
									
							
						</div>
                    
                </div>
				
            </div>
        </div>
        
        
        
        
        
        
        
    </div>
</section>


{{--
    <section id="basic-form-layouts">
	<div class="row">
            <div class="col-sm-12">
                <div class="content-header"> Ticket Detail</div>
               
            </div>
        </div>
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header">
                        <a href="{{ url('/') }}" title="Back">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('comman.label.back')
                            </button>
                        </a>
	                 <div class="next_previous pull-right">
                   
                      </div>  
                          
                        
                        
	            </div>
	            <div class="card-body">
	                <div class="px-3">
                           <div class="box-content ">
                              
								<div class="row match-height">
									
									<div class="col-md-12 col-sm-12">
									<div class="col-12">
										<div class="content-header"> <u>{{ $item->subject }} </u></div>
										<p class="content-sub-header">
										@if($item->creator)
										{{ $item->creator->full_name}} ( {{ $item->creator->email}} ) has created the ticket and assign to you.
										@endif
										</p>
										<div class="card card-outline-primary box-shadow-0 text-center" style="height: 301.75px;">
											<div class="card-body">
												<div class="card-block pt-3">
													<div class="row d-flex">
														<div class="col align-self-center">
															<img src="{{ url('img/doc-icon.png')}}" alt="element 01" width="190">
														</div>
														
														<div class="col align-self-center">
														
														<p>Assign By Ishan on </p>
															@if($item->user)
																<h4 class="card-title mt-3">{{ $item->user->full_name}}</h4>
															@endif
															<p>STATUS : <b>{{ strtoupper($item->status)  }}</b></p>
															<p class="card-text">
															{{$item->total_file}} files, {{$item->total_size}} in total ・ Will be deleted on @if($item->exp_date){{ \Carbon\Carbon::createFromFormat("Y-m-d",$item->exp_date)->format("jS M, Y") }} @endif
															</p>
															<a @if($item->file_url) href="{{$item->file_url}}"  @endif class="btn btn-raised btn-primary">Click to Download Files!</a>
														</div>
													</div>
												</div>
											</div>
											@if($item->status == "closed")
												<p class="content-sub-header" style="text-align: left !important;">
												You have completed the ticket and closed on
												
												@if($item->closed_at && $item->closed_at != "")
												{{ \Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$item->closed_at)->format("jS M, Y g:i a") }}
												@endif
											    </p>
											@endif
										</div>
									</div>
								 
									
								   
								</div>

                                       
                                </div>
                            </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	

	

	
</section>

--}}


@endsection


     