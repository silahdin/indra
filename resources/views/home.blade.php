@extends('layouts.applte')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('main.dashboard_head')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @lang('main.dashboard_login_status')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
