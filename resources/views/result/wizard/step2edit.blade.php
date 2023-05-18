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
    $('.tahun').datepicker({
      viewMode: "years", 
      minViewMode: "years",
      autoclose: true,
      format: 'yyyy'
    });
    $('.numbersOnly').keyup(function () {
      this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    $('input.number').keyup(function(event) {
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40) return;
      // format number
      $(this).val(function(index, value) {
          return value
          .replace(/\D/g, "")
          .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
          ;
      });
    });
    
})
</script>

<script>
$(document).ready(function(){
    //Cloning
    $(".tr_clone_add").click('click', function() {
      var $tr    = $(this).closest('.tr_clone');
      var newClass='newClass';
      var $clone = $tr.clone().addClass(newClass);
      $clone.find(':text').val('');
      $tr.after($clone);
      $(".tambah:last").remove(); //Remove field html
      $(".hapus:last").remove(); //Remove field html
      //$(".inner:last").prepend('<i class="fa fa-plus"></i>');
      $('.numbersOnly').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
      });
      $('input.number').keyup(function(event) {
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40) return;
        // format number
        $(this).val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            ;
        });
      });
      $('.tahun').datepicker({
        viewMode: "years", 
        minViewMode: "years",
        autoclose: true,
        format: 'yyyy'
      });
  });

  $(".tr_clone_remove").click('click', function() { //Once remove button is clicked
    $(".newClass:last").remove(); //Remove field html
    x--; //Decrement field counter
  });
    //Cloning

      var _token = $("input[name=_token]").val();
      $("#nextBtn").click(function(e){
          e.preventDefault();
          $.ajax({
              /* the route pointing to the post function */
              url: '{{route('wizard.post.step2')}}',
              type: 'POST',
              /* send the csrf-token and the input to the controller */
              data: $("#regForm").serialize(),
              dataType: 'JSON',
              /* remind that 'data' is the response of the AjaxController */
              beforeSend: function() {
                $("#spinner").show();
                $('#nextBtn').prop('disabled', true);
              },
              success: function (data) { 
                if(data.status == "success") {
                  window.location.href = '{{route('wizard_step3', ['idjob' => $jobid])}}';
                } else {
                  $('html, body').animate({scrollTop: '100px'}, 1500);
                  $('#nextBtn').prop('disabled', false);
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

<form id="regForm" action="{{route('wizard.post.step2')}}" method="POST">
    <input type="hidden" name="idjob" value="{{$jobid}}">
<div style="float:right;">
  <h5>Step 2</h5>
</div>

  @csrf
  <input type="hidden" name="step" value="2e">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>Work Experience [Update]</h1>
    <hr>
    
    <div class="alert alert-danger print-error-msg" style="display:none">
      <ul></ul>
    </div>

    <div class="row">
        <div class="col-sm-12">
                <label for="sel1">Kompensasi terakhir/Latest compensation</label>
                <input placeholder="Kompensasi terakhir/Latest compensation" name="latest_compensation" value="{{$ddata->latest_compensation}}" id="latest_compensation" class="required number">
        </div>
    </div>

    <hr>
    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Riwayat Pekerjaan/ Work Experience</h5>
    <table border="1px" width="100%">
      <tr>
        <td align="center">Action</td>
        <td align="center">Tahun Bekerja/ <br>Year</td>
        <td align="center">Perusahaan/ <br>Employer</td>
        <td align="center">Posisi/ <br>Title</td>
        <td align="center">Deskripsi Pekerjaan/ <br>Job Responsibilities</td>
        <td align="center">Prestasi/ <br>Achievements</td>
        <td align="center">Alasan Keluar/ <br>Reasons for Leaving</td>
      </tr>

      <tr align="center" class="tr_clone">
        <td class="inner">
            <a href="javascript:void(0);" class="tr_clone_add" title="Add field"><span><i class="fa fa-plus tambah"></i></span></a> 
            <a href="javascript:void(0);" class="tr_clone_remove" title="Remove field"><span style="color: #D63939;"><i class="fa fa-trash hapus"></i></span></a>
        </td>
        <td><input type="text" name="from[]" id="from" value="" class="input numbersOnly tahun"  style="width:50px !important" placeholder="From" maxlength="4" >
          <input type="text" name="to[]" id="to" value="" class="input numbersOnly tahun" style="width:50px !important" placeholder="To" maxlength="4" ></td>
        <td><input type="text" name="company[]" id="company" value="" class="input" ></td>
        <td><input type="text" name="position[]" id="position" value="" class="input" ></td>
        <td><input type="text" name="job_responsibilities[]" id="job_responsibilities" value="" class="input" ></td>
        <td><input type="text" name="achievements[]" id="achievements" value="" class="input" ></td>
        <td><input type="text" name="reason[]" id="reason" value="" class="input" ></td>
      </tr>

      <?php 
      $dexperiences = DB::table('pelamar_experience')
        ->where('users_id', Auth::user()->id)
        ->get();
       ?>
       @foreach($dexperiences as $dexperience)

      <tr align="left" class="">
        <td class="inner">
            
        </td>
        <td><input type="text" name="from[]" id="from" value="{{$dexperience->from}}" class="input numbersOnly tahun"  style="width:50px !important" placeholder="From" maxlength="4" >
            <input type="text" name="to[]" id="to" value="{{$dexperience->to}}" class="input numbersOnly tahun" style="width:50px !important" placeholder="To" maxlength="4" ></td>
        <td><input type="text" name="company[]" id="company" value="{{$dexperience->company}}" class="input" ></td>
        <td><input type="text" name="position[]" id="position" value="{{$dexperience->position}}" class="input" ></td>
        <td><input type="text" name="job_responsibilities[]" id="job_responsibilities" value="{{$dexperience->job_responsibilities}}" class="input" ></td>
        <td><input type="text" name="achievements[]" id="achievements" value="{{$dexperience->achievements}}" class="input" ></td>
        <td><input type="text" name="reason[]" id="reason" value="{{$dexperience->reason}}" class="input" ></td>
      </tr>
      @endforeach

    </table>

    <br>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Referensi/  Professional References <small>(provide at least 2 names)</small></h5>
    <table border="0px" width="100%">
    <?php 
    $no3 = 1;
    $dreferences = DB::table('pelamar_references')
    ->where('users_id', Auth::user()->id)
    ->get();
    ?>
    @foreach($dreferences as $dreference)
      <tr>
        <td style="width: 500px"><strong>{{$no3}}.</strong> Nama/ Name</td>
        <td>:</td>
        <td><input type="text" name="name[]" id="name" value="{{ $dreference->name }}" class="input" required ></td>
      </tr>
      <tr>
          <td>Hubungan/ Relationship</td>
          <td>:</td>
          <td><input type="text" name="relationship[]" id="relationship" value="{{ $dreference->relationship }}" class="input" required></td>
      </tr>
      <tr>
        <td>Nomor/email untuk dihubungi/ Contact No. Ponsel/ Cellular & Email</td>
        <td>:</td>
        <td><input type="text" name="contact[]" id="contact" value="{{ $dreference->contact }}" class="input" required></td>
      </tr>
      <?php $no3++; ?>
      @endforeach

      @if(count($dreferences)==2)
        <tr>
            <td style="width: 500px"><strong>3.</strong> Nama/ Name</td>
            <td>:</td>
            <td><input type="text" name="name[]" id="name" value="" class="input"  ></td>
          </tr>
          <tr>
              <td>Hubungan/ Relationship</td>
              <td>:</td>
              <td><input type="text" name="relationship[]" id="relationship" value="" class="input" ></td>
          </tr>
          <tr>
            <td>Nomor/email untuk dihubungi/ Contact No. Ponsel/ Cellular & Email</td>
            <td>:</td>
            <td><input type="text" name="contact[]" id="contact" value="" class="input" ></td>
          </tr>
        @endif

    </table>

    <br><br>
  </div>
  
  <div class="lds-spinner" id="spinner" style="display: none; float:right; margin-right: 180px">
      <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
    </div>

  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="location.href='{{route('wizard', ['idjob' => $jobid])}}'">Previous</button>
      <button type="button" id="nextBtn">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
</form>

@endsection
