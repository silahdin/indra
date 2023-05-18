@extends('layouts.applte')
<?php
  $results = DB::select('select * from bank_question where category like "english%"');
  $options = DB::select('select a,b,c,d from bank_question where category like "english%"');
  // $ans = DB::select('select key from bank_question where category like "english%"');

  $results_tech = DB::select('select * from bank_question where category like "tech%"');
  $options_tech = DB::select('select a,b,c,d from bank_question where category like "tech%"');
  // $ans_tech = DB::select('select key from bank_question where category like "tech%"');

  $results_tax = DB::select('select * from bank_question where category like "tax%"');
  $options_tax = DB::select('select a,b,c,d from bank_question where category like "tax%"');
  // $ans_tax = DB::select('select key from bank_question where category like "tax%"');
  // var_dump($results);

?>

<style>
  .update{
    display: inline;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $('.eng').click(function(){
      $('.eng-ques').toggleClass('hidden');
    });
    $('.tech').click(function(){
      $('.tech-ques').toggleClass('hidden');
    })
    $('.tax').click(function(){
      $('.tax-ques').toggleClass('hidden');
    })

    $('.edit').click(function(){
      $(this).parent().addClass('hidden');
      $(this).parent().next().removeClass('hidden');
      $(this).parent().next().next().removeClass('hidden');
    })


    //update function
    
  });
</script>

@section('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('result.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Forms</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View Forms</h3>
              <ul class="forms-headers" style="list-style:none; padding: 5px; font-size: 20px; margin-top: 3px;">
              <li class="eng"><i class="fa fa-language"></i> English </a></li>
              <div class="box-header with-header hidden eng-ques" style="font-size: 14px;">
                <?php
                  
                  foreach($results as $ques){
                    // var_dump($ques->{"question"});

                    echo"<p class='new'> ADD A NEW QUESTION </p>";
                    echo "<p class='q'>".$ques->{'question'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo '<textarea class="textfield hidden"  rows="2" cols= "100">'.$ques->{'question'}.'</textarea>'.'<form class="update hidden" method="POST" action="/update"><input type="submit" name="submit" style="float:right;"> </input></form></p>';
                   
                    echo "<p class='o1'> Option 1 = ".$ques->{'a'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'a'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                    echo "<p class='o2'> Option 2 = ".$ques->{'b'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'b'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                    echo "<p class='o3'> Option 3 = ".$ques->{'c'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'c'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                    echo "<p class='o4'> Option 4 = ".$ques->{'d'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'d'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";

                    echo "<p class='a'> Answer = ".$ques->{'key'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'key'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                  }
                  // foreach($ans as $e_ans){
                  //   // var_dump($e_ans);
                  // }
                ?>
              </div>
              <li class="tech"><i class="fa fa-support"></i> Technical</a></li>
              <div class="box-header with-header hidden tech-ques" style="font-size: 14px;">
                <?php
                  
                  foreach($results_tech as $ques){
                    // var_dump($ques->{"question"});
                    echo"<p class='new'> ADD A NEW QUESTION </p>";
                    echo "<p class='q'>".$ques->{'question'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'question'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                   
                    echo "<p class='o1'> Option 1 = ".$ques->{'a'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'a'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                    echo "<p class='o2'> Option 2 = ".$ques->{'b'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'b'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                    echo "<p class='o3'> Option 3 = ".$ques->{'c'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'c'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                    echo "<p class='o4'> Option 4 = ".$ques->{'d'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'d'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";

                    echo "<p class='a'> Answer = ".$ques->{'key'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'key'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                  }
                ?>
              </div>
              <li class="tax"><i class="fa fa-calculator"></i> Tax </a></li>
              <div class="box-header with-header hidden tax-ques" style="font-size: 14px;">
                <?php
                  
                  foreach($results_tax as $ques){
                    // var_dump($ques->{"question"});
                    echo"<p class='new'> ADD A NEW QUESTION </p>";
                    echo "<p class='q'>".$ques->{'question'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'question'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                   
                    echo "<p class='o1'> Option 1 = ".$ques->{'a'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'a'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                    echo "<p class='o2'> Option 2 = ".$ques->{'b'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'b'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                    echo "<p class='o3'> Option 3 = ".$ques->{'c'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'c'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                    echo "<p class='o4'> Option 4 = ".$ques->{'d'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'d'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";

                    echo "<p class='a'> Answer = ".$ques->{'key'}." <button class='edit' style='float:right;'>Edit</button></p>";
                    echo "<textarea class='textfield hidden'  rows='2' cols= '100'>".$ques->{'key'}."</textarea>"."<form class='update hidden' method='POST'  action='/update'> <input type='submit' name='submit' style='float:right;'> </input></form></p>";
                  }
                ?>
              </div>
              </ul>   
            </div>
            <br>
            <!-- /.box-body -->
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
