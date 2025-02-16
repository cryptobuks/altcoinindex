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
</style>
@stop
@section('content')
<div class="ui segment latest-block-btn">
    <div class="coins_page_headings">
        <div class="ui teal large ribbon label"><i class="tag icon"></i></div>
        <h1>{{ $crypto_exchange->name }}</h1>
    </div>
    <div class="ui divider"></div>
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
    <p>{{ $crypto_exchange->full_address }}</p> <br />
    <a href="@if($crypto_exchange->affiliate_url == '') {{$crypto_exchange->url}} @else {{$crypto_exchange->affiliate_url}} @endif" target="_blank" title="{{ $crypto_exchange->name }}" rel="nofollow noopener noreferrer">
        <button class="btn btn-primary">@lang('v8.ACCOUNT')</button>
    </a>
</div>
@if(isset($crypto_exchanges))
<div class="ui segment latest-block-btn">
    <div class="coins_page_headings">
        <div class="ui teal large ribbon label"><i class="tag icon"></i></div>
        <h1>@lang('v8.RELATED_EXCHANGES')</h1>
    </div>
    <div class="ui divider"></div>
    <p>@lang('v8.RELATED_EXCHANGES_DESC')</p>
</div>
<div class="row">
    @foreach ($crypto_exchanges as $exchange)
    <div class="col-4 col-xl-2 col-lg-2 col-md-3 col-sm-4 mb-3">    
        <a class="card" href="{{ makeUrl('crypto-exchanges') }}/{{ $exchange->alias }}" title="{{ $exchange->name }}">  
            <img class="img-fluid" src="{{ $exchange->logo }}" title="{{ $exchange->name }}" alt="{{ $exchange->name }}" style="width: 100%;border-bottom: 1px solid #eee;height: 160px;">
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
