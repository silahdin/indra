@extends('layouts.appcompro')

@section('content')
<?php
function shorter($string){
  if (strlen($string) >= 240) {
    return substr($string, 0, 250). " ... ";
  }
  else {
    return $string;
  }
}

function convert_tgl_to_user($tgl){
    $tanggal =  substr($tgl, 0,10);
    $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}




// echo "<pre>";
// print_r($post);
// echo "</pre>";

// die();
$lang_org = session('language');
?>



    <!--Page Title-->
    <section class="page-title" style="background-image:url({{ asset('assets/compro/assets/frontend_assets/images/background/services.png') }});">
        <div class="float-text"></div>
        <div class="auto-container">


                <?php
			    if($lang_org=='en')
			        {
			            echo $servicespage->title_in;
			        }
			        else
			        {
			            echo $servicespage->title_en;
			        }
			    
			    ?>

        </div>
    </section>
    <!--End Page Title-->

    <!-- Services Section -->
    <section class="services-section alternate">
        <div class="auto-container">
            <div class="sec-title centered">

    @if ( Session::get('langIN') != NULL )
                <span>{{ $servicespage->titleh2_in }}</span>
                <h2>{{ $servicespage->texth2_in }}</h2>
    @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                <span>{{ $servicespage->titleh2_en }}</span>
                <h2>{{ $servicespage->texth2_in }}</h2>
    @endif
            </div>

            <div class="services" style="padding-bottom: 51px;">
                <div class="services-outer clearfix">

<?php foreach ($services as $key) { ?>

                    <!-- Service Block -->
                    <div class="service-block col-md-6 col-sm-6 col-xs-12">
                        <div class="inner-box" style="padding-top: 8px;">

    @if ( Session::get('langIN') != NULL )
                            <div class="icon-box"><img src="{{ asset($key->icon) }}" class="flaticon-briefcase" ></div>
                            <h3><a href="{{ $key->url}}">{{ $key->title_in}}</a></h3>
                            <p>{{ $key->text_in}}</p>

    @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )

                            <div class="icon-box"><img src="{{ asset($key->icon) }}" class="flaticon-briefcase" ></div>
                            <h3><a href="{{ $key->url}}">{{ $key->title_en}}</a></h3>
                            <p>{{ $key->text_en}}</p>
    @endif

                        </div>
                    </div>
<?php } ?>




                </div>
            </div>
        </div>
    </section>
    <!-- End Services Section -->



    <!--End Page Title-->

    <!-- Services Section -->


    <!-- Testimonial Section -->


  <section class="services-section alternate" style="background-color: #cbddee">

        <div class="auto-container">

            <div class="sec-title centered" style="margin-top: -197px;" id="link1">
                <img src="{{ asset('assets/compro/assets/frontend_assets/images/icons/icon-a4.png') }}" style="margin-left: 10px;">

    @if ( Session::get('langIN') != NULL )
                <h2 style="margin-top: 36px;" >{{ $servicespage->titleh3_in }}</h2>
                <span>{{ $servicespage->texth3_in }}</span>
    @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                <h2 style="margin-top: 36px;" >{{ $servicespage->titleh3_en }}</h2>
                <span>{{ $servicespage->texth3_en }}</span>

    @endif
            </div>

            <div class="services">
                <div class="services-outer clearfix">
                    <!-- Service Block -->
                    <div class="service-block col-md-4 col-sm-6 col-xs-12" >
                        <div class="inner-box" style="border-style: none; padding-top: 1px">

    @if ( Session::get('langIN') != NULL )
                             <img src="{{ asset('assets/compro/assets/frontend_assets/images/icons/mi-4.png') }}" class="flaticon-briefcase" >
                             <h3 style="margin-top: 36px;"><a href="#">@lang('main.services_title1')</a></h3>
                            <p style="font-size: 15px; text-align: justify; padding-top: 23px;">@lang('main.services_subtitle1')</p>

    @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                             <img src="{{ asset('assets/compro/assets/frontend_assets/images/icons/mi-4.png') }}" class="flaticon-briefcase" >
                             <h3 style="margin-top: 36px;"><a href="#">@lang('main.services_title1')</a></h3>
                            <p style="font-size: 15px; text-align: justify; padding-top: 23px;">@lang('main.services_subtitle1')</p>

    @endif

                        </div>
                    </div>

                    <!-- Service Block -->
                    <div class="service-block col-md-4 col-sm-6 col-xs-12">
                        <div class="inner-box" style="border-style: none; padding-top: 1px">
                           <img src="{{ asset('assets/compro/assets/frontend_assets/images/icons/st-6.png') }}" class="flaticon-briefcase" >


    @if ( Session::get('langIN') != NULL )
                              <h3 style="margin-top: 43px;"><a href="#" >@lang('main.services_title2')</a></h3>
                            <p style="font-size: 15px; text-align: justify; padding-top: 23px;">@lang('main.services_subtitle2')</p>
    @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                              <h3 style="margin-top: 43px;"><a href="#" >@lang('main.services_title2')</a></h3>
                            <p style="font-size: 15px; text-align: justify; padding-top: 23px;">@lang('main.services_subtitle2')</p>

    @endif
                        </div>
                    </div>

                    <!-- Service Block -->
                    <div class="service-block col-md-4 col-sm-6 col-xs-12">
                        <div class="inner-box" style="border-style: none; padding-top: 1px">

    @if ( Session::get('langIN') != NULL )
                             <img src="{{ asset('assets/compro/assets/frontend_assets/images/icons/cc-6.png') }}" class="flaticon-briefcase" >
                            <h3 style="margin-top: 36px;"><a href="#">@lang('main.services_title3')</a></h3>
                            <p style="font-size: 15px; text-align: justify;">@lang('main.services_subtitle3')</p>
    @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                             <img src="{{ asset('assets/compro/assets/frontend_assets/images/icons/cc-6.png') }}" class="flaticon-briefcase" >
                            <h3 style="margin-top: 36px;"><a href="#">@lang('main.services_title3')</a></h3>
                            <p style="font-size: 15px; text-align: justify;">@lang('main.services_subtitle3')</p>
    @endif

                        </div>
                    </div>

                    <!-- Service Block -->



                </div>
            </div>
        </div>
    </section>


 <section class="video-section-two" style="background-color: #558bc2;">
       <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="services-single">



                        <div class="two-column">
                            <div class="row clearfix">
                                <div class="image-column col-md-6 col-sm-6 col-xs-12">
                                     <div class="image" style="padding-left: 30px;"><img src="{{ asset('assets/compro/assets/frontend_assets/images/background/winda - Copy - Copy - Copy.png') }}" alt="" style=" height: 530px; width: 300px;"></div>
                                </div>
                                <div class="content-column col-md-6 col-sm-6 col-xs-12">
                                    <div class="inner-column">
                                        <h3 class="title">@lang('main.services_winda')</h3>

    @if ( Session::get('langIN') != NULL )
                                        <p style="text-align: justify; color: white">@lang('main.services_winda_detail')</p>
    @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                                        <p style="text-align: justify; color: white">@lang('main.services_winda_detail')</p>

    @endif
                                <ul class="social-icon-two clearfix" style="margin-top: -36px;">
                                <li><img src="{{ asset('assets/compro/assets/frontend_assets/images/gallery/polis.png') }}"></li>
                                <li><img src="{{ asset('assets/compro/assets/frontend_assets/images/gallery/um.png') }}"></a></li>
                                <li><img src="{{ asset('assets/compro/assets/frontend_assets/images/gallery/dp-2.png') }}"></a></li>

                            </ul>

    @if ( Session::get('langIN') != NULL )
                            <a class="theme-btn btn-style-one" >@lang('main.services_gabung')</a>

    @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                            <a class="theme-btn btn-style-one" >@lang('main.services_join_winda')</a>

    @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="two-column">
                            <div class="row clearfix">
                                <div class="image-column pull-right col-md-6 col-sm-6 col-xs-12">
                                    <div class="image" style="padding-left: 30px;"><img src="{{ asset('assets/compro/assets/frontend_assets/images/background/win.png') }}" alt="" style=" height: 530px; width: 300px;"></div>
                                </div>

                                <div class="content-column col-md-6 col-sm-6 col-xs-12">
                                    <div class="inner-column">
                                        <h3 class="title">@lang('main.services_zaki')</h3>

    @if ( Session::get('langIN') != NULL )
                                        <p style="text-align: justify; color: white">@lang('main.services_zaki_detail')</p>

    @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                                        <p style="text-align: justify; color: white">@lang('main.services_zaki_detail')</p>

    @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Blog List -->
                </div>

    </section>



@endsection
