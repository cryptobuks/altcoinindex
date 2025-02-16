@extends(getCurrentTemplate() . '.layouts.default')
@section('meta_title')@lang('v9.DICTIONARY_SEO_TITLE')@stop
@section('meta_desc')@lang('v9.DICTIONARY_SEO_DESC')@stop
@section('meta_link'){{ Request::url() }}@stop
@section('meta_image'){{ URL::asset('public/images/pages/images') . '/dictionary.png' }}@stop
@section('styles')<style type="text/css">.dictionary-search {width: 100%;position: relative;display: flex;}.searchTerm {width: 100%;border: 1px solid #337ab7;border-right: none;padding: 22px;height: 20px;border-radius: 5px 0 0 5px;outline: none;color: #9DBFAF;font-size: 22px;margin-left: 15px;}.searchTerm:focus{color: #337ab7;}.searchButton {width: 100px;height: 46px;border: 1px solid #337ab7;background: #337ab7;text-align: center;color: #fff;border-radius: 0 5px 5px 0;cursor: pointer;font-size: 20px;margin-right: 15px;}.wrap{max-width: 800px;margin: 0 auto;}.ui-autocomplete.ui-widget {font-size: 20px;}.heading-color{border-bottom: 4px double;border-color: #337ab7;margin-bottom: 25px;display: inline-block;}.term-box-style{background: white; padding:10px;margin-bottom: 10px;border-radius: 5px;box-shadow: 1px 3px 15px 0px rgba(0, 0, 0, 0.14);
    border: 1px solid #eee;}.term-box-style h3{margin-top: 0px;}.term-style h2{text-align: center;display: block;margin: 10px;font-size: 24px;margin-top: 25px;}.latest_postnav{list-style: none;padding: unset;}.latest_postnav li{border-bottom: 1px solid #eee;padding-bottom: 5px;margin-bottom: 5px;}.box{position: unset;}.latest_post{margin-top: 10px;margin-bottom: 10px;}.pagination{float: right;}</style>
<link href="{{ URL::asset('public/css/jquery_ui.css') }}" rel="stylesheet" />
@stop
@section('scripts')
  <script src="{{ URL::asset('public/js/jquery_ui.js') }}"></script>
  <script>
  $( function() {
    $( "#terms" ).autocomplete({
      source: function( request, response ) {
        $.get({
          url: APP_URL + '/ajax-load-dictionary/',
          dataType: "json",
          data: {q: request.term, lang: '{{LaravelLocalization::getCurrentLocale()}}'},
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
        event.preventDefault();
        $("#terms").val(ui.item.label);
        window.location = "{{ makeUrl('crypto-dictionary')}}/" + ui.item.value;
      }
    });
  } );
  </script>
@stop
@section('content')
<div class="tab ui active">
    <div class="box box-success table-heading-class">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('v9.DICTIONARY_HEADING')</h3>
            <h1 class="sr-only">@lang('v9.DICTIONARY_HEADING')</h1>
            <h2 class="sr-only">A complete list of crypto definitions</h2>
            <h2 class="sr-only">Cryptocurrency and blockchain glossary</h2>
            <h2 class="sr-only">Commonly used terms in the world of blockchain and cryptocurrency</h2>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="wrap">
            <div class="dictionary-search">
                <input id="terms" type="text" class="searchTerm" placeholder="@lang('v9.DICTIONARY_TEXTAREA')">
                <button type="submit" class="searchButton" onclick="">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12 term-style">
          <h2>
            <span class="heading-color">
            @lang('v9.DICTIONARY_SUB_HEADING')
            </span>
          </h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 term-style">
        <div class="box box-success table-heading-class">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('v9.QUICK_LINKS')</h3>
            </div>
        </div>
        <div class="latest_post_container" style="padding: 10px; background-color: #fff;height: unset;">
          <ul class="latest_postnav">
            @if($newest_terms)
              @foreach($newest_terms as $newest_term)
              <li>
                <div class="media">
                  <a href="{{ makeUrl('crypto-dictionary') }}/{{ $newest_term->alias }}" title="{{ $newest_term->term }}"> {{ $newest_term->term }} </a>
                </div>
              </li>
              @endforeach
            @endif
          </ul>
        </div>
        <div class="latest_post">
          <div class="box box-success table-heading-class">
              <div class="box-header with-border">
                  <h3 class="box-title">@lang('menu.TOOLS')</h3>
              </div>
          </div>
          <div class="latest_post_container" style="padding: 10px; background-color: #fff;height: unset;">
            <ul class="latest_postnav">
                <li><div class="media"><a href="{{ makeUrl('cryptocurrency-converter') }}" title="@lang('menu.CONVERTER')">@lang('menu.CONVERTER')</a></div></li>
                <li><div class="media"><a href="{{ makeUrl('cryptocurrency-widgets') }}" title="@lang('menu.WIDGETS')">@lang('menu.WIDGETS')</a></div></li>
                <li><div class="media"><a href="{{ makeUrl('buy-sell-cryptocoins') }}" title="@lang('menu.BUY_SELL')">@lang('menu.BUY_SELL')</a></div></li>
                <li><div class="media"><a href="{{ makeUrl('crypto-mining-equipment') }}" title="@lang('menu.MINING_EQUIPMENT')">@lang('menu.MINING_EQUIPMENT')</a></div></li>
                <li><div class="media"><a href="{{ makeUrl('block-explorer') }}" title="@lang('menu.BLOCKEXPLORER')">@lang('menu.BLOCKEXPLORER')</a></div></li>
                <li><div class="media"><a href="{{ makeUrl('fundamental-crypto-asset-score') }}" title="@lang('v9.ASSET_SCORE')">@lang('v9.ASSET_SCORE')</a></div></li>
            </ul>
          </div>
        </div>
        @include(getCurrentTemplate() . '.ads.dictionary_ad')
      </div>
      <div class="col-md-6 term-style">
          @php $i = 1 @endphp
          @foreach($terms as $term)
            <div class="term-box-style">
                <h3>
                    <a href="{{ makeUrl('crypto-dictionary') }}/{{ $term->alias }}" title="{{ $term->term }}"> {{ $term->term }} </a>
                </h3>
                {!! strip_tags($term->definition) !!}
            </div>
            @if($i == 5)
              @include(getCurrentTemplate() . '.ads.news_page_horizontal_ad')
            @endif 
            @php $i++ @endphp
          @endforeach
          @if($terms->links() != '')
              {{ $terms->links() }}
          @endif

          @if(isset($single) && $single == 1)
            @include(getCurrentTemplate() . '.ads.news_page_horizontal_ad')
            <div class="latest_post">
              <div class="box box-success table-heading-class">
                  <div class="box-header with-border">
                      <h3 class="box-title">@lang('v9.OTHER_TERMS')</h3>
                  </div>
              </div>
            </div>
            @foreach($other_terms as $other_term)
              <div class="term-box-style">
                  <h3>
                      <a href="{{ makeUrl('crypto-dictionary') }}/{{ $other_term->alias }}" title="{{ $other_term->term }}"> {{ $other_term->term }} </a>
                  </h3>
                  {!! strip_tags($other_term->definition) !!}
              </div>
            @endforeach
          @endif
      </div>
      <div class="col-md-3 term-style">
        <div class="box box-success table-heading-class">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('v9.CRYPTO_NEWS')</h3>
            </div>
        </div>
        <div class="latest_post_container" style="padding: 10px; background-color: #fff;height: unset;">
          <ul class="latest_postnav">
            <li>
              <div class="media">
                <a href="{{ makeUrl('tag') }}/blockchain" title="Blockchain"> Blockchain </a>
              </div>
            </li>
            @if($crypto_tags)
              @foreach($crypto_tags as $crypto_tag)
              <li style="margin-bottom: 10px;">
                <div class="media">
                  <a href="{{ makeUrl('tag') }}/{{ $crypto_tag->slug }}" title="{{ $crypto_tag->tag }}"> {{ $crypto_tag->tag }} </a>
                </div>
              </li>
              @endforeach
            @endif
          </ul>
        </div><br />
        @include(getCurrentTemplate() . '.ads.news_ad')
      </div>
    <br />
</div>
@if(isset($single))
    @include('default.includes.disqus')
@endif
@stop
