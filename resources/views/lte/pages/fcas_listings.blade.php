@extends(getCurrentTemplate() . '.layouts.default')
@section('meta_title')@lang('v9.FCAS_SEO_TITLE')@stop
@section('meta_desc')@lang('v9.FCAS_SEO_DESC')@stop
@section('meta_link'){{ Request::url() }}@stop
@section('meta_image'){{ URL::asset('public/images/pages/images') . '/fcas.png' }}@stop
@section('styles')<style>body{background: unset;}.card {box-shadow: 1px 3px 15px 0px rgba(0, 0, 0, 0.14);border: none;}
.card {position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.125);border-radius: 0.25rem;}.card-body {flex: 1 1 auto;padding: 0 .25rem;text-align: center;font-weight: 700;}.mb-3, .my-3 {margin-bottom: 1.5rem !important;}.link-of-asset{padding: 16px;display: block;float: left;}.text-of-asset{font-size: 20px;vertical-align: middle;font-weight: 500;}.grade-badge{right:0px;padding: 5px;border-radius: unset;position: absolute;}h5.card-title span{margin-right: 12px;}.coin-icon{border:1px solid #eee;border-radius: 25px;width: 40px!important;height: 40px!important;}.hr{border: 0;border-top: 0.5px solid #ccc;width: 100%;margin: unset;padding:unset;}
</style>
@stop
@section('content')
<div class="tab ui active">
      <div class="box box-success table-heading-class">
          <div class="box-header with-border">
              <h3 class="box-title">@lang('v9.FCAS_PAGE')</h3>
              <h1 class="sr-only">@lang('v9.FCAS_PAGE')</h1>
            <h2 class="sr-only">Complete List of Fundamental Crypto Assets Score</h2>
            <h2 class="sr-only">Compare Bitcoin, Ethereum and Litecoin Assets Score</h2>
            <h2 class="sr-only">Bitcoin, Ethereum and Litecoin Crypto Score</h2>
          </div>
          <p style="padding: 10px;">@lang('v9.FCAS_DESC')</p>
    </div>
    <div class="row">
        @foreach ($fcas_listings as $fcas_listing)
        @if(isset($fcas_listing->cryptoMarkets['name']) && $fcas_listing->cryptoMarkets['name'] != '')
        <div class="col-4 col-xl-3 col-lg-3 col-md-3 col-sm-4 mb-3">
          <div class="card bg-light mb-3">
          <div style="background-image: url({{ $fcas_listing->cryptoMarkets['image'] }});"></div>
            <div class="card-header">
              <span style="padding: 10px; float: left;">
                @if(file_exists('public/storage/' . $fcas_listing->cryptoMarkets['image']))
                <img class="img-fluid coin-icon" src="{{URL::asset('public/storage/' . $fcas_listing->cryptoMarkets['image'])}}" title="{{ $fcas_listing->cryptoMarkets['name'] }}" alt="{{ $fcas_listing->cryptoMarkets['name'] }}">
                @else
                <img class="img-fluid coin-icon" src="{{ $fcas_listing->cryptoMarkets['image'] }}" title="{{ $fcas_listing->cryptoMarkets['name'] }}" alt="{{ $fcas_listing->cryptoMarkets['name'] }}">
                @endif
            </span>
              <a class="link-of-asset" href="{{ makeUrl('currencies') }}/{{ $fcas_listing->cryptoMarkets['alias'] }}" title="{{ $fcas_listing->cryptoMarkets['name'] }}">
                <span class="text-of-asset">{{ str_limit(ucfirst(strtolower($fcas_listing->cryptoMarkets['name'])), 12) }}</span>
              </a>
            </div>
            <hr class="hr" />
            <div class="card-body" style="text-align: left;padding:10px;">
              <h5 class="card-title">
                <span><a href="{{ makeUrl('currencies') }}/{{ $fcas_listing->cryptoMarkets['alias'] }}" title="{{ $fcas_listing->cryptoMarkets['name'] }}">{{ $fcas_listing->symbol }}</a></span>
                <span>HEALTH &nbsp;&nbsp;<strong>{{ $fcas_listing->score }}</strong> &nbsp;
                  <span style="font-size: 10px;margin: unset;" title="score difference">
                    @if($fcas_listing->point_change_24h >= 0)
                    <i class="fa fa-level-up" aria-hidden="true" style="color:green;"></i>
                    @else
                    <i class="fa fa-level-down" aria-hidden="true" style="color:red;"></i>
                    @endif
                    {{$fcas_listing->point_change_24h}}
                  </span>
                </span>
                <?php
                if($fcas_listing->grade == 'S') {
                  $color = '#68ba66';
                } else if($fcas_listing->grade == 'A') {
                  $color = '#8fcb89';
                } else if($fcas_listing->grade == 'B') {
                  $color = '#b2dbad';
                } else if($fcas_listing->grade == 'C') {
                  $color = '#FC9D51';
                } else {
                  $color = '#FB4819';
                }
                ?>
                <span><a title="grade" class="badge badge-info" style="width: 35px;background: {{$color}};">{{ $fcas_listing->grade }}</a></span>
              </h5>
            </div>
            <hr class="hr" />
            <p class="card-text" style="margin: unset;padding:5px 5px 5px 10px;font-size: 12px;">
              @lang('v9.UPDATED_ON'): <i class="fa fa-clock-o fa-fw" style="font-size: 1em;"></i> {{ date("M j, Y", strtotime($fcas_listing->last_updated)) }}
            </p>
          </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@include('default.includes.disqus')
@stop
