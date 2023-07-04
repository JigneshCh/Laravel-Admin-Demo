@extends('layouts.apex')


@section('title','Access Denied')


@section('content')

<section id="error">
    <div class="container-fluid bg-grey bg-lighten-3">
        <div class="container">
            <div class="row full-height-vh">
                <div class="col-md-12  ml-auto d-flex align-items-center">
                    <div class="row text-center mb-3">
                       
                        <div class="col-12">
                            <h4 class="grey darken-2 font-large-5">Opps...</h4>
							<div class="panel-body">
                    
                    You don't have permission for access this page.
                </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>



    
@endsection

