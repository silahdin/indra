@extends('layouts.app')

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
    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Essay </h5>
    <div class="row">
        <?php $no = 1; ?>
        @foreach($denglish as $dsoal)
        <div class="col-sm-12">
                <label for="sel1"><?=$no++?>. {{$dsoal->question}}</label>
                <br>{{$dsoal->answer}}
                <br><br>
        </div>
        @endforeach
        
    </div>

    <hr>
    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Multiple Choice </h5>
    <div class="row">
        <div class="col-sm-12">
            <?php 
            $tjwb = DB::table('bank_question')
            ->select('bank_question.id_question')
            ->leftJoin('english_question', 'english_question.id_question', '=', 'bank_question.id_question')
            ->where('english_question.id_career', Crypt::decryptString($jobid))
            ->where('english_question.users_id', Auth::user()->id)
            ->whereRaw('bank_question.key = english_question.jwb')
            ->count();
            ?>
            <strong>Correct Number of Answers: <span style="font-size: 20px">{{$tjwb}}</span> answer</strong>
        </div>
    </div>
    <br>
    <table border="0" style="width: 100%">
            <?php $no=1; ?>
            @foreach($denglish2 as $dsoal2)
            <tr @if($dsoal2->key != $dsoal2->jwb) style="color: red" @else style="color: green"  @endif> 
                <td><strong>@if($dsoal2->key != $dsoal2->jwb) <i class="fa fa-times" aria-hidden="true"></i> @else <i class="fa fa-check" aria-hidden="true"></i> @endif {{$no}}. </strong> {!!$dsoal2->question!!}</td>
            </tr>
            <tr>
                <td>
                        <table border="0px" style="width: 100%">
                            <tr>
                                <td @if($dsoal2->jwb=="a") style="color: blue; width: 400px" @else style="width: 400px" @endif><strong> A.</strong> {{$dsoal2->a}}</td>
                                <td @if($dsoal2->jwb=="c") style="color: blue; width: 400px" @else style="width: 400px" @endif><strong> C.</strong> {{$dsoal2->c}}</td>
                                @if($dsoal2->e!= "")<td @if($dsoal2->jwb=="e") style="color: blue; width: 400px" @else style="width: 400px" @endif><strong> E.</strong> {{$dsoal2->e}}</td>@endif
                            </tr>
                            <tr>
                                <td @if($dsoal2->jwb=="b") style="color: blue; width: 400px" @else style="width: 400px" @endif><strong> B.</strong> {{$dsoal2->b}}</td>
                                <td @if($dsoal2->jwb=="d") style="color: blue; width: 400px" @else style="width: 400px" @endif><strong> D.</strong> {{$dsoal2->d}}</td>
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

    

    <br><br>

  </div>
  
  
  <div style="overflow:auto;">
      <div style="float:right;">
          <button type="button" class="btn btn-primary" id="prevBtn" onclick="location.href='{{route('home')}}'">Home</button>
      </div>
    </div>
  <!-- Circles which indicates the steps of the form: -->
</form>

@endsection
