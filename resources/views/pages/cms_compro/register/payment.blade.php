@extends('layouts.applte')

@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

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
            <li class="active">Payment Peserta</li>
          </ol>
        </section>

<style>
.payment-box{
    background: gray;
    min-height: 257px;
    height: 200px;
    width: 50%;
    padding: 10px;
    overflow: hidden;
    overflow-y: scroll;
}
.flexing{
    display: flex;
    justify-content: space-between;
    background: beige;
    padding: 10px;
    margin-bottom: 10px;
}
.total{
    display: flex;
    justify-content: space-between;
    padding: 10px;
    padding-right: 17px;
    background: blue;
    width: 50%;
    color: white;
    font-size: 19px;
    text-align: right;
}
</style>

    <?php  
// print_r($post);
?>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pembayaran Peserta Training</h3>
            </div>
            <form action="{{ route('register.paymentDo', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="payment-box">
                                <?php foreach ($data as $key => $value)  { ?>
                                    
                                <div class="flexing">
                                    <span>{{convert_date_user($value->created_at)}}</span>
                                    <span>Rp. {{ number_format($value->pay)}}</span>
                                </div>                                                                                                                                                                                                 
                                <?php  } ?>
                            </div>
                            <div class="total">
                                <span>Rp. </span>
                                @if ($post->payment==null)
                                    <span>0</span>
                                @else
                                    <span>{{number_format($post->payment)}}</span>

                                @endif
                            </div>
                            <br>
                            <input type="text" name="payment" class="money">
                            <button type="submit">Tambah</button>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('register') }}'">Kembali</button>
                </div>
            </form>
        </div>

    </section>
</div>
<script type="text/javascript">
    $('.money').maskMoney({ prefix: 'Rp. ', thousands: ',', decimal: '.', precision: 0 });
    $('.number').maskMoney({ suffix: ' jam', prefix: '', thousands: ',', decimal: '.', precision: 0 });
    $('.decimal').maskMoney({ prefix: '', thousands: ',', decimal: '.', allowZero: true });
</script>
@endsection