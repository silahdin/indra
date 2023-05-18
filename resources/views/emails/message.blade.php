<?php
      $transfer = Session::get('transfer')[0];
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
<table>
	<tr>
		<td>Nama </td>
		<td>: {{ $name }}</td>
	</tr>
	<tr>
		<td>Phone </td>
		<td>: {{ $transfer['mobile'] }}</td>
	</tr>
	<tr>
		<td>Birth</td>
		<td>: {{convert_tgl_to_userEN($transfer['birth'])}}</td>
	</tr>
	<tr>
		<td>Gender</td>
		<td>: {{$transfer['gender']}}</td>
	</tr>	
	<tr>
		<td>Email</td>
		<td>: {{$transfer['email']}}</td>
	</tr>	
	<tr>
		<td>Mobile</td>
		<td>: {{$transfer['mobile']}}</td>
	</tr>														
	<tr>
		<td>Training</td>
		<td>: <strong> {{$transfer['name_train_en']}} </strong></td>
	</tr>
	<tr>
		<td>Class</td>
		<td>: <strong> {{$transfer['name_class_en']}} </strong></td>
	</tr>
	<tr>
		<td>Schedule</td>
		<td>: {{$transfer['schedule']->day_en }}, {{$transfer['schedule']->time}} - {{$transfer['schedule']->time_end}}</td>
	</tr>
	<tr>
		<td>Price</td>
		<td>: {{ number_format($transfer['cost_price']) }}</td>
	</tr>
	<tr>
		<td>Register Fee</td>
		<td>: {{ number_format($transfer['cost_regis']) }}</td>
	</tr>
	<tr>
		<td>Total</td>
		<td>: {{ number_format($transfer['cost_total']) }}</td>
	</tr>	
	<tr>
		<td></td>
	</tr>
	<tr>
		<td>Transfer ke no. rekening</td>
		<td>:  <strong>{{ $transfer['norek'] }}</strong></td>
	</tr>	
	<tr>
		<td>Bank</td>
		<td>:  <strong>BCA</strong></td>
	</tr>	
</table>