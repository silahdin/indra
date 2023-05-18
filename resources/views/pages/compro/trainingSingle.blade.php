@extends('layouts.appcompro')

@section('content')
<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/image/free.jpg');
?>

<div class="section-one text-center margin-right-0" style="background-image: url('{{$imgBanner}}');">
    <!-- <div class="wrapper-color"></div> -->
    <div class="container container-content">
        <div class="row ">
            <div class="col-sm-12 color-white">
                <div class="content-section-one">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <!-- <h2 class="h2-opening">Halaman Program</h2> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-training last-section list-schedule ">
    <div class="container container-content">
        <div class="row margin-right-0">
            <div class="col-sm-12">
                <hr>
                @if ( Session::get('langIN') != NULL )
                    <h1>{{$content->title_in}}</h1>
                    <p>Pilih kelas terbaikmu dan jadwal yang sesuai</p>
                    <div class="table">
                        <div class="row-res header">
                            <div class="cell">
                                
                            </div>
                            <div class="cell">
                                Kelas
                            </div>
                            <div class="cell">
                                Waktu
                            </div>
                            <div class="cell">
                                Harga
                            </div>
                            <div class="cell">
                                Pilih
                            </div>
                        </div>
                @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                    <h1>{{$content->title_en}}</h1>
                    <p>Choose your best class & schedule</p>
                    <div class="table">
                        <div class="row-res header">
                            <div class="cell">

                            </div>
                            <div class="cell  tc-name">
                                Class
                            </div>
                            <div class="cell">
                                Duration
                            </div>
                            <div class="cell">
                                Price
                            </div>
                            <div class="cell">
                                Choose
                            </div>
                        </div>
                @endif



                <?php
                $no = 1;
                foreach ($schedule as $pos) {
                    if ($no % 2 == 0 ){ ?>
                        <div class="group even">
                    <?php
                    } else { ?>
                        <div class="group">
                        <?php
                    } ?>
                            @if ( Session::get('langIN') != NULL )
                                <div class="row-res table-row">
                                    <div class="cell" data-title="">
                                        <img src="{{ asset($pos->img) }}">
                                    </div>
                                    <div class="cell tc-name" data-title="Class Name" style="vertical-align:middle">
                                        <p class="name-training">{{$pos->class_name_in}}</p>
                                    </div>
                                    <div class="cell tc-info" data-title="Info">
                                        {{$pos->duration}} Jam
                                    </div>
                                    <div class="cell tc-name" data-title="Price">
                                        <div style="width:80%; padding-right:55px">
                                            <span style="float:left">Rp.</span> <span  style="float:right">{{number_format($pos->price)}} </span>

                                        </div>
                                    </div>
                                    <div class="cell" data-title="">
                                        <button class="btn btn-success register-train-{{$pos->id}}" style="width:90%; margin-bottom:10px">
                                            Daftar </button>
                                        <button class="btn btn-primary see{{$no}}" style="width:90%">Lihat Detail</button>
                                    </div>
                                </div>
                            @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                                <div class="row-res table-row">
                                    <div class="cell" data-title="">
                                        <img src="{{ asset($pos->img) }}">
                                    </div>
                                    <div class="cell  tc-name" data-title="Class Name" style="vertical-align:middle">
                                        <p class="name-training">{{$pos->class_name_en}}</p>
                                    </div>
                                    <div class="cell tc-info" data-title="Info">
                                        {{$pos->duration}} Hours
                                    </div>
                                    <div class="cell tc-price" data-title="Price">
                                        <div style="width:80%; padding-right:55px">
                                            <span style="float:left">Rp.</span> <span  style="float:right">{{number_format($pos->price)}} </span>

                                        </div>
                                    </div>
                                    <div class="cell" data-title="">
                                        <button class="btn btn-success register-train-{{$pos->id}}" style="width:90%; margin-bottom:10px">
                                            Register </button>
                                        <button class="btn btn-primary see{{$no}}" style="width:90%">See Details</button>
                                    </div>
                                </div>
                            @endif

                        </div>
                    <div class="group detailed ">
                        <div class="row-res table-row">
                            @if ( Session::get('langIN') != NULL )
                                <div class="not-cell content-detail hiding hide{{$no}}"><?=$pos->detail_in?></div>
                            @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                                <div class="not-cell content-detail hiding hide{{$no}}"><?=$pos->detail_en?></div>
                            @endif
                        </div>
                    </div>

                    <script>
                        $('.see{{$no}}').click(function () {
                            $('.hide{{$no}}').toggle('bubble', function () {
                            })
                        })

                        $('.register-train-{{$pos->id}}').click(function () {
                            localStorage.setItem('class', {{ $pos-> id}});
                        localStorage.setItem('train', {{ $pos-> id_training}});
                        var classed = localStorage.getItem('class');
                        // alert(classed);
                        setTimeout(() => {
                            // window.location = "{{ route('compro.registerTrain') }}";
                            window.location = "{{ route('compro.google') }}";
                        }, 900);
                        })
                    </script>
                <?php
                $no ++;
                }
                ?>

                </div>
            </div>
        </div>
        <div class="row row-train-last">
            <div class="col-sm-12 ">
                @if ( Session::get('langIN') != NULL )
                    <a href="{{ route('compro.trainingPrev', ['id' => $content->id])  }}"> <span class="fa fa-arrow-left"></span> Training Sebelumnya </a>
                    <a href="{{ route('compro.trainingNext', ['id' => $content->id])  }}" style="float:right;     margin-right: 15px;"> Training Berikutnya <span class="fa fa-arrow-right"></span> </a>
                @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                    <a href="{{ route('compro.trainingPrev', ['id' => $content->id])  }}"> <span class="fa fa-arrow-left"></span> Prev Training </a>
                    <a href="{{ route('compro.trainingNext', ['id' => $content->id])  }}" style="float:right;     margin-right: 15px;"> Next Training <span class="fa fa-arrow-right"></span> </a>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    setTimeout(() => {
        var width = $('.table .group').width();
        $('.content-detail').width(width);
    }, 900);

</script>
<style>


</style>

@endsection
