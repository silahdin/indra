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

	<div class="section-content-management">
		<div class="container container-content container-form-about">
			<div class="row margin-right-0">
				<div class="col-sm-12 col-text-program">
					@if ( Session::get('langIN') != NULL )
                        <div class="header">
                            <img src="{{ asset($content->img_icon) }}" alt=""><h1 class="blues">{{$content->title_in}}</h1>
                        </div>
					@elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                        <div class="header">
                            <img src="{{ asset($content->img_icon) }}" alt=""><h1 class="blues">{{$content->title_in}}</h1>
                        </div>
					@endif
                </div>
                <div class="col-sm-12">
					@if ( Session::get('langIN') != NULL )
                        <?php echo $content->content_in ?>
					@elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                        <?php echo $content->content_en ?>
					@endif                
                </div>
			</div>
		</div>
	</div>
@endsection
