@extends('layouts.appcompro')

@section('content')
<div class="space-top"></div>
    <section class="section-contactUs">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <br><br>
                </div>
            </div>
        </div>
    </section>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="cards">

                @if(\Session::has('error'))
                    <div class="alert alert-danger">
                    {{\Session::get('error')}}
                    </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    

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


                                @if (session('info'))
                                    <div class="alert alert-warning" role="alert">
                                        {{ session('info') }}
                                    </div>
                                @endif
                        </div>

                        @if(count(@$listjobs ?? []) == 0)
                            <div class="col-sm-12 text-center">
                                <br>
                                <h6 style="color:#066360;">You don't have any Career right now, please add some careers to go on test.</h6>
                                <a style="margin-top: 10px; padding: 10px 30px 10px 30px; font-size: 0.9rem" class="btn btn-md btn-success" href="{{ route('compro.career') }}">Add Career</a>
                                <br>
                            </div>
                        @endif


                        @foreach(@$listjobs ?? [] as $listjob)

                            <?php 

                            $twaktus = DB::table('test_modules')
                                ->join('test_career_modules', 'test_career_modules.module_id', '=', 'test_modules.id')
                                ->whereNull('test_career_modules.deleted_at')
                                ->whereNull('test_modules.deleted_at')
                                ->where('test_career_modules.career_id', $listjob->id)
                                ->sum('test_modules.minutes');

                            $ongoing = DB::table('test_user_ongoings')->leftJoin('test_career_modules', 'test_career_modules.id', 'test_user_ongoings.module_career_id')
                                    ->where('test_user_ongoings.status', '!=', 2)
                                    ->where('test_user_ongoings.user_id', Auth::user()->id)
                                    ->select('test_user_ongoings.*', 'test_career_modules.career_id as career_id')
                                    ->whereNull('test_user_ongoings.deleted_at')
                                    ->first();
                            ?>
                        
                            <div class="col-sm-3">
                                <div class="alert alert-primary" role="alert">
                                        <h5 class="" style="font-size: 17px; font-weight: bold">{{$listjob->position}}</h5>
                                        <h3 class="" style="font-size: 14px; font-weight: bold; color: black">{{$listjob->jobdesk_in}}</h3>
                                        <hr class="my-4">
                                        <p class="" style="font-size: 14px">Duration :  {{$twaktus}} Minutes</p>

                                        @if(\Carbon\Carbon::now()->format('Y-m-d') > $listjob->date_end)
                                            <a href="javascript:void(0);" class="btn btn-danger">Locked</a>
                                        @else

                                            <?php
                                                $finished = true;
                                                $ongoing_finish = DB::table('test_user_ongoings')->join('test_career_modules', 'test_career_modules.id', 'test_user_ongoings.module_career_id')
                                                    ->where('test_user_ongoings.user_id', Auth::user()->id)
                                                    ->where('test_career_modules.career_id', $listjob->id)
                                                    ->whereNull('test_user_ongoings.deleted_at')
                                                    ->whereNull('test_career_modules.deleted_at')
                                                    ->select('test_user_ongoings.*', 'test_career_modules.career_id as career_id')
                                                    ->get(); 

                                                if($ongoing_finish->count() > 0){
                                                    foreach ($ongoing_finish as $finish) {
                                                        if($finish->status < 2){
                                                            $finished = false;
                                                            break;
                                                        }
                                                    }
                                                }else{
                                                    $finished = false;
                                                } 
                                                
                                            ?>

                                            @if(!$finished)
                                                <a href="{{ route('hometest', ['id' => Crypt::encrypt($listjob->id)]) }}" class="btn btn-{{ (@$ongoing->career_id == @$listjob->id) ? 'warning' : 'primary' }}">{{ (@$ongoing->career_id == @$listjob->id) ? 'Continue' : 'Proceed' }}</a>
                                            @else

                                                <button type="button" class="btn btn-success">Finished</button>

                                                <a href="{{ route('hometest', ['id' => Crypt::encrypt($listjob->id)]) }}" class="btn btn-info">See Answers</a>
                                            @endif

                                        @endif
                                        
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
    <br>
    <section class="about flex-box" style="background-color:#8c9090;text-align:center;color:wheat">
        <div class="container" style="">
            <div style="margin-top:15px">
                <span>FOLLOW US</span>
            </div>
            <div style="font-size:xx-large">
                <a href="https://www.linkedin.com/company/reandabernardi/" style="color:wheat"><span class="fa fa-linkedin"></span></a>
            </div>
        </div>
    </section>
@endsection
