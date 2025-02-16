@extends(getCurrentTemplate() . '.layouts.default') @section('meta_title')@lang('seo.MINING_TITLE')@stop @section('meta_desc')@lang('seo.MINING_DESCRIPTION')@stop @section('meta_link'){{ Request::url() }}@stop @section('meta_image'){{ URL::asset('public/images/pages/images') . '/mining.png' }}@stop @section('content')  

<div class="panel panel-default">
    <div class="box box-success table-heading-class">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $sub_heading }}</h3>
            <h1 class="sr-only">{{ $sub_heading }}</h1>
        </div>
    </div>
</div>
<div class="row">
   @foreach ($mining_equipments as $equipment)  
   <div class="col-md-3" style="padding-bottom: 10px;">
      <div style="background: white;border:1px solid rgba(0, 0, 0, 0.125);box-shadow: 1px 3px 15px 0px rgba(0, 0, 0, 0.14);border-radius: 2px;">
      <div class="image" style="border-bottom: 1px solid #ccc;"> 
         <img class="image" src="{{ $equipment->logo }}" alt="{{ $equipment->name }}" title="{{ $equipment->name }}" style="width: 100%;"> 
      </div>
      <div class="content" style="min-height: 335px;">
         <div class="header" style="font-size: 14px;">{{ $equipment->name }}</div>
         <div class="ui divider"></div>
         <div class="description">
            <div class="ui list">
               <div class="item">
                  <i class="microchip icon"></i> 
                  <div class="content">
                     <div class="header">@lang('v7.ALGO')</div>
                     <div class="description">{{ $equipment->algorithm }}</div>
                  </div>
               </div>
               <div class="item">
                  <i class="slack hash icon"></i> 
                  <div class="content">
                     <div class="header">@lang('v7.HASHES')</div>
                     <div class="description">{{ $equipment->hashes_per_second }}</div>
                  </div>
               </div>
               <div class="item">
                  <i class="dollar sign icon"></i> 
                  <div class="content">
                     <div class="header">@lang('v7.COST')</div>
                     <div class="description">{{ $equipment->cost }} {{ $equipment->currency }}</div>
                  </div>
               </div>
               <div class="item">
                  <i class="hdd icon"></i> 
                  <div class="content">
                     <div class="header">@lang('v7.TYPE')</div>
                     <div class="description">{{ $equipment->type }}</div>
                  </div>
               </div>
               <div class="item">
                  <i class="power off icon"></i> 
                  <div class="content">
                     <div class="header">@lang('v7.POWER')</div>
                     <div class="description">{{ $equipment->power_consumption }}</div>
                  </div>
               </div>
               <div class="item">
                  <i class="bitcoin icon"></i> 
                  <div class="content">
                     <div class="header">@lang('v7.CURRENCIES_AVAIL')</div>
                     <div class="description">{{ $equipment->currencies_available }}</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <a href="@if($equipment->affiliate == '') {{ $equipment->url }} @else {{ $equipment->affiliate }}  @endif" target="_blank" style="color:#fff"><button class="fluid ui button orange" style="color:#fff">@lang('v7.BUY')</button> </a>  
   </div>
</div>
   @endforeach 
</div>
{{ $mining_equipments->links() }}
<br /><br />@stop
