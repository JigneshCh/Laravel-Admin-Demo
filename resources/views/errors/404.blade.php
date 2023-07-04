@if(\Auth::user() && \Auth::user()->utype == "admin")

	@php( $layout = 'layouts.apex' )

@elseif(\Auth::user())	

	@php( $layout = 'layouts.frontend' )
	
@else

	@php( $layout = 'layouts.apex-auth' )
	
@endif 	

@extends($layout)

@section('title',"No file found")

@section('content')



			
<section id="basic-badges" class="height-725">
   
    <div class="row match-height justify-content-md-center">
        <div class="col-12 ">
            <div class="card" style="height: 600px;">
               
                <div class="card-body">
					<div class="card-block pt-3 text-center">
							<div class="clearfix">
								<h5 class="text-bold-500  font-45 primary ">File Not Found !</h5>
							</div>
							<div class="sussess">
								<img src="{{ asset('img/no-file.png') }}" alt="img">
							</div>
							<p class="line">The file you are trying to open is no longer available and cannot be opened</p>
							<hr class="line-1">
							
							
							 <p class="text-muted text-center col-12 py-1"> <?php $today = getdate(); ?>
        &copy; <a href="#" target="_blank"> {{ config('app.name') }} {{$today['year']}} </a>All Rights</p>
							
							<div class="card-block ">
								<a href="{{url('/admin/tickets')}}" class="btn btn-raised btn-dark ">Back To Tickets!</a>
																
							</div>
							
							
									
							
						</div>
                    
                </div>
				
            </div>
        </div>
        
        
        
        
        
        
        
    </div>
</section>

@endsection
