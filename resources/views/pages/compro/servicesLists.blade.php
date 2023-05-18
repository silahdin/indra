@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/banner/Banner Page Audit & Assurance.jpg');
?>
	<div class="space-top">
	</div>

	<section class="about flex-box"
		style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>@lang('main.services_lists_title')</h1>
		</div>
	</section>
	<section  class="services-page">
		<div class="container container-content">
			<div class="row">
					<!-- <div class="row"> -->
						<div class="col-sm-12 col-text-program">
                            <h6 style="line-height:1.5">@lang('main.services_lists_detail')</h6>
                             <h6 style="line-height:1.5">@lang('main.services_lists_des')</h6>
						</div>
					<!-- </div> -->
			</div>
		</div>
	</section>
    <section style="background-color:#f8f9fa;">
    <br><br>
        <div class="container container-content">
			<h4 style="font-weight:900">@lang('main.services_lists_core_service')</h4>
            <div class="row">

					<?php if($med==$size){
						?>
						@if ( Session::get('language') == 'ch' )
						<div class="col-sm-6">
							<div class="nav-services flex-box" style="margin:1.5px">
								<a href="{{ route('compro.servListId', ['id'=> $services[0]->slug]) }}" class="btnc-more" style="padding:5px 15px;margin:inherit">{{ $services[0]->name_ch}}</a>
							</div>
						</div>
						@elseif ( Session::get('language') == 'en'  )
						<div class="col-sm-6">
							<div class="nav-services flex-box" style="margin:1.5px">
								<a href="{{ route('compro.servListId', ['id'=> $services[0]->slug]) }}" class="btnc-more" style="padding:5px 15px;margin:inherit">{{ $services[0]->name}}</a>
							</div>
						</div>
						@endif
                </div>
					<?php }else {?>
						<div class="col-sm-6">
							<div class="nav-services flex-box" style="margin:1.5px">
								<?php for($i=0;$i<$med;$i++){?>
								@if ( Session::get('language') == 'ch' )
									<a href="{{ route('compro.servListId', ['id'=> $services[$i]->slug]) }}" class="btnc-more" style="padding:5px 15px;margin:inherit">{{ $services[$i]->name_ch}}</a>
								@elseif ( Session::get('language') == 'en'  )
									<a href="{{ route('compro.servListId', ['id'=> $services[$i]->slug]) }}" class="btnc-more" style="padding:5px 15px;margin:inherit">{{ $services[$i]->name}}</a>
								@endif
								<?php echo'';}?>
								
							
							</div>
						</div>
						<div class="col-sm-6">
							<div class="nav-services flex-box" style="margin:1.5px">
								<?php for($j=$med;$j<$size;$j++){?>
								    @if ( Session::get('language') == 'ch' )
									<a href="{{ route('compro.servListId', ['id'=> $services[$j]->slug]) }}" class="btnc-more" style="padding:5px 15px;margin:inherit">{{ $services[$j]->name_ch}}</a>
								@elseif ( Session::get('language') == 'en'  )
									<a href="{{ route('compro.servListId', ['id'=> $services[$j]->slug]) }}" class="btnc-more" style="padding:5px 15px;margin:inherit">{{ $services[$j]->name}}</a>
								@endif
								<?php echo'';}?>
							</div>
						</div>
					<?php echo "";}?>
            </div>
        </div>
        <br><br><br>
    </section>

	@include('pages.compro.follow')

@endsection
