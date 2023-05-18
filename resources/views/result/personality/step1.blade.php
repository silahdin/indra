@extends('layouts.appresult')

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



.tengah {
    text-align: center;  
  }
</style>

<script>
function getValRadio(key, baris) {

  var idBarisM = $('input[name=jwb_m_'+key+']:checked').attr('id');
  var idBarisL = $('input[name=jwb_l_'+key+']:checked').attr('id');
  var barisM = idBarisM.substr(idBarisM.length - 1);
  var barisL = idBarisL.substr(idBarisL.length - 1);
  if(barisM == barisL) {
    alert('Nomer '+key+', Nilai M dan L tidak boleh sama');
    $('input[name=jwb_l_'+key+']').prop('checked', false);
    $('input[name=jwb_m_'+key+']').prop('checked', false);
  }

}

$(document).ready(function(){
      var _token = $("input[name=_token]").val();
      $("#nextBtn").click(function(e){
          e.preventDefault();
          $.ajax({
              /* the route pointing to the post function */
              url: '{{route('personality_test.post')}}',
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
    <h5>&nbsp;</h5>
</div>

  @csrf
  <input type="hidden" name="step" value="2">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>Personality Test</h1>
    <hr>
    
    <div class="alert alert-danger print-error-msg" style="display:none">
      <ul></ul>
    </div>
    
        <table border="0" width="100%">
            <tr>
                <td style="width: 30%">
                    <table border="1" style="width: 100%">
                            <tr style="text-align:center; font-weight: bold">
                                <td bgcolor="#CCCCCC" width="20px">No.</td>
                                <td bgcolor="yellow" width="20px">M</td>
                                <td bgcolor="#6ac06a" width="20px">L</td>
                                <td bgcolor="#f47b73">Description</td>
                            </tr>
                            <?php $no=1; ?>
                            @foreach($dpers as $dsoal)
                            <?php 
                            $mjwb1 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal->id_words)
                            ->first();

                            $ljwb1 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal->id_words)
                            ->first();
                            ?>
                            <tr>
                                    @if($no==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal->key}}</td>@endif
                                    <td>@if(isset($mjwb1)) X @endif</td>
                                    <td>@if(isset($ljwb1)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal->question}}</span></td>
                            </tr>
                            <?php $no++; ?>
                            @endforeach
                        </table>
                </td>
                <td style="width: 30%">
                    <table border="1" style="width: 100%">
                            <tr style="text-align:center; font-weight: bold">
                                <td bgcolor="#CCCCCC" width="20px">No.</td>
                                <td bgcolor="yellow" width="20px">M</td>
                                <td bgcolor="#6ac06a" width="20px">L</td>
                                <td bgcolor="#f47b73">Description</td>
                            </tr>
                            <?php 
                            $dpers2 = DB::table('bank_words')
                            ->select('id_words', 'question', 'key')
                            ->where('category', 'person')
                            ->where('key', 9)
                            ->where('st_words', 1)
                            ->orderBy('id_words', 'ASC')
                            ->take(4)
                            ->get()
                            ?>
                            <?php $no2=1; ?>
                            @foreach($dpers2 as $dsoal2)
                            <?php 
                            $mjwb2 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal2->id_words)
                            ->first();

                            $ljwb2 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal2->id_words)
                            ->first();
                            ?>
                            <tr>
                                     @if($no2==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal2->key}}</td>@endif
                                     <td>@if(isset($mjwb2)) X @endif</td>
                                     <td>@if(isset($ljwb2)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal2->question}}</span></td>
                            </tr>
                            <?php $no2++; ?>
                            @endforeach
                        </table>
                </td>
                <td style="width: 30%">
                        <table border="1" style="width: 100%">
                                <tr style="text-align:center; font-weight: bold">
                                    <td bgcolor="#CCCCCC" width="20px">No.</td>
                                    <td bgcolor="yellow" width="20px">M</td>
                                    <td bgcolor="#6ac06a" width="20px">L</td>
                                    <td bgcolor="#f47b73">Description</td>
                                </tr>
                                <?php 
                                $dpers3 = DB::table('bank_words')
                                ->select('id_words', 'question', 'key')
                                ->where('category', 'person')
                                ->where('key', 17)
                                ->where('st_words', 1)
                                ->orderBy('id_words', 'ASC')
                                ->take(4)
                                ->get()
                                ?>
                                <?php $no3=1; ?>
                                @foreach($dpers3 as $dsoal3)
                                <?php 
                            $mjwb3 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal3->id_words)
                            ->first();

                            $ljwb3 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal3->id_words)
                            ->first();
                            ?>
                                <tr>
                                    @if($no3==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal3->key}}</td>@endif
                                    <td>@if(isset($mjwb3)) X @endif</td>
                                    <td>@if(isset($ljwb3)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal3->question}}</span></td>
                                </tr>
                                <?php $no3++; ?>
                                @endforeach
                            </table>
                </td>
            </tr>

            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>

            <tr>
                <td>
                    <table border="1" style="width: 100%">
                            <tr style="text-align:center; font-weight: bold">
                                <td bgcolor="#CCCCCC" width="20px">No.</td>
                                <td bgcolor="yellow" width="20px">M</td>
                                <td bgcolor="#6ac06a" width="20px">L</td>
                                <td bgcolor="#f47b73">Description</td>
                            </tr>
                            <?php 
                                $dpers4 = DB::table('bank_words')
                                ->select('id_words', 'question', 'key')
                                ->where('category', 'person')
                                ->where('key', 2)
                                ->where('st_words', 1)
                                ->orderBy('id_words', 'ASC')
                                ->take(4)
                                ->get()
                                ?>
                            <?php $no4=1; ?>
                            @foreach($dpers4 as $dsoal4)
                            <?php 
                            $mjwb4 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal4->id_words)
                            ->first();

                            $ljwb4 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal4->id_words)
                            ->first();
                            ?>
                            <tr>
                                    @if($no4==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal4->key}}</td>@endif
                                    <td>@if(isset($mjwb4)) X @endif</td>
                                    <td>@if(isset($ljwb4)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal4->question}}</span></td>
                            </tr>
                            <?php $no4++; ?>
                            @endforeach
                        </table>
                </td>
                <td>
                    <table border="1" style="width: 100%">
                            <tr style="text-align:center; font-weight: bold">
                                <td bgcolor="#CCCCCC" width="20px">No.</td>
                                <td bgcolor="yellow" width="20px">M</td>
                                <td bgcolor="#6ac06a" width="20px">L</td>
                                <td bgcolor="#f47b73">Description</td>
                            </tr>
                            <?php 
                            $dpers5 = DB::table('bank_words')
                            ->select('id_words', 'question', 'key')
                            ->where('category', 'person')
                            ->where('key', 10)
                            ->where('st_words', 1)
                            ->orderBy('id_words', 'ASC')
                            ->take(4)
                            ->get()
                            ?>
                            <?php $no5=1; ?>
                            @foreach($dpers5 as $dsoal5)
                            <?php 
                            $mjwb5 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal5->id_words)
                            ->first();

                            $ljwb5 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal5->id_words)
                            ->first();
                            ?>
                            <tr>
                                     @if($no5==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal5->key}}</td>@endif
                                     <td>@if(isset($mjwb5)) X @endif</td>
                                     <td>@if(isset($ljwb5)) X @endif</td>
                                     <td><span style="font-size: 11px;">{{$dsoal5->question}}</span></td>
                            </tr>
                            <?php $no5++; ?>
                            @endforeach
                        </table>
                </td>
                <td>
                    <table border="1" style="width: 100%">
                                <tr style="text-align:center; font-weight: bold">
                                    <td bgcolor="#CCCCCC" width="20px">No.</td>
                                    <td bgcolor="yellow" width="20px">M</td>
                                    <td bgcolor="#6ac06a" width="20px">L</td>
                                    <td bgcolor="#f47b73">Description</td>
                                </tr>
                                <?php 
                                $dpers6 = DB::table('bank_words')
                                ->select('id_words', 'question', 'key')
                                ->where('category', 'person')
                                ->where('key', 18)
                                ->where('st_words', 1)
                                ->orderBy('id_words', 'ASC')
                                ->take(4)
                                ->get()
                                ?>
                                <?php $no6=1; ?>
                                @foreach($dpers6 as $dsoal6)
                                <?php 
                            $mjwb6 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal6->id_words)
                            ->first();

                            $ljwb6 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal6->id_words)
                            ->first();
                            ?>
                                <tr>
                                    @if($no6==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal6->key}}</td>@endif
                                    <td>@if(isset($mjwb6)) X @endif</td>
                                    <td>@if(isset($ljwb6)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal6->question}}</span></td>
                                </tr>
                                <?php $no6++; ?>
                                @endforeach
                            </table>
                </td>
            </tr>

            <tr>
                <td colspan="3">&nbsp;</td>
              </tr>
  
              <tr>
                  <td>
                      <table border="1" style="width: 100%">
                              <tr style="text-align:center; font-weight: bold">
                                  <td bgcolor="#CCCCCC" width="20px">No.</td>
                                  <td bgcolor="yellow" width="20px">M</td>
                                  <td bgcolor="#6ac06a" width="20px">L</td>
                                  <td bgcolor="#f47b73">Description</td>
                              </tr>
                              <?php 
                                  $dpers7 = DB::table('bank_words')
                                  ->select('id_words', 'question', 'key')
                                  ->where('category', 'person')
                                  ->where('key', 3)
                                  ->where('st_words', 1)
                                  ->orderBy('id_words', 'ASC')
                                  ->take(4)
                                  ->get()
                                  ?>
                              <?php $no7=1; ?>
                              @foreach($dpers7 as $dsoal7)
                              <?php 
                            $mjwb7 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal7->id_words)
                            ->first();

                            $ljwb7 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal7->id_words)
                            ->first();
                            ?>
                              <tr>
                                      @if($no7==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal7->key}}</td>@endif
                                      <td>@if(isset($mjwb7)) X @endif</td>
                                    <td>@if(isset($ljwb7)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal7->question}}</span></td>
                              </tr>
                              <?php $no7++; ?>
                              @endforeach
                          </table>
                  </td>
                  <td>
                      <table border="1" style="width: 100%">
                              <tr style="text-align:center; font-weight: bold">
                                  <td bgcolor="#CCCCCC" width="20px">No.</td>
                                  <td bgcolor="yellow" width="20px">M</td>
                                  <td bgcolor="#6ac06a" width="20px">L</td>
                                  <td bgcolor="#f47b73">Description</td>
                              </tr>
                              <?php 
                              $dpers8 = DB::table('bank_words')
                              ->select('id_words', 'question', 'key')
                              ->where('category', 'person')
                              ->where('key', 11)
                              ->where('st_words', 1)
                              ->orderBy('id_words', 'ASC')
                              ->take(4)
                              ->get()
                              ?>
                              <?php $no8=1; ?>
                              @foreach($dpers8 as $dsoal8)
                              <?php 
                            $mjwb8 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal8->id_words)
                            ->first();

                            $ljwb8 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal8->id_words)
                            ->first();
                            ?>
                              <tr>
                                       @if($no8==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal8->key}}</td>@endif
                                       <td>@if(isset($mjwb8)) X @endif</td>
                                       <td>@if(isset($ljwb8)) X @endif</td>
                                       <td><span style="font-size: 11px;">{{$dsoal8->question}}</span></td>
                              </tr>
                              <?php $no8++; ?>
                              @endforeach
                          </table>
                  </td>
                  <td>
                      <table border="1" style="width: 100%">
                                  <tr style="text-align:center; font-weight: bold">
                                      <td bgcolor="#CCCCCC" width="20px">No.</td>
                                      <td bgcolor="yellow" width="20px">M</td>
                                      <td bgcolor="#6ac06a" width="20px">L</td>
                                      <td bgcolor="#f47b73">Description</td>
                                  </tr>
                                  <?php 
                                  $dpers9 = DB::table('bank_words')
                                  ->select('id_words', 'question', 'key')
                                  ->where('category', 'person')
                                  ->where('key', 19)
                                  ->where('st_words', 1)
                                  ->orderBy('id_words', 'ASC')
                                  ->take(4)
                                  ->get()
                                  ?>
                                  <?php $no9=1; ?>
                                  @foreach($dpers9 as $dsoal9)
                                  <?php 
                            $mjwb9 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal9->id_words)
                            ->first();

                            $ljwb9 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal9->id_words)
                            ->first();
                            ?>
                                  <tr>
                                      @if($no9==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal9->key}}</td>@endif
                                      <td>@if(isset($mjwb9)) X @endif</td>
                                    <td>@if(isset($ljwb9)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal9->question}}</span></td>
                                  </tr>
                                  <?php $no9++; ?>
                                  @endforeach
                              </table>
                  </td>
              </tr>

              <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
    
                <tr>
                    <td>
                        <table border="1" style="width: 100%">
                                <tr style="text-align:center; font-weight: bold">
                                    <td bgcolor="#CCCCCC" width="20px">No.</td>
                                    <td bgcolor="yellow" width="20px">M</td>
                                    <td bgcolor="#6ac06a" width="20px">L</td>
                                    <td bgcolor="#f47b73">Description</td>
                                </tr>
                                <?php 
                                    $dpers10 = DB::table('bank_words')
                                    ->select('id_words', 'question', 'key')
                                    ->where('category', 'person')
                                    ->where('key', 4)
                                    ->where('st_words', 1)
                                    ->orderBy('id_words', 'ASC')
                                    ->take(4)
                                    ->get()
                                    ?>
                                <?php $no10=1; ?>
                                @foreach($dpers10 as $dsoal10)
                                <?php 
                            $mjwb10 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal10->id_words)
                            ->first();

                            $ljwb10 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal10->id_words)
                            ->first();
                            ?>
                                <tr>
                                        @if($no10==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal10->key}}</td>@endif
                                        <td>@if(isset($mjwb10)) X @endif</td>
                                    <td>@if(isset($ljwb10)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal10->question}}</span></td>
                                </tr>
                                <?php $no10++; ?>
                                @endforeach
                            </table>
                    </td>
                    <td>
                        <table border="1" style="width: 100%">
                                <tr style="text-align:center; font-weight: bold">
                                    <td bgcolor="#CCCCCC" width="20px">No.</td>
                                    <td bgcolor="yellow" width="20px">M</td>
                                    <td bgcolor="#6ac06a" width="20px">L</td>
                                    <td bgcolor="#f47b73">Description</td>
                                </tr>
                                <?php 
                                $dpers11 = DB::table('bank_words')
                                ->select('id_words', 'question', 'key')
                                ->where('category', 'person')
                                ->where('key', 12)
                                ->where('st_words', 1)
                                ->orderBy('id_words', 'ASC')
                                ->take(4)
                                ->get()
                                ?>
                                <?php $no11=1; ?>
                                @foreach($dpers11 as $dsoal11)
                                <?php 
                            $mjwb11 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal11->id_words)
                            ->first();

                            $ljwb11 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal11->id_words)
                            ->first();
                            ?>
                                <tr>
                                         @if($no11==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal11->key}}</td>@endif
                                         <td>@if(isset($mjwb11)) X @endif</td>
                                         <td>@if(isset($ljwb11)) X @endif</td>
                                         <td><span style="font-size: 11px;">{{$dsoal11->question}}</span></td>
                                </tr>
                                <?php $no11++; ?>
                                @endforeach
                            </table>
                    </td>
                    <td>
                        <table border="1" style="width: 100%">
                                    <tr style="text-align:center; font-weight: bold">
                                        <td bgcolor="#CCCCCC" width="20px">No.</td>
                                        <td bgcolor="yellow" width="20px">M</td>
                                        <td bgcolor="#6ac06a" width="20px">L</td>
                                        <td bgcolor="#f47b73">Description</td>
                                    </tr>
                                    <?php 
                                    $dpers12 = DB::table('bank_words')
                                    ->select('id_words', 'question', 'key')
                                    ->where('category', 'person')
                                    ->where('key', 20)
                                    ->where('st_words', 1)
                                    ->orderBy('id_words', 'ASC')
                                    ->take(4)
                                    ->get()
                                    ?>
                                    <?php $no12=1; ?>
                                    @foreach($dpers12 as $dsoal12)
                                    <?php 
                            $mjwb12 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal12->id_words)
                            ->first();

                            $ljwb12 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal12->id_words)
                            ->first();
                            ?>
                                    <tr>
                                        @if($no12==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal12->key}}</td>@endif
                                        <td>@if(isset($mjwb12)) X @endif</td>
                                    <td>@if(isset($ljwb12)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal12->question}}</span></td>
                                    </tr>
                                    <?php $no12++; ?>
                                    @endforeach
                                </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">&nbsp;</td>
                  </tr>
      
                  <tr>
                      <td>
                          <table border="1" style="width: 100%">
                                  <tr style="text-align:center; font-weight: bold">
                                      <td bgcolor="#CCCCCC" width="20px">No.</td>
                                      <td bgcolor="yellow" width="20px">M</td>
                                      <td bgcolor="#6ac06a" width="20px">L</td>
                                      <td bgcolor="#f47b73">Description</td>
                                  </tr>
                                  <?php 
                                      $dpers13 = DB::table('bank_words')
                                      ->select('id_words', 'question', 'key')
                                      ->where('category', 'person')
                                      ->where('key', 5)
                                      ->where('st_words', 1)
                                      ->orderBy('id_words', 'ASC')
                                      ->take(4)
                                      ->get()
                                      ?>
                                  <?php $no13=1; ?>
                                  @foreach($dpers13 as $dsoal13)
                                  <?php 
                            $mjwb13 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal13->id_words)
                            ->first();

                            $ljwb13 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal13->id_words)
                            ->first();
                            ?>
                                  <tr>
                                          @if($no13==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal13->key}}</td>@endif
                                          <td>@if(isset($mjwb13)) X @endif</td>
                                    <td>@if(isset($ljwb13)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal13->question}}</span></td>
                                  </tr>
                                  <?php $no13++; ?>
                                  @endforeach
                              </table>
                      </td>
                      <td>
                          <table border="1" style="width: 100%">
                                  <tr style="text-align:center; font-weight: bold">
                                      <td bgcolor="#CCCCCC" width="20px">No.</td>
                                      <td bgcolor="yellow" width="20px">M</td>
                                      <td bgcolor="#6ac06a" width="20px">L</td>
                                      <td bgcolor="#f47b73">Description</td>
                                  </tr>
                                  <?php 
                                  $dpers14 = DB::table('bank_words')
                                  ->select('id_words', 'question', 'key')
                                  ->where('category', 'person')
                                  ->where('key', 13)
                                  ->where('st_words', 1)
                                  ->orderBy('id_words', 'ASC')
                                  ->take(4)
                                  ->get()
                                  ?>
                                  <?php $no14=1; ?>
                                  @foreach($dpers14 as $dsoal14)
                                  <?php 
                            $mjwb14 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal14->id_words)
                            ->first();

                            $ljwb14 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal14->id_words)
                            ->first();
                            ?>
                                  <tr>
                                           @if($no14==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal14->key}}</td>@endif
                                           <td>@if(isset($mjwb14)) X @endif</td>
                                           <td>@if(isset($ljwb14)) X @endif</td>
                                           <td><span style="font-size: 11px;">{{$dsoal14->question}}</span></td>
                                  </tr>
                                  <?php $no14++; ?>
                                  @endforeach
                              </table>
                      </td>
                      <td>
                          <table border="1" style="width: 100%">
                                      <tr style="text-align:center; font-weight: bold">
                                          <td bgcolor="#CCCCCC" width="20px">No.</td>
                                          <td bgcolor="yellow" width="20px">M</td>
                                          <td bgcolor="#6ac06a" width="20px">L</td>
                                          <td bgcolor="#f47b73">Description</td>
                                      </tr>
                                      <?php 
                                      $dpers15 = DB::table('bank_words')
                                      ->select('id_words', 'question', 'key')
                                      ->where('category', 'person')
                                      ->where('key', 21)
                                      ->where('st_words', 1)
                                      ->orderBy('id_words', 'ASC')
                                      ->take(4)
                                      ->get()
                                      ?>
                                      <?php $no15=1; ?>
                                      @foreach($dpers15 as $dsoal15)
                                      <?php 
                            $mjwb15 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal15->id_words)
                            ->first();

                            $ljwb15 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal15->id_words)
                            ->first();
                            ?>
                                      <tr>
                                          @if($no15==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal15->key}}</td>@endif
                                          <td>@if(isset($mjwb15)) X @endif</td>
                                    <td>@if(isset($ljwb15)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal15->question}}</span></td>
                                      </tr>
                                      <?php $no15++; ?>
                                      @endforeach
                                  </table>
                      </td>
                  </tr>

                  <tr>
                      <td colspan="3">&nbsp;</td>
                    </tr>
        
                    <tr>
                        <td>
                            <table border="1" style="width: 100%">
                                    <tr style="text-align:center; font-weight: bold">
                                        <td bgcolor="#CCCCCC" width="20px">No.</td>
                                        <td bgcolor="yellow" width="20px">M</td>
                                        <td bgcolor="#6ac06a" width="20px">L</td>
                                        <td bgcolor="#f47b73">Description</td>
                                    </tr>
                                    <?php 
                                        $dpers16 = DB::table('bank_words')
                                        ->select('id_words', 'question', 'key')
                                        ->where('category', 'person')
                                        ->where('key', 6)
                                        ->where('st_words', 1)
                                        ->orderBy('id_words', 'ASC')
                                        ->take(4)
                                        ->get()
                                        ?>
                                    <?php $no16=1; ?>
                                    @foreach($dpers16 as $dsoal16)
                                    <?php 
                            $mjwb16 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal16->id_words)
                            ->first();

                            $ljwb16 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal16->id_words)
                            ->first();
                            ?>
                                    <tr>
                                            @if($no16==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal16->key}}</td>@endif
                                            <td>@if(isset($mjwb16)) X @endif</td>
                                    <td>@if(isset($ljwb16)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal16->question}}</span></td>
                                    </tr>
                                    <?php $no16++; ?>
                                    @endforeach
                                </table>
                        </td>
                        <td>
                            <table border="1" style="width: 100%">
                                    <tr style="text-align:center; font-weight: bold">
                                        <td bgcolor="#CCCCCC" width="20px">No.</td>
                                        <td bgcolor="yellow" width="20px">M</td>
                                        <td bgcolor="#6ac06a" width="20px">L</td>
                                        <td bgcolor="#f47b73">Description</td>
                                    </tr>
                                    <?php 
                                    $dpers17 = DB::table('bank_words')
                                    ->select('id_words', 'question', 'key')
                                    ->where('category', 'person')
                                    ->where('key', 14)
                                    ->where('st_words', 1)
                                    ->orderBy('id_words', 'ASC')
                                    ->take(4)
                                    ->get()
                                    ?>
                                    <?php $no17=1; ?>
                                    @foreach($dpers17 as $dsoal17)
                                    <?php 
                            $mjwb17 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal17->id_words)
                            ->first();

                            $ljwb17 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal17->id_words)
                            ->first();
                            ?>
                                    <tr>
                                             @if($no17==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal17->key}}</td>@endif
                                             <td>@if(isset($mjwb17)) X @endif</td>
                                             <td>@if(isset($ljwb17)) X @endif</td>
                                             <td><span style="font-size: 11px;">{{$dsoal17->question}}</span></td>
                                    </tr>
                                    <?php $no17++; ?>
                                    @endforeach
                                </table>
                        </td>
                        <td>
                            <table border="1" style="width: 100%">
                                        <tr style="text-align:center; font-weight: bold">
                                            <td bgcolor="#CCCCCC" width="20px">No.</td>
                                            <td bgcolor="yellow" width="20px">M</td>
                                            <td bgcolor="#6ac06a" width="20px">L</td>
                                            <td bgcolor="#f47b73">Description</td>
                                        </tr>
                                        <?php 
                                        $dpers18 = DB::table('bank_words')
                                        ->select('id_words', 'question', 'key')
                                        ->where('category', 'person')
                                        ->where('key', 22)
                                        ->where('st_words', 1)
                                        ->orderBy('id_words', 'ASC')
                                        ->take(4)
                                        ->get()
                                        ?>
                                        <?php $no18=1; ?>
                                        @foreach($dpers18 as $dsoal18)
                                        <?php 
                            $mjwb18 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal18->id_words)
                            ->first();

                            $ljwb18 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal18->id_words)
                            ->first();
                            ?>
                                        <tr>
                                            @if($no18==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal18->key}}</td>@endif
                                            <td>@if(isset($mjwb18)) X @endif</td>
                                    <td>@if(isset($ljwb18)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal18->question}}</span></td>
                                        </tr>
                                        <?php $no18++; ?>
                                        @endforeach
                                    </table>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">&nbsp;</td>
                      </tr>
          
                      <tr>
                          <td>
                              <table border="1" style="width: 100%">
                                      <tr style="text-align:center; font-weight: bold">
                                          <td bgcolor="#CCCCCC" width="20px">No.</td>
                                          <td bgcolor="yellow" width="20px">M</td>
                                          <td bgcolor="#6ac06a" width="20px">L</td>
                                          <td bgcolor="#f47b73">Description</td>
                                      </tr>
                                      <?php 
                                          $dpers19 = DB::table('bank_words')
                                          ->select('id_words', 'question', 'key')
                                          ->where('category', 'person')
                                          ->where('key', 7)
                                          ->where('st_words', 1)
                                          ->orderBy('id_words', 'ASC')
                                          ->take(4)
                                          ->get()
                                          ?>
                                      <?php $no19=1; ?>
                                      @foreach($dpers19 as $dsoal19)
                                      <?php 
                            $mjwb19 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal19->id_words)
                            ->first();

                            $ljwb19 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal19->id_words)
                            ->first();
                            ?>
                                      <tr>
                                              @if($no19==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal19->key}}</td>@endif
                                              <td>@if(isset($mjwb19)) X @endif</td>
                                    <td>@if(isset($ljwb19)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal19->question}}</span></td>
                                      </tr>
                                      <?php $no19++; ?>
                                      @endforeach
                                  </table>
                          </td>
                          <td>
                              <table border="1" style="width: 100%">
                                      <tr style="text-align:center; font-weight: bold">
                                          <td bgcolor="#CCCCCC" width="20px">No.</td>
                                          <td bgcolor="yellow" width="20px">M</td>
                                          <td bgcolor="#6ac06a" width="20px">L</td>
                                          <td bgcolor="#f47b73">Description</td>
                                      </tr>
                                      <?php 
                                      $dpers20 = DB::table('bank_words')
                                      ->select('id_words', 'question', 'key')
                                      ->where('category', 'person')
                                      ->where('key', 15)
                                      ->where('st_words', 1)
                                      ->orderBy('id_words', 'ASC')
                                      ->take(4)
                                      ->get()
                                      ?>
                                      <?php $no20=1; ?>
                                      @foreach($dpers20 as $dsoal20)
                                      <?php 
                            $mjwb20 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal20->id_words)
                            ->first();

                            $ljwb20 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal20->id_words)
                            ->first();
                            ?>
                                      <tr>
                                               @if($no20==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal20->key}}</td>@endif
                                               <td>@if(isset($mjwb20)) X @endif</td>
                                               <td>@if(isset($ljwb20)) X @endif</td>
                                               <td><span style="font-size: 11px;">{{$dsoal20->question}}</span></td>
                                      </tr>
                                      <?php $no20++; ?>
                                      @endforeach
                                  </table>
                          </td>
                          <td>
                              <table border="1" style="width: 100%">
                                          <tr style="text-align:center; font-weight: bold">
                                              <td bgcolor="#CCCCCC" width="20px">No.</td>
                                              <td bgcolor="yellow" width="20px">M</td>
                                              <td bgcolor="#6ac06a" width="20px">L</td>
                                              <td bgcolor="#f47b73">Description</td>
                                          </tr>
                                          <?php 
                                          $dpers21 = DB::table('bank_words')
                                          ->select('id_words', 'question', 'key')
                                          ->where('category', 'person')
                                          ->where('key', 23)
                                          ->where('st_words', 1)
                                          ->orderBy('id_words', 'ASC')
                                          ->take(4)
                                          ->get()
                                          ?>
                                          <?php $no21=1; ?>
                                          @foreach($dpers21 as $dsoal21)
                                          <?php 
                            $mjwb21 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal21->id_words)
                            ->first();

                            $ljwb21 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal21->id_words)
                            ->first();
                            ?>
                                          <tr>
                                              @if($no21==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal21->key}}</td>@endif
                                              <td>@if(isset($mjwb21)) X @endif</td>
                                    <td>@if(isset($ljwb21)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal21->question}}</span></td>
                                          </tr>
                                          <?php $no21++; ?>
                                          @endforeach
                                      </table>
                          </td>
                      </tr>

                      <tr>
                          <td colspan="3">&nbsp;</td>
                        </tr>
            
                        <tr>
                            <td>
                                <table border="1" style="width: 100%">
                                        <tr style="text-align:center; font-weight: bold">
                                            <td bgcolor="#CCCCCC" width="20px">No.</td>
                                            <td bgcolor="yellow" width="20px">M</td>
                                            <td bgcolor="#6ac06a" width="20px">L</td>
                                            <td bgcolor="#f47b73">Description</td>
                                        </tr>
                                        <?php 
                                            $dpers22 = DB::table('bank_words')
                                            ->select('id_words', 'question', 'key')
                                            ->where('category', 'person')
                                            ->where('key', 8)
                                            ->where('st_words', 1)
                                            ->orderBy('id_words', 'ASC')
                                            ->take(4)
                                            ->get()
                                            ?>
                                        <?php $no22=1; ?>
                                        @foreach($dpers22 as $dsoal22)
                                        <?php 
                            $mjwb22 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal22->id_words)
                            ->first();

                            $ljwb22 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal22->id_words)
                            ->first();
                            ?>
                                        <tr>
                                                @if($no22==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal22->key}}</td>@endif
                                                <td>@if(isset($mjwb22)) X @endif</td>
                                    <td>@if(isset($ljwb22)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal22->question}}</span></td>
                                        </tr>
                                        <?php $no22++; ?>
                                        @endforeach
                                    </table>
                            </td>
                            <td>
                                <table border="1" style="width: 100%">
                                        <tr style="text-align:center; font-weight: bold">
                                            <td bgcolor="#CCCCCC" width="20px">No.</td>
                                            <td bgcolor="yellow" width="20px">M</td>
                                            <td bgcolor="#6ac06a" width="20px">L</td>
                                            <td bgcolor="#f47b73">Description</td>
                                        </tr>
                                        <?php 
                                        $dpers23 = DB::table('bank_words')
                                        ->select('id_words', 'question', 'key')
                                        ->where('category', 'person')
                                        ->where('key', 16)
                                        ->where('st_words', 1)
                                        ->orderBy('id_words', 'ASC')
                                        ->take(4)
                                        ->get()
                                        ?>
                                        <?php $no23=1; ?>
                                        @foreach($dpers23 as $dsoal23)
                                        <?php 
                            $mjwb23 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal23->id_words)
                            ->first();

                            $ljwb23 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal23->id_words)
                            ->first();
                            ?>
                                        <tr>
                                                 @if($no23==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal23->key}}</td>@endif
                                                 <td>@if(isset($mjwb23)) X @endif</td>
                                                 <td>@if(isset($ljwb23)) X @endif</td>
                                                 <td><span style="font-size: 11px;">{{$dsoal23->question}}</span></td>
                                        </tr>
                                        <?php $no23++; ?>
                                        @endforeach
                                    </table>
                            </td>
                            <td>
                                <table border="1" style="width: 100%">
                                            <tr style="text-align:center; font-weight: bold">
                                                <td bgcolor="#CCCCCC" width="20px">No.</td>
                                                <td bgcolor="yellow" width="20px">M</td>
                                                <td bgcolor="#6ac06a" width="20px">L</td>
                                                <td bgcolor="#f47b73">Description</td>
                                            </tr>
                                            <?php 
                                            $dpers24 = DB::table('bank_words')
                                            ->select('id_words', 'question', 'key')
                                            ->where('category', 'person')
                                            ->where('key', 24)
                                            ->where('st_words', 1)
                                            ->orderBy('id_words', 'ASC')
                                            ->take(4)
                                            ->get()
                                            ?>
                                            <?php $no24=1; ?>
                                            @foreach($dpers24 as $dsoal24)
                                            <?php 
                            $mjwb24 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_m', $dsoal24->id_words)
                            ->first();

                            $ljwb24 = DB::table('personality_question')
                            ->where('id_career', $jobid)
                            ->where('users_id', $iduser)
                            ->where('id_words_l', $dsoal24->id_words)
                            ->first();
                            ?>
                                            <tr>
                                                @if($no24==1) <td rowspan="4" bgcolor="#CCCCCC" style="font-weight: bold; text-align: center">{{$dsoal24->key}}</td>@endif
                                                <td>@if(isset($mjwb24)) X @endif</td>
                                    <td>@if(isset($ljwb24)) X @endif</td>
                                    <td><span style="font-size: 11px;">{{$dsoal24->question}}</span></td>
                                            </tr>
                                            <?php $no24++; ?>
                                            @endforeach
                                        </table>
                            </td>
                        </tr>

        </table>
        
        
    <br><br>
  </div>
  
  <div class="lds-spinner" id="spinner" style="display: none; float:right; margin-right: 180px">
      <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
    </div>

  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" class="btn btn-primary" id="" onclick="window.close()">Close</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
</form>

@endsection