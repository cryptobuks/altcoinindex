@extends(getCurrentTemplate() . '.layouts.default')
@section('meta_title')@lang('seo.ACTIVE_ICO_TITLE')@stop
@section('meta_desc')@lang('seo.ACTIVE_ICO_DESCRIPTION')@stop
@section('meta_link'){{ Request::url() }}@stop
@section('meta_image'){{ URL::asset('public/images/pages/images') . '/ico.png' }}@stop
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
}</style>
@stop
@section('content')
<div class="tab ui active">
    <div class="ui segment">
        <div class="coins_page_headings latest-block-btn">
            <div class="ui teal large ribbon label"><i class="tag icon"></i></div>
            <h1>@lang('v7.ICOS_PAGE')</h1>
            <h2 class="sr-only">A complete list of crypto icos</h2>
            <h2 class="sr-only">Initial coin offerings</h2>
        </div>
        <div class="ui divider"></div>
        <p>@lang('v7.ICOS_DESC')</p>
    </div>
    <div class="row">
        @foreach ($icos as $ico)
            <div class="col-4 col-xl-2 col-lg-2 col-md-3 col-sm-4 mb-3">    
                <a class="card" href="{{ makeUrl('crypto-ico') }}/{{ $ico->alias }}" title="{{ $ico->name }}">  
                    @if(file_exists('public/storage/' . $ico->image))
                    <img class="img-fluid" alt="{{$ico->name}}" title="{{$ico->name}}" src="{{URL::asset('public/storage/' . $ico->image)}}" style="width: 100%;border-bottom: 1px solid #eee;min-height: 185px;" />
                    @elseif($ico->coin_image != '' && file_exists('public/images/coins_icons/' . $ico->coin_image))
                    <img class="img-fluid" alt="{{$ico->name}}" title="{{$ico->name}}" src="{{URL::asset('public/images/coins_icons/' . $ico->coin_image)}}" style="width: 100%;border-bottom: 1px solid #eee;min-height: 185px;" />
                    @else
                    <img class="img-fluid" alt="{{$ico->name}}" title="{{$ico->name}}" src="{{URL::asset('public/images/default_coin.png')}}" style="width: 100%;border-bottom: 1px solid #eee;min-height: 185px;" />
                    @endif
                    <div class="card-body">
                    <h5 class="mb-0"><strong>{{ str_limit(ucfirst(strtolower($ico->name)), 15) }}</strong></h5>
                    </div>
                </a>
            </div>
        @endforeach
        <div style="clear: both;margin: 15px;">
            @if($icos->links() != '')
                {{ $icos->links() }}
            @endif
        </div>
    </div>
</div>
@include('default.includes.disqus')
@stop
