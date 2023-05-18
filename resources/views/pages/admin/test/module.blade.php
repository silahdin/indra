@extends('layouts.appcompro_test')

@section('content')

<div class="space-top"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Position {{@$career->position}} - {{@$career->jobdesk_in}}
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
 
                                    <div class="col-sm-4">
                                        <div class="alert alert-primary" role="alert">
                                                <h4 class="alert-heading">{{$module->name}}</h4>
                                                <hr class="my-4">
                                                <p class="lead">Duration :  {{$module->minutes}} Minutes</p>

                                               <form id="preview_form" action="{{ route('module.preview.post') }}" method="post" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="module_id" value="{{ Crypt::encrypt($module->id) }}">
                                                    <button type="submit" class="btn btn-primary">Proceed</button>
                                                </form>
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