@extends(getCurrentTemplate() . '.layouts.default')
@section('meta_title'){{ $title }}@stop
@section('meta_desc'){{ $desc }}@stop
@section('meta_link'){{ Request::url() }}@stop
@section('meta_image'){{ URL::asset('public/images/pages/images') . '/defi.png' }}@stop
@section('styles')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.css" rel="stylesheet" />
@stop
@section('scripts')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
<script src="{{ URL::asset('public/js/ccc-streamer-utilities.js') }}"></script>
<script src="{{ URL::asset('public/js/default/streaming-code.js') }}"></script>
<script>
 $(document).ready(function() {
    $('#dataTables-example').DataTable({
        "responsive": true,
        "bPaginate": false,
        "bInfo" : false,
        "bFilter": false,
        "aaSorting": [],
        @if(Auth::user())
        "columnDefs": [
            { "orderable": false, "targets": [9,10] }
        ],
        @else
        "columnDefs": [
            { "orderable": false, "targets": [9] }
        ],
        @endif
        "language": {
            "url": "{{ URL::asset('public/js/datatables/') }}/langs/" + $('.top-language-dropdown .item.selected').attr('name') + '.js'
        }
    });
    $('#dataTables-example').on('click', '.add-watchlist', function() {
        var coin = $(this).attr('coin');
        $.get(APP_URL + '/ajax-save-favorite-coin/'+coin, function(response) {
            if(response == 'true') {
                $("#id_"+coin).addClass('favorite');
            } else {
                $("#id_"+coin).removeClass('favorite');
            }
        });
    });
    streaming([{!! $streaming_data !!}]);
});
</script> 
@stop 
@section('content')
<div class="ui segment"><div class="ui teal large ribbon label"><i class="tag icon"></i></div><h1>{{ $sub_heading }}</h1></div>
<div class="panel panel-default live">
  <div class="panel-heading sr-only">
    <div class="ui teal large ribbon label"><i class="tag icon"></i></div>
    <h1>{{ $sub_heading }}</h1>
    <h2>{{ $sub_heading }}</h2>
    <p>{{ $desc }}</p>
    <b>@lang('seo.SEO_HIDE1')</b>
    <h2>Coin Market Cap</h2>
    <p>@lang('seo.SEO_HIDE2')<p>
    <b>@lang('seo.SEO_HIDE3')</b>
  </div>
  <div class="panel-body all-currencies-page top-currencies-page live" style="padding-top:0"> {{ $all_markets->links() }}
    <ul class="custom-pagination" style="float: right;">
      <li style="list-style-type:none"><a href="{{ makeUrl('defi') }}">@lang('pagination.FIRST')</a></li>
    </ul>
    <div class="ui pointing secondary menu currencies-page-tabs" style="float: left;margin-top: 0px;">
      <a class="m item @if(Request::is('/defi')) active @endif" href="{{ makeUrl('defi') }}">
         <i class="shekel sign alternate icon"></i>Defi
       </a>
       <a class="m item @if(Request::is( '/top-gainers-crypto-currencies')) active @endif" href="{{ makeUrl('top-gainers-crypto-currencies') }}">
         <i class="level up alternate icon"></i>@lang('menu.TOP_GAINERS')
       </a>
       <a class="m item @if(Request::is( '/top-losers-crypto-currencies')) active @endif" href="{{ makeUrl('top-losers-crypto-currencies') }}">
         <i class="level down alternate icon"></i>@lang('menu.TOP_LOSERS')
       </a>
       <a class="m item @if(Request::is( '*/high-low-crypto-currencies')) active @endif" href="{{ makeUrl('high-low-crypto-currencies') }}">
         <i class="certificate icon"></i>@lang('menu.HIGH_LOW_COINS')
       </a>
     </div>
    <table width="100%" class="table table-bordered dataTable no-footer dtr-inline collapsed white" id="dataTables-example">
      <thead>
        <tr>
          <th><span class="paddi">@lang('tbl_headings.RANK')</span>  </th>
          <th style="width: 150px;">@lang('tbl_headings.NAME')</th>
          <th class="right">@lang('tbl_headings.PRICE')</th>
          <th class="right">@lang('tbl_headings.MARKET_CAP')</th>
          <th class="right">@lang('tbl_headings.24h_VOLUME')</th>
          <th class="right">@lang('tbl_headings.1H_CHANGE')</th>
          <th class="right">@lang('tbl_headings.24H_CHANGE')</th>
          <th class="right">@lang('v5.7D_CHANGE')</th>
          <th class="right">@lang('tbl_headings.AVAILABLE_SUPPLY')</th>
          <th class="right">@lang('v5.BUY_SELL')</th>
          @if(Auth::user())
          <th class="right"><i class="fa fa-desktop fa-fw" title="add to favorites"></i></th>
          @endif
        </tr>
      </thead>
      <tbody class="crypto-currencies-data">
        <?php 
          $i = 1; 
          $page = isset($_GET['page']) ? (50*($_GET['page']-1)) : 0;
        ?> 
        @foreach ($all_markets as $market)
        <tr class="odd gradeX" id="TABLE_ROW_{{$market->symbol}}">
          <td><?php echo $i + $page; ?></td>
          <td> 
            <h3 class="ui image header">
              <img alt='{{ $market->name }} icon' title='{{ $market->name }} ' src='{{ $market->image }}' width='25' />
              <div class="content">
                <a href="{{ makeUrl('currencies') }}/{{ $market->alias }}" title="{{ $market->name }} ({{$market->symbol}}) Price, Charts & Market Cap">
                  {{ str_limit($market->name, 12) }} 
                  <span class="sr-only">{{ $market->name }} ({{$market->symbol}}) Price, Charts and Market Cap</span>
                  <div class="sub header"><b>
                    <acronym title="{{ $market->name }}">{{$market->symbol}}</acronym></b>
                  </div>
                </a>
              </div>
            </h3>
          </td>
          <td class="price right" title="{{$market->symbol}} @lang('tbl_headings.PRICE')" val="{{$market->price_usd}}" id="PRICE_{{$market->symbol}}"></td>
          <td class="market_cap_usd right" title="{{$market->symbol}} @lang('tbl_headings.MARKET_CAP')" val="{{$market->market_cap_usd}}"></td>
          <td class="volume_usd_day right" val="{{$market->volume_usd_day}}"></td>
          <td class="percent_change_hour right" style="color:@if($market->percent_change_hour >= 0) green @else red @endif">{{$market->percent_change_hour}} % @if($market->percent_change_hour>= 0) <i class="fa fa-long-arrow-up" aria-hidden="true"></i> @else <i class="fa fa-long-arrow-down" aria-hidden="true"></i> @endif</td>
          <td class="right" id="CHANGE24HOURPCT_{{$market->symbol}}" style="color:@if($market->percent_change_day >= 0) green @else red @endif">{{$market->percent_change_day}} %</td>
          <td class="percent_change_week right" style="color: @if($market->percent_change_week >= 0) green @else red @endif">{{$market->percent_change_week}} % @if($market->percent_change_week>= 0) <i class="fa fa-long-arrow-up" aria-hidden="true"></i> @else <i class="fa fa-long-arrow-down" aria-hidden="true"></i> @endif </td>
          <td class="right">{{$market->available_supply}} {{$market->symbol}}</td>
          <td class="right">
            <div class="ui label simple dropdown item" style="background: #00b5ad;color: #fff;" tabindex="0">       
                <i class="cart icon"></i>@lang('v5.BUY_SELL') <i class="dropdown icon"></i>
                <div class="menu" tabindex="-1">
                    @if(isset($affiliates))
                      @foreach($affiliates as $affiliate)
                       <div class="item info-label">
                          <a href="{{ $affiliate->link }}" target="_blank" title="{{ $affiliate->name }}" alt="{{ $affiliate->name }}">
                            {{ $affiliate->name }}
                          </a>
                      </div>
                      @endforeach
                  @endif
                </div>
            </div>
        </td>
        @if(Auth::user())
        <td class="right">
            <a class="add-watchlist @if(in_array($market->symbol, $favorite_coins)) favorite @endif" 
            id="id_{{ $market->symbol }}" coin= "{{ $market->symbol }}"
            style="cursor: pointer;">
                <i class="fa fa-heart fa-fw"></i>
            </a>
        </td>
        @endif
    </tr> 
    <?php $i++; ?>
    @endforeach 
  </tbody>
</table> 
{{ $all_markets->links() }}
@if($all_markets->links() != '')
<ul class="custom-pagination" style="float: right;">
  <li style="list-style-type:none"><a href="{{ makeUrl('currencies') }}">@lang('pagination.FIRST')</a></li>
</ul> 
@endif 
</div>
</div> 
@stop
