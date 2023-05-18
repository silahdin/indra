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
              url: '{{route('tax.step1.post')}}',
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
                  window.location.href = '{{route('tax.step2', ['idjob' => $jobid])}}';
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

<form id="regForm" method="POST">
    <input type="hidden" name="idjob" value="{{$jobid}}">
<div style="float:right;">
    <h5>Step 1</h5>
</div>

  @csrf
  <input type="hidden" name="step" value="2">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>TAX</h1>
    <hr>
    
    <div class="alert alert-danger print-error-msg" style="display:none">
      <ul></ul>
    </div>
    
    <p class="tengah"><span style="font-size: 18px; font-weight: bold">BAGIAN I – SOAL PERPAJAKAN</span></p> 
    
    <table border="0" style="width: 100%">
        <?php $no=1; ?>
        @foreach($dtaxs as $dsoal)
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

    <table border="0" style="width: 100%">
        <tr>
            <td>
                    <strong>{{$no}}.</strong> Usaha dagang Maju Tak Gentar (Hary) terdaftar di KPP Pratama Jakarta Pulogadung mempunyai usaha dagang perdagangan aceran bahan bangunan. UD Maju Tak Gentar (09.888.777.0-073.000) menggunakan pembukuan dalam melaksanakan kewajiban pajaknya. Transaksi yang dilakukan adalah :<br><br>
                    <i class="fa fa-check" aria-hidden="true"></i> Tanggal 8 Januari 2013 membayar biaya sewa gudang sebesar Rp9.000.000,00 Penerima pembayaran adalah Widodo (non NPWP)<br>
                    <i class="fa fa-check" aria-hidden="true"></i> Tanggal 15 Januari 2013 membayar biaya sewa peralatan pesta sebesar Rp6.000.000,00. Penerima pembayaran adalah Wajinah (non NPWP)<br>
                    <i class="fa fa-check" aria-hidden="true"></i> Tanggal 27 Januari 2013 membayar biaya notaris sebesar Rp15.000.000,00. Penerima pembayaran adalah Firma Waginah, SH (02.444.555.6-001.000)<br>
                    <br>
            </td>
        </tr>
        <?php 
        $dtax5s = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'tax5')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();
        ?>
        @foreach($dtax5s as $dtax5)
        <input type="hidden" name="q[]" value="{{$dtax5->id_question}}">
        <tr>
            <td>{!!$dtax5->question!!}</td>
        </tr>
        <tr>
            <td>
                    <table border="0px" style="width: 100%">
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dtax5->id_question}}" value="a"> A.</strong> {{$dtax5->a}}</td>
                        </tr>
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dtax5->id_question}}" value="b"> B.</strong> {{$dtax5->b}}</td>
                        </tr>
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dtax5->id_question}}" value="c"> C.</strong> {{$dtax5->c}}</td>
                        </tr>
                        <tr>
                            <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dtax5->id_question}}" value="d"> D.</strong> {{$dtax5->d}}</td>
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
        $dtax6s = DB::table('bank_question')
        ->select('bank_question.id_question', 'bank_question.question', 'bank_question.a', 'bank_question.b', 'bank_question.c', 'bank_question.d', 'english_question.jwb')
        ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
        ->where('category', 'tax6')
        ->orderBy('bank_question.id_question', 'ASC')
        ->get();
        ?>
        @foreach($dtax6s as $dtax6)
          <input type="hidden" name="q[]" value="{{$dtax6->id_question}}">
          <tr>
              <td><strong>{{$no}}.</strong> {!!$dtax6->question!!}</td>
          </tr>
          <tr>
              <td>
                      <table border="0px" style="width: 100%">
                          <tr>
                              <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dtax6->id_question}}" value="a"> A.</strong> {{$dtax6->a}}</td>
                          </tr>
                          <tr>
                              <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dtax6->id_question}}" value="b"> B.</strong> {{$dtax6->b}}</td>
                          </tr>
                          <tr>
                              <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dtax6->id_question}}" value="c"> C.</strong> {{$dtax6->c}}</td>
                          </tr>
                          <tr>
                              <td style="width: 400px"><strong><input type="radio" name="jwb_{{$dtax6->id_question}}" value="d"> D.</strong> {{$dtax6->d}}</td>
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