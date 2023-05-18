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
              url: '{{route('technical.step2.post')}}',
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
                    window.location.href = '{{route('home')}}';
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
    <h5>Step 2</h5>
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
    
    <p class="tengah"><span style="font-size: 18px; font-weight: bold">II.	PILIHAN GANDA</span></p>

    <p><u>Berikut ini adalah data piutang PT SBA per 31 December2004 :</u><br>
    </p>    
    
    <table border="0" style="width: 50%">
      <tr>
        <td>Umur</td>
        <td>Jumlah</td>
        <td>% estimasi Tak tertagih</td>
      </tr>
      <tr>
        <td>Dibawah 60 hari</td>
        <td>Rp 850.000.000,-</td>
        <td>2%</td>
      </tr>
      <tr>
        <td>61-120 hari</td>
        <td>Rp  88.000.000,-</td>
        <td>10%</td>
      </tr>
      <tr>
          <td>120-180 hari</td>
          <td>Rp   75.000.000,-</td>
          <td>15%</td>
      </tr>
      <tr>
          <td>Lebih dari 180 hari</td>
          <td>Rp   40.000.000,-</td>
          <td>25%</td>
      </tr>
    </table>
    <br>
    <table border="0" style="width: 100%">
        <?php $no=26; ?>
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
                        </tr>
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal->id_question}}" value="b"> B.</strong> {{$dsoal->b}}</td>
                        </tr>
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal->id_question}}" value="c"> C.</strong> {{$dsoal->c}}</td>
                        </tr>
                        <tr>
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

<p>Pada 1 Agustus  2004, PT SKU membeli sebidang tanah untuk lokasi pabrik Rp 800.000.000 Bangunan lama yang ada di atas lahan dihancurkan dan 
    diganti dengan bangunan pabrik yang baru, dan pekerjaan konstruksi bangunan pabrik baru dimulai bulan September  2004. tambahan data yang 
    tersedia sebagai berikut:
</p> 
<table border="0" style="width: 50%">
    <tr>
      <td>Biaya penghancuran bangunan lama </td>
      <td>Rp. 200.000.000</td>
    </tr>
    <tr>
        <td>Bea perolehan hak atas tanah dan bangunan </td>
        <td>Rp. 35,000,000</td>
    </tr>
    <tr>
        <td>Biaya notaries</td>
        <td>Rp. 25.000.000</td>
      </tr>
    <tr>
        <td>Biaya arsitek dan konsultan</td>
        <td>Rp. 250.000.000</td>
    </tr>
    <tr>
        <td>Biaya konstruksi bangunan pabrik baru</td>
        <td>Rp.18.500.000.000</td>
    </tr>
</table>
<br>

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
 
<table border="0" style="width: 100%">
  <?php 
  $denglishcs = DB::table('bank_question')
  ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
  ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
  ->where('category', 'technical_step1h')
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
    
<table border="0" style="width: 100%">
        <tr>
            <td>
                2 tahun setelah perbaikan tersebut, PT Jaya  menukarkan mesin cetak yang dimilikinya  dengan mesin cetak yang  baru. Aktiva baru tersebut mempunyai nilai pasar Rp3.000 juta dan untuk pertukaran tersebut, PT Jaya harus membayar kas sebesar Rp1.000 juta. 
              </td>
        </tr>
        <?php 
        $denglish30s = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'technical_step30')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();
        ?>
        @foreach($denglish30s as $dsoal30)
        <input type="hidden" name="q[]" value="{{$dsoal30->id_question}}">
        
        <tr>
            <td>
                <br>
                <strong>{{$no}}.</strong>  {!!$dsoal30->question!!}
                    <table border="0px" style="width: 100%">
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal30->id_question}}" value="a"> A.</strong> {{$dsoal30->a}}</td>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal30->id_question}}" value="c"> C.</strong> {{$dsoal30->c}}</td>
                        </tr>
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal30->id_question}}" value="b"> B.</strong> {{$dsoal30->b}}</td>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal30->id_question}}" value="d"> D.</strong> {{$dsoal30->d}}</td>
                        </tr>
                    </table>
            </td>
        </tr>
        <?php $no++; ?>
        @endforeach
      </table>

      <table border="0" style="width: 100%">
            <?php 
            $denglish31s = DB::table('bank_question')
            ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
            ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
            ->where('category', 'technical_step31')
            ->orderBy('bank_question.id_question', 'ASC')
            ->get();
            ?>
            @foreach($denglish31s as $dsoal31)
            <input type="hidden" name="q[]" value="{{$dsoal31->id_question}}">
            
            <tr>
                <td>
                    <br>
                    <strong>{{$no}}.</strong>  {!!$dsoal31->question!!}
                        <table border="0px" style="width: 100%">
                            <tr>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal31->id_question}}" value="a"> A.</strong> {{$dsoal31->a}}</td>
                            </tr>
                            <tr>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal31->id_question}}" value="b"> B.</strong> {{$dsoal31->b}}</td>
                            </tr>
                            <tr>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal31->id_question}}" value="c"> C.</strong> {{$dsoal31->c}}</td>
                            </tr>
                            <tr>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal31->id_question}}" value="d"> D.</strong> {{$dsoal31->d}}</td>
                            </tr>
                            <tr>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal31->id_question}}" value="e"> E.</strong> Choices of B and D</td>
                            </tr>
                            <tr>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal31->id_question}}" value="f"> F.</strong> Choices A and C</td>
                            </tr>
                            <tr>
                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal31->id_question}}" value="g"> G.</strong> Choices A, B, and D</td>
                            </tr>
                        </table>
                </td>
            </tr>
            <?php $no++; ?>
            @endforeach
          </table>

          <table border="0" style="width: 100%">
                <?php 
                $denglish32s = DB::table('bank_question')
                ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
                ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
                ->where('category', 'technical_step32')
                ->orderBy('bank_question.id_question', 'ASC')
                ->get();
                ?>
                @foreach($denglish32s as $dsoal32)
                <input type="hidden" name="q[]" value="{{$dsoal32->id_question}}">
                
                <tr>
                    <td>
                        <br>
                        <strong>{{$no}}.</strong>  {!!$dsoal32->question!!}
                            <table border="0px" style="width: 100%">
                                <tr>
                                    <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal32->id_question}}" value="a"> A.</strong> {{$dsoal32->a}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal32->id_question}}" value="b"> B.</strong> {{$dsoal32->b}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal32->id_question}}" value="c"> C.</strong> {{$dsoal32->c}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal32->id_question}}" value="d"> D.</strong> {{$dsoal32->d}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal32->id_question}}" value="e"> E.</strong> In the form of materials or supplies to be consumed in the production process or the rendering of services</td>
                                </tr>
                                <tr>
                                    <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal32->id_question}}" value="f"> F.</strong> Choices B and D</td>
                                </tr>
                                <tr>
                                    <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal32->id_question}}" value="g"> G.</strong> Choices B, D, and E</td>
                                </tr>
                            </table>
                    </td>
                </tr>
                <?php $no++; ?>
                @endforeach
              </table>

              <table border="0" style="width: 100%">
                    <?php 
                    $denglish33s = DB::table('bank_question')
                    ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
                    ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
                    ->where('category', 'technical_step33')
                    ->orderBy('bank_question.id_question', 'ASC')
                    ->get();
                    ?>
                    @foreach($denglish33s as $dsoal33)
                    <input type="hidden" name="q[]" value="{{$dsoal33->id_question}}">
                    
                    <tr>
                        <td>
                            <br>
                            <strong>{{$no}}.</strong>  {!!$dsoal33->question!!}
                                <table border="0px" style="width: 100%">
                                    <tr>
                                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal33->id_question}}" value="a"> A.</strong> {{$dsoal33->a}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal33->id_question}}" value="b"> B.</strong> {{$dsoal33->b}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal33->id_question}}" value="c"> C.</strong> {{$dsoal33->c}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal33->id_question}}" value="d"> D.</strong> {{$dsoal33->d}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal33->id_question}}" value="e"> E.</strong> Fixed and variable production overhead</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal33->id_question}}" value="f"> F.</strong> Selling costs</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoal33->id_question}}" value="g"> G.</strong> Choices C, D, and F</td>
                                    </tr>
                                </table>
                        </td>
                    </tr>
                    <?php $no++; ?>
                    @endforeach
                  </table>

                  <table border="0" style="width: 100%">
                        <?php 
                        $denglishjs = DB::table('bank_question')
                        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
                        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
                        ->where('category', 'technical_step1j')
                        ->orderBy('bank_question.id_question', 'ASC')
                        ->get();
                        ?>
                        @foreach($denglishjs as $dsoalj)
                        <input type="hidden" name="q[]" value="{{$dsoalj->id_question}}">
                        
                        <tr>
                            <td>
                                <br>
                                <strong>{{$no}}.</strong>  {!!$dsoalj->question!!}
                                    <table border="0px" style="width: 100%">
                                        <tr>
                                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalj->id_question}}" value="a"> A.</strong> {{$dsoalj->a}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalj->id_question}}" value="b"> B.</strong> {{$dsoalj->b}}</td>
                                        </tr>
                                        <tr>
                                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalj->id_question}}" value="c"> C.</strong> {{$dsoalj->c}}</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dsoalj->id_question}}" value="d"> D.</strong> {{$dsoalj->d}}</td>
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
      <button type="button" id="nextBtn">Submit</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
</form>

@endsection