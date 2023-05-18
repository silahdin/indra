@extends('layouts.appcompro_test')

@section('content')

<div class="space-top"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span style="font-weight: bold;">
                      Position
                    </span> :
                    {{@$career->position}} - {{@$career->jobdesk_in}}
                </div>

                @if(\Session::has('error'))
                    <div class="alert alert-danger">
                    {{\Session::get('error')}}
                    </div>
                @endif

                <div class="card-body" style="padding: 30px;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('info') }}
                        </div>
                    @endif

                    <div class="row">

                            @if(count(@$modules ?? []) == 0)

                                <div class="col-sm-3">
                                    <div class="alert" role="alert">
                                    </div>
                                </div>

                                <div class="col-sm-6" style="text-align: center;">
                                    <div class="alert alert-primary" role="alert">
                                        <p>&nbsp;</p><p>&nbsp;</p>
                                        <h4>No Modules Available</h4> 
                                        <p>&nbsp;</p><p>&nbsp;</p>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="alert" role="alert">
                                    </div>
                                </div>

                            @else

                                @foreach(@$modules ?? [] as $module)

                                    <?php 

                                    $ongoing = DB::table('test_user_ongoings')->leftJoin('test_career_modules', 'test_career_modules.id', 'test_user_ongoings.module_career_id')
                                            ->where('test_career_modules.career_id', $career->id)
                                            ->where('test_career_modules.module_id', $module->id)
                                            ->where('test_user_ongoings.user_id', Auth::user()->id)
                                            ->select('test_user_ongoings.*', 'test_career_modules.career_id as career_id')
                                            ->whereNull('test_user_ongoings.deleted_at')
                                            ->first();
                                    ?>
 
                                    <div class="col-sm-4">
                                        <div class="alert alert-primary" role="alert">
                                            <h4 class="alert-heading">{{$module->name}}</h4>
                                            <hr class="my-4">
                                            <p class="lead">Duration :  {{$module->minutes}} Minutes</p>

                                            @if($ongoing->status == 2)
                                                <form style="float: " id="preview_form" action="{{ route('online.test.finished') }}" method="post" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="module_id" value="{{ Crypt::encrypt($module->id) }}">
                                                        <input type="hidden" name="career_id" value="{{ Crypt::encrypt($career->id) }}">

                                                    <button type="button" class="btn btn-success">Finished</button>

                                                    <button type="submit" class="btn btn-info">See Answers</button>
                                                </form>
                                            @else

                                                <form id="preview_form" action="{{ route('online.test.start') }}" method="post" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="module_id" value="{{ Crypt::encrypt($module->id) }}">
                                                        <input type="hidden" name="career_id" value="{{ Crypt::encrypt($career->id) }}">

                                                    <button type="submit" class="btn btn-{{ ($ongoing->status == 1) ? 'warning' : 'primary'}}">{{ ($ongoing->status == 1) ? 'Continue' : 'Proceed'}}</button>
                                                </form>

                                            @endif

                                           
                                        </div>
                                    </div>

                                @endforeach

                            @endif

                            

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="pull-right">
                                <button type="button" onclick="location.href='{{ route('admin.career.list') }}'" class="btn btn-warning">Back</button>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection