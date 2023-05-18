@extends('layouts.applte')

@section('content')
<?php 
function convert_date_user($date){
    $old_date_timestamp = strtotime($date);
    return date('d-m-Y H:i:s', $old_date_timestamp); 
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
          <h1>
            &nbsp;
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('training')}}">Peserta Training</a></li>
            <!-- <li class="active">Data Peserta</li> -->
            <li class="active">Detail Peserta</li>
          </ol>
        </section>

    <?php  
// print_r($post);
?>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Detail Peserta Training</h3>
            </div>

                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="title_in">Nama :</label>
                        <div class="form-control">
                            {{ $post->name }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title_in">Tanggal Lahir :</label>
                        <div class="form-control">
                            {{ $post->birth }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="title_in">Kelamin :</label>
                        <div class="form-control">
                            {{ $post->gender }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="title_in">Email :</label>
                        <div class="form-control">
                            {{ $post->email	 }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="title_in">Mobile phone :</label>
                        <div class="form-control">
                            {{ $post->mobile }}
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="title_in">no. KTP :</label>
                        <div class="form-control">
                            {{ $post->ktp }}
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <label for="title_in">Occupation :</label>
                        <div class="form-control">
                            {{ $post->occupation }}
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <label for="title_in">Institusi :</label>
                        <div class="form-control">
                            {{ $post->institution }}
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                        <label for="title_in">Edukasi :</label>
                        <div class="form-control">
                            {{ $post->education }}
                        </div>
                    </div>                                        

                    <div class="form-group">
                        <label for="title_in">Training :</label>
                        <div class="form-control">
                            {{ $post->title_in }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="title_in">Kelas :</label>
                        <div class="form-control">
                            {{ $post->class_name_in }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="title_in">Jadwal :</label>
                        <div class="form-control">
                            {{ $post->day_in }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title_in">Biaya Kelas :</label>
                        <div class="form-control">
                            {{ number_format($post->cost_price) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title_in">Biaya Daftar :</label>
                        <div class="form-control">
                            {{ number_format($post->cost_regis) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title_in">Biaya Total :</label>
                        <div class="form-control">
                            {{ number_format($post->cost_total) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title_in">Status :</label>
                        <div class="">
                            @if($post->rowstate==1)
                              <span class="label label-primary" style="font-size: 14px">Active</span>
                            @elseif($post->rowstate==2)
                              <span class="label label-danger" style="font-size: 14px">Not Active</span>
                            @elseif($post->rowstate==3)
                              <span class="label label-warning" style="font-size: 14px">Waiting</span>
                            @elseif($post->rowstate==4)
                              <span class="label label-success" style="font-size: 14px">Registered</span>
                            @endif  
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title_in">Dibuat tanggal :</label>
                        <div class="form-control">
                            {{ convert_date_user($post->created_at) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title_in">Terakhir diupdate tanggal :</label>
                        <div class="form-control">
                            {{ convert_date_user($post->updated_at) }}
                        </div>
                    </div>                    


                </div>

                <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('register') }}'">Kembali</button>
                </div>

            </div>

    </section>
</div>
@endsection