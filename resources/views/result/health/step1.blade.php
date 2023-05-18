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

.input {
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
              url: '{{route('health.step1.post')}}',
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

<form id="regForm" action="{{route('health.step1.post')}}" method="POST">

<div style="float:right;">
    <h5>&nbsp;</h5>
</div>

  @csrf
  <input type="hidden" name="step" value="2">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>Health Information</h1>
    <hr>
    
    <div class="alert alert-danger print-error-msg" style="display:none">
      <ul></ul>
    </div>           
    
    <div class="row">
        <?php $no=2; ?>
        @foreach($dhealths as $dhealth)
        <?php 
        $djwb = DB::table('health_question')
        ->select('jwb', 'remarks')
        ->where('id_career', $jobid)
        ->where('users_id', $iduser)
        ->where('id_health', $dhealth->id_health)
        ->first();
        ?>
        <input type="hidden" name="q[{{$dhealth->id_health}}]" value="{{$dhealth->id_health}}">
            <div class="col-sm-3">
                <span style="font-size: 14px">{!!$dhealth->name!!}</span>
            </div>
            <div class="col-sm-1">
                    <span style="font-size: 10px">
                      @if(isset($djwb) && $djwb->jwb == "Y") Ya @else Tidak @endif
                    </span>
            </div>
        @endforeach
    </div>

    <hr>

    <div class="row">
        <?php 
        $dhealth2s = DB::table('bank_health')
        ->where('st_health', 1)
        ->where('category', 2)
        ->orderBy('id_health', 'ASC')
        ->get();
        ?>
        @foreach($dhealth2s as $dhealth2)
        <?php 
        $djwb2 = DB::table('health_question')
        ->select('jwb', 'remarks')
        ->where('id_career', $jobid)
        ->where('users_id', $iduser)
        ->where('id_health', $dhealth2->id_health)
        ->first();
        ?>
        <input type="hidden" name="q[{{$dhealth2->id_health}}]" value="{{$dhealth2->id_health}}">
        <div class="col-sm-7" style="height: 50px">
            <span style="font-size: 14px">
                <?php if($dhealth2->id_health == 50) { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>A.</strong>"; ?>
                <?php } else if($dhealth2->id_health == 51) { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>B.</strong>";  ?>
                <?php } else if($dhealth2->id_health == 52) { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>C.</strong>";  ?>
                <?php } else if($dhealth2->id_health == 63) { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>A.</strong>";  ?>
                <?php } else { ?>
                <strong>{{$no}}.</strong> <?php } ?> {!!$dhealth2->name!!}</span> 
        </div>
        <div class="col-sm-2" style="height: 50px">
            @if(isset($djwb2) && $djwb2->jwb == "Y") Ya @else Tidak @endif
        </div>
        <div class="col-sm-3" style="height: 50px">
            <?php if($dhealth2->id_health != 49 && $dhealth2->id_health != 50 && $dhealth2->id_health != 60 && $dhealth2->id_health != 61 && $dhealth2->id_health != 63 && $dhealth2->id_health != 64 && $dhealth2->id_health != 65) { ?>
              @if(isset($djwb2) && $djwb2->remarks != "") <u>{{$djwb2->remarks}}</u> @endif
            <?php } ?>
            <?php if($dhealth2->id_health == 63) { ?>
              @if(isset($djwb2) && $djwb2->remarks != "") <u>{{$djwb2->remarks}}</u> @endif
            <?php } ?>
        </div>
        <?php if($dhealth2->id_health != 49 && $dhealth2->id_health != 50 && $dhealth2->id_health != 51 && $dhealth2->id_health != 63) { $no++; } ?>
        @endforeach
    </div>

    <hr>
    
    <div class="row">
            <?php 
            $dhealth3s = DB::table('bank_health')
            ->where('st_health', 1)
            ->where('category', 3)
            ->orderBy('id_health', 'ASC')
            ->get();
            ?>
            <div class="col-sm-12" style="height: 50px">
                <strong>{{$no}}.</strong> <i>Khusus untuk Wanita</i>
            </div>
            @foreach($dhealth3s as $dhealth3)
            <?php 
        $djwb3 = DB::table('health_question')
        ->select('jwb', 'remarks')
        ->where('id_career', $jobid)
        ->where('users_id', $iduser)
        ->where('id_health', $dhealth3->id_health)
        ->first();
        ?>
            <input type="hidden" name="q[{{$dhealth3->id_health}}]" value="{{$dhealth3->id_health}}">
            <div class="col-sm-7" style="height: 50px">
                <span style="font-size: 14px">
                        <?php if($dhealth3->id_health == 66) { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dhealth3->name.""; ?>
                        <?php } else if($dhealth3->id_health == 67) { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dhealth3->name."";  ?>
                        <?php } else if($dhealth3->id_health == 68) { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dhealth3->name."";  ?>
                        <?php } else if($dhealth3->id_health == 69) { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dhealth3->name."";  ?>
                        <?php } else if($dhealth3->id_health == 70) { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dhealth3->name."";  ?>
                        <?php } else if($dhealth3->id_health == 71) { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$dhealth3->name."";  ?>
                        <?php } ?> 
            </div>
            <div class="col-sm-2" style="height: 50px">
                @if(isset($djwb3) && $djwb3->jwb == "Y") Ya @else Tidak @endif
            </div>
            <div class="col-sm-3" style="height: 50px">
                <?php if($dhealth3->id_health == 68) { ?>
                  @if(isset($djwb3) && $djwb3->remarks != "") <u>{{$djwb3->remarks}}</u> @endif
                <?php } ?>
            </div>
            <?php $no++; ?>
            @endforeach
        </div>

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
