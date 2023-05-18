@extends('layouts.applte')
<?php

    if(isset($_GET['submit'])){
       $pos = $_GET['position']; 
       $lev = $_GET['level'];
       $req = $_GET['req'];
       $sd = $_GET['sd'];
       $ed = $_GET['ed'];
       $loc = $_GET['loc'];
       $rdet = $_GET['rdet'];
       $resp = $_GET['resp'];
       $skill = $_GET['skill'];

       DB::insert('insert into cms_career (position, jobdesk_en, requirement_en, location, date_start, date_end, detRole_en, detRespon_en, detSkill_en, created_at ) values (?, ?,?,?,?,?,?,?,?,?)', [$pos,$lev,$req,$loc,$sd,$ed,$rdet,$resp,$skill,now()]);
    }
    // $pos = $_GET['position'];
    // echo $pos;
    

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#newQues').click(function() {
            $(this).after('<br><div class="temp"><div class="form-group qq"><label for="ques">Question : </label><textarea class="form-control" id="ques" placeholder="Add question" rows="4"></textarea></div></div>');
            $('.qq').after('<br><div class="form-group op1"><label for="op1">Option 1: </label><input class="form-control" id="op1" placeholder="Option 1"></div>');
            $('.op1').after('<br><div class="form-group op2"><label for="op2">Option 2: </label><input class="form-control" id="op2" placeholder="Option 2"></div>');
            $('.op2').after('<br><div class="form-group op3"><label for="op3">Option 3: </label><input class="form-control" id="op3" placeholder="Option 3"></div>');
            $('.op3').after('<br><div class="form-group op4"><label for="op4">Option 4: </label><input class="form-control" id="op4" placeholder="Option 4"></div>');
            $('.op4').after('<br><button onclick=ok() class="btn btn-primary ok" type="button" > OK </button>');
        });


    });

    function ok() {
        var ok = $('body').find('.ok');
        var question = $('#ques').val();
        var op1 = $('#op1').val();
        var op2 = $('#op2').val();
        var op3 = $('#op3').val();
        var op4 = $('#op4').val();


        $('.entry').after("<div class='question-block'><p class='fques'><b>Question : " + question + "</b></p><div class='form-check'><input class='form-check-input' type='radio' name='opt1' value='a'><label class='form-check-label' for='opt1'> " + op1 + "</label></div><div class='form-check'><input class='form-check-input' type='radio' name='opt2' value='b'><label class='form-check-label' for='opt2'> " + op2 + "</label></div><div class='form-check'><input class='form-check-input' type='radio' name='opt3' value='c'><label class='form-check-label' for='opt3'> " + op3 + "</label></div><div class='form-check'><input class='form-check-input' type='radio' name='opt4' value='d'><label class='form-check-label' for='opt4'> " + op4 + "</label></div></div>");
        $('.temp').remove();
    }

    $('#jobSub').click(function() {
        alert('yo');
    })

    function v() {
        alert("asdad");
    }
</script>
<style>
    .question-block {
        border: 1px solid black;
        padding: 3px;
    }
</style>
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            &nbsp;
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('result.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Jobs</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add a new job</h3>

            </div>
            <div class="box-body">



                <form method="GET" onsubmit="up()" action="jobs">
                    <div class="form-group">
                        <label for="position">Job Position</label>
                        <input type="text" name="position" class="form-control" id="position" aria-describedby="jobPos" placeholder="Enter job Position">
                        <small id="jobPos" class="form-text text-muted">The title for the job goes here</small>
                    </div>
                    <div class="form-group">
                        <label for="level">Job Level</label>
                        <input type="text" name="level" class="form-control" id="level" aria-describedby="lev" placeholder="Enter level">
                        <small id="lev" class="form-text text-muted">Level : ex Manager Level etc</small>
                    </div>
                    <div class="form-group">
                        <label for="requirement">Requirements</label>
                        <textarea class="form-control" name="req" id="requirement" aria-describedby="req" placeholder="Enter any requirements" rows="4"></textarea>
                        <small id="lev" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="start">Starting Date</label>
                        <input type="date" name="sd" class="form-control" id="start" aria-describedby="sDate" placeholder="Starting date">
                        <small id="sDate" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="end">Ending Date</label>
                        <input type="date" name="ed" class="form-control" id="end" aria-describedby="eDate" placeholder="Ending date">
                        <small id="eDate" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="loc" class="form-control" id="location" aria-describedby="loc" placeholder="Location">
                        <small id="loc" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="role">Role Details</label>
                        <textarea name="rdet" class="form-control" id="role" aria-describedby="jobRole" placeholder="Details about the role of the applicant" rows="4"></textarea>
                        <small id="jobRole" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="resp">Responsibilities</label>
                        <textarea name="resp" class="form-control" id="resp" aria-describedby="jobRes" placeholder="Responsibility of the applicant" rows="4"></textarea>
                        <small id="jobRes" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="qual">Skills/Qualifications</label>
                        <textarea class="form-control" name="skill" id="qual" aria-describedby="jobQual" placeholder="Qualifications / Skills required" rows="4"></textarea>
                        <small id="jobQual" class="form-text text-muted"></small>
                    </div>
                    <div class="paper">
                        <div class="form-group entry">
                            <label for="test">Create the technical test</label>
                        </div>

                    </div>
                    <button type="button" id="newQues" class="btn btn-primary"> Add a Question </button>
                    </br>
                    </br>
                    </br>
                    <button id="jobSub" type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>




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