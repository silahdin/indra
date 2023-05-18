@extends('layouts.appresult')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<!-- bootstrap datepicker -->
<script src="{{ asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">

<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  margin-top: 35px;
  margin-bottom: 0px;
  font-family: Raleway;
  padding: 40px;
  width: 90%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 3px;
  width: 100%;
  font-size: 15px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */


button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}

.input{
  border: 0;
  outline: 0;
  background: transparent;
  border-bottom: 1px solid #CCC;
}

.tebal {
    font-weight: bold;
}
</style>
<body>

<form id="regForm" action="{{route('wizard.post')}}" method="POST">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>Summary</h1>
    <hr>

    <div class="row">
        <div class="col-sm-6">
                <label for="sel1">Nama Lengkap/ Full Name</label>
                <br><span class="tebal">{{ $dpribadi->full_name }}</span>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Posisi/Job Position</label>
                <br><span class="tebal">{{ $dpribadi->job_position }}</span>
                <br><br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Jenis Kelamin/ Gender</label>
                <br><span class="tebal">{{ $dpribadi->gender }}</span>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Status/ Marital Status</label>
                <br><span class="tebal">{{ $dpribadi->marital_status }}</span>
                <br><br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Agama/ Religion</label>
                <br><span class="tebal">{{ $dpribadi->religion }}</span>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Alamat/ Address</label>
                <br><span class="tebal">{{ $dpribadi->address }}</span>
                <br><br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Tempat / Place</label>
                <br><span class="tebal">{{ $dpribadi->place_birth }}</span>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Tanggal Lahir/ Date of Birth</label>
                <br><span class="tebal">{{ $dpribadi->date_birth }}</span>
                <br><br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Kesiapan bekerja/ Date of Availability</label>
                <br><span class="tebal">{{ $dpribadi->date_availability }}</span>
                <br><br>
        </div>
        <div class="col-sm-6">

            &nbsp;

            <br>
        </div>
        <div class="col-sm-4">
                <label for="sel1">Kontak Informasi/ Contact Information</label>
                <br><span class="tebal">{{ $dpribadi->contact_home }}</span>
        </div>
        <div class="col-sm-4">
                <label for="sel1">Kontak Informasi/ Contact Information</label>
                <br><span class="tebal">{{ $dpribadi->contact_cellular }}</span>
        </div>
        <div class="col-sm-4">
                <label for="sel1">Kontak Informasi/ Contact Information</label>
                <br><span class="tebal">{{ $dpribadi->contact_email }}</span>
                <br><br>
        </div>
    </div>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Susunan Keluarga/ Family History</h5>
    <table border="1px" width="100%">
      <tr>
        <td align="center">No.</td>
        <td align="center">Nama / <br>Name</td>
        <td align="center"> Hubungan/ <br>Relationship</td>
        <td align="center">Tanggal Lahir/ <br>Date of Birth</td>
        <td align="center">Pendidikan/ <br>Education</td>
        <td align="center">Pekerjaan/ <br>Occupation</td>
      </tr>
      <?php 
      $no1 = 1;
      $dkeluargas = DB::table('pelamar_keluarga')
        ->where('users_id', $iduser)
        ->where('id_career', $jobid)
        ->get();
       ?>
       @foreach($dkeluargas as $dkeluarga)
      <tr align="center" class="">
        <td class="inner">
            {{$no1}}.
        </td>
        <td>{{$dkeluarga->name}}</td>
        <td>{{$dkeluarga->relationship}}</td>
        <td>{{$dkeluarga->dob}}</td>
        <td>{{$dkeluarga->education}}</td>
        <td>{{$dkeluarga->occupation}}</td>
      </tr>
      <?php $no1++; ?>
      @endforeach
    </table>

    <hr>
    <?php 
      $ddata = DB::table('pelamar_data')
      ->where('users_id', $iduser)
      ->where('id_career', $jobid)
        ->first();
       ?>
    <div class="row">
        <div class="col-sm-12">
                <label for="sel1">Kompensasi terakhir/Latest compensation</label>
                <br><span class="tebal">{{ number_format($ddata->latest_compensation) }}</span>
        </div>
    </div>
    <br>
    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Riwayat Pekerjaan/ Work Experience</h5>
    <table border="1px" width="100%">
      <tr>
        <td align="center">No.</td>
        <td align="center">Tahun Bekerja/ <br>Year</td>
        <td align="center">Perusahaan/ <br>Employer</td>
        <td align="center">Posisi/ <br>Title</td>
        <td align="center">Deskripsi Pekerjaan/ <br>Job Responsibilities</td>
        <td align="center">Prestasi/ <br>Achievements</td>
        <td align="center">Alasan Keluar/ <br>Reasons for Leaving</td>
      </tr>

      <?php 
      $no2 = 1;
      $dexperiences = DB::table('pelamar_experience')
      ->where('users_id', $iduser)
      ->where('id_career', $jobid)
        ->get();
       ?>
       @foreach($dexperiences as $dexperience)

      <tr align="center" class="tr_clone">
        <td class="inner">
            {{$no2}}.
        </td>
        <td>{{$dexperience->from}} - {{$dexperience->to}}</td>
        <td>{{$dexperience->company}}</td>
        <td>{{$dexperience->position}}</td>
        <td>{{$dexperience->job_responsibilities}}</td>
        <td>{{$dexperience->achievements}}</td>
        <td>{{$dexperience->reason}}</td>
      </tr>
      <?php $no2++; ?>
      @endforeach

    </table>

    <br>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Referensi/  Professional References <small>(provide at least 2 names)</small></h5>
    <table border="0px" width="100%">
      
    <?php 
    $no3 = 1;
    $dreferences = DB::table('pelamar_references')
    ->where('users_id', $iduser)
    ->where('id_career', $jobid)
    ->get();
    ?>
    @foreach($dreferences as $dreference)
      <tr>
        <td style="width: 500px"><strong>{{$no3}}.</strong> Nama/ Name</td>
        <td>:</td>
        <td><span class="tebal">{{ $dreference->name }}</span></td>
      </tr>
      <tr>
          <td>Hubungan/ Relationship</td>
          <td>:</td>
          <td><span class="tebal">{{ $dreference->relationship }}</span></td>
      </tr>
      <tr>
        <td>Nomor/email untuk dihubungi/ Contact No. Ponsel/ Cellular & Email</td>
        <td>:</td>
        <td><span class="tebal">{{ $dreference->contact }}</span></td>
      </tr>
      <?php $no3++; ?>
      @endforeach

    </table>

    <hr>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Riwayat Pendidikan/ Educational History</h5>
    <table border="0px" width="100%">
    <?php 
    $no4 = 1;
    $deducations = DB::table('pelamar_education')
    ->where('users_id', $iduser)
    ->where('id_career', $jobid)
    ->get();
    ?>
    @foreach($deducations as $deducation)
    <tr>
    <td style="width: 400px"><strong>{{$no4}}.</strong> {{ $deducation->tipe }}</td>
    <td>:</td>
    <td><span class="tebal">{{ $deducation->name }}</span></td>
    </tr>
    <tr>
        <td>Jurusan/ Major</td>
        <td>:</td>
        <td><span class="tebal">{{ $deducation->major }}</span></td>
    </tr>
    @if($deducation->ipk!="" && $deducation->ipk!=0)
    <tr>
        <td>IPK/ GPA</td>
        <td>:</td>
        <td><span class="tebal">{{ $deducation->ipk }}</span></td>
    </tr>
    @endif
    <?php $no4++; ?>
    @endforeach

    </table>

    <hr>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Daftar pelatihan yang pernah diikuti, baik internal maupun eksternal/ List of internal and external trainings: </h5>
    <table border="1px" width="100%">
      <tr>
        <td align="center">No.</td>
        <td align="center">Nama Pelatihan/ <br>Training Subject</td>
        <td align="center">Penyelenggara/ <br>Host</td>
        <td align="center">Tahun/ <br>Year</td>
        <td align="center">Hasil/ <br>Result</td>
      </tr>
      <?php 
        $no5 = 1;
        $dtrainings = DB::table('pelamar_training')
        ->where('users_id', $iduser)
        ->where('id_career', $jobid)
        ->get();
        ?>
        @foreach($dtrainings as $dtraining)
      <tr align="center" class="">
        <td class="inner">
            {{$no5}}.
        </td>
        <td>{{$dtraining->subject}}</td>
        <td>{{$dtraining->host}}</td>
        <td>{{$dtraining->year}}</td>
        <td>{{$dtraining->result}}</td>
      </tr>
      <?php $no5++; ?>
    @endforeach
    </table>

    <hr>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Sertifikasi profesional yang dimiliki/ Professional certifications: </h5>
    <table border="1px" width="100%">
      <tr>
        <td align="center">No.</td>
        <td align="center">Nama Sertifikasi/ <br>Name of Certificates</td>
        <td align="center">Institusi yang Menerbitkan/ <br>Issuer</td>
        <td align="center">Tahun/ <br>Year</td>
      </tr>

      <?php 
        $no6 = 1;
        $dcertifications = DB::table('pelamar_certification')
        ->where('users_id', $iduser)
        ->where('id_career', $jobid)
        ->get();
        ?>
        @foreach($dcertifications as $dcertification)
      <tr align="center" class="">
        <td class="inner">
                {{$no6}}.
        </td>
        <td>{{$dcertification->name}}</td>
        <td>{{$dcertification->issuear}}</td>
        <td>{{$dcertification->year}}</td>
      </tr>
      <?php $no6++; ?>
    @endforeach
    </table>

    <hr>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Kemampuan komputer / Computer Ability </h5>
    <table border="1px" width="100%">
      <tr>
        <td align="center">Aplikasi /<br> Application</td>
        <td align="center">Tidak Mahir / <br>Unskilled </td>
        <td align="center">Kurang Mahir / <br>Poor  </td>
        <td align="center">Cukup Mahir /<br> Average </td>
        <td align="center">Mahir / <br> Skilled</td>
        <td align="center">Sangat Mahir / <br> Expert</td>
      </tr>

      <?php 
        $no8 = 1;
        $dcomputers = DB::table('pelamar_computer')
        ->where('users_id', $iduser)
        ->where('id_career', $jobid)
        ->get();
        ?>
        @foreach($dcomputers as $dcomputer)
      <tr>
        <td>{{$no8}}. {{$dcomputer->application}}</td>
        <td align="center">@if($dcomputer->nilai==1) <strong>X</strong> @endif</td>
        <td align="center">@if($dcomputer->nilai==2) <strong>X</strong> @endif</td>
        <td align="center">@if($dcomputer->nilai==3) <strong>X</strong> @endif</td>
        <td align="center">@if($dcomputer->nilai==4) <strong>X</strong> @endif</td>
        <td align="center">@if($dcomputer->nilai==5) <strong>X</strong> @endif</td>
      </tr>
      <?php $no8++; ?>
      @endforeach

    </table>

    <hr>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Kemampuan bahasa / Language Ability <span id="jumlahq"></span></h5>
    <input type="hidden" name="tlang" id="tlang" value="0">
    <table border="1px" width="100%">
      <tr>
        <td align="center">No.</td>
        <td align="center">Bahasa</td>
        <td align="center">Buruk / Poor</td>
        <td align="center">Cukup / Fair</td>
        <td align="center">Baik / Good</td>
        <td align="center">Lancar / Fluent</td>
      </tr>
      <?php 
        $no7 = 1;
        $dlanguages = DB::table('pelamar_language')
        ->where('users_id', $iduser)
        ->where('id_career', $jobid)
        ->get();
        ?>
        @foreach($dlanguages as $dlanguage)
      <tr align="center" class="tr_clone3">
        <td class="inner">
                {{$no7}}.
        </td>
        <td>{{$dlanguage->language}}</td>
        <td>@if($dlanguage->nilai==1) <strong>X</strong> @endif</td>
        <td>@if($dlanguage->nilai==2) <strong>X</strong> @endif</td>
        <td>@if($dlanguage->nilai==3) <strong>X</strong> @endif</td>
        <td>@if($dlanguage->nilai==4) <strong>X</strong> @endif</td>
      </tr>
      <?php $no7++; ?>
       @endforeach

    </table>

    <br><br>

  </div>
  
  
  <div style="overflow:auto;">
      <div style="float:right;">
        <button type="button" id="nextBtn" onclick="window.close()">Close</button>
      </div>
    </div>
  <!-- Circles which indicates the steps of the form: -->
</form>

@endsection
