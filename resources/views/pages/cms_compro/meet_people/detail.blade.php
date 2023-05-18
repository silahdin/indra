@extends('layouts.appcompro')

@section('content')


<div class="space-top"></div>
<br>

<section class="services-page person-leader detail-leader">
    <div class="container container-content">
        <div class="row">
            <div class="col-sm-9">
                
                {!! @$people->words !!}

                <h6 class="sub-meet-us"><strong> {{ @$people->name }}</strong> - {{ @$people->position }}</h6>

            </div>
            <div class="col-sm-3">
                <div class="wrap-meet">
                    <img src="{{ asset(@$people->image_url) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

	<br>
	<br>
    @include('pages.compro.follow')
@endsection
