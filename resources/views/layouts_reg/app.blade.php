<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reanda Bernardi</title>

    <!-- Scripts 
    <script src="{{ asset('js/app.js') }}" defer></script>
    -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/timeTo.css') }}" rel="stylesheet">
    
   @if(Request::segment(1) != "home" && Request::segment(1) != "hometest")
    <?php 
    if(Request::segment(1) == "hometest") { //Crypt::decryptString($id)
        $dwaktu = DB::table('tbl_test_user_target')
        ->select('start', 'target')
        ->where('id_career', Crypt::decryptString($id))
        ->where('users_id', Auth::user()->id)
        ->first();

        $idnya = $id;
    } else {
        $dwaktu = DB::table('tbl_test_user_target')
        ->select('start', 'target')
        ->where('id_career', Crypt::decryptString($jobid))
        ->where('users_id', Auth::user()->id)
        ->first();

        $idnya = $jobid;
    }

    /*$dwaktu = DB::table('tbl_test_user_target')
    ->select('start', 'target')
    ->where('id_career', Crypt::decryptString($id))
    ->where('users_id', Auth::user()->id)
    ->first();

    $idnya = $id;*/
    ?>

    <?php if($dwaktu->target < date("Y-m-d H:i:s")) { ?>
        <script>window.location.href = "{{route('logoutreg', ['id' => $idnya])}}"; </script>
    <?php } ?>
        <script src="{{ asset('/js/jquery.time-to.js') }}"></script>
        <script>
            $(document).ready(function(){
                $('#countdown').timeTo(new Date('{{$dwaktu->target}}'), function(){ alert("Time's up"); window.location.href = "{{route('logoutreg', ['id' => $idnya])}}" }); 
                /*$('#countdown1').timeTo({
                    time: new Date('{{$dwaktu->target}}'), //2017-07-30T23:59:45
                    countdown: true,
                    displayDays: 2,
                    theme: "black",
                    displayCaptions: false,
                    fontSize: 16,
                    captionSize: 12,
                    languages: {
                        pl: {days: 'D', hours: 'H', min: 'M', sec: 'S'}
                    },
                    lang: 'pl'
                });*/
            });
        </script>

    @endif
<script>
    $(document).ready(function(){
        //get browser
        var chrome   = navigator.userAgent.indexOf('Chrome') > -1;
        if(chrome == false) {
            alert('we recommend using the chrome browser to work on this test');
        }
        
    });
</script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Reanda Bernardi
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <?php /*<li class="nav-item">
                            <a class="nav-link" href="{{ route('wizard_summary') }}">Summary PI</a>
                        </li>*/ ?>
                        @if(Auth::user()->level=="admin")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('result.dashboard') }}">Administrator</a>
                        </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item" style="margin: 9px 15px 0 0">
                                    <div id="countdown"></div>
                            </li>
                            <li class="nav-item ">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} {{ __('Logout') }}
                                 </a>

                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                     @csrf
                                 </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
