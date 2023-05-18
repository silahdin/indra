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
    //cek total language
    var jumlah = $('input[name*="language[]"]').length;
    $("#jumlahq").html("jumlahnya: "+jumlah);

    //Cloning
    $(".tr_clone_add1").click('click', function() {
      var $tr    = $(this).closest('.tr_clone1');
      var newClass='newClass1';
      var $clone = $tr.clone().addClass(newClass);
      $clone.find(':text').val('');
      $tr.after($clone);
      $(".tambah1:last").remove(); //Remove field html
      $(".hapus1:last").remove(); //Remove field html
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

  $(".tr_clone_remove1").click('click', function() { //Once remove button is clicked
    $(".newClass1:last").remove(); //Remove field html
    x--; //Decrement field counter
  });

  //=====================
  $(".tr_clone_add2").click('click', function() {
    var $tr    = $(this).closest('.tr_clone2');
    var newClass='newClass2';
    var $clone = $tr.clone().addClass(newClass);
    $clone.find(':text').val('');
    $tr.after($clone);
    $(".tambah2:last").remove(); //Remove field html
    $(".hapus2:last").remove(); //Remove field html
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

$(".tr_clone_remove2").click('click', function() { //Once remove button is clicked
  $(".newClass2:last").remove(); //Remove field html
  x--; //Decrement field counter
});

//=====================
var count =2;
$(".tr_clone_add3").click('click', function() {
  var $tr    = $(this).closest('.tr_clone3');
  var newClass='newClass3';
  var $clone = $tr.clone().addClass(newClass);
  $clone.find(':text').val('');
  $clone.find(':radio').prop('checked', false);
  $tr.after($clone);
  
  count++;
  
  var nilai = $tr.find('.nilai').attr('name', 'nilai'+count);
  var language = $tr.find('.language').attr('name', 'language'+count);
  $("#tlang").val('')
  $("#tlang").val(count)




  $(".tambah3:last").remove(); //Remove field html
  $(".hapus3:last").remove(); //Remove field html
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

$(".tr_clone_remove3").click('click', function() { //Once remove button is clicked
$(".newClass3:first").remove(); //Remove field html
x--; //Decrement field counter
});
    //Cloning

      var _token = $("input[name=_token]").val();
      $("#nextBtn").click(function(e){
          e.preventDefault();
          $.ajax({
              /* the route pointing to the post function */
              url: '{{route('wizard.post.step3')}}',
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
                console.log(data);
                if(data.status == "success") {
                  window.location.href = '{{route('wizard_summary', ['idjob' => $jobid])}}';
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
  <h5>Step 3</h5>
</div>

  @csrf
  <input type="hidden" name="step" value="3">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>Education History</h1>
    <hr>
    
    <div class="alert alert-danger print-error-msg" style="display:none">
      <ul></ul>
    </div>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Educational History</h5>
    <table border="0px" width="100%">
      <tr>
        <td style="width: 400px"><strong>1.</strong> High School <input type="hidden" name="tipeedu[]" value="SMA" ></td>
        <td>:</td>
        <td><input type="text" name="nameedu[]" id="name" value="" class="input" required ></td>
      </tr>
      <tr>
          <td>Major</td>
          <td>:</td>
          <td><input type="text" name="majoredu[]" id="major" value="" class="input" required></td>
      </tr>
      <input type="hidden" name="ipkedu[]" id="ipk" value="0">

      <tr>
        <td style="width: 400px"><strong>2.</strong> Vocational School <input type="hidden" name="tipeedu[]" value="SMK" ></td>
        <td>:</td>
        <td><input type="text" name="nameedu[]" id="name" value="" class="input" required ></td>
        </tr>
        <tr>
            <td>Major</td>
            <td>:</td>
            <td><input type="text" name="majoredu[]" id="major" value="" class="input" required></td>
        </tr>
        <input type="hidden" name="ipkedu[]" id="ipk" value="0">

        <tr>
        <td style="width: 400px"><strong>3.</strong> Undergraduate Degree <input type="hidden" name="tipeedu[]" value="Strata 1" ></td>
        <td>:</td>
        <td><input type="text" name="nameedu[]" id="name" value="" class="input" required ></td>
        </tr>
        <tr>
            <td>Major</td>
            <td>:</td>
            <td><input type="text" name="majoredu[]" id="major" value="" class="input" required></td>
        </tr>
        <tr>
            <td>GPA</td>
            <td>:</td>
            <td><input type="text" name="ipkedu[]" id="ipk" value="" class="input" required></td>
        </tr>

        <tr>
        <td style="width: 400px"><strong>4.</strong> Master Degree <input type="hidden" name="tipeedu[]" value="Strata 2" ></td>
        <td>:</td>
        <td><input type="text" name="nameedu[]" id="name" value="" class="input" required ></td>
        </tr>
        <tr>
            <td>Major</td>
            <td>:</td>
            <td><input type="text" name="majoredu[]" id="major" value="" class="input" required></td>
        </tr>
        <tr>
            <td>GPA</td>
            <td>:</td>
            <td><input type="text" name="ipkedu[]" id="ipk" value="" class="input" required></td>
        </tr>

    </table>

    <hr>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> List of internal and external trainings: </h5>
    <table border="1px" width="100%">
      <tr>
        <td align="center">Action</td>
        <td align="center">Training Subject</td>
        <td align="center">Host</td>
        <td align="center">Year</td>
        <td align="center">Result</td>
      </tr>

      <tr align="center" class="tr_clone1">
        <td class="inner">
            <a href="javascript:void(0);" class="tr_clone_add1" title="Add field"><span><i class="fa fa-plus tambah1"></i></span></a> 
            <a href="javascript:void(0);" class="tr_clone_remove1" title="Remove field"><span style="color: #D63939;"><i class="fa fa-trash hapus1"></i></span></a>
        </td>
        <td><input type="text" name="subject[]" id="subject" value="" class="input" ></td>
        <td><input type="text" name="host[]" id="host" value="" class="input" ></td>
        <td><input type="text" name="yeartraining[]" id="yeartraining" value="" class="input numbersOnly tahun"  style="width:50px !important" placeholder="Year" maxlength="4" ></td>
        <td><input type="text" name="result[]" id="result" value="" class="input" ></td>
      </tr>
    </table>

    <hr>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Professional certifications: </h5>
    <table border="1px" width="100%">
      <tr>
        <td align="center">Action</td>
        <td align="center">Name of Certificates</td>
        <td align="center">Issuer</td>
        <td align="center">Year</td>
      </tr>

      <tr align="center" class="tr_clone2">
        <td class="inner">
            <a href="javascript:void(0);" class="tr_clone_add2" title="Add field"><span><i class="fa fa-plus tambah2"></i></span></a> 
            <a href="javascript:void(0);" class="tr_clone_remove2" title="Remove field"><span style="color: #D63939;"><i class="fa fa-trash hapus2"></i></span></a>
        </td>
        <td><input type="text" name="namecert[]" id="namecert" value="" class="input" ></td>
        <td><input type="text" name="institusi[]" id="institusi" value="" class="input" ></td>
        <td><input type="text" name="yearcert[]" id="yearcert" value="" class="input numbersOnly tahun"  style="width:50px !important" placeholder="Year" maxlength="4" ></td>
      </tr>
    </table>

    <hr>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Computer Ability </h5>
    <table border="1px" width="100%">
      <tr>
        <td align="center">Application</td>
        <td align="center">Unskilled </td>
        <td align="center">Poor  </td>
        <td align="center">Average </td>
        <td align="center">Skilled</td>
        <td align="center">Expert</td>
      </tr>

      <tr align="left" class="">
        <td> &nbsp;&nbsp;&nbsp;<i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Ms. Word </td>
        <td><input type="radio" name="ms_word" value="1"></td>
        <td><input type="radio" name="ms_word" value="2"></td>
        <td><input type="radio" name="ms_word" value="3"></td>
        <td><input type="radio" name="ms_word" value="4"></td>
        <td><input type="radio" name="ms_word" value="5"></td>
      </tr>

      <tr align="left" class="">
        <td> &nbsp;&nbsp;&nbsp;<i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Ms. Excel </td>
        <td><input type="radio" name="ms_excel" value="1"></td>
        <td><input type="radio" name="ms_excel" value="2"></td>
        <td><input type="radio" name="ms_excel" value="3"></td>
        <td><input type="radio" name="ms_excel" value="4"></td>
        <td><input type="radio" name="ms_excel" value="5"></td>
    </tr>

    <tr align="left" class="">
        <td> &nbsp;&nbsp;&nbsp;<i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Ms. Powerpoint </td>
        <td><input type="radio" name="ms_powerpoint" value="1"></td>
        <td><input type="radio" name="ms_powerpoint" value="2"></td>
        <td><input type="radio" name="ms_powerpoint" value="3"></td>
        <td><input type="radio" name="ms_powerpoint" value="4"></td>
        <td><input type="radio" name="ms_powerpoint" value="5"></td>
    </tr>

    <tr align="left" class="">
        <td> &nbsp;&nbsp;&nbsp;<i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Ms. Access </td>
        <td><input type="radio" name="ms_access" value="1"></td>
        <td><input type="radio" name="ms_access" value="2"></td>
        <td><input type="radio" name="ms_access" value="3"></td>
        <td><input type="radio" name="ms_access" value="4"></td>
        <td><input type="radio" name="ms_access" value="5"></td>
    </tr>

    </table>

    <hr>

    <h5><i class="fa fa-asterisk" aria-hidden="true" style="font-size: 12px !important; color:blue"></i> Language Ability</h5>
    <input type="hidden" name="tlang" id="tlang" value="1">
    <table border="1px" width="100%">
      <tr>
        <td align="center">Action</td>
        <td align="center">Language</td>
        <td align="center">Poor</td>
        <td align="center">Fair</td>
        <td align="center">Good</td>
        <td align="center">Fluent</td>
      </tr>

      <tr align="center" class="">
        <td class="inner">
            
        </td>
        <td><input type="text" name="language0" id="language" value="Bahasa Indonesia" class="input language" ></td>
        <td><input type="radio" name="nilai0" value="1" class="nilai"></td>
        <td><input type="radio" name="nilai0" value="2" class="nilai"></td>
        <td><input type="radio" name="nilai0" value="3" class="nilai"></td>
        <td><input type="radio" name="nilai0" value="4" class="nilai"></td>
      </tr>
      <tr align="center" class="">
          <td class="inner">
              
          </td>
          <td><input type="text" name="language1" id="language" value="Bahasa Inggris" class="input language" ></td>
          <td><input type="radio" name="nilai1" value="1" class="nilai"></td>
          <td><input type="radio" name="nilai1" value="2" class="nilai"></td>
          <td><input type="radio" name="nilai1" value="3" class="nilai"></td>
          <td><input type="radio" name="nilai1" value="4" class="nilai"></td>
      </tr>
      <tr align="center" class="tr_clone3">
        <td class="inner">
            <a href="javascript:void(0);" class="tr_clone_add3" title="Add field"><span><i class="fa fa-plus tambah3"></i></span></a> 
            <a href="javascript:void(0);" class="tr_clone_remove3" title="Remove field"><span style="color: #D63939;"><i class="fa fa-trash hapus3"></i></span></a>
        </td>
        <td><input type="text" name="language2" id="language" value="" class="input language" ></td>
        <td><input type="radio" name="nilai2" value="1" class="nilai"></td>
        <td><input type="radio" name="nilai2" value="2" class="nilai"></td>
        <td><input type="radio" name="nilai2" value="3" class="nilai"></td>
        <td><input type="radio" name="nilai2" value="4" class="nilai"></td>
      </tr>
    </table>

    <br><br>
  </div>
  
  <div class="lds-spinner" id="spinner" style="display: none; float:right; margin-right: 180px">
      <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
    </div>

  <div style="overflow:auto;">
    <div style="float:right;">
        <button type="button" id="prevBtn" onclick="location.href='{{route('wizard_step2', ['idjob' => $jobid])}}'">Previous</button>
      <button type="button" id="nextBtn">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
</form>

@endsection
