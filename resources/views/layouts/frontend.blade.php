<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title','Home') | {{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta content='text/html;charset=utf-8' http-equiv='content-type'>
        <meta content='Gesmansys' name='description'>
        <link href='{{ asset('favicon.png') }}' rel='shortcut icon' type='image/x-icon'>
        @include('frontend.include.cssfiles')
        @stack('css')
    </head>

    <body class="@yield('body_class','')">
        
        <div class="wrapper">
            @include('frontend.include.sidebar')
            @include('frontend.include.topnav')
            <div class="main-panel">
                <div class="main-content">
                    <div class="content-wrapper">
                        @yield('content')
                        @include('frontend.include.footer')
                    </div>
                </div>
            </div>
        </div>
    </body>
    @include('frontend.include.jsfiles')
    @include('frontend.include.page_notification')
    
    
    <script>

    $(document).ready(function () {


        $('#flash-overlay-modal').modal();

        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.selectTag').select2({
            tokenSeparators: [",", " "],
        });


        $('.time_pick').datetimepicker({
            format: 'LT'
        });
    });


</script>

<script>
    moment.locale('{{\App::getLocale()}}');
    function getLangFullDate(fulldate,monthtype="short"){
        return moment.utc(fulldate,'YYYY-MM-DD HH:mm:ss').format('MMM Do YYYY, h:mm a');
    }
    function getLangDate(date,monthtype="short"){
        return moment.utc(date,'YYYY-MM-DD').format('MMM Do YYYY');
    }

</script>

@stack('js')


</body>
</html>