@extends('layouts.appcompro')

@section('content')

<?php 
$ljob = DB::table('cms_career')
->select('cms_career.id', 'cms_career.position', 'cms_career.jobdesk_in')
->where('cms_career.id', Crypt::decryptString($id))
->first()
?>
<?php 
$cjobs = DB::table('tbl_list_test_job')
->leftJoin('tbl_test', 'tbl_test.id_test', '=', 'tbl_list_test_job.id_test')
->where('tbl_list_test_job.id_career', Crypt::decryptString($id))
->count();

$listjobs = DB::table('tbl_list_test_job')
->select('tbl_list_test_job.id_test', 'tbl_test.name', 'tbl_test.minutes')
->leftJoin('tbl_test', 'tbl_test.id_test', '=', 'tbl_list_test_job.id_test')
->where('tbl_list_test_job.id_career', Crypt::decryptString($id))
->get();

$gjwb = DB::table('tbl_test_user')
->where('id_career', Crypt::decryptString($id))
->where('users_id', Auth::user()->id)
->where('st_test', 1)
->count();

$twaktus = DB::table('tbl_list_test_job')
->leftJoin('tbl_test', 'tbl_test.id_test', '=', 'tbl_list_test_job.id_test')
->where('id_career', Crypt::decryptString($id))
->sum('minutes');

$pwaktu = $twaktus + 15;
$current = \Carbon\Carbon::now();
$targetwaktu = \Carbon\Carbon::now()->addMinutes($pwaktu);

//Insert / Update Waktu Mulai dan Target Selesai
$cekwaktu = DB::table('tbl_test_user_target')
->select('target')
->where('id_career', Crypt::decryptString($id))
->where('users_id', Auth::user()->id)
->first();
if(isset($cekwaktu) && $cekwaktu->target == "") {
    //jika sudah ada datanya edit datanya
    DB::table('tbl_test_user_target')->where('users_id', Auth::user()->id)->where('id_career', Crypt::decryptString($id))->update(['start' => $current, 'target' => $targetwaktu]);
} else {
    //jika belum ada datanya tambahkan datanya
    //DB::table('tbl_test_user_target')->insert(array ('users_id' => Auth::user()->id, 'id_career' => Crypt::decryptString($id), 'start' => $current, 'target' => $targetwaktu) );
}
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Position {{$ljob->position}} - {{$ljob->jobdesk_in}}
                </div>

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

                            @foreach($listjobs as $dtest)
                            <?php 
                            $ljobt = DB::table('tbl_test_user')
                            ->select('id_test_user', 'st_test')
                            ->where('id_test', $dtest->id_test)
                            ->where('users_id', Auth::user()->id)
                            ->where('id_career', $ljob->id)
                            ->first()
                            ?>
                            <div class="col-sm-4">
                                <div class="alert alert-primary" role="alert">
                                        <h4 class="alert-heading">{{$dtest->name}}</h4>
                                        <hr class="my-4">
                                        <p class="lead">Duration :  {{$dtest->minutes}} Minutes</p>
                                        @if(isset($ljobt->st_test) && $ljobt->st_test==1)
                                        <a href="#" class="btn btn-danger">Locked</a>
                                        @else 
                                            @if($dtest->id_test==1)
                                                <a href="{{route('home_action', ['halaman' => 'personalinformation', 'idjob' => Crypt::decryptString($id)])}}" class="btn btn-primary">Proceed</a>
                                            @elseif($dtest->id_test==2)
                                                <a href="{{route('home_action', ['halaman' => 'english', 'idjob' => Crypt::decryptString($id)])}}" class="btn btn-primary">Proceed</a>
                                            @elseif($dtest->id_test==5)
                                                <a href="{{route('home_action', ['halaman' => 'health', 'idjob' => Crypt::decryptString($id)])}}" class="btn btn-primary">Proceed</a>
                                            @elseif($dtest->id_test==3)
                                                <a href="{{route('home_action', ['halaman' => 'technical', 'idjob' => Crypt::decryptString($id)])}}" class="btn btn-primary">Proceed</a>
                                            @elseif($dtest->id_test==4)
                                                <a href="{{route('home_action', ['halaman' => 'personality_test', 'idjob' => Crypt::decryptString($id)])}}" class="btn btn-primary">Proceed</a>
                                            @elseif($dtest->id_test==6)
                                                <a href="{{route('home_action', ['halaman' => 'technical_set3', 'idjob' => Crypt::decryptString($id)])}}" class="btn btn-primary">Proceed</a>
                                            @elseif($dtest->id_test==7)
                                                <a href="{{route('home_action', ['halaman' => 'tax_test', 'idjob' => Crypt::decryptString($id)])}}" class="btn btn-primary">Proceed</a>
                                            @elseif($dtest->id_test==8)
                                                <a href="{{route('home_action', ['halaman' => 'technical_set4', 'idjob' => Crypt::decryptString($id)])}}" class="btn btn-primary">Proceed</a>
                                            @else
                                                <a href="#" class="btn btn-warning">Not Available</a>
                                            @endif
                                        @endif
                                </div>
                            </div>
                            @endforeach

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="pull-right">
                                <button type="button" onclick="location.href='{{route('home')}}'" class="btn btn-warning">Back</button>
                                @if($gjwb==$cjobs)
                                <button type="button" onclick="location.href='{{route('submitjob', ['idjob' => Crypt::decryptString($id)])}}'" class="btn btn-success">Submit And Send Notification</button>
                                @else 
                                <button type="button" class="btn btn-success" disabled>Submit And Send Notification</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection