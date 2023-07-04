<nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span><span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
          </div>
          <div class="navbar-container">
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
              <ul class="navbar-nav">
                {{--
				<li class="nav-item mr-2"><a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen">
                        <i class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">fullscreen</p></a>
                </li>
				 <li class="dropdown nav-item">
                    <a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle">
                        <i class="ft-flag font-medium-3 blue-grey darken-4"></i>
                        <span class="selected-language d-none"></span>
                    </a>
                  <div class="dropdown-menu dropdown-menu-right">
                      <a href="{{request()->fullUrlWithQuery(['lang'=>'en'])}}" class="dropdown-item py-1">
                          <img src="{!! asset('apex/img/flags/us.png') !!}" class="langimg"><span> English</span>
                      </a>
                      <a href="{{request()->fullUrlWithQuery(['lang'=>'fr'])}}" class="dropdown-item">
                          <img src="{!! asset('apex/img/flags/de.png') !!}" class="langimg"><span> French</span>
                      </a>
                  </div>
                </li> --}}
                @include('apex.include.notifications')
                <li class="dropdown nav-item">
                    <a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle" aria-expanded="false">
                        @if(isset(Auth::user()->people->photo))
                        <img class="img-circle" width="23" height="23" alt="{!! Auth::user()->name !!}"
                             src="{!! asset('uploads/'.Auth::user()->people->photo) !!}" style="vertical-align: top;"/>
                        @else 
                        <i class="ft-user font-medium-3 blue-grey darken-4"></i>
                        @endif
                        <p class="d-none">User Settings</p>
                    </a>
                  <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu dropdown-menu-right">
                      <a href="{!! url('profile') !!}" class="dropdown-item py-1">
                          <i class="ft-edit mr-2"></i>
                          <span>Profile</span>
                      </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item">
                        <i class="ft-power mr-2"></i>
                        <span>Logout</span>
                    </a>
                    
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>