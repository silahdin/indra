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
  width: 100%;
}

.tengah {
    text-align: center;  
  }
</style>
<script>
  $(document).ready(function(){  
      $('input.nomer').keyup(function(event) {
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
      var _token = $("input[name=_token]").val();
      $("#nextBtn").click(function(e){
          e.preventDefault();
          $.ajax({
              /* the route pointing to the post function */
              url: '{{route('technical.set4.post')}}',
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

<form id="regForm" method="POST">
    <input type="hidden" name="idjob" value="{{$jobid}}">
<div style="float:right;">
    <h5>Step 1</h5>
</div>

  @csrf
  <input type="hidden" name="step" value="2">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>Technical Test 4</h1>
    <hr>
    
    <div class="alert alert-danger print-error-msg" style="display:none">
      <ul></ul>
    </div>
    
    <p class="tengah"><span style="font-size: 18px; font-weight: bold">II. ESSAY</span></p> 

    <p>PT Indonesia adalah perusahaan yang bergerak di bidang jasa perhotelan.<br>
        Informasi tambahan untuk perhitungan PPh dan pajak tangguhan tahun 2018 terdiri dari:
    </p>      
    <p><strong>1.</strong> 	Aset tetap terdiri dari:</p>  
    
    <table border="1" style="width: 100%">
      <tr style="text-align: center; font-weight: bold">
          <td>No.</td><td>Jenis asset</td><td>Harga perolehan (Rp)</td><td>Saat perolehan</td><td>Masa Manfaat / Komersial</td><td>Manfaat / Fiskal</td>
      </tr>
      <tr>
        <td align="center">1.</td><td>Building</td><td>250.000.000.000</td><td>1 Januari 2016</td><td>25 tahun</td><td>20 tahun</td>
    </tr>
    <tr>
      <td align="center">2.</td><td>Furniture</td><td>150.000.000.000</td><td>1 Januari 2016</td><td>5 tahun</td><td>8 tahun</td>
  </tr>
  </table>
  <br>
    <p>Perusahaan menggunakan model biaya dalam mengukur aset tetapnya sesuai dengan PSAK 16. Tidak ada penurunan nilai aset tetap dibandingkan nilai wajarnya. 
      Metode penyusutan yang digunakan, baik komersial maupun fiskal adalah metode garis lurus.</p>
      <p>Hitung: Nilai buku aset tetap komersial dan fiskal per 31 Desember 2018 beserta penyusutan komersial dan fiskal tahun 2018.</p>
    
    <p>Jawaban:</p>

    <table border="1" style="width: 100%">
        <tr style="text-align: center; font-weight: bold">
            <td>Jenis asset</td><td>Depresiasi Komersial</td><td>Depresiasi Fiskal</td><td>NBV Commercial</td><td>NBV Fiscal</td>
        </tr>
        <tr>
          <td>Building</td><td><input type="text" name="jwb_1_1_1" id="jwb_1_1_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_1_2" id="jwb_1_1_2" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_1_3" id="jwb_1_1_3" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_1_4" id="jwb_1_1_4" value="0" class="input nomer" ></td>
      </tr>
      <tr>
        <td>Furniture</td><td><input type="text" name="jwb_1_2_1" id="jwb_1_2_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_2_2" id="jwb_1_2_2" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_2_3" id="jwb_1_2_3" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_2_4" id="jwb_1_2_4" value="0" class="input nomer" ></td>
      </tr>
      <tr>
          <td>Total</td><td><input type="text" name="jwb_1_3_1" id="jwb_1_3_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_3_2" id="jwb_1_3_2" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_3_3" id="jwb_1_3_3" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_3_4" id="jwb_1_3_4" value="0" class="input nomer" ></td>
        </tr>
        <tr>
            <td>Differences NBV Commercial and NBV Fiscal</td><td><input type="text" name="jwb_1_4_1" id="jwb_1_4_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_4_2" id="jwb_1_4_2" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_4_3" id="jwb_1_4_3" value="0" class="input nomer" ></td><td><input type="text" name="jwb_1_4_4" id="jwb_1_4_4" value="0" class="input nomer" ></td>
          </tr>
    </table>

    <br>

    <p><strong>2.</strong> Saldo piutang (kotor) per 31 Desember 2017 adalah Rp 84,664,800,000.
      Data pembentukan allowance for bad debts dan penghapusan (write off) piutang tak tertagih tahun 2018 adalah sebagai berikut:</p>
      <div class="row">
        <div class="col-sm-6">-	Saldo <i>allowance for bad debts</i>, 1 Januari 2018</div><div class="col-sm-6">Rp 2.555.000.000</div>
        <div class="col-sm-6">-	Pembentukan <i>allowance for bad debts</i> tahun 2018</div><div class="col-sm-6">7.500.000.000</div>
        <div class="col-sm-6">-	Penghapusan piutang (<i>write off</i>) tahun 2018</div><div class="col-sm-6">(7.260.000.000)</div>
        <div class="col-sm-6">-	Saldo <i>allowance for bad debts</i>, 31 Desember 2018</div><div class="col-sm-6">Rp 2.795.000.000</div>
      </div> 
      <br>
      <p>
        Penghapusan piutang tak tertagih tersebut telah dilakukan sesuai dengan ketentuan pajak dan memenuhi syarat penghapusan piutang secara  iscal
      </p>   
      <p>Hitung: Nilai buku piutang komersial dan fiskal per 31 Desember 2018.<br>
          Jawaban:
      </p>   
      
      <table border="1" style="width: 100%">
          <tr style="text-align: center; font-weight: bold">
              <td></td><td>NBV Komersial</td><td>NBV Fiskal</td>
          </tr>
          <tr>
            <td>Piutang awal</td><td><input type="text" name="jwb_2_1_1" id="jwb_2_1_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_2_1_2" id="jwb_2_1_2" value="0" class="input nomer" ></td>
        </tr>
        <tr>
          <td>Dikurangi: write-off</td><td><input type="text" name="jwb_2_2_1" id="jwb_2_2_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_2_2_2" id="jwb_2_2_2" value="0" class="input nomer" ></td>
        </tr>
        <tr>
            <td>Dikurangi: AFDA</td><td><input type="text" name="jwb_2_3_1" id="jwb_2_3_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_2_3_2" id="jwb_2_3_2" value="0" class="input nomer" ></td>
          </tr>
          <tr>
              <td>Piutang akhir</td><td><input type="text" name="jwb_2_4_1" id="jwb_2_4_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_2_4_2" id="jwb_2_4_2" value="0" class="input nomer" ></td>
          </tr>
          <tr>
            <td>Differences in NBV</td><td><input type="text" name="jwb_2_5_1" id="jwb_2_5_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_2_5_2" id="jwb_2_5_2" value="0" class="input nomer" ></td>
          </tr>
      </table>

      <br>

    <p><strong>3.</strong>	Saldo persediaan (kotor) per 31 Desember 2017 adalah Rp 15,168,730,000.
      Untuk persediaan, perusahaan menyajikan nilai persedian antara yang terendah antara biaya dan nilai realisasi 
      bersih sesuai dengan PSAK 14. Data penurunan dan penghapusan nilai persediaan tahun 2018 adalah sebagai berikut:
      </p>
      <div class="row">
        <div class="col-sm-6">-	Saldo <i>allowance for decrease in value of inventory</i>, 1 Januari 2018</div><div class="col-sm-6">Rp 1.004.740.000</div>
        <div class="col-sm-6">-	Pembentukan <i>allowance for decrease in value of inventory</i> tahun 2018</div><div class="col-sm-6">600.000.000</div>
        <div class="col-sm-6">-	Penghapusan persediaan tahun 2018</div><div class="col-sm-6">(97.630.000)</div>
        <div class="col-sm-6">-	Saldo <i>allowance for decrease in value of inventory</i>, 31 Desember 2018</div><div class="col-sm-6">Rp 1.507.110.000</div>
      </div> 
      <br>
      <p>
          Penghapusan persediaan pada tahun 2018 telah sesuai dengan ketentuan pajak yang berlaku
      </p>   
      <p>Hitung: Nilai buku persediaan komersial dan fiskal per 31 Desember 2018<br>
          Jawaban:
      </p>   
      
      <table border="1" style="width: 100%">
          <tr style="text-align: center; font-weight: bold">
              <td></td><td>NBV Komersial</td><td>NBV Fiskal</td>
          </tr>
          <tr>
            <td>Persediaan awal</td><td><input type="text" name="jwb_3_1_1" id="jwb_3_1_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_3_1_2" id="jwb_3_1_2" value="0" class="input nomer" ></td>
        </tr>
        <tr>
          <td>Dikurangi: write-off</td><td><input type="text" name="jwb_3_2_1" id="jwb_3_2_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_3_2_2" id="jwb_3_2_2" value="0" class="input nomer" ></td>
        </tr>
        <tr>
            <td>Dikurangi: AFDI</td><td><input type="text" name="jwb_3_3_1" id="jwb_3_3_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_3_3_2" id="jwb_3_3_2" value="0" class="input nomer" ></td>
          </tr>
          <tr>
              <td>Persediaan akhir</td><td><input type="text" name="jwb_3_4_1" id="jwb_3_4_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_3_4_2" id="jwb_3_4_2" value="0" class="input nomer" ></td>
          </tr>
          <tr>
            <td>Differences</td><td><input type="text" name="jwb_3_5_1" id="jwb_3_5_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_3_5_2" id="jwb_3_5_2" value="0" class="input nomer" ></td>
          </tr>
      </table>
      <br>

      <p><strong>4.</strong>	Keterangan lain:</p>
      <i class="fa fa-check" aria-hidden="true"></i> Rugi komersial sebelum pajak adalah sebesar Rp (2,128,749,186)<br>
      <i class="fa fa-check" aria-hidden="true"></i>	Dalam operating expenses, terdapat pemberian sumbangan sebesar Rp9.750.000.000, sanksi administrasi perpajakan Rp750.000.000, dan non-monetary benefits (benefit in-kind) untuk karyawan sebesar Rp7.000.000.000.<br>
      <i class="fa fa-check" aria-hidden="true"></i>	PT Fath Indonesia memiliki kerugian fiskal yang masih dapat dikompensasikan dengan laba fiskal tahun 2018 sebesar Rp21.728.536.675.<br>
      <br>
      Hitung PPh Badan terutang tahun 2018 dan buat jurnal untuk mencatat beban pajak kini 2018
      <br><br>
      Jawab:
      <br><br>
        
        <table border="1" style="width: 100%">
            <tr>
              <td>Rugi sebelum pajak</td><td><input type="text" name="jwb_4_1_1" id="jwb_4_1_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_1_2" id="jwb_4_1_2" value="0" class="input nomer" ></td>
          </tr>
          <tr>
            <td>Permanent differences:</td><td><input type="text" name="jwb_4_2_1" id="jwb_4_2_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_2_2" id="jwb_4_2_2" value="0" class="input nomer" ></td>
          </tr>
          <tr>
              <td>&nbsp;&nbsp;&nbsp;1. Sumbangan</td><td><input type="text" name="jwb_4_3_1" id="jwb_4_3_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_3_2" id="jwb_4_3_2" value="0" class="input nomer" ></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;2. Sanksi pajak</td><td><input type="text" name="jwb_4_4_1" id="jwb_4_4_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_4_2" id="jwb_4_4_2" value="0" class="input nomer" ></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;3. BIK</td><td><input type="text" name="jwb_4_5_1" id="jwb_4_5_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_5_2" id="jwb_4_5_2" value="0" class="input nomer" ></td>
            </tr>
            <tr>
                <td>Total permanent differences</td><td><input type="text" name="jwb_4_6_1" id="jwb_4_6_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_6_2" id="jwb_4_6_2" value="0" class="input nomer" ></td>
            </tr>
            <tr>
              <td>&nbsp;</td><td></td><td></td>
            </tr>
            <tr>
              <td>Temporary differences:</td><td></td><td></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;1.	Differences in depreciation expenses between commercial and fiscal</td><td><input type="text" name="jwb_4_7_1" id="jwb_4_7_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_7_2" id="jwb_4_7_2" value="0" class="input nomer" ></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;2.	Bad debt expense</td><td><input type="text" name="jwb_4_8_1" id="jwb_4_8_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_8_2" id="jwb_4_8_2" value="0" class="input nomer" ></td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;3.	Loss on decrease in value of inventory</td><td><input type="text" name="jwb_4_9_1" id="jwb_4_9_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_9_2" id="jwb_4_9_2" value="0" class="input nomer" ></td>
            </tr>
            <tr>
              <td>Total temporary differences</td><td><input type="text" name="jwb_4_10_1" id="jwb_4_10_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_10_2" id="jwb_4_10_2" value="0" class="input nomer" ></td>
            </tr>
            <tr>
              <td>&nbsp;</td><td></td><td></td>
            </tr>
            <tr>
              <td>Income before loss carry forward</td><td><input type="text" name="jwb_4_11_1" id="jwb_4_11_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_11_2" id="jwb_4_11_2" value="0" class="input nomer" ></td>
            </tr>
            <tr>
              <td>Less: loss carry forward</td><td><input type="text" name="jwb_4_12_1" id="jwb_4_12_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_12_2" id="jwb_4_12_2" value="0" class="input nomer" ></td>
            </tr>
            <tr>
              <td>Taxable income</td><td><input type="text" name="jwb_4_13_1" id="jwb_4_13_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_13_2" id="jwb_4_13_2" value="0" class="input nomer" ></td>
            </tr>
            <tr>
                <td>Taxable income (rounded)</td><td><input type="text" name="jwb_4_14_1" id="jwb_4_14_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_14_2" id="jwb_4_14_2" value="0" class="input nomer" ></td>
              </tr>
              <tr>
                <td>Income tax expense (25%)</td><td><input type="text" name="jwb_4_15_1" id="jwb_4_15_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_15_2" id="jwb_4_15_2" value="0" class="input nomer" ></td>
              </tr>
        </table>
        <br>
        <p>Jurnal:</p>
        <br>
        <table border="1" style="width: 100%">
            <tr style="text-align: center; font-weight: bold">
                <td></td><td>Dr</td><td>Cr</td>
            </tr>
            <tr>
              <td>Dr. Income tax expense</td><td><input type="text" name="jwb_4_16_1" id="jwb_4_16_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_16_2" id="jwb_4_16_2" value="0" class="input nomer" ></td>
          </tr>
          <tr>
            <td>Cr. Income tax payable</td><td><input type="text" name="jwb_4_17_1" id="jwb_4_17_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_4_17_2" id="jwb_4_17_2" value="0" class="input nomer" ></td>
          </tr>
        </table>

        <br>

    <p><strong>5.</strong>	Hitung Deferred tax asset (liability) per 31 Desember 2018</p>
      <br>   
      
      <table border="1" style="width: 100%">
          <tr style="text-align: center; font-weight: bold">
              <td></td><td>Commercial</td><td>Fiscal</td><td>Differences</td><td>DTA (DTL)</td>
          </tr>
          <tr>
            <td>NBV difference of fixed assets</td><td><input type="text" name="jwb_5_1_1" id="jwb_5_1_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_1_2" id="jwb_5_1_2" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_1_3" id="jwb_5_1_3" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_1_4" id="jwb_5_1_4" value="0" class="input nomer" ></td>
        </tr>
        <tr>
          <td>Accounts receivable, net</td><td><input type="text" name="jwb_5_2_1" id="jwb_5_2_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_2_2" id="jwb_5_2_2" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_2_3" id="jwb_5_2_3" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_2_4" id="jwb_5_2_4" value="0" class="input nomer" ></td>
        </tr>
        <tr>
            <td>Inventories, net</td><td><input type="text" name="jwb_5_3_1" id="jwb_5_3_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_3_2" id="jwb_5_3_2" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_3_3" id="jwb_5_3_3" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_3_4" id="jwb_5_3_4" value="0" class="input nomer" ></td>
          </tr>
          <tr>
              <td>Total DTA per 31 Dec 2018</td><td><input type="text" name="jwb_5_4_1" id="jwb_5_4_1" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_4_2" id="jwb_5_4_2" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_4_3" id="jwb_5_4_3" value="0" class="input nomer" ></td><td><input type="text" name="jwb_5_4_4" id="jwb_5_4_4" value="0" class="input nomer" ></td>
          </tr>
      </table>
      <br>

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