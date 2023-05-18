@extends('layouts.appcompro')

@section('content')
<style>
@media (max-width: 1280px) {
  
  .gambar {
      margin-left: -32px !important;
  }
  
  .mobileimg {
     height: 183px !important;
  }
  
  .imgres {
     margin-left: -33% !important;
  }
  
}
</style>
<?php
$imgBanner = asset($subService->image);
?>
	<div class="space-top">
	</div>

	<section class="about flex-box mobileimg"
		style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
		<div class="boxes">
			<h1>
			<?php
			    $lang_org = session('language');
			    if($lang_org=='en')
			        {
			            echo $subService->name;
			        }
			        else
			        {
			            echo $subService->name_ch;
			        }
			    
			?>
			</h1>
		</div>
	</section>
	<section  class="services-page">
		<div class="container container-content">
			<div class="row">
					<!-- <div class="row"> -->
						<div class="col-sm-12 col-text-program "style="line-height:1.5">
                        
                        <?php
        			    $lang_org = session('language');
        			    if($lang_org=='en')
        			        {
        			            echo $subService->description;
        			        }
        			        else
        			        {
        			            echo $subService->description_ch;
        			        }
        			    
        			     ?>
                        </div>	
					<!-- </div> -->
			</div>
		</div>
	</section>
    <?php if($subService->situation_part !=""){?>
    <section style="background-color:#f8f9fa;">
    <br>
        <div class="container container-content">
        <br>
            <div class="row">
                <div class="col-sm-12 col-text-program "style="line-height:1.5">
                  
                    <?php
        			    $lang_org = session('language');
        			    if($lang_org=='en')
        			        {
        			            echo $subService->situation_part;
        			        }
        			        else
        			        {
        			            echo $subService->situation_part_ch;
        			        }
        			    
        			?>
                </div>
            </div>
        </div>
        <br>
    </section>
    <?php }?>
    
    <section  class="services-page" style="{{ count($attachment) > 0 ? 'padding-top: 0px;' : '' }}">

    	<div class="container container-content">

    <!-- ATTACHMENT -->
	@if(count($attachment) > 0)
		<div class="row">
			@foreach($attachment as $file)
				@php
					$filename = explode('.', $file->file_name);
					$ext = end($filename);
					$icon = 'fa fa-file-archive-o';

					if(in_array($ext, ['jpg', 'jpeg', 'gif', 'png']))
						$icon = 'fa fa-file-image-o';

					if(in_array($ext, ['doc', 'docx']))
						$icon = 'fa fa-file-word-o';

					if(in_array($ext, ['xls', 'xlsx']))
						$icon = 'fa fa-file-excel-o';

					if(in_array($ext, ['ppt', 'pptx']))
						$icon = 'fa fa-file-powerpoint-o';

					if(in_array($ext, ['pdf']))
						$icon = 'fa fa-file-pdf-o';

				@endphp
				<div class="col-sm-6 col-lg-2" style="text-align: center; word-wrap: break-word; margin-top: 20px;">
					<div style="margin-bottom: 8px;">
						<i class="{{ $icon }}" style="font-size: 30pt;"></i>
					</div>
					<a href="{{ $file->file_url ? asset($file->file_url) : 'javascript:void(0);' }}" target="_blank">{{ $file->file_name }}</a>
				</div>
			@endforeach
		</div>
		<div style="margin-bottom: 20px;"></div>
	@endif
		</div>

    <br>
        <?php if($subService->help_part !=""){?>
		<div class="container container-content">
			<div class="row">
					<!-- <div class="row"> -->
						<div class="col-sm-12 col-text-program "style="line-height:1.5">
                      
                        <?php
        			    $lang_org = session('language');
        			    if($lang_org=='en')
        			        {
        			            echo $subService->help_part;
        			        }
        			        else
        			        {
        			            echo $subService->help_part_ch;
        			        }
        			    
        			?>
                        </div>	
					<!-- </div> -->
			</div>


		</div>
		<br><br>
        <?php }?>
        <?php if(count($partner) != 0){?>
		<div class="container container-content">
        <div class="row">
					<div class="col-sm-12 col-text-program "style="line-height:1.5">
                        <h3>Our {{ $subService->name }} Partners</h3>
                    </div>	
			    </div>
			</div>
        <div class="row">
			<div class="col-12">
			    
				<section class="regular slider">
				    
				<?php foreach ($partner as $key) { ?>
					<div>
						<div>
							<span>
								<img src="{{asset($key->image)}}" style="width: 200px" class="gambar">
							</span>
						</div>
					</div>																		
				<?php }?>
				</section>
			</div>
        </div>
        <?php }?>
	</section>
    
    <section style="background-color:#f8f9fa;">
    <br><br>
        <div class="container container-content">
            <div class="row">
				<div class="col-sm-9">
					<h4 style="font-weight:900">@lang('main.footer_contact_us')</h4>
					<?php if($contact_one !=""){?>
                    <div class="row">
						<div class="col-sm-3">
							<img class="img-tl" src="{{asset($contact_one->image)}}" alt="" style="height:150px">
						</div>
						<div class="col-sm-6" style="font-size:xx-large">
							<h6>{{ $contact_one->name }}</h6>
							<h5>{{ $contact_one->title }}</h5>
							<h5>{{ $contact_one->phone }}</h5>
							<div class="social-contact">
								<a href="{{route('compro.servCon', ['id'=> $contact_one->contact_id, 'sername' => $subService->name])}}" class="fa fa-envelope"></a>
								<a href="{{$contact_one->linkedin}}" class="fa fa-linkedin"></a>
							</div>
						</div>
					</div>
                    <?php }?>
                    <br><?php if($contact_two !=""){?>
                    <div class="row">
						<div class="col-sm-3">
							<img class="img-tl" src="{{asset($contact_two->image)}}" alt="" style="height:150px">
						</div>
						<div class="col-sm-6" style="font-size:xx-large">
							<h6>{{ $contact_two->name }}</h6>
							<h5>{{ $contact_two->title }}</h5>
							<h5>{{ $contact_two->phone }}</h5>
							<div class="social-contact">
								<a href="{{route('compro.servCon', ['id'=> $contact_two->contact_id, 'sername' => $subService->name])}}" class="fa fa-envelope"></a>
								<a href="{{$contact_two->linkedin}}" class="fa fa-linkedin"></a>
							</div>
						</div>
					</div>
                    <?php }?>
                </div>
                <div class="col-sm-3">
					@include('pages.compro.follow')
                </div>
            </div>
        </div>
        <br><br>
    </section>
    
@endsection
