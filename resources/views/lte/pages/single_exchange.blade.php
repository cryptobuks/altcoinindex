@extends(getCurrentTemplate() . '.layouts.default')
@section('meta_title'){{ $crypto_exchange->name }} crypto exchange @stop
@section('meta_desc'){{ $crypto_exchange->description }}@stop
@section('meta_link'){{ Request::url() }}@stop
@section('meta_image'){{ $crypto_exchange->logo }}@stop
@section('styles')<style>.card {
    box-shadow: 1px 3px 15px 0px rgba(0, 0, 0, 0.14);
    border: none;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
}.card-body {
    flex: 1 1 auto;
    padding: 0 .25rem;
    text-align: center;
    font-weight: 700;
}.mb-3, .my-3 {
    margin-bottom: 1.5rem !important;
}.pool-detail img{width: 115px;float: left;margin: 0 10px 0 0;border: 1px solid #eee;}
.pool-detail p {font-size: 20px; font-weight: 500;line-height: 29px;}
.pool-detail button {color: white!important;} 
.coin-detail-social-buttons{float:right}.coin-detail-table th{background-color:#2c3b41!important}.coin-detail,.coin-detail:hover{color:#fff}.content{min-height:10px!important}.info-box{background:#FFF;border:1px solid #EEE;overflow:hidden;border-radius:0;margin-bottom:-1px;min-height:10px}.info-label{background:#f9f9f9;font-size:11px;color:#444;font-weight:700;border-bottom:1px solid #EEE}.info-box .info-text{font-size:12px;color:#777;white-space:nowrap;min-height:25px}.info-box .info-text,.info-label{line-height:25px;padding-left:10px;padding-right:10px}@media (max-width:767px){.coin-detail-wrapper{display:none}.partial-coin-detail-wrapper{display:block}}@media (min-width:767px){.partial-coin-detail-wrapper{display:none}}.coin-detail-page-header ul{list-style:none;margin-top:-35px;margin-bottom:-15px;padding:unset}.coin-detail-page-header ul li{display:inline-block;padding:4px;font-size:18px}div#markets .table-responsive,div#price_history .table-responsive{overflow-x:hidden!important}.social-container .reddit,.social-container .twitter{height:600px;overflow:auto}.social-container{padding-top:20px}.social-container .reddit{padding-left:25px}.ui.teal.label,.ui.teal.labels .label{background-color:#337ab7!important;border-color:#337ab7!important}.ui.ribbon.label:after{border-right-color:#337ab7!important}.ui.segment{margin-top:unset}.green{color: green;}.red{color: red;}
</style>
@stop
@section('content')
<div class="box box-success table-heading-class">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $crypto_exchange->name }}</h3>
        <h1 class="sr-only">{{ $crypto_exchange->name }}</h1>
    </div>
</div>
<div class="ui segment">
    <div class="row">
        <div class="col-md-5 pool-detail">
            <img class="img-fluid" src="{{ $crypto_exchange->logo }}" title="{{ $crypto_exchange->name }}" alt="{{ $crypto_exchange->name }}" style="width: 120px;">
        </div>
    </div><br />
    <p>{{ $crypto_exchange->description }}.</p>
    <div style="margin-top: 20px;" class="ui grid aligned">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
                <div class="info-label">@lang('v8.ORDER_BOOK') </div>
                <div class="info-text"> 
                    @if($crypto_exchange->order_book == 0)
                        <span style="color: red;">No</span>
                    @else
                        <span style="color: green;">Yes</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
                <div class="info-label">@lang('v8.TRADES')</div>
                <div class="info-text">
                    @if($crypto_exchange->trades == 0)
                        <span style="color: red;">No</span>
                    @else
                        <span style="color: green;">Yes</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
                <div class="info-label"> @lang('v8.TYPE') </div>
                <div class="info-text">
                    {{ $crypto_exchange->centralization_type }}
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
                <div class="info-label">@lang('v8.COUNTRY')</div>
                <div class="info-text">
                    {{ $crypto_exchange->country }}
                </div>
            </div>
        </div>
    </div> <br />
    <h4>@lang('v8.FEES')</h4>
    <p>{{ $crypto_exchange->fees }}</p>
    <h4>@lang('v8.RATING')</h4>
    <p>{{ $crypto_exchange->rating }}/5 </p>
    <h4>@lang('v8.FULL_ADDRESS')</h4>
    <p>{{ $crypto_exchange->full_address }}</p><br />
    <a href="@if($crypto_exchange->affiliate_url == '') {{$crypto_exchange->url}} @else {{$crypto_exchange->affiliate_url}} @endif" target="_blank" title="{{ $crypto_exchange->name }}" rel="nofollow noopener noreferrer">
        <button class="btn btn-primary">@lang('v8.ACCOUNT')</button>
    </a>
</div>
@if(isset($crypto_exchanges))
<div class="box box-success table-heading-class">
    <div class="box-header with-border">
        <h3 class="box-title">@lang('v8.RELATED_EXCHANGES')</h3>
        <h1 class="sr-only">@lang('v8.RELATED_EXCHANGES')</h1>
    </div>
    <p style="margin: 10px;">@lang('v8.RELATED_EXCHANGES_DESC')<br />&nbsp;</p>
</div>
<div class="row">
    @foreach ($crypto_exchanges as $exchange)
    <div class="col-4 col-xl-2 col-lg-2 col-md-3 col-sm-4 mb-3">    
        <a class="card" href="{{ makeUrl('crypto-exchanges') }}/{{ $exchange->alias }}" title="{{ $exchange->name }}">  
            <img class="img-fluid" src="{{ $exchange->logo }}" title="{{ $exchange->name }}" alt="{{ $exchange->name }}" style="width: 100%;border-bottom: 1px solid #eee;height: 130px;">
            <div class="card-body">
            <h5 class="mb-0"><strong>{{ str_limit(ucfirst(strtolower($exchange->name)), 15) }}</strong></h5>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endif
@include('default.includes.disqus')
@stop
