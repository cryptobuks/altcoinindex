@extends(getCurrentTemplate() . '.layouts.default')
@section('meta_title')@lang('fear.FEAR_GREED_TITLE')@stop
@section('meta_desc')@lang('fear.FEAR_GREED_DESCRIPTION')@stop
@section('meta_link'){{ Request::url() }}@stop
@section('meta_image'){{ URL::asset('public/images/pages/images') . '/fear_greed.png' }}@stop
@section('scripts')
<script src="{{ URL::asset('public/js/amchart/core.js') }}"></script>
<script src="{{ URL::asset('public/js/amchart/charts.js') }}"></script>
<script src="{{ URL::asset('public/js/amchart/animated.js') }}"></script>
<script>
function loadFearGreedChart() {
    var t = $(".time-frame :selected").val();
    $.getJSON('{{URL::to("/")}}/ajax-load-fear-greed-data/' + t, function(res_data) {
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.data = res_data;
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        var series = chart.series.push(new am4charts.StepLineSeries());
        series.dataFields.dateX = "date";
        series.dataFields.valueY = "visits";
        series.tooltipText = "@lang('fear.FEAR_GREED_GRAPH_TOOLTIP'): {valueY.value}";
        chart.cursor = new am4charts.XYCursor();
        series.fillOpacity = 0.5;
        series.fill = am4core.color("#00b5ad");
        series.stroke = am4core.color("#00b5ad");
        series.strokeWidth = 3;
    });
}
am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv2", am4charts.GaugeChart);
    chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect
    chart.innerRadius = -25;
    var axis = chart.xAxes.push(new am4charts.ValueAxis());
    axis.min = 0;
    axis.max = 100;
    axis.strictMinMax = true;
    axis.renderer.grid.template.stroke = new am4core.InterfaceColorSet().getFor("background");
    axis.renderer.grid.template.strokeOpacity = 0.3;
    var colorSet = new am4core.ColorSet();
    var range0 = axis.axisRanges.create();
    range0.value = 0;
    range0.endValue = 30;
    range0.axisFill.fillOpacity = 1;
    range0.axisFill.fill = '#ff847c';
    range0.axisFill.zIndex = - 1;
    var range1 = axis.axisRanges.create();
    range1.value = 30;
    range1.endValue = 50;
    range1.axisFill.fillOpacity = 1;
    range1.axisFill.fill = '#ffe78f';
    range1.axisFill.zIndex = -1;
    var range2 = axis.axisRanges.create();
    range2.value = 50;
    range2.endValue = 75;
    range2.axisFill.fillOpacity = 1;
    range2.axisFill.fill = '#ade498';
    range2.axisFill.zIndex = -1;
    var range2 = axis.axisRanges.create();
    range2.value = 75;
    range2.endValue = 100;
    range2.axisFill.fillOpacity = 1;
    range2.axisFill.fill = '#96bb7c';
    range2.axisFill.zIndex = -1;
    var hand = chart.hands.push(new am4charts.ClockHand());
    chart.setTimeout(randomValue, 2000);
    function randomValue() {
        hand.showValue(@if(isset($latest_fear_greed_index->value)){{ $latest_fear_greed_index->value }}@endif, am4core.ease.cubicOut);
    }
});
function checkTime(i) {
    if (i<10) {i = "0" + i}; 
    return i;
}
var today = new Date('<?php print date("F d, Y H:i:s", strtotime("next day 0:0")-time())?>');
function updateRemainingTime() {
    today.setSeconds(today.getSeconds()-1)
    var hour=today.getHours();
    var minute=today.getMinutes();
    var second=today.getSeconds();
    minute = checkTime(minute);
    second = checkTime(second);
    var remaining_time = hour+" @lang('fear.HOURS'), "+minute+" @lang('fear.MINUTES'), "+second+" @lang('fear.SECONDS')";
    $('span#remaining_time').html('').html(remaining_time);
}setInterval(updateRemainingTime, 1000);
$(document).ready(function() {loadFearGreedChart();});
</script>
@stop
@section('styles')<style>.card {box-shadow: 1px 3px 15px 0px rgba(0, 0, 0, 0.14);border: none;}
.card {position: relative;display: flex;flex-direction: column;min-width: 0;
    word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.125);border-radius: 0.25rem;}.card-body {flex: 1 1 auto;padding: 0 .25rem;text-align: center;font-weight: 700;}.mb-3, .my-3 {margin-bottom: 1.5rem !important;
}.is-4{font-size: 24px; float: left;padding: 15px;display: block;clear: both;margin-top: 0px;}
.fng-countdown{clear: both;display: block;top: 80px;position: relative;}
.historical-records{clear: both; float: left;padding: 5px;}
.historical-records .field{float: left;width: 100%;font-size: 16px;}
.historical-records .field hr{clear: both;margin: unset;padding: unset;}
.greed-meter hr{margin: 5px;padding: 1px;}
.greed-meter span{float: right;margin: 4px;font-weight: normal;font-size: 11px;font-style: italic;}
.value-div .left{float: left;font-size: 18px;font-weight: 500;}
.value-div .right{float: right;font-size: 18px;background: blue;color: white;padding: 5px;border-radius: 50px;margin: -5px;top: -12px;position: relative;}
.field{padding: 10px; font-size: 20px; font-weight: normal;}
.has-text-centered{font-weight: normal;font-size: 14px;}
.card-body.height {height: 350px;}</style>
@stop
@section('content')
<div class="tab ui active">
    <div class="box box-success table-heading-class">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('fear.FEAR_GREED_PAGE')</h3>
            <h1 class="sr-only">@lang('fear.FEAR_GREED_PAGE')</h1>
            <h2 class="sr-only">Every day emotions and sentiments analysis of cryptocurrency</h2>
            <h2 class="sr-only">Fear and greed index of bitcoin</h2>
        </div>
        <p style="padding: 10px;">@lang('fear.FEAR_GREED_DESC')</p>
    </div>
</div>
@if(count($fear_greed_indexes) > 0)
<div class="tab ui active">
    <div class="row">
        <div class="col-12">
            <div class="col-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 mb-4">
                <div class="card greed-meter" href="" title="">  
                    <div class="card-body height">
                        <h2 class="title is-4">@lang('fear.FEAR_GREED_INDEX')</h2>
                        <div style="clear: both;">
                            <div id="chartdiv2" style="height: 240px;"></div>
                        </div>
                        <hr />
                        <span>@lang('fear.UPDATED'): {{ date("M, j Y", $latest_fear_greed_index->timestamp) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 mb-4">
                <div class="card" href="" title="">  
                    <div class="card-body height">
                        <h2 class="title is-4">@lang('fear.FEAR_GREED_HV')</h2> 
                        <div class="historical-records">
                            <?php
                            $historical_labels = [
                                strtotime(date('Y-m-d', strtotime('0 days'))) => __('fear.NOW'), 
                                strtotime(date('Y-m-d', strtotime('-1 day'))) => __('fear.YESTERDAY'), 
                                strtotime(date('Y-m-d', strtotime('-7 days'))) => __('fear.WEEK'), 
                                strtotime(date('Y-m-d', strtotime('-30 days'))) => __('fear.MONTH')
                            ];
                            ?>
                            @foreach($fear_greed_indexes as $fear_greed_index)
                                @if(isset($historical_labels[$fear_greed_index->timestamp]))
                                <div class="field">
                                    <div style="text-align: left;">
                                        {{ $historical_labels[$fear_greed_index->timestamp] }}
                                    </div>
                                    <div class="value-div">
                                        <div class="left" style="color:<?php echo getColor($fear_greed_index->value_classification) ?>">{{ $fear_greed_index->value_classification }}</div>
                                        <div class="right" style="background:<?php echo getColor($fear_greed_index->value_classification) ?>">{{ $fear_greed_index->value }}</div>
                                    </div>
                                    <hr />
                                </div> 
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 mb-4">
                <div class="card" href="" title="">  
                    <div class="card-body height">
                        <h2 class="title is-4">@lang('fear.FEAR_GREED_NU')</h2> 
                        <div class="fng-countdown">
                            <div class="field">@lang('fear.FEAR_GREED_NU_TEXT')</div> 
                            <div class="has-text-centered">
                                <span id="remaining_time"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab ui active" style="padding-top: 15px;">
    <div class="ui segment" style="padding: unset;">
        <div class="coins_page_headings latest-block-btn">
            <div class="box box-success table-heading-class">
                <div class="box-header with-border" style="float: left;border-bottom: unset;">
                    <h3 class="box-title">@lang('fear.FEAR_GREED_MAP_TITLE')</h3>
                </div>
                <div class="pull-right time-frame-select-box" style="margin: 5px;">
                    <div class="btn-group">
                        <select class="time-frame form-control" style="font-size: unset;" onchange="loadFearGreedChart()">
                            <option value="7 day">7 @lang('menu.DAYS')</option>
                            <option value="1 months">1 @lang('menu.MONTH')</option>
                            <option value="3 months" selected="selected">3 @lang('menu.MONTHS')</option>
                            <option value="6 months">6 @lang('menu.6_MONTHS')</option>
                            <option value="1 year">1 @lang('menu.YEAR')</option>
                            <option value="2 year">2 @lang('menu.YEARS')</option>
                            <option value="all">@lang('menu.ALL')</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div id="chartdiv" style="height: 400px;clear: both;"></div>
    </div>
</div>
<div class="tab ui active" style="padding-top: 15px;">

    <div class="box box-success table-heading-class">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('fear.WHY_FEAR_GREED')</h3>
            <span style="float: right;font-style: italic;">
                <a target="_blank" rel="nofollow noopener noreferrer" href="https://alternative.me/crypto/fear-and-greed-index/">@lang('fear.SOURCE')</a>
            </span>
        </div>
        <div style="padding: 10px;">
            <p>@lang('fear.WHY_FEAR_GREED_DESC_1')</p>
            <ul>
                <li>@lang('fear.WHY_FEAR_GREED_DESC_2')</li>
                <li>@lang('fear.WHY_FEAR_GREED_DESC_3')</li>
            </ul>
            <p>@lang('fear.WHY_FEAR_GREED_DESC_4')</p>
        </div>
    </div>
</div>
@else
<div class="tab ui active" style="padding-top: 15px;">
    <div class="ui segment">No record yet!</div>
</div>
@endif
<br />
@include('default.includes.disqus')
@stop
