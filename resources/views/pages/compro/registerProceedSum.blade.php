@extends('layouts.appcompro')

@section('content')

<?php

$imgBanner = asset('assets/compro/assets/frontend_assets/images/image/free.jpg');
$sum = session()->get('transfer')[0];
// echo "<pre>";
// print_r($sum);
// echo "</pre>";
// die();
?>
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

function convert_tgl_to_userEN($tgl){
    $tanggal =  substr($tgl, 0,10);
    $bulan = array (1 =>   'January',
                'February',
                'March',
                'April',
                'May',
                'Juny',
                'July',
                'Augustus',
                'September',
                'October',
                'November',
                'Desember'
            );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}
?>



	<div class="section-one text-center margin-right-0" style="background-image: url('{{$imgBanner}}');">
		<!-- <div class="wrapper-color"></div> -->
		<div class="container container-content">
			<div class="row ">
				<div class="col-sm-12 color-white">
					<div class="content-section-one">
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2 text-center">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="section-content-career">
		<div class="container container-content container-form-job">
			<div class="wrapper-job">
				<div class="row">
					<div class="col-sm-12">
						<h3>@lang('main.register_process_training_order')</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<table>
							<tr>
								<td>@lang('main.register_process_training_order_name')</td>
								<td>: {{$sum['name']}}</td>
							</tr>
							<tr>
								<td>@lang('main.register_process_training_order_birth')</td>
								<td>: {{convert_tgl_to_userEN($sum['birth'])}}</td>
							</tr>
							<tr>
								<td>@lang('main.register_process_training_order_gender')</td>
								<td>: {{$sum['gender']}}</td>
							</tr>
							<tr>
								<td>@lang('main.register_process_training_order_email')</td>
								<td>: {{$sum['email']}}</td>
							</tr>
							<tr>
								<td>@lang('main.register_process_training_order_mobile')</td>
								<td>: {{$sum['mobile']}}</td>
							</tr>
							<tr>
								<td>no. KTP</td>
								<td>: {{$sum['ktp']}}</td>
							</tr>
							<tr>
								<td>@lang('main.register_process_training_order_training')</td>
								<td>: <strong> {{$sum['name_train_en']}} </strong></td>
							</tr>
							<tr>
								<td>@lang('main.register_process_training_order_class')</td>
								<td>: <strong> {{$sum['name_class_en']}} </strong></td>
							</tr>
							<tr>
								<td>@lang('main.register_process_training_order_schedule')</td>
								<td>: {{$schedule[0]->day_en }}, {{$schedule[0]->time}} - {{$schedule[0]->time_end}}</td>
							</tr>
						</table>
					</div>
					<div class="col-sm-6">
						<table>
							<tr>
								<td>@lang('main.register_process_training_order_price')</td>
								<td>: {{ number_format($sum['cost_price']) }}</td>
							</tr>
							<tr>
								<td>@lang('main.register_process_training_order_registerfee')</td>
								<td>: {{ number_format($sum['cost_regis']) }}</td>
							</tr>
							<tr>
								<td>@lang('main.register_process_training_order_total')</td>
								<td>: {{ number_format($sum['cost_total']) }}</td>
							</tr>
							<tr>
								<td></td>
							</tr>
							<tr>
								<td>Transfer ke no. rekening</td>
								<td>:  <strong>{{ $sum['norek'] }}</strong></td>
							</tr>
							<tr>
								<td>@lang('main.register_process_training_order_bank')</td>
								<td>:  <strong>BCA</strong></td>
							</tr>
						</table>
					</div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <p>@lang('main.register_process_training_order_thank')</p>
            </div>
        </div>
				<div class="row">
					<div class="col-sm-12 text-center">
						<a class="btn btn-default" href="{{ route('compro.home') }}">@lang('main.register_process_training_order_back')</a>
					</div>
				</div>

			</div>
		</div>
	</div>
@endsection
