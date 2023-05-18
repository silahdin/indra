<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

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
                </div>
            </div>
        </nav>

        <main class="py-4">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Your account has been activated</div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-12">
                            <div class="alert alert-success">
                                    Your account has been activated. <br><br>
                                    Welcome to Reanda Bernardi Career Portal. Please continue to login to check and apply for Reanda Bernardi job openings
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                            <a href="{{route('login')}}?id={{Request::segment(3)}}" class="btn btn-danger">Login</a>
                        </div>                          

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
DB::table('users')->where('email', $email)->update(['st_user' => 1]);
?>

</main>
</div>
</body>
</html>