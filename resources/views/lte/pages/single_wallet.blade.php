@extends(getCurrentTemplate() . '.layouts.default')
@section('meta_title'){{ $wallet->name }} - Crypto Wallet @stop
@section('meta_desc')@lang('v7.WALLET_SEO_DESC', [
    'name' => "$wallet->name",
    'coins' => "$wallet->coins",
    'validation ' => "$wallet->validation_type ",
    'ease_of_use ' => "$wallet->ease_of_use ",
    'personal' => "$wallet->security",
    'anonymity ' => "$wallet->anonymity ",
    'wallet_features ' => "$wallet->wallet_features ",
    'platforms ' => "$wallet->platforms "
])@stop
@section('meta_link'){{ Request::url() }}@stop
@section('meta_image'){{ $wallet->logo }}@stop
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
        <h3 class="box-title">@lang('v7.WALLET'): {{ $wallet->name }}</h3>
        <h1 class="sr-only">@lang('v7.WALLET'): {{ $wallet->name }}</h1>
    </div>
</div>
<div class="ui segment">
    <div class="row">
        <div class="col-md-5 pool-detail">
            @if(file_exists('public/storage/' . $wallet->logo))
            <img class="img-fluid" src="{{URL::asset('public/storage/' . $wallet->logo)}}" title="{{ $wallet->name }}" alt="{{ $wallet->name }}">
            @else
            <img class="img-fluid" src="{{ $wallet->logo }}" title="{{ $wallet->name }}" alt="{{ $wallet->name }}">
            @endif
            <div style="">
                <p style="font-size: 30px;">{{ $wallet->name }}</p>
                <p>@lang('v7.ANONYMITY'): {{ $wallet->anonymity }}</p>
                <p>
                    <a href="@if($wallet->affiliate == '') {{ $wallet->affiliate_url }} @else {{ $wallet->affiliate }} @endif" target="_blank" rel="nofollow noopener" style="font-size: 18px;">
                        <button class="ui button active logs bl">@lang('v7.WALLET_WEBSITE')</button>
                    </a>
                </p>
            </div>
        </div>
    </div><br />
    <p style="word-break: break-all;">
        <?php
            if($wallet->affiliate == '') {
                $wallet_link = $wallet->affiliate_url;
            } else {
                $wallet_link = $wallet->affiliate;
            }
        ?>
        @lang('v7.WALLET_DESC', [
            'name' => "<strong>$wallet->name</strong>",
            'coins' => "<strong>$wallet->coins</strong>",
            'validation ' => "<strong>$wallet->validation_type</strong> ",
            'ease_of_use ' => "<strong>$wallet->ease_of_use</strong> ",
            'personal' => "<strong>$wallet->security</strong>",
            'anonymity ' => "<strong>$wallet->anonymity</strong> ",
            'wallet_features ' => "<strong>$wallet->wallet_features</strong> ",
            'platforms ' => "<strong>$wallet->platforms</strong> ",
            'affiliate_url ' => $wallet_link
        ])
    </p>
    <div style="margin-top: 20px;" class="ui grid aligned">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
                <div class="info-label">@lang('v7.HAS_ATTACHED_CARD') </div>
                <div class="info-text">
                    @if($wallet->has_attched_card == 0)
                        <span style="color: red;">False</span>
                    @else
                        <span style="color: green;">True</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
                <div class="info-label">@lang('v7.HAS_TRADING')</div>
                <div class="info-text">
                    @if($wallet->has_trading_facilities == 0)
                        <span style="color: red;">False</span>
                    @else
                        <span style="color: green;">True</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
                <div class="info-label"> @lang('v7.FEATURED') </div>
                <div class="info-text">
                    @if($wallet->featured == 0)
                        <span style="color: red;">No</span>
                    @else
                        <span style="color: green;">Yes</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="info-box">
                <div class="info-label">@lang('v7.HAS_OFFER')</div>
                <div class="info-text">
                    @if($wallet->has_vouchers_and_offers == 0)
                        <span style="color: red;">No</span>
                    @else
                        <span style="color: green;">Yes</span>
                    @endif
                </div>
            </div>
        </div>
    </div><br /><br />
    <p>
        <strong>@lang('v7.COINS')</strong>
        <?php
            $coins = explode(',', $wallet->coins);
            foreach ($coins as $key => $value) {
                ?>
                    <span class="ui label">{{ $value }}</span>
                <?php
            }
        ?>
    </p>
    @if($wallet->wallet_features)
    <p>
        <strong>@lang('v7.WALLET_FEATURES')</strong>
        <?php
            $coins = explode(',', $wallet->wallet_features);
            foreach ($coins as $key => $value) {
                ?>
                    <span class="ui label">{{ $value }}</span>
                <?php
            }
        ?>
    </p>
    @endif
    <p>
        <strong>@lang('v7.PLATFORMS')</strong>
        <?php
            $coins = explode(',', $wallet->platforms);
            foreach ($coins as $key => $value) {
                ?>
                    <span class="ui label">{{ $value }}</span>
                <?php
            }
        ?>
    </p>
    <p>
        <strong>@lang('v7.VALIDATION_TYPE')</strong>
        <span class="ui label">{{ $wallet->validation_type }}</span>
    </p>
    <p>
        <strong>@lang('v7.EASE_OF_USE')</strong>
        <span class="ui label">{{ $wallet->ease_of_use }}</span>
    </p>
    <p>
        <strong>@lang('v7.ANONYMITY')</strong>
        <span class="ui label">{{ $wallet->anonymity }}</span>
    </p>
    @if($wallet->source_code_url != '')
    <p>
        <a href="{{ $wallet->source_code_url }}" target="_blank" rel="nofollow noopener" style="font-size: 18px;">
            <button class="ui button active logs bl" style="color: white!important;">@lang('v7.SOURCE_CODE_URL')</button>
        </a>
    </p>
    @endif
</div>
@if($wallets)
<div class="box box-success table-heading-class">
    <div class="box-header with-border">
        <h3 class="box-title">@lang('v7.RELATED_WALLETS')</h3>
        <h1 class="sr-only">@lang('v7.RELATED_WALLETS')</h1>
    </div>
    <p style="padding: 10px;">@lang('v7.RELATED_WALLETS_DESC')</p>
</div>
<div class="row">
    @foreach ($wallets as $wallet)
    <div class="col-4 col-xl-2 col-lg-2 col-md-3 col-sm-4 mb-3">
        <a class="card" href="{{ makeUrl('wallets') }}/{{ $wallet->alias }}" title="{{ $wallet->name }}">
            @if(file_exists('public/storage/' . $wallet->logo))
            <img class="img-fluid" src="{{URL::asset('public/storage/' . $wallet->logo)}}" title="{{ $wallet->name }}" alt="{{ $wallet->name }}" style="width: 100%;border-bottom: 1px solid #eee;height: 182px;">
            @else
            <img class="img-fluid" src="{{ $wallet->logo }}" title="{{ $wallet->name }}" alt="{{ $wallet->name }}" style="width: 100%;border-bottom: 1px solid #eee;height: 182px;">
            @endif
            <div class="card-body">
            <h5 class="mb-0"><strong>{{ str_limit(ucfirst(strtolower($wallet->name)), 15) }}</strong></h5>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endif
@include('default.includes.disqus')
@stop
