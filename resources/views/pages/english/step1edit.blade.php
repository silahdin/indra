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
</style>

<script>
$(document).ready(function(){
      var _token = $("input[name=_token]").val();
      $("#nextBtn").click(function(e){
          e.preventDefault();
          $.ajax({
              /* the route pointing to the post function */
              url: '{{route('english.step1.post')}}',
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
                console.log(data.status);
                if(data.status == "success") {
                  window.location.href = '{{route('english.step2', ['idjob' => $jobid])}}';
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

<form id="regForm" action="{{route('english.step1.post')}}" method="POST">
    <input type="hidden" name="idjob" value="{{$jobid}}">
<div style="float:right;">
  <h5>Essay</h5>
</div>

  @csrf
  <input type="hidden" name="step" value="1e">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>English Test</h1>
    <hr>
    
    <div class="alert alert-danger print-error-msg" style="display:none">
      <ul></ul>
    </div>

    <div class="row">
        <?php $no = 1; ?>
        @foreach($denglish as $dsoal)
        <?php 
        $djwb = DB::table('english_essay')
        ->select('answer')
        ->where('users_id', Auth::user()->id)
        ->where('id_bankessay', $dsoal->id_bankessay)
        ->first();
        ?>
        <div class="col-sm-12">
                <label for="sel1"><?=$no++?>. {{$dsoal->question}}</label>
                <br>
                <input type="hidden" name="q[]" value="{{$dsoal->id_bankessay}}"?>
                <textarea placeholder="Answer" name="answer[]" id="answer_{{$dsoal->id_bankessay}}" class="required" rows="3" style="width: 100%">{{$djwb->answer}}</textarea>
        </div>
        @endforeach
        
    </div>
    

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
