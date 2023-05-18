    @extends('layouts.appcompro')

    @section('content')
    <?php
    function shorter($string){
    if (strlen($string) >= 160) {
        return substr($string, 0, 170). " ... ";
    }
    else {
        return $string;
    }
    }

    function convert_tgl_to_user($tgl){
        $tanggal =  substr($tgl, 0,10);
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }

    function convert_tgl_to_userEN($tgl){
        $tanggal =  substr($tgl, 0,10);
        $bulan = array (1 =>   'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'Juny',
                    'July',
                    'Augustus',
                    'September',
                    'October',
                    'November',
                    'Desember'
                );
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }

    ?>

<div class="space-top">
</div>

<br>
<br>
<br>

    <div class="section-content-mediaOne">
        <div class="container container-content container-form-job">
            <div class="wrapper-job">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="container-img-article con-left-blog">
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{ asset( $post->img_head ) }}" alt="" style="width: 100%"
                                        class="head-img-article">
                                    <div class="container-content">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h6 class="date-article"><span class="fa fa-clock-o"></span>
                                                @if ( Session::get('langIN') != NULL )
                                                    {{ convert_tgl_to_user( $post->created_at ) }}</h6>
                                                    <h1 class="h1-page">{{ $post->title_in }}</h1>
                                                @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                                                    {{ convert_tgl_to_userEN( $post->created_at ) }}</h6>
                                                    <h1 class="h1-page">{{ $post->title_en }}</h1>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-sm-12 content-all-p">
                                                @if ( Session::get('langIN') != NULL )
                                                <?php echo $post->content_in; ?>
                                                @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                                                <?php echo $post->content_en; ?>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-right">
                        <div class="con-left-blog">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="container-widget">
                                        <h5 style="padding-bottom: 10px; margin-bottom: 10px;margin-bottom: 10px;border-bottom: 1px solid #b2b7b7;"><span>@lang('main.media_lates_news')</span></h5>
                                        <?php foreach ($otherPost as $pos) { ?>
                                        <div class="one-other">
                                            @if ( Session::get('langIN') != NULL )
                                            <h5><a class="a-link"
                                                    href="{{ route('compro.mediaCenterOne', ['id' => $pos->article_id, 'url' => $pos->url ] ) }}"
                                                    title="{{ asset($pos->title_in) }}">{{ $pos->title_in }}</a></h5>
                                            <span style=" color: #aba9a9; font-size: 13px;"><i class="fa fa-clock-o"></i>
                                                {{ convert_tgl_to_user( $pos->created_at ) }}</span>
                                            @elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )
                                            <h5><a class="a-link"
                                                    href="{{ route('compro.mediaCenterOne', ['id' => $pos->article_id, 'url' => $pos->url ] ) }}"
                                                    title="{{ asset($pos->title_en) }}">{{ $pos->title_en }}</a></h5>
                                            <span style=" color: #aba9a9; font-size: 13px;"><i class="fa fa-clock-o"></i>
                                                {{ convert_tgl_to_user( $pos->created_at ) }}</span>
                                            @endif
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>







    @endsection
