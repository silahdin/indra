@extends('layouts.appcompro')

@section('content')
<?php
function shorter($string){
  if (strlen($string) >= 240) {
    return substr($string, 0, 250). " ... ";
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

<?php
$imgBanner = asset('assets/compro/assets/frontend_assets/images/slider/alone.jpg');
?>

<div class="space-top">
</div>

<section class="about flex-box" style="background:url('{{$imgBanner}}'); background-size: cover; height: 500px;">
    <div class="boxes">
        <h1>@lang('main.media_center')</h1>

    </div>
</section>
<br>
<br>
<br>
@if ( Session::get('langIN') != NULL )

@elseif ( Session::get('langEN') != NULL || Session::get('langIN') == NULL )

@endif

<div class="container container-content container-form-job container-news">
    <div class="wrapper-job">
        <div class="row">
            <div class="col-sm-9">
                <div class="row row-article">

                    <?php foreach ($post as $pos) { ?>
                    <div class="col-sm-4">
                        <article class="article">
                            <div class="wrapper">
                                @if ( Session::get('language') == 'ch' )
                                <h2><a href="{{ route('compro.mediaCenterOne', ['id' => $pos->article_id, 'url' => $pos->url ] ) }}"
                                        title="{{ asset($pos->title_in) }}">{{ $pos->title_in }}</a></h2>
                                <img class="img-post" src="{{ asset($pos->img_head) }}" alt="" width="100%">
                                <div class="new">
                                    <p class="contents"> <?=shorter($pos->content_in) ?> </p>
                                </div>
                                <hr>
                                <a
                                    href="{{ route('compro.mediaCenterOne', ['id' => $pos->article_id, 'url' => $pos->url ] ) }}">@lang('main.media_read_more')</a>
                                <span style="float: right; color: grey"><i class="fa fa-clock-o"></i>
                                    {{ convert_tgl_to_user( $pos->created_at ) }}</span>
                                @elseif ( Session::get('language') == 'en')
                                <h2><a href="{{ route('compro.mediaCenterOne', ['id' => $pos->article_id, 'url' => $pos->url ] ) }}"
                                        title="{{ asset($pos->title_en) }}">{{ $pos->title_en }}</a></h2>
                                <img class="img-post" src="{{ asset($pos->img_head) }}" alt="" width="100%">
                                <div class="new">
                                    <p class="contents"> <?=shorter($pos->content_en) ?> </p>
                                </div>
                                <hr>
                                <a
                                    href="{{ route('compro.mediaCenterOne', ['id' => $pos->article_id, 'url' => $pos->url ] ) }}">@lang('main.media_read_more')</a>
                                <span style="float: right; color: grey"><i class="fa fa-clock-o"></i>
                                    {{ convert_tgl_to_userEN( $pos->created_at ) }}</span>
                                @endif
                            </div>
                        </article>
                    </div>
                    <?php } ?>
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
                                            @if ( Session::get('language') == 'ch' )
                                            <h5><a class="a-link"
                                                    href="{{ route('compro.mediaCenterOne', ['id' => $pos->article_id, 'url' => $pos->url ] ) }}"
                                                    title="{{ asset($pos->title_in) }}">{{ $pos->title_in }}</a></h5>
                                            <span style=" color: #aba9a9; font-size: 13px;"><i class="fa fa-clock-o"></i>
                                                {{ convert_tgl_to_user( $pos->created_at ) }}</span>
                                            @elseif ( Session::get('language') == 'en'  )
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

        <div class="row">
            <div class="col-sm-12 text-center">
                {{ $post->links() }}
            </div>
        </div>
    </div>
</div>
<br>
<style type="text/css">
    .container-news>.row>.col-sm-4 {
        margin-top: 15px;
    }
</style>
<br>
	<br>
	<br>
    @include('pages.compro.follow')
@endsection
