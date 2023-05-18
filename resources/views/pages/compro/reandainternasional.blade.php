@extends('layouts.appcompro')

@section('content')


<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/etc/international.jpg');
?>
<style>
		.modal-lg {
			max-width: 50% !important;
	}
</style>
<div class="space-top">
	</div>

	<section class="about flex-box"
		style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>@lang('main.newreanda_internation')</h1>
			<p>@lang('main.newreanda_internation_title')</p>
			<p>@lang('main.newreanda_internation_subtitle')</p>
		</div>
	</section>
	<br>
	<br>
	<br>
	<section class="person-leader detail-leader">
		<div class="container container-custom">
			<div class="row">
				<div class="col-sm-12">
					<h2>@lang('main.newreanda_firm_profile')</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-9">
					<p>
						@lang('main.newreanda_title1')
					</p>
					<p>
						@lang('main.newreanda_title2')
					</p>
					<p>
						@lang('main.newreanda_title3')
					</p>
					<p>
						@lang('main.newreanda_title4')
					</p>
					<br>
					<br>

				</div>
				<div class="col-sm-3">
					<img class="img-dl-rl" src="{{asset('assets/compro/assets/frontend_assets/images/etc/dl.jpg')}}" alt="">
					<div class="wrapper-btn">
						<a href="{{asset('assets/compro/assets/frontend_assets/doc/etc/Reandabernardi-Compro-2018_FINAL.pdf')}}">@lang('main.newreanda_download_company')</a>
					</div>
					<div class="wrapper-btn">
						<a href="{{asset('assets/compro/assets/frontend_assets/doc/etc/ReandachinafinalPreview.pdf')}}">@lang('main.newreanda_download_company_chinese')</a>
					</div>
				</div>
			</div>
			<br>

			<hr>

			<div class="row">
				<div class="col-12"><h2>@lang('main.newreanda_directory')</h2></div>
				<br><br><br>
				<div class="col-3">
				  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="background-color: white">
					<a class="nav-link active" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">AFRICA</a>
					<a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">ASIA</a>
					<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">EUROPE</a>
					<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">MIDDLE EAST</a>
					<a class="nav-link" id="v-pills-test-tab" data-toggle="pill" href="#v-pills-test" role="tab" aria-controls="v-pills-settings" aria-selected="false">OCEANIA</a>

				  </div>
				</div>
				<div class="col-9">
				  <div class="tab-content" id="v-pills-tabContent">

					<div class="tab-pane fade show active" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
						<ul>
                            <?php
                            $cafrikas = DB::table('cms_country')
                            ->where('directory_id', 1)
                            ->orderBy('country_id', 'ASC')
                            ->get();
                            ?>
                            @foreach ($cafrikas as $cafrika)
                                <li><a href="#" data-toggle="modal" data-target="#{{$cafrika->country_id}}_Modal">{{ $cafrika->country }}</a></li>

                                <div class="modal fade" id="{{$cafrika->country_id}}_Modal" tabindex="-1" role="dialog" aria-labelledby="{{$cafrika->country_id}}_ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="{{$cafrika->country_id}}_ModalLabel">{{ $cafrika->country }}</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="row">

                                                            @if($cafrika->website)
                                                            <div class="col-sm-12 text-center"><h2><a href="http://{{ $cafrika->website }}/">{{ $cafrika->website }}</a></h2></div>
                                                            <div class="col-sm-12"><hr></div>
                                                            @endif


                                                        <div class="col-sm-6" style="background-color: #00b9b5; color: white">
                                                                Chief Representative(s)
                                                        </div>
                                                        <div class="col-sm-6" style="background-color: #f26649; color: white">
                                                                Liaison Officers
                                                        </div>

                                                <?php
                                                //Nomer 1
                                                $lafrikas_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 1)
                                                ->where('country_id', $cafrika->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(0)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lafrikas_cr as $lafrika_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lafrika_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lafrikas_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 1)
                                                ->where('country_id', $cafrika->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(0)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lafrikas_lo as $lafrika_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lafrika_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach


                                                <?php
                                                //Nomer 2
                                                $lafrikas_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 1)
                                                ->where('country_id', $cafrika->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(1)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lafrikas_cr as $lafrika_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lafrika_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lafrikas_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 1)
                                                ->where('country_id', $cafrika->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(1)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lafrikas_lo as $lafrika_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lafrika_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                //Nomer 3
                                                $lafrikas_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 1)
                                                ->where('country_id', $cafrika->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(2)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lafrikas_cr as $lafrika_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lafrika_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lafrikas_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 1)
                                                ->where('country_id', $cafrika->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(2)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lafrikas_lo as $lafrika_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lafrika_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                            @endforeach

						</ul>
                    </div>

                    <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <ul>
                            <?php
                            $casias = DB::table('cms_country')
                            ->where('directory_id', 2)
                            ->orderBy('country_id', 'ASC')
                            ->get();
                            ?>
                            @foreach ($casias as $casia)
                                <li><a href="#" data-toggle="modal" data-target="#{{$casia->country_id}}_Modal">{{ $casia->country }}</a></li>

                                <div class="modal fade" id="{{$casia->country_id}}_Modal" tabindex="-1" role="dialog" aria-labelledby="{{$casia->country_id}}_ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="{{$casia->country_id}}_ModalLabel">{{ $casia->country }}</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="row">

                                                            @if($casia->website)
                                                            <div class="col-sm-12 text-center"><h2><a href="http://{{ $casia->website }}/">{{ $casia->website }}</a></h2></div>
                                                            <div class="col-sm-12"><hr></div>
                                                            @endif


                                                        <div class="col-sm-6" style="background-color: #00b9b5; color: white">
                                                                Chief Representative(s)
                                                        </div>
                                                        <div class="col-sm-6" style="background-color: #f26649; color: white">
                                                                Liaison Officers
                                                        </div>

                                                <?php
                                                //Nomer 1
                                                $lasias_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 2)
                                                ->where('country_id', $casia->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(0)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lasias_cr as $lasia_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lasia_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lasias_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 2)
                                                ->where('country_id', $casia->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(0)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lasias_lo as $lasia_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lasia_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach


                                                <?php
                                                //Nomer 2
                                                $lasias_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 2)
                                                ->where('country_id', $casia->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(1)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lasias_cr as $lasia_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lasia_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lasias_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 2)
                                                ->where('country_id', $casia->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(1)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lasias_lo as $lasia_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lasia_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                //Nomer 3
                                                $lasias_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 2)
                                                ->where('country_id', $casia->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(2)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lasias_cr as $lasia_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lasia_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lasias_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 2)
                                                ->where('country_id', $casia->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(2)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lasias_lo as $lasia_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lasia_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>


                            @endforeach

                        </ul>
                    </div>

                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <ul>
                            <?php
                            $cerops = DB::table('cms_country')
                            ->where('directory_id', 3)
                            ->orderBy('country_id', 'ASC')
                            ->get();
                            ?>
                            @foreach ($cerops as $cerop)
                                <li><a href="#" data-toggle="modal" data-target="#{{$cerop->country_id}}_Modal">{{ $cerop->country }}</a></li>

                                <div class="modal fade" id="{{$cerop->country_id}}_Modal" tabindex="-1" role="dialog" aria-labelledby="{{$cerop->country_id}}_ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="{{$cerop->country_id}}_ModalLabel">{{ $cerop->country }}</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="row">

                                                            @if($cerop->website)
                                                            <div class="col-sm-12 text-center"><h2><a href="http://{{ $cerop->website }}/">{{ $cerop->website }}</a></h2></div>
                                                            <div class="col-sm-12"><hr></div>
                                                            @endif


                                                        <div class="col-sm-6" style="background-color: #00b9b5; color: white">
                                                                Chief Representative(s)
                                                        </div>
                                                        <div class="col-sm-6" style="background-color: #f26649; color: white">
                                                                Liaison Officers
                                                        </div>

                                                <?php
                                                //Nomer 1
                                                $lerops_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 3)
                                                ->where('country_id', $cerop->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(0)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lerops_cr as $lerop_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lerop_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lerops_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 3)
                                                ->where('country_id', $cerop->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(0)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lerops_lo as $lerop_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lerop_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach


                                                <?php
                                                //Nomer 2
                                                $lerops_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 3)
                                                ->where('country_id', $cerop->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(1)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lerops_cr as $lerop_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lerop_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lerops_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 3)
                                                ->where('country_id', $cerop->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(1)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lerops_lo as $lerop_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lerop_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                //Nomer 3
                                                $lerops_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 3)
                                                ->where('country_id', $cerop->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(2)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lerops_cr as $lerop_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lerop_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lerops_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 3)
                                                ->where('country_id', $cerop->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(2)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lerops_lo as $lerop_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lerop_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>


                            @endforeach

                        </ul>
                    </div>

                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <ul>
                            <?php
                            $cmidls = DB::table('cms_country')
                            ->where('directory_id', 4)
                            ->orderBy('country_id', 'ASC')
                            ->get();
                            ?>
                            @foreach ($cmidls as $cmidl)
                                <li><a href="#" data-toggle="modal" data-target="#{{$cmidl->country_id}}_Modal">{{ $cmidl->country }}</a></li>

                                <div class="modal fade" id="{{$cmidl->country_id}}_Modal" tabindex="-1" role="dialog" aria-labelledby="{{$cmidl->country_id}}_ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="{{$cmidl->country_id}}_ModalLabel">{{ $cmidl->country }}</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="row">

                                                            @if($cmidl->website)
                                                            <div class="col-sm-12 text-center"><h2><a href="http://{{ $cmidl->website }}/">{{ $cmidl->website }}</a></h2></div>
                                                            <div class="col-sm-12"><hr></div>
                                                            @endif


                                                        <div class="col-sm-6" style="background-color: #00b9b5; color: white">
                                                                Chief Representative(s)
                                                        </div>
                                                        <div class="col-sm-6" style="background-color: #f26649; color: white">
                                                                Liaison Officers
                                                        </div>

                                                <?php
                                                //Nomer 1
                                                $lmidls_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 4)
                                                ->where('country_id', $cmidl->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(0)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lmidls_cr as $lmidl_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lmidl_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lmidls_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 4)
                                                ->where('country_id', $cmidl->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(0)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lmidls_lo as $lmidl_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lmidl_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach


                                                <?php
                                                //Nomer 2
                                                $lmidls_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 4)
                                                ->where('country_id', $cmidl->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(1)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lmidls_cr as $lmidl_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lmidl_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lmidls_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 4)
                                                ->where('country_id', $cmidl->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(1)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lmidls_lo as $lmidl_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lmidl_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                //Nomer 3
                                                $lmidls_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 4)
                                                ->where('country_id', $cmidl->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(2)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lmidls_cr as $lmidl_cr)
                                                    <div class="col-sm-6">
                                                        {!! $lmidl_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $lmidls_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 4)
                                                ->where('country_id', $cmidl->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(2)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($lmidls_lo as $lmidl_lo)
                                                    <div class="col-sm-6">
                                                        {!! $lmidl_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>


                            @endforeach

                        </ul>
                    </div>

                    <div class="tab-pane fade" id="v-pills-test" role="tabpanel" aria-labelledby="v-pills-test-tab">
                        <ul>
                            <?php
                            $coceanias = DB::table('cms_country')
                            ->where('directory_id', 5)
                            ->orderBy('country_id', 'ASC')
                            ->get();
                            ?>
                            @foreach ($coceanias as $coceania)
                                <li><a href="#" data-toggle="modal" data-target="#{{$coceania->country_id}}_Modal">{{ $coceania->country }}</a></li>

                                <div class="modal fade" id="{{$coceania->country_id}}_Modal" tabindex="-1" role="dialog" aria-labelledby="{{$coceania->country_id}}_ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="{{$coceania->country_id}}_ModalLabel">{{ $coceania->country }}</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="row">

                                                            @if($coceania->website)
                                                            <div class="col-sm-12 text-center"><h2><a href="http://{{ $coceania->website }}/">{{ $coceania->website }}</a></h2></div>
                                                            <div class="col-sm-12"><hr></div>
                                                            @endif


                                                        <div class="col-sm-6" style="background-color: #00b9b5; color: white">
                                                                Chief Representative(s)
                                                        </div>
                                                        <div class="col-sm-6" style="background-color: #f26649; color: white">
                                                                Liaison Officers
                                                        </div>

                                                <?php
                                                //Nomer 1
                                                $loceanias_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 5)
                                                ->where('country_id', $coceania->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(0)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($loceanias_cr as $loceania_cr)
                                                    <div class="col-sm-6">
                                                        {!! $loceania_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $loceanias_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 5)
                                                ->where('country_id', $coceania->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(0)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($loceanias_lo as $loceania_lo)
                                                    <div class="col-sm-6">
                                                        {!! $loceania_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach


                                                <?php
                                                //Nomer 2
                                                $loceanias_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 5)
                                                ->where('country_id', $coceania->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(1)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($loceanias_cr as $loceania_cr)
                                                    <div class="col-sm-6">
                                                        {!! $loceania_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $loceanias_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 5)
                                                ->where('country_id', $coceania->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(1)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($loceanias_lo as $loceania_lo)
                                                    <div class="col-sm-6">
                                                        {!! $loceania_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                //Nomer 3
                                                $loceanias_cr = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 5)
                                                ->where('country_id', $coceania->country_id)
                                                ->where('category', 'CR')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(2)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($loceanias_cr as $loceania_cr)
                                                    <div class="col-sm-6">
                                                        {!! $loceania_cr->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                                <?php
                                                $loceanias_lo = DB::table('cms_global_list')
                                                ->select('content')
                                                //->where('directory_id', 5)
                                                ->where('country_id', $coceania->country_id)
                                                ->where('category', 'LO')
                                                ->orderBy('global_list_id', 'ASC')
                                                ->skip(2)->take(1)
                                                ->get();
                                                ?>
                                                @foreach ($loceanias_lo as $loceania_lo)
                                                    <div class="col-sm-6">
                                                        {!! $loceania_lo->content !!}
                                                        <hr>
                                                    </div>
                                                @endforeach

                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>


                            @endforeach

                        </ul>
                    </div>

				  </div>
				</div>
			  </div>


		</div>
	</section>


<br>
<br>






	<br>
	<br>
    @include('pages.compro.follow')
@endsection
