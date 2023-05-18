@extends('layouts.appcompro')

@section('content')

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/image/about.jpg');
?>
<div class="section-one text-center margin-right-0" style="background-image: url('{{$imgBanner}}');">
		<!-- <div class="wrapper-color"></div> -->
		<div class="container container-content">
			<div class="row ">
				<div class="col-sm-12 color-white">
					<div class="content-section-one">
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2 text-center">
								<!-- <h2 class="h2-opening">Tentang Recare</h2> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="section-content-about">
		<div class="container container-content container-form-about">

			<div class="row margin-right-0">
				<div class="col-sm-12 text-center col-text-program">
					@if ( Session::get('langIN') != NULL )
						<h2>@lang('main.manage_title1')</h2>
						<h4>@lang('main.manage_title2')</h4>
					@elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
						<h2>@lang('main.manage_title1')</h2>
						<h5>@lang('main.manage_title2')</h5>
					@endif
                </div>
				<?php
				$no = 1;
				foreach ($listTrain as $pos) {
				$img = $pos->img_icon;
				$img_icon_hover = $pos->img_icon_hover;
                ?>

					<script type="text/javascript">
						function hover{{$no}}(element) {
							element.setAttribute('src', '{{$img_icon_hover}}');
						}
						function unhover{{$no}}(element) {
							element.setAttribute('src', '{{$img}}');
						}
					</script>
					<div class="col-sm-4 col-box-program">
						<div class="box-program">
							<div class="row">
								<div class="col-sm-4">
									<a href="{{ route('compro.managementSingle', ['id' => $pos->id]) }}"><img onmouseover="hover{{$no}}(this);" onmouseout="unhover{{$no}}(this);" src="{{ asset($img) }}"
										alt=""></a>
								</div>
								<div class="col-sm-8">
									@if ( Session::get('langIN') != NULL )
										<h4>{{$pos->title_in}}</h4>
									@elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
										<h4>{{$pos->title_en}}</h4>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									@if ( Session::get('langIN') != NULL )
										<p>{{$pos->description_in}}</p>
									@elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
										<p>{{$pos->description_en}}</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									@if ( Session::get('langIN') != NULL )
										<a href="{{ route('compro.managementSingle', ['id' => $pos->id]) }}">@lang('main.manage_see_program')</a>
									@elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
										<a href="{{ route('compro.managementSingle', ['id' => $pos->id]) }}">@lang('main.manage_see_program')</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				<?php
				$no++;
				} ?>
			</div>
		</div>
	</div>
@endsection
