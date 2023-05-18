@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/banner/Banner Page Audit & Assurance.jpg');
?>
<div class="space-top">
</div>

<section class="services-page person-leader detail-leader">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
              <div class="nav-services flex-box">
                <a href="{{ route('compro.pubTax') }}">@lang('main.publication_link1')</a>
                <a href="{{ route('compro.pubPrim') }}">@lang('main.publication_link2')</a>
                <a href="{{ route('compro.pubAn') }}">@lang('main.publication_link3')</a>
                <a href="{{ route('compro.pubCon') }}" class="active">@lang('main.publication_link4')</a>
                <a href="{{ route('compro.pubDB') }}">@lang('main.publication_link5')</a>
              </div>
            </div>
            <div class="col-sm-9">
        			<div class="row">
        			<?php for($i=0;$i<count($produk);$i++) { ?>
        				<div class="col-sm-3 wrap-pub-download">
        					<div class="conpub-download">
        					  <h6>
                      {{$produk[$i]->title_in}}
                    </h6>
        						<img class="img-pub"  src="{{asset($produk[$i]->img)}}"	alt="">
        						<div>
        						  <p>{{$produk[$i]->text_in}}</p>
        						</div>
        						<a href="{{ asset($produk[$i]->doc) }}" class="btn btn-warning">
                      @lang('main.publication_download')
                    </a>
        					</div>
        				</div>
        			<?php } ?>
            </div>
          </div>
    </div>
</section>

	<br>
	<br>
    @include('pages.compro.follow')
@endsection
