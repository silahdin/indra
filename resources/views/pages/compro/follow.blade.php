<section class="about flex-box" style="background-color:#8c9090;text-align:center;color:wheat">
		<div class="container" style="">
			<div style="margin-top:20px">
				<span><b>Reanda Indonesia</b></span>
			</div>

			<?php
				$follows = DB::table('new_cms_follows')->get();
			?>

			<div style="padding-bottom:30px; text-align: center; padding-top: 20px;">

				@foreach($follows as $follow)

					@if($follow->status == 1)

						<img src="{{ asset($follow->icon) }}" width="25" height="25">

						<a {{ (@$follow->link_open == 1) ? 'target=_blank' : '' }} href="{{ @$follow->link }}" style="color:wheat; padding-left: 4px;">{{ @$follow->textline }}</a>

						<span style="padding-right: 20px;"></span>

					@endif

				@endforeach

			</div>
		</div>
	</section>