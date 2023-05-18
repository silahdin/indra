@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
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
  width: 70%;
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
.tab {
  display: none;
}

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
</style>

<script>
    $(document).ready(function(){
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $("#nextBtn").click(function(){
          $.ajax({
              /* the route pointing to the post function */
              url: '{{route('wizard.post')}}',
              type: 'POST',
              /* send the csrf-token and the input to the controller */
              data: {_token: CSRF_TOKEN, message:$(".getinfo").val()},
              dataType: 'JSON',
              /* remind that 'data' is the response of the AjaxController */
              success: function (data) { 
                  $(".writeinfo").append(data.msg); 
              }
          }); 
      });
 });   
</script>
<body>

<form id="regForm" action="/action_page.php">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>Personal Information</h1>
    <hr>
    <div class="row">
        <div class="col-sm-6">
                <label for="sel1">Nama Lengkap/ Full Name</label>
                <input placeholder="Nama Lengkap/ Full Name" oninput="this.className = ''" name="full_name" id="full_name">
        </div>
        <div class="col-sm-6">
                <label for="sel1">Posisi/Job Position</label>
                <input placeholder="Posisi/Job Position" oninput="this.className = ''" name="job_position" id="job_position">
                <br><br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Jenis Kelamin/ Gender</label>
                <select class="form-control" id="gender" onselect="this.className = ''" name="gender">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Status/ Marital Status</label>
                <select class="form-control" id="marital_status" onselect="this.className = ''" name="marital_status">
                    <option value="Menikah">Menikah</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                </select>
                <br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Agama/ Religion</label>
                <select class="form-control" id="religion" onselect="this.className = ''" name="religion">
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                </select>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Alamat/ Address</label>
                <input placeholder="Alamat/ Address" oninput="this.className = ''" name="address" id="address">
                <br><br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Tempat / Place</label>
                <input placeholder="Tempat / Place" oninput="this.className = ''" name="place_birth" id="place_birth">
        </div>
        <div class="col-sm-6">
                <label for="sel1">Tanggal Lahir/ Date of Birth</label>
                <input placeholder="Tanggal Lahir/ Date of Birth" oninput="this.className = ''" name="date_birth" id="date_birth">
                <br><br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Kesiapan bekerja/ Date of Availability</label>
                <input placeholder="Kesiapan bekerja/ Date of Availability" oninput="this.className = ''" name="date_availability" id="date_availability">
                <br><br>
        </div>
        <div class="col-sm-6">
                &nbsp;
                <br>
        </div>
        <div class="col-sm-4">
                <label for="sel1">Kontak Informasi/ Contact Information</label>
                <input placeholder="Rumah/ Home" oninput="this.className = ''" name="contact_home" id="contact_home">
        </div>
        <div class="col-sm-4">
                <label for="sel1">Kontak Informasi/ Contact Information</label>
                <input placeholder="Ponsel/ Cellular" oninput="this.className = ''" name="contact_cellular" id="contact_cellular">
        </div>
        <div class="col-sm-4">
                <label for="sel1">Kontak Informasi/ Contact Information</label>
                <input placeholder="Kotak Surat/ Email" oninput="this.className = ''" name="contact_email" id="contact_email">
                <br><br>
        </div>
    </div>
    <br><br>
  </div>
  <div class="tab">
    <h1>Work Experience</h1>
    <hr>
    <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
    <p><input placeholder="Phone..." oninput="this.className = ''" name="phone"></p>
  </div>
  <div class="tab">
    <h1>Education History</h1>
    <hr>
    <p><input placeholder="dd" oninput="this.className = ''" name="dd"></p>
    <p><input placeholder="mm" oninput="this.className = ''" name="nn"></p>
    <p><input placeholder="yyyy" oninput="this.className = ''" name="yyyy"></p>
  </div>
  <div class="tab">
    <h1>Summary</h1>
    <hr>
    <p><input placeholder="Username..." oninput="this.className = ''" name="uname"></p>
    <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>

<div class="writeinfo"></div>   

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

@endsection
