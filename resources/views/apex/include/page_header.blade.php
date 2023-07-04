<section class="top-section">
    <div class="page-header">
        <div class="page-header-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 clearfix">
                    <div class="page-title">
                        <h4><span class="text-semibold">Welcome</span> - {{Auth::user()->name}}</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 clearfix">
                    <div class="heading-elements-div">
                        <div class="heading-btn-group-div">
                            <ul class="clearfix ul-dashboard">
                                <li><a href="{{url('Billing/subscription')}}" class="btn btn-link btn-float has-text">Your Plan
                                        <span class="account-span">
                                            @if (Session::has('current_plan_name') && Session::get('current_plan_name')!="")
                                            {{ Session::get('current_plan_name') }}
                                            @endif
                                        </span>
                                    </a></li>
                                <li><a href="{{url('fb-adsets')}}" class="btn btn-link btn-float has-text">Chosen Filter<span class="account-span"><img src="{!! asset('user-backend/assets/images/sun.png') !!}" alt="sun" class="img-top"></span></a></li>
                                <li>
                                    <a href="{{url('fb-compaigns')}}" class="btn btn-link btn-float has-text">Number of Campaigns
                                        <span class="account-span"> 
                                            @if (Session::has('adcompigns_count') && Session::get('adcompigns_count')!="")
                                            {{ Session::get('adcompigns_count') }}
                                            @else
                                            0
                                            @endif
                                        </span>
                                    </a>
                                </li>
                                <li><a href="#" class="btn btn-link btn-float has-text">Monthly spending limit<span class="account-span"> N/A</span></a></li>
                                <li><a href="#" class="btn btn-link btn-float has-text">Amount used: <span class="account-span"> N/A</span></a></li>
                            </ul>	
                        </div>
                    </div>	
                </div>
            </div>
        </div>			
    </div><!-- /page header -->

</section>