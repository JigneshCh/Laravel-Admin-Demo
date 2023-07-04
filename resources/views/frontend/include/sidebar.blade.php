 <?php
            $active = function ($menu) {
                $active = 0;
                if(str_contains(Request::url(), $menu->url) && ($menu->url!='' && $menu->url != "/admin" || (Route::getCurrentRoute()->uri() =="admin"))){
                    $active = 1;
                }
                if(!$active && isset($menu->items)){
                    foreach($menu->items as $me){
                        if(str_contains(Request::url(), $me->url) && ($me->url!='' && $me->url != "/admin" || (Route::getCurrentRoute()->uri() =="admin"))){
                            $active = 1;
                            break;
                        }
                    }
                }
                return $active;
            };

            $accessible = function ($menu) {
                $isaccessible = 1;
                
                return $isaccessible;
            };

            ?>

<div data-active-color="black" data-background-color="white" data-image="" class="app-sidebar">
        <!-- main menu header-->
        <!-- Sidebar Header starts-->
        <div class="sidebar-header">
          <div class="logo clearfix">
              <a href="{!! url('/') !!}" class="logo-text float-left">
                  <div class="logo-img">
                        <img alt="Logo" class="mb-1" src="{{ asset('assets/images/logo.png') }}" height="31">
                  </div>
           
              </a>
              <a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block">
                  <i data-toggle="expanded" class="ft-toggle-right toggle-icon"></i>
              </a>
              <a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i>
              </a>
          </div>
        </div>
        <!-- Sidebar Header Ends-->
        <!-- / main menu header-->
        <!-- main menu content-->
        <div class="sidebar-content ps-container ps-theme-default ps-active-y" data-ps-id="19f86c1e-c17d-2fbd-f575-61295e113677">
          <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
              
               <li class=" nav-item" >
                    <a  href="{!! url('/') !!}">
						<i class="fa fa-list"></i>
                        <span class="menu-title"> Dashboard</span>
                    </a>
                   
                </li>
              </ul>
              
          </div>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;">
                
            </div>
                
        </div>
            <div class="ps-scrollbar-y-rail" style="top: 0px; height: 857px; right: 3px;">
                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 754px;"></div>
                    
            </div>
                
        </div>
        <!-- main menu content-->
        <div class="sidebar-background" style="background-image: url(&quot;&quot;);"></div>
        <!-- main menu footer-->
        <!-- include includes/menu-footer-->
        <!-- main menu footer-->
      </div>