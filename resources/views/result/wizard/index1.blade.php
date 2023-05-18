@extends('layouts.appresult')

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


<body>

<form id="regForm" action="">
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <h1>Personal Information</h1>
    <hr>
    <div class="row">
        <div class="col-sm-6">
                <label for="sel1">Full Name</label>
                <input placeholder="Full Name" oninput="this.className = ''" name="full_name" id="full_name">
        </div>
        <div class="col-sm-6">
                <label for="sel1">Job Position</label>
                <input placeholder="Job Position" oninput="this.className = ''" name="job_position" id="job_position">
                <br><br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Gender</label>
                <select class="form-control" id="gender" onselect="this.className = ''" name="gender">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Marital Status</label>
                <select class="form-control" id="marital_status" onselect="this.className = ''" name="marital_status">
                    <option value="Menikah">Menikah</option>
                    <option value="Belum Menikah">Belum Menikah</option>
                </select>
                <br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Religion</label>
                <select class="form-control" id="religion" onselect="this.className = ''" name="religion">
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                </select>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Address</label>
                <input placeholder="Address" oninput="this.className = ''" name="address" id="address">
                <br><br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Place of Birth</label>
                <input placeholder="Place of Birth" oninput="this.className = ''" name="place_birth" id="place_birth">
        </div>
        <div class="col-sm-6">
                <label for="sel1">Date of Birth</label>
                <input placeholder="Date of Birth" oninput="this.className = ''" name="date_birth" id="date_birth">
                <br><br>
        </div>
        <div class="col-sm-6">
                <label for="sel1">Date of Availability</label>
                <input placeholder="Date of Availability" oninput="this.className = ''" name="date_availability" id="date_availability">
                <br><br>
        </div>
        <div class="col-sm-6">
                &nbsp;
                <br>
        </div>
        <div class="col-sm-4">
                <label for="sel1">Contact Information</label>
                <input placeholder="Home" oninput="this.className = ''" name="contact_home" id="contact_home">
        </div>
        <div class="col-sm-4">
                <label for="sel1">Contact Information</label>
                <input placeholder="Cellular" oninput="this.className = ''" name="contact_cellular" id="contact_cellular">
        </div>
        <div class="col-sm-4">
                <label for="sel1">Contact Information</label>
                <input placeholder="Email" oninput="this.className = ''" name="contact_email" id="contact_email">
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

@endsection
