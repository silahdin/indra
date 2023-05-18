

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<!-- bootstrap datepicker -->
<script src="{{ asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
<body>

<form id="regForm" action="" method="POST">
    
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
        ->where('users_id', $iduser)
        ->where('id_bankessay', $dsoal->id_bankessay)
        ->first();
        ?>
        <div class="col-sm-12">
                <label for="sel1"><?=$no++?>. {{$dsoal->question}}</label>
                <br>
               @if($djwb->answer) {{$djwb->answer}} @endif
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


