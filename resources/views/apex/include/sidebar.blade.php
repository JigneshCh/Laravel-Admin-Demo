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
                        <img alt="Logo" class="mb-1" src="{{ asset('assets/images/logo.png') }}" height="80">
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
              @foreach($laravelAdminMenus->menus as $section)

               @if($accessible($section))
               <li class=" nav-item {{ ($active($section))? "open": "" }} @if(isset($section->items) && count($section->items)>0) has-sub @endif">
                    <a class="" href="{{ ($section->url) ? url($section->url) : "#"  }}"><i class="{{ $section->icon }}"></i>
                        <span class="menu-title"> @lang("menu.label.".$section->title) </span>
                    </a>
                    @if(isset($section->items) && count($section->items)>0)
                        <ul class="menu-content">
                            @foreach($section->items as $menu)
                                @if($accessible($menu))
                                <li class="{{ ($active($section))? "is-shown": "" }} {{ ($active($menu))? "active": "" }}">
                                    <a href="{{ ($menu->url) ? url($menu->url) : "#"  }}"><i class="{{ $menu->icon }}"></i>
                                        <span> @lang("menu.label.".$menu->title)</span>
                                    </a>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </li>
                @endif


            @endforeach  
              
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