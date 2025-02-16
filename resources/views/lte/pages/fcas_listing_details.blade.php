@extends(getCurrentTemplate() . '.layouts.default')
@if(isset($market))
@section('meta_title')@lang('v6.COIN_DETAIL_TITLE', ['COIN' => $market->name])@stop
@section('meta_desc')@lang('v6.COIN_DETAIL_DESC', ['COIN' => $market->name])@stop
@else
@section('meta_title')@lang('v6.COIN_DETAIL_TITLE', ['COIN' => 'This coin'])@stop
@section('meta_desc')@lang('v6.COIN_DETAIL_DESC', ['COIN' => 'This coin'])@stop
@endif
@section('meta_link'){{ Request::url() }}@stop
@section('meta_image')
@if(isset($market->name)){{ $market->image }}@elseif(isset($market->symbol)){{ URL::asset('public/images/coins_icons') }}/{{ strtolower($market->symbol).'_.png' }}@endif
@stop
@section('styles')
<link href="{{ URL::asset('public/css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('public/css/datatables/dataTables.responsive.css') }}" rel="stylesheet" />
<style type="text/css">.green{color: green;}.red{color: red;}</style>
@stop
@section('scripts')
<script src="{{ URL::asset('public/js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('public/js/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/js/datatables/dataTables.responsive.js') }}"></script>
<script src="{{ URL::asset('public/js/amchart/core.js') }}"></script>
<script src="{{ URL::asset('public/js/amchart/charts.js') }}"></script>
<script src="{{ URL::asset('public/js/amchart/animated.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        loadAreaChart('{{ $market->symbol }}');
        $('#dataTables-example').DataTable({
            responsive: true,
            "iDisplayLength": 20,
            "bFilter": false,
            "bLengthChange": false,
            "language": {
                "url": "{{ URL::asset('public/js/datatables/') }}/langs/" + $('.top-language-dropdown .item.selected').attr('name') + '.js'
            }
        });
    });
    function loadSingleCoinHistoricalData(coin) {
        loadAreaChart('{{ $market->symbol }}');
    }
    function loadAreaChart(a) {
        var t = $(".time-frame :selected").val();
        $.getJSON('{{URL::to("/")}}/ajax-load-score-data/' + a + "/" + t + "/USD", function(res_data) {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("price-score-chart", am4charts.XYChart);
            chart.data = res_data;
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.dateX = "date";
            series.dataFields.valueY = "visits";
            series.tooltipText = "${valueY.value}";
            chart.cursor = new am4charts.XYCursor();
            series.fillOpacity = 0.5;
            series.fill = am4core.color("#337ab7");
            series.stroke = am4core.color("#337ab7");
        });
    }
</script>
@stop
@section('content')
@if(isset($market->name))
    <div class="ui segment partial-coin-detail-wrapper">
      <div class="ui teal large ribbon label">
          <strong><span class="sr-only">{{ $market->name }} </span>@lang('tbl_headings.RANK') {{ $market->rank }}  </strong>
        </div>
        <a title="{{ $market->name }}" target="_blank" class="ui label">
            ${{ $market->price_usd }}
        </a>
         <div class="ui label simple dropdown item" style="background: #337ab7;color: #fff;" tabindex="0">
            <i class="cart icon"></i> @lang('v5.BUY_SELL') <i class="dropdown icon"></i>
            <div class="menu" tabindex="-1">
                @if(isset($affiliates))
                  @foreach($affiliates as $affiliate)
                   <div class="item">
                      <a href="{{ $affiliate->link }}" target="_blank" title="{{ $affiliate->name }}" alt="{{ $affiliate->name }}">
                        {{ $affiliate->name }}
                      </a>
                  </div>
                  @endforeach
              @endif
            </div>
         </div>
      </div>
      <div class="ui segment coin-detail-wrapper">
         <div class="ui teal large ribbon label"><strong><span class="sr-only">{{ $market->name }} </span>@lang('tbl_headings.RANK') {{ $market->rank }}  </strong></div>
         @if(isset($coin_details->website_url))
          <a title="{{ $market->name }}" href="{{ $coin_details->website_url }}" target="_blank" class="ui label">
              <i class="linkify icon"></i> @lang('tbl_headings.WEBSITE')
          </a>
          @endif
          @if(isset($coin_details->reddit) && $coin_details->reddit != '')
          <a href="{{ $coin_details->reddit }}" target="_blank" class="ui label">
              <i class="reddit alien icon"></i><span id="subreddit">Reddit</span>
          </a>
          @endif
          @if(isset($coin_details->twitter) && $coin_details->twitter != '')
          <a href="https://twitter.com/{{ $coin_details->twitter }}" target="_blank" class="ui label">
              <i class="twitter alien icon"></i><span id="subreddit">Twitter</span>
          </a>
          @endif
          <div class="ui label">
            <i class="anchor icon"></i>  {{ $market->available_supply }} {{ $market->symbol }}
          </div>
         <div class="ui label simple dropdown item" style="background: #337ab7;color: #fff;" tabindex="0">
            <i class="cart icon"></i> @lang('v5.BUY_SELL') <i class="dropdown icon"></i>
            <div class="menu" tabindex="-1">
                @if(isset($affiliates))
                   @foreach($affiliates as $affiliate)
                   <div class="item">
                      <a href="{{ $affiliate->link }}" target="_blank" title="{{ $affiliate->name }}" alt="{{ $affiliate->name }}">
                        {{ $affiliate->name }}
                      </a>
                  </div>
                  @endforeach
                @endif
            </div>
         </div>
         <div class="ui label cd simple dropdown item" style="background:#f06060;color:#fff;"><i class="google wallet icon"></i> Get Wallet <i class="dropdown icon"></i>
            <div class="menu">
                <div class="item">
                    <a rel="nofollow" href="https://freewallet.org/currency/{{ strtolower($market->symbol) }}" target="_blank" title="Get Free {{$market->symbol}} Wallet" alt="Get Free {{$market->symbol}} Wallet">
                        @lang('v6.FREE_WALLET_1')
                    </a>
                    <p><small>@lang('v6.FREE_WALLET_SUB_1')</small></p>
                </div>
                <div class="item">
                    <a rel="nofollow" href="https://www.blockchain.com/wallet" target="_blank" title="Get Free {{$market->symbol}} Wallet" alt="Get Free {{$market->symbol}} Wallet">
                        @lang('v6.FREE_WALLET_2')
                    </a>
                    <p><small>@lang('v6.FREE_WALLET_SUB_2')</small></p>
                </div>
            </div>
        </div>
       <div class="row" style="float: right;">
        <div class="col-lg-12">
          @if(Auth::user())
            <a class="add-watchlist @if(in_array($market->symbol, $favorite_coins)) favorite @endif"
            id="id_{{ $market->symbol }}" coin= "{{ $market->symbol }}"
            style="cursor: pointer;" title="add to watchlist">
                <i class="fa fa-star fa-fw"></i>
            </a>
          @endif
        </div>
    </div>
    <div class="ui divider"></div>
    <div style="margin-top: 20px; margin-bottom: 20px;" class="ui grid center aligned">
        <div class="row">
            <div class="four wide column detail-page-market-stats">
              <div class="four wide column">
                 <h2 class="ui header">
                    @if(isset($market))
                     <img alt="{{ $market->name }}" title="{{ $market->name }}" src="{{ str_replace('/thumbs', '', $market->image) }}" style="width: 45px; vertical-align: middle; float: left;margin: -1px 3px;" />
                    @endif
                    <div class="content">
                        {{ $market->name }}
                        <div id="code" class="sub header">
                            <em>
                                <b>
                                    <acronym title="{{ $market->name }}">
                                        {{ $market->symbol }}
                                    </acronym>
                                </b>
                            </em>
                        </div>
                    </div>
                 </h2>
              </div>
            </div>
            <div class="four wide column">
                <div class="ui mini statistic">
                    <div class="label">1 H</div><span id="dailyLow" class="value price-fiat">@if(isset($market->percent_change_hour)) @if($market->percent_change_hour >=0) <span class="green"> {{ $market->percent_change_hour }} % <i class="fa fa-long-arrow-up" aria-hidden="true"></i> </span> @else <span class="red"> {{ $market->percent_change_hour }} % <i class="fa fa-long-arrow-down" aria-hidden="true"></i></span> @endif @endif</span>
                </div>
            </div>
            <div class="four wide column">
                <div class="ui mini statistic">
                    <div class="label">24 H</div><span id="dailySpread" class="value">@if(isset($market->percent_change_day)) @if($market->percent_change_day >=0) <span class="green"> {{ $market->percent_change_day }} % <i class="fa fa-long-arrow-up" aria-hidden="true"></i></span> @else <span class="red"> {{ $market->percent_change_day }} % <i class="fa fa-long-arrow-down" aria-hidden="true"></i> </span> @endif @endif</span>
                </div>
            </div>
            <div class="four wide column">
                <div class="ui mini statistic">
                    <div class="label">7 d</div><span id="ath" class="value price-fiat">@if(isset($market->percent_change_week)) @if($market->percent_change_week >=0) <span class="green"> {{ $market->percent_change_week }} % <i class="fa fa-long-arrow-up" aria-hidden="true"></i></span> @else <span class="red"> {{ $market->percent_change_week }} % <i class="fa fa-long-arrow-down" aria-hidden="true"></i> </span> @endif @endif</span>
                </div>
            </div>
        </div>
    </div>
    <div class="ui divider"></div>
    <div class="descriptiond">@lang('seo.COIN_DES1') <strong><a href="{{ Request::url() }}" title="{{ $market->name }}">{{ $market->name }}</a></strong> @lang('seo.COIN_DES2') <strong>
    @if($market->price_usd < 0.9999) {{ number_format($market->price_usd, 4) }} @else {{ number_format($market->price_usd, 2) }}@endif

    USD</strong>, @lang('seo.COIN_DES3') <a href="{{ makeUrl('currencies/bitcoin') }}" title="@lang('seo.COIN_DES14')">@lang('seo.COIN_DES14')</a> @lang('seo.COIN_DES15') <strong>

    @if($market->price_btc < 0.999999){{ number_format($market->price_btc, 8) }} @else {{ number_format($market->price_btc, 2) }} @endif

    <acronym title="Bitcoin">BTC</acronym></strong>. @lang('seo.COIN_DES4') <strong>{{ number_format(($market->market_cap_usd/$market->price_usd)*$market->price_btc) }} @lang('seo.COIN_DES5')</strong> @lang('seo.COIN_DES6') <i>{{ $market->name }}</i> @lang('seo.COIN_DES7') <strong> {{ $market->percent_change_day }} %</strong>@lang('seo.COIN_DES8') <a href="{{ makeUrl('currencies') }}" title="@lang('seo.COIN_DES9')">@lang('seo.COIN_DES9')</a> @lang('seo.COIN_DES10') <strong>{{ number_format($market->volume_usd_day/100000000, 3) }} M US dollars</strong> @lang('seo.COIN_DES11') <strong>{{ $market->name }}</strong> @lang('seo.COIN_DES12') <a href="{{ makeUrl('crypto-exchanges') }}" title="@lang('seo.COIN_DES13')">@lang('seo.COIN_DES13')</a>. @lang('v7.SEO_DESC14') {{ $market->name }}'s @lang('v7.SEO_DESC15') <a href="{{ makeUrl('user/favorites-coins') }}" title="Favorites Coins">@lang('v7.SEO_DESC16')</a> @lang('v7.SEO_DESC17') <a href="{{ makeUrl('user/blockfolio') }}" title="Portfolio">@lang('v7.SEO_DESC18')</a> @lang('v7.SEO_DESC19').</div>
       <div class="ui divider"></div>
    @if(isset($coin_historical_data) && count($coin_historical_data) > 10)
    <div class="row">
      <div class="col-lg-12">
        <div class="ui segment coins_page_headings">
            <div class="ui teal large ribbon label"><i class="tag icon"></i></div>
            <h1>@lang('menu.CHARTS')</h1>
        </div>
        <div class="pull-right time-frame-select-box">
            <div class="btn-group">
                <select class="time-frame form-control" onchange="loadSingleCoinHistoricalData('{{ $market->symbol }}')">
                    <option value="7 day">7 @lang('menu.DAYS')</option>
                    <option value="1 months">1 @lang('menu.MONTH')</option>
                    <option value="3 months">3 @lang('menu.MONTHS')</option>
                    <option value="6 months" selected="selected">6 @lang('menu.6_MONTHS')</option>
                    <option value="1 year">1 @lang('menu.YEAR')</option>
                    <option value="2 year">2 @lang('menu.YEARS')</option>
                    <option value="all">@lang('menu.ALL')</option>
                </select>
            </div>
        </div>
        <div class="tab-pane fade active in" id="area">
            <div id="price-score-chart" style="height: 400px;"></div>
        </div>
      </div>
    </div>
    @endif
@endif
<br />
@if (isset($coin_details->description) && $coin_details->description != '')
    <div class="panel panel-default" style="clear: both;">
        <div class="panel-body">
            <div class="ui teal large ribbon label">@lang('v5.DESC')
                <h3 class="sr-only">@lang('v5.DESC')</h3>
            </div>
            <div class="col-md-12">
            <br />{!! $coin_details->description !!}
          </div>
        </div>
    </div>
@endif
@if (isset($coin_details->technology) && $coin_details->technology != '')
    <div class="panel panel-default">
        <div class="panel-body">
          <div class="ui teal large ribbon label">@lang('v5.TECH')
            <h3 class="sr-only">@lang('v5.TECH')</h3>
          </div>
          <div class="col-md-12">
            <br />{!! $coin_details->technology !!}
          </div>
        </div>
    </div>
@endif
@if (isset($coin_details->features) && $coin_details->features != '')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="ui teal large ribbon label">@lang('v5.FEATURES')
                <h3 class="sr-only">@lang('v5.FEATURES')</h3>
            </div>
            <div class="col-md-12">
                <br />{!! $coin_details->features !!}
            </div>
        </div>
    </div>
@endif
</div>
@include('default.includes.disqus')
@stop
