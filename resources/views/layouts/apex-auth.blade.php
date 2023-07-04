<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title','Home') | {{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta content='text/html;charset=utf-8' http-equiv='content-type'>
        <meta content='Gesmansys' name='description'>
        <link href='{{ asset('favicon.png') }}' rel='shortcut icon' type='image/x-icon'>
        @yield('headExtra')
        @include('apex.include.cssfiles')
        @stack('css')
    </head>

    <body data-col="1-column" class="1-column blank-page blank-page login-screen">
        <div class="wrapper">
            <div class="main-panel">
              <div class="main-content">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
              </div>
            </div> 
        </div>
    </body>
    @include('apex.include.jsfiles')
    @include('apex.include.page_notification')
	
	@stack('js')
</html>