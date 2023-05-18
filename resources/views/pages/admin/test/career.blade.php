@extends('layouts.appcompro_test')

@section('content')

<?php use Illuminate\Support\Facades\Crypt; ?>

<div class="space-top"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="border: 0px;">
                

                <div class="row">
                    <div class="col-sm-12 text-center">
                            <p>
                                    Welcome to Reanda Bernardi Career Website!<br>
                                    You are one step ahead to your new adventure.<br>
                                    You can start from anywhere but you have to finish all your tasks before you click "finish"<br>
                                    Ready?  
                                    <br>
                                    <br>
                                    <strong>Guidance: </strong><br>
                                    1. For the best experience, do the test using your laptop or PC.<br>
                                    2. Find a quiet place with less interuptions from anything or anyone.<br>
                                    3. Manage your time. You must finish every session within the set time limit. Otherwise, the system will not save your answer. Hence, you will be deemed to have failed the test. <br>
                                    4.  Stay calm and don’t be nervous. Take meals before the test, bring a calculator next to you, and pray before you do the test.<br>
                                    <hr>
                            </p>
                    </div>

                    <div class="col-sm-12 text-center" style="display: none;">
                        <br>
                        <a style="padding: 10px 20px 10px 20px; font-size: 1rem" class="btn btn-md btn-success" href="{{ route('compro.career') }}" target="_blank">ADD CAREER</a>
                        <br>
                    </div>

                    
                        @foreach(@$listjobs ?? [] as $listjob)

                            <?php 
                            $twaktus = DB::table('test_modules')
                                ->leftJoin('test_career_modules', 'test_career_modules.module_id', '=', 'test_modules.id')
                                ->where('test_career_modules.career_id', $listjob->id)
                                ->whereNull('test_career_modules.deleted_at')
                                ->sum('minutes')
                            ?>
                        
                            <div class="col-sm-3">
                                <div class="alert alert-primary" role="alert">
                                        <h5 class="" style="font-size: 17px; font-weight: bold">{{$listjob->position}}</h5>
                                        <h3 class="" style="font-size: 14px; font-weight: bold; color: black">{{$listjob->jobdesk_in}}</h3>
                                        <hr class="my-4">
                                        <p class="" style="font-size: 14px">Duration :  {{$twaktus}} Minutes</p>

                                        <a href="{{ route('admin.module.list', ['career_id' => Crypt::encrypt($listjob->id)]) }}" class="btn btn-primary">Proceed</a>
                                        
                                </div>
                            </div>
                        @endforeach

                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')

<style type="text/css">

.question{
    width: auto !important;
    float: left !important;
}

.group-table td, .group-table th {
    padding: .75rem;
    vertical-align: top;
}

</style>

@endpush

@push('scripts')

<script>
$(document).ready(function(){
    //Date picker
    $('.tanggal').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
})

$(document).ready(function() {
    $(window).keydown(function(event){
        if((event.keyCode == 13) && ($(event.target)[0]!=$("textarea")[0])) {
            event.preventDefault();
            return false;
        }
    });
});


</script>

@endpush