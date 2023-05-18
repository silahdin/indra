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
?>

<section class="section-head-image">
    <div class="row row-costum">
        <div class="col-sm-12 col-costum">
            <img src="{{ asset('assets/compro/assets/frontend_assets/images/back_news.jpg') }}" alt=""  style="width: 100%">
                <!-- <div class="maps" id="maps" style="border:thin solid #ccc;height:500px;"></div> -->

        </div>
    </div>
</section>

<section class="section-content">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
@if ( Session::get('langIN') != NULL || Session::get('langEN') == NULL )
            <h1 class="h1-page">@lang('main.button_search')</h1>
@elseif ( Session::get('langEN') != NULL )
            <h1 class="h1-page">@lang('main.button_search')</h1>
@endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
@if ( Session::get('langIN') != NULL || Session::get('langEN') == NULL )
                <p>@lang('main.search_result'): {{$cari}}</p>
@elseif ( Session::get('langEN') != NULL )
                <p>@lang('main.search_result'): {{$cari}}</p>
@endif
            </div>
        </div>

        <div class="row">
            <?php if ($produk == '[]'){ ?>
            <div class="col-sm-4">
@if ( Session::get('langIN') != NULL || Session::get('langEN') == NULL )
                <p>@lang('main.not_found')</p>
@elseif ( Session::get('langEN') != NULL )
                <p>@lang('main.not_found')</p>
@endif
            </div>
            <?php }else{ ?>
            <?php foreach ($produk as $pos) { ?>
            <div class="col-sm-4">
                <article class="article">
                    <div class="wrapper">
@if ( Session::get('langIN') != NULL || Session::get('langEN') == NULL )
                        <h2><a href="{{ route('compro.artikel', ['id' => $pos->article_id, 'url' => $pos->url ] ) }}" title="{{ asset($pos->title_in) }}">{{ $pos->title_in }}</a></h2>
                        <p><?=shorter($pos->content_in) ?></p>
@elseif ( Session::get('langEN') != NULL )
                        <h2><a href="{{ route('compro.artikel', ['id' => $pos->article_id, 'url' => $pos->url ] ) }}" title="{{ asset($pos->title_en) }}">{{ $pos->title_en }}</a></h2>
                        <p><?=shorter($pos->content_en) ?></p>
@endif
<!--                         <div class="img-post" style="background-size: auto; background: url({{ asset($pos->img_head) }}) no-repeat center center; background-position: 0% -10%; height: 500px">
                        </div> -->

                        <img class="img-post" src="{{ asset($pos->img_head) }}" alt="" width="100%">
                        <hr>
@if ( Session::get('langIN') != NULL || Session::get('langEN') == NULL )
                        <a href="{{ route('compro.artikel', ['id' => $pos->article_id, 'url' => $pos->url ] ) }}">Selengkapnya...</a>
@elseif ( Session::get('langEN') != NULL )
                        <a href="{{ route('compro.artikel', ['id' => $pos->article_id, 'url' => $pos->url ] ) }}">More...</a>
@endif

                        <span style="float: right;">21 April 2018</span>
                    </div>
                </article>
            </div>
            <?php } ?>
            <?php } ?>
        </div>

    </div>
</section>

@endsection
