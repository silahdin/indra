@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<!-- bootstrap datepicker -->
<script src="{{ asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">

<style>
  //loading
  .lds-spinner {
    color: official;
    display: inline-block;
    position: relative;
    width: 64px;
    height: 64px;
  }
  .lds-spinner div {
    transform-origin: 32px 32px;
    animation: lds-spinner 1.2s linear infinite;
  }
  .lds-spinner div:after {
    content: " ";
    display: block;
    position: absolute;
    top: 3px;
    left: 29px;
    width: 5px;
    height: 14px;
    border-radius: 20%;
    background: blue;
  }
  .lds-spinner div:nth-child(1) {
    transform: rotate(0deg);
    animation-delay: -1.1s;
  }
  .lds-spinner div:nth-child(2) {
    transform: rotate(30deg);
    animation-delay: -1s;
  }
  .lds-spinner div:nth-child(3) {
    transform: rotate(60deg);
    animation-delay: -0.9s;
  }
  .lds-spinner div:nth-child(4) {
    transform: rotate(90deg);
    animation-delay: -0.8s;
  }
  .lds-spinner div:nth-child(5) {
    transform: rotate(120deg);
    animation-delay: -0.7s;
  }
  .lds-spinner div:nth-child(6) {
    transform: rotate(150deg);
    animation-delay: -0.6s;
  }
  .lds-spinner div:nth-child(7) {
    transform: rotate(180deg);
    animation-delay: -0.5s;
  }
  .lds-spinner div:nth-child(8) {
    transform: rotate(210deg);
    animation-delay: -0.4s;
  }
  .lds-spinner div:nth-child(9) {
    transform: rotate(240deg);
    animation-delay: -0.3s;
  }
  .lds-spinner div:nth-child(10) {
    transform: rotate(270deg);
    animation-delay: -0.2s;
  }
  .lds-spinner div:nth-child(11) {
    transform: rotate(300deg);
    animation-delay: -0.1s;
  }
  .lds-spinner div:nth-child(12) {
    transform: rotate(330deg);
    animation-delay: 0s;
  }
  @keyframes lds-spinner {
    0% {
      opacity: 1;
    }
    100% {
      opacity: 0;
    }
  }
     
//loading


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

.tengah {
    text-align: center;  
  }
</style>

<script>
$(document).ready(function(){
      var _token = $("input[name=_token]").val();
      $("#nextBtn").click(function(e){
          e.preventDefault();
          $.ajax({
              /* the route pointing to the post function */
              url: '{{route('technical.step1.post')}}',
              type: 'POST',
              /* send the csrf-token and the input to the controller */
              data: $("#regForm").serialize(),
              dataType: 'JSON',
              /* remind that 'data' is the response of the AjaxController */
              beforeSend: function() {
                $("#spinner").show();
                //$('#nextBtn').prop('disabled', true);
              },
              success: function (data) { 
                if(data.status == "success") {
                  window.location.href = '{{route('technical.test2', ['idjob' => $jobid])}}';
                } else {
                  $('html, body').animate({scrollTop: '100px'}, 1500);
                  //$('#nextBtn').prop('disabled', false);
                  printErrorMsg(data.errors);
                }
              },
              complete: function() {
                $("#spinner").hide();
               // $('#nextBtn').prop('disabled', true);
              },
          }); 
      });
 });   

function printErrorMsg (msg) {
  $(".print-error-msg").find("ul").html('');
  $(".print-error-msg").css('display','block');
  $.each( msg, function( key, value ) {
    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
  });
}
</script>
<body>

<form id="regForm" action="{{route('technical.step1.post')}}" method="POST">
    <input type="hidden" name="idjob" value="{{$jobid}}">
<div style="float:right;">
    <h5>Step 1</h5>
</div>

  @csrf
  <input type="hidden" name="step" value="2">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>Technical Test</h1>
    <hr>
    
    <div class="alert alert-danger print-error-msg" style="display:none">
      <ul></ul>
    </div>
    
    <p class="tengah"><span style="font-size: 18px; font-weight: bold">I.	PILIHAN GANDA</span></p>

    <p><span style="font-size: 16px; font-weight: bold"><u>Untuk menjawab soal no. 1 s.d. 2 perhatikan ilustrasi berikut:</u><br>
      Data berikut ini adalah catatan laporan keuangan sehubungan dengan pengungkapan aset tetap untuk tahun berakhir 31 Desember  2009 dan 2008 dari PT Hayalan: 
    </span></p>    
    
    <table border="0" style="width: 50%">
      <tr>
        <td>&nbsp;</td>
        <td><strong>2009</strong></td>
        <td><strong>2008</strong></td>
      </tr>
      <tr>
        <td>Tanah</td>
        <td>180,000,000</td>
        <td>200,500,000</td>
      </tr>
      <tr>
        <td>Bangunan</td>
        <td>184,000,000</td>
        <td>80,000,000</td>
      </tr>
      <tr>
          <td>Mesin</td>
          <td>111,750,000</td>
          <td>88,500,000</td>
      </tr>
      <tr>
          <td>Peralatan kantor</td>
          <td>31,000,000</td>
          <td>44,400,000</td>
      </tr>
      <tr>
        <td>Kendaraan</td>
        <td>182,250,000</td>
        <td>231,375,000</td>
      </tr>
      <tr>
          <td>Akumulasi penyusutan</td>
          <td>(226,621,250)</td>
          <td>(158,532,500)</td>
        </tr>
    </table>
    <br>
    <u>Catatan/Asumsi :</u> 
    <br>
    <i class="fa fa-check"></i> penjualan tanah ditahun 2009 dengan keuntungan Rp45 juta. Tidak ada penambahan tanah selama tahun berjalan.<br>
    <i class="fa fa-check"></i> Dalam tahun berjalan terjadi penambahan gedung. <br>
    <i class="fa fa-check"></i> Satu unit mesin dengan harga perolehan Rp 75 juta dan telah disusutkan senilai Rp60 juta dijual dengan kerugian Rp10 juta. Ditahun berjalan perusahaan membeli 1 unit mesin baru. <br>
    <i class="fa fa-check"></i> Tidak ada pembelian peralatan kantor selama periode berjalan. Diakhir tahun terjadi penghapusan peralatan kantor dengan kerugian Rp3 juta. <br>
    <i class="fa fa-check"></i> 2 Unit kendaraan yang mempunyai nilai buku Rp 100 juta dan telah dengan kentungan sebesar Rp25 juta. Sebagai gantinya diakhir tahun 2004, perusahaan membeli 2 unit kendaraan baru secera leasing. Cicilan pertama dibayar dibulan Januari 2010:
    <br><br>
    <table border="0" style="width: 100%">
        <?php $no=1; ?>
        @foreach($denglish as $dsoal)
        <input type="hidden" name="q[]" value="{{$dsoal->id_question}}">
        <tr>
            <td><strong>{{$no}}.</strong> {!!$dsoal->question!!}</td>
        </tr>
        <tr>
            <td>
                    <table border="0px" style="width: 100%">
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal->id_question}}" value="a"> A.</strong> {{$dsoal->a}}</td>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal->id_question}}" value="c"> C.</strong> {{$dsoal->c}}</td>
                        </tr>
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal->id_question}}" value="b"> B.</strong> {{$dsoal->b}}</td>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal->id_question}}" value="d"> D.</strong> {{$dsoal->d}}</td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <?php $no++; ?>
        @endforeach
    </table>
    

<u>Untuk menjawab soal no. 3 s.d. 7 perhatikan ilustrasi berikut:</u><br><br>

Berikut adalah catatan keuangan perusahaan sehubungan dengan aset/kewajiban pajak tangguhan serta data pajak lainnya: 
<table border="0" style="width: 50%">
    <tr>
      <td>&nbsp;</td>
      <td><strong>2009</strong></td>
      <td><strong>2008</strong></td>
    </tr>
    <tr>
        <td><i>Aset pajak tangguhan</i></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Penyisihan bonus</td>
        <td>122,000,000</td>
        <td>179,000,000</td>
      </tr>
    <tr>
        <td>Akumulasi depresiasi</td>
        <td>-</td>
        <td>200,000,000</td>
    </tr>
    <tr>
        <td>Penyisihan piutang tak tertagih</td>
        <td>102,000,000</td>
        <td>30,000,000</td>
    </tr>
    <tr>
        <td>Penyisihan imbalan kerja</td>
        <td>239,000,000</td>
        <td>170,000,000</td>
    </tr>
    <tr>
        <td>Penyisihan penurunan persediaan</td>
        <td>13,500,000</td>
        <td>37,500,000</td>
    </tr>
    <tr>
        <td>Rugi fiscal</td>
        <td>-</td>
        <td>150,000,000</td>
    </tr>
  <tr>
      <td>Total Aset Pajak</td>
      <td>476,500,000</td>
      <td>766,500,000</td>
    </tr>
    <tr>
        <td><i>Liabilitas pajak tangguhan</i></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Akumulasi depresiasi</td>
        <td>10,000,000</td>
        <td>-</td>
    </tr>
    <tr>
        <td>Aktiva leasing</td>
        <td>83,000,000</td>
        <td>125,000,000</td>
    </tr>
    <tr>
        <td>Selisih kurs</td>
        <td>41,000,000</td>
        <td>20,000,000</td>
    </tr>
    <tr>
      <td>Perbedaan penilaian persediaan</td>
      <td>87,300,000</td>
      <td>75,000,000</td>
    </tr>
    <tr>
      <td>Total kewajiban pajak</td>
      <td>221,300,000</td>
      <td>220,000,000</td>
    </tr>
</table>
<br><br>
Berdasarkan SPT tahun 2009, pajak yang masih harus dibayar oleh perusahaan sebesar Rp400 juta (Pph ps 29). <br>
Jumlah kredit pajak selama tahun 2009 senilai Rp305,500,000<br>
Total perbedaan tetap yang menjadi koreksi positif (net) dalam perhitungan SPT tahun 2009 sebesar Rp344,400,000. 
<br><br>
Berdasarkan data diatas hitunglah: <br>

<table border="0" style="width: 100%">
    @foreach($denglish2 as $dsoal2)
    <input type="hidden" name="q[]" value="{{$dsoal2->id_question}}">
    <tr>
        <td><strong>{{$no}}.</strong> {!!$dsoal2->question!!}</td>
    </tr>
    <tr>
        <td>
                <table border="0px" style="width: 100%">
                    <tr>
                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal2->id_question}}" value="a"> A.</strong> {{$dsoal2->a}}</td>
                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal2->id_question}}" value="c"> C.</strong> {{$dsoal2->c}}</td>
                    </tr>
                    <tr>
                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal2->id_question}}" value="b"> B.</strong> {{$dsoal2->b}}</td>
                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal2->id_question}}" value="d"> D.</strong> {{$dsoal2->d}}</td>
                    </tr>
                </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <?php $no++; ?>
    @endforeach
</table>
 
 
 <u>Untuk menjawab soal no. 8,9 & 10 perhatikan ilustrasi berikut:</u><br>
Rekonsiliasi bank PT. Sadikun  pada tanggal 31 Oktober  2009 adalah sebagai berikut:<br><br>
<table border="0" style="width: 50%">
  <tr>
    <td>Saldo menurut bank</td>
    <td>Rp. 100,000,000</td>
  </tr>
  <tr>
    <td>Ditambah: Setoran dalam perjalanan</td>
    <td><u>Rp. 17,400,000</u></td>
  </tr>
  <tr>
    <td></td>
    <td>Rp. 117,400,00</td>
  </tr>
  <tr>
    <td>Dikurangi: Check yang masih beredar</td>
    <td>(Rp. 22.300.000)</td>
  </tr>
  <tr>
    <td>Saldo menurut catatan perusahaan</td>
    <td><u>Rp. 95.100.000</u></td>
  </tr>
  <tr>
    <td colspan="2">Data menurut rekening koran bank bulan November 2009  adalah sebagai berikut:</td>
  </tr>
  <tr>
    <td>Setoran</td>
    <td>Rp. 163.100.000</td>
  </tr>
  <tr>
    <td>Penarikan</td>
    <td>Rp. 119.700.000</td>
  </tr>
</table>
<br> 
<p>	Semua item rekonsiliasi pada 31 Oktober 2009 telah nampak pada laporan bank bulan November, kecuali 1 cek senilai Rp5,500,000 masih belum tampak pada rekening koran. Cek yang masih beredar pada 30 November  2009 sebesar Rp. 21.700.000 (yang berasal dari cek yang dikeluarkan selama bulan November) dan setoran dalam perjalanan sebesar Rp11.200.000. Selain itu dalam bulan November terdapat pembayaran dari customer sebesar Rp25 juta  melalui bank yang belum tercatat oleh perusahaan. Pendapatan bunga dan biaya administrasi selama bulan November 2004 masing-masing sebesar Rp1,300,000 dan Rp150,000.</p>

<table border="0" style="width: 100%">
  <?php 
  $denglishcs = DB::table('bank_question')
  ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
  ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
  ->where('category', 'technical_step1c')
  ->orderBy('bank_question.id_question', 'ASC')
  ->get();
  ?>
  @foreach($denglishcs as $dsoalc)
  <input type="hidden" name="q[]" value="{{$dsoalc->id_question}}">
  <tr>
      <td><strong>{{$no}}.</strong> {!!$dsoalc->question!!}</td>
  </tr>
  <tr>
      <td>
              <table border="0px" style="width: 100%">
                  <tr>
                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalc->id_question}}" value="a"> A.</strong> {{$dsoalc->a}}</td>
                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalc->id_question}}" value="c"> C.</strong> {{$dsoalc->c}}</td>
                  </tr>
                  <tr>
                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalc->id_question}}" value="b"> B.</strong> {{$dsoalc->b}}</td>
                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalc->id_question}}" value="d"> D.</strong> {{$dsoalc->d}}</td>
                  </tr>
              </table>
      </td>
  </tr>
  <tr>
      <td>&nbsp;</td>
  </tr>
  <?php $no++; ?>
  @endforeach
</table>
    
    <img src="{{url('/')}}/uploads/img/imgtech1.jpg" width="800px">
    <table border="0" style="width: 100%">
        <?php 
        $denglishds = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'technical_step1d')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();
        ?>
        @foreach($denglishds as $dsoald)
        <input type="hidden" name="q[]" value="{{$dsoald->id_question}}">
        <tr>
            <td><strong>{{$no}}.</strong> {!!$dsoald->question!!}</td>
        </tr>
        <tr>
            <td>
                    <table border="0px" style="width: 100%">
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoald->id_question}}" value="a"> A.</strong> {{$dsoald->a}}</td>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoald->id_question}}" value="c"> C.</strong> {{$dsoald->c}}</td>
                        </tr>
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoald->id_question}}" value="b"> B.</strong> {{$dsoald->b}}</td>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoald->id_question}}" value="d"> D.</strong> {{$dsoald->d}}</td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <?php $no++; ?>
        @endforeach
      </table>

      <p><u>Untuk menjawab soal no. 12 s.d. 16 perhatikan ilustrasi berikut:</u></p>
      <img src="{{url('/')}}/uploads/img/imgtech2.jpg" width="800px">
      <table border="0" style="width: 100%">
          <?php 
          $denglishes = DB::table('bank_question')
          ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
          ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
          ->where('category', 'technical_step1e')
          ->orderBy('bank_question.id_question', 'ASC')
          ->get();
          ?>
          @foreach($denglishes as $dsoale)
          <input type="hidden" name="q[]" value="{{$dsoale->id_question}}">
          <tr>
              <td><strong>{{$no}}.</strong> {!!$dsoale->question!!}</td>
          </tr>
          <tr>
              <td>
                      <table border="0px" style="width: 100%">
                          <tr>
                              <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoale->id_question}}" value="a"> A.</strong> {{$dsoale->a}}</td>
                              <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoale->id_question}}" value="c"> C.</strong> {{$dsoale->c}}</td>
                          </tr>
                          <tr>
                              <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoale->id_question}}" value="b"> B.</strong> {{$dsoale->b}}</td>
                              <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoale->id_question}}" value="d"> D.</strong> {{$dsoale->d}}</td>
                          </tr>
                      </table>
              </td>
          </tr>
          <tr>
              <td>&nbsp;</td>
          </tr>
          <?php $no++; ?>
          @endforeach
        </table>

        <table border="0" style="width: 100%">
            <?php 
            $denglish7s = DB::table('bank_question')
            ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
            ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
            ->where('category', 'technical_step17')
            ->orderBy('bank_question.id_question', 'ASC')
            ->get();
            ?>
            @foreach($denglish7s as $dsoal7)
            <input type="hidden" name="q[]" value="{{$dsoal7->id_question}}">
            <tr>
                <td><strong>{{$no}}.</strong> 
                  PT Gober memiliki piutang yang diklasifikasikan sebagai aset lancar dari perusahaan-perusahaan yang merupakan afiliasinya pada tanggal 31 Desember 2000 sebagai berikut:<br>
                      -	Piutang usaha dari PT Kwik sebesar Rp950 juta. PT Gober memiliki kepemilikan sebesar 45% atas investasinya kepada PT Kwik.<br>
                      -	Piutang usaha dari PT Kwek sebesar Rp2,7 milyar. PT Gober memiliki kepemilikan sebesar 92% atas investasinya kepada PT Kwek. PT Gober tidak memiliki rencana untuk mengalihkan saham yang dimilikinya dalam jangka pendek dan tidak ada restriksi dalam pentransferan dana dari PT Kwek kepada PT Gober.<br>
                      -	Piutang dari PT Kwak sebesar Rp1,3 milyar atas biaya administrasi dan penjualan yang dibebankan PT Gober kepada PT Kwak. PT Gober memiliki kepemilikan sebesar 68% atas investasinya kepada PT Kwak. Kepemilikan PT Gober hanya bersifat sementara sehubungan seluruh saham yang dimilikinya akan segera dijual.<br>
                  <br>
                  {!!$dsoal7->question!!}</td>
            </tr>
            <tr>
                <td>
                        <table border="0px" style="width: 100%">
                            <tr>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal7->id_question}}" value="a"> A.</strong> {{$dsoal7->a}}</td>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal7->id_question}}" value="c"> C.</strong> {{$dsoal7->c}}</td>
                            </tr>
                            <tr>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal7->id_question}}" value="b"> B.</strong> {{$dsoal7->b}}</td>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal7->id_question}}" value="d"> D.</strong> {{$dsoal7->d}}</td>
                            </tr>
                        </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <?php $no++; ?>
            @endforeach
          </table>

          <table border="0" style="width: 100%">
            <?php 
            $denglish8s = DB::table('bank_question')
            ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
            ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
            ->where('category', 'technical_step18')
            ->orderBy('bank_question.id_question', 'ASC')
            ->get();
            ?>
            @foreach($denglish8s as $dsoal8)
            <input type="hidden" name="q[]" value="{{$dsoal8->id_question}}">
            <tr>
                <td><strong>{{$no}}.</strong> 
                  Selama 2003, dr Imam menerima Rp 175,000,000.00 tunai dari pasiennya dan mengeluarkan Rp 110,000,000.00 untuk membiayai usahanya. Walaupun sebagian besar transaksi dilaksanakan secara tunai, namun demikian masih ada saldo perkiraan sebagai berikut:
                  <br><br>
                  <table border="0" style="width: 50%">
                    <tr>
                      <td></td>
                      <td>1 Januari 2003</td>
                      <td>31 December 2003</td>
                    </tr>
                    <tr>
                      <td>Piutang usaha</td>
                      <td>Rp 12,000,000.00</td>
                      <td>Rp 5,000,000.00</td>
                    </tr>
                    <tr>
                        <td>Persediaan obat</td>
                        <td>Rp27,300,000.00</td>
                        <td>Rp10,000,000.00</td>
                    </tr>
                    <tr>
                      <td>Uang muka</td>
                      <td>Rp3,000,000.00</td>
                      <td>nihil</td>
                    </tr>
                    <tr>
                      <td>Beban masih harus dibayar</td>
                      <td>Rp   4,000,000.00</td>
                      <td>nihil</td>
                    </tr>
                    <tr>
                      <td>Beban dibayar dimuka</td>
                      <td>Rp   1,000,000.00</td>
                      <td>Rp 5,000,000.00</td>
                    </tr>
                  </table>
                  <br>
                  {!!$dsoal8->question!!}</td>
            </tr>
            <tr>
                <td>
                        <table border="0px" style="width: 100%">
                            <tr>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal8->id_question}}" value="a"> A.</strong> {{$dsoal8->a}}</td>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal8->id_question}}" value="c"> C.</strong> {{$dsoal8->c}}</td>
                            </tr>
                            <tr>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal8->id_question}}" value="b"> B.</strong> {{$dsoal8->b}}</td>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal8->id_question}}" value="d"> D.</strong> {{$dsoal8->d}}</td>
                            </tr>
                        </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <?php $no++; ?>
            @endforeach
          </table>


          <table border="0" style="width: 100%">
              <tr>
                  <td><u>Untuk menjawab soal no. 19 s.d. 20 perhatikan ilustrasi berikut:</u><br>
                    PT TIM mulai beroperasi 1 January 2002 dan menggunakan metode akuntansi angsuran (installment),dalam pengakuan laba brutonya. Data-data berikut ini yang tersedia per 31 Desember   2004.<br>

                    <br>
                    <table border="0" style="width: 50%">
                      <tr>
                        <td></td>
                        <td><u>	2004</u></td>
                      </tr>
                      <tr>
                          <td>Piutang tahun 2002</td>
                          <td>Rp 700.000.000</td>
                      </tr>
                      <tr>
                          <td>Piutang tahun 2003 </td>
                          <td>Rp1.200.000.000</td>
                      </tr>
                      <tr>
                          <td>Piutang tahun 2004</td>
                          <td>Rp4.200.000.000</td>
                      </tr>
                    </table>
                    </td>
              </tr>
              <?php 
              $denglish9s = DB::table('bank_question')
              ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
              ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
              ->where('category', 'technical_step19')
              ->orderBy('bank_question.id_question', 'ASC')
              ->get();
              ?>
              @foreach($denglish9s as $dsoal9)
              <input type="hidden" name="q[]" value="{{$dsoal9->id_question}}">
              
              <tr>
                  <td>
                      <br>
                      <strong>{{$no}}.</strong>  {!!$dsoal9->question!!}
                          <table border="0px" style="width: 100%">
                              <tr>
                                  <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal9->id_question}}" value="a"> A.</strong> {{$dsoal9->a}}</td>
                                  <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal9->id_question}}" value="c"> C.</strong> {{$dsoal9->c}}</td>
                              </tr>
                              <tr>
                                  <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal9->id_question}}" value="b"> B.</strong> {{$dsoal9->b}}</td>
                                  <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal9->id_question}}" value="d"> D.</strong> {{$dsoal9->d}}</td>
                              </tr>
                          </table>
                  </td>
              </tr>
              <?php $no++; ?>
              @endforeach
            </table>
            <br>
            <table border="0" style="width: 100%">
                <tr>
                    <td><u>Untuk menjawab soal no. 21 s.d. 22 perhatikan ilustrasi berikut:</u><br>
                        Per tanggal 28 November 2004, manajemen PT Tirta memutuskan untuk merubah kebijakan akuntansinya sehubungan dengan penyusutan mesin pabrikasinya. Mesin tersebut mempunyai estimasi masa manfaat 8 tahun dengan harga perolehan Rp18 milyar. Mesin diperoleh bulan Januari 2001 dan disusutkan dengan metode garis lurus. Manajemen merubah metode penyusutan menjadi metode saldo menurun. 
                      <br>
                      </td>
                </tr>
                <?php 
                $denglishgs = DB::table('bank_question')
                ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
                ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
                ->where('category', 'technical_step1g')
                ->orderBy('bank_question.id_question', 'ASC')
                ->get();
                ?>
                @foreach($denglishgs as $dsoalg)
                <input type="hidden" name="q[]" value="{{$dsoalg->id_question}}">
                
                <tr>
                    <td>
                        <br>
                        <strong>{{$no}}.</strong>  {!!$dsoalg->question!!}
                            <table border="0px" style="width: 100%">
                                <tr>
                                    <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalg->id_question}}" value="a"> A.</strong> {{$dsoalg->a}}</td>
                                    <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalg->id_question}}" value="c"> C.</strong> {{$dsoalg->c}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalg->id_question}}" value="b"> B.</strong> {{$dsoalg->b}}</td>
                                    <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalg->id_question}}" value="d"> D.</strong> {{$dsoalg->d}}</td>
                                </tr>
                            </table>
                    </td>
                </tr>
                <?php $no++; ?>
                @endforeach
              </table>
              <br>
              <table border="0" style="width: 100%">
                  <tr>
                      <td>Pada tanggal 31 Maret 2002, PT Bentara memiliki saldo atas akun-akun sebagai berikut:<br>
                        <table border="0" style="width: 60%">
                          <tr>
                            <td>Bank</td>
                            <td style="width: 20%">Rp2,3 milyar</td>
                          </tr>
                          <tr>
                              <td>Kas</td>
                              <td>Rp600 juta</td>
                          </tr>
                          <tr>
                              <td>Deposito pada Bank Lippo, jatuh tempo dalam 3 bulan</td>
                              <td>Rp5,5 milyar</td>
                          </tr>
                          <tr>
                              <td>Deposito pada Bank BNI yang dibatasi penggunaannya,
                                  untuk pembangunan pabrik yang direncanakan
                                  dimulai pada 2 Februari 2003
                              </td>
                              <td>Rp8,4 milyar</td>
                          </tr>
                        </table>
                        </td>
                  </tr>
                  <?php 
                  $denglish23s = DB::table('bank_question')
                  ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
                  ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
                  ->where('category', 'technical_step23')
                  ->orderBy('bank_question.id_question', 'ASC')
                  ->get();
                  ?>
                  @foreach($denglish23s as $dsoal23)
                  <input type="hidden" name="q[]" value="{{$dsoal23->id_question}}">
                  
                  <tr>
                      <td>
                          <br>
                          <strong>{{$no}}.</strong>  {!!$dsoal23->question!!}
                              <table border="0px" style="width: 100%">
                                  <tr>
                                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal23->id_question}}" value="a"> A.</strong> {{$dsoal23->a}}</td>
                                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal23->id_question}}" value="c"> C.</strong> {{$dsoal23->c}}</td>
                                  </tr>
                                  <tr>
                                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal23->id_question}}" value="b"> B.</strong> {{$dsoal23->b}}</td>
                                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal23->id_question}}" value="d"> D.</strong> {{$dsoal23->d}}</td>
                                  </tr>
                              </table>
                      </td>
                  </tr>
                  <?php $no++; ?>
                  @endforeach
                </table>
               
              <table border="0" style="width: 100%">
                  <?php 
                  $denglish24s = DB::table('bank_question')
                  ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
                  ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
                  ->where('category', 'technical_step24')
                  ->orderBy('bank_question.id_question', 'ASC')
                  ->get();
                  ?>
                  @foreach($denglish24s as $dsoal24)
                  <input type="hidden" name="q[]" value="{{$dsoal24->id_question}}">
                  
                  <tr>
                      <td>
                          <br>
                          <strong>{{$no}}.</strong>  {!!$dsoal24->question!!}
                              <table border="0px" style="width: 100%">
                                  <tr>
                                      <td style="width: 400px"><u>Penyisihan atas piutang tak tertagih</u></td>
                                      <td><u>Beban piutang tak tertagih</u></td>
                                  </tr>
                                  <tr>
                                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal24->id_question}}" value="a"> A.</strong> {{$dsoal24->a}}</td>
                                      <td>Menurun</td>
                                  </tr>
                                  <tr>
                                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal24->id_question}}" value="b"> B.</strong> {{$dsoal24->b}}</td>
                                      <td>Menurun</td>
                                  </tr>
                                  <tr>
                                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal24->id_question}}" value="c"> C.</strong> {{$dsoal24->c}}</td>
                                      <td>Tidak terpengaruh</td>
                                  </tr>
                                  <tr>
                                      <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal24->id_question}}" value="d"> D.</strong> {{$dsoal24->d}}</td>
                                      <td>Tidak terpengaruh</td>
                                  </tr>
                              </table>
                      </td>
                  </tr>
                  <?php $no++; ?>
                  @endforeach
                </table>
                <br>
                <table border="0" style="width: 100%">
                    <tr>
                        <td>Informasi berikut berkaitan dengan penjualan dan piutang PT Qayss:<br>
                          <table border="0" style="width: 60%">
                            <tr>
                              <td>Penjualan kredit tahun 2004</td>
                              <td style="width: 20%">Rp.875.000.000</td>
                            </tr>
                            <tr>
                                <td>Saldo  penyisihan piutang tak tertagih awal th</td>
                                <td>Rp.  77.800.000</td>
                            </tr>
                            <tr>
                                <td>piutang yang dihapuskan selama tahun 2004</td>
                                <td>Rp.  65.000.000</td>
                            </tr>
                            <tr>
                                <td>Penerimaan kembali piutang yang telah dihapus</td>
                                <td>Rp. 12.000.000</td>
                            </tr>
                          </table>
                          </td>
                    </tr>
                    <?php 
                    $denglish25s = DB::table('bank_question')
                    ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
                    ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
                    ->where('category', 'technical_step25')
                    ->orderBy('bank_question.id_question', 'ASC')
                    ->get();
                    ?>
                    @foreach($denglish25s as $dsoal25)
                    <input type="hidden" name="q[]" value="{{$dsoal25->id_question}}">
                    
                    <tr>
                        <td>
                            <br>
                            <strong>{{$no}}.</strong>  {!!$dsoal25->question!!}
                                <table border="0px" style="width: 100%">
                                    <tr>
                                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal25->id_question}}" value="a"> A.</strong> {{$dsoal25->a}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal25->id_question}}" value="b"> B.</strong> {{$dsoal25->b}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal25->id_question}}" value="c"> C.</strong> {{$dsoal25->c}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal25->id_question}}" value="d"> D.</strong> {{$dsoal25->d}}</td>
                                    </tr>
                                </table>
                        </td>
                    </tr>
                    <?php $no++; ?>
                    @endforeach
                  </table>

                <br>

    <br><br>
  </div>
  
  <div class="lds-spinner" id="spinner" style="display: none; float:right; margin-right: 180px">
      <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
    </div>

  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="nextBtn">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
</form>

@endsection