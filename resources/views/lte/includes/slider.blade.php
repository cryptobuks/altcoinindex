@if(setting('site.slider') == 1) @if(Request::is('*/dashboard') || Request::path() == LaravelLocalization::getCurrentLocale())
  <style type="text/css">
  .slider-wrapper {padding-bottom: 15px;}
  div.carousel-inner img {width: 100%}
  .carousel-control { width: 5%; }
  .carousel-control.right {margin-right: 15px;}
  .box-body {padding: unset;margin: unset;}
  .carousel-caption {font-size: 2em; bottom: 0px; right: unset; left: unset; width: 100%;padding-bottom: 20px;background: #000; opacity: 0.7}
   @media only screen and (max-width: 768px)  {.carousel-caption {font-size: 1em;}}
    @media only screen and (max-width: 400px)  {.carousel-caption {display: none;}}
  </style>
  <div class="row slider-wrapper">
    <div class="col-lg-12">
      <div class="box-body">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @php
            $i = 1;
            @endphp
            @foreach($slider_images as $image)
              <div class="item @if($i == 1) active @endif">
                <a href="{{ $image->page_link }}">
                    <img src="{{URL::asset('public/storage/' . $image->image_link)}}" alt="{{ $image->name }}" title="{{ $image->name }}">
                    <div class="carousel-caption">
                      {{ $image->text }}
                    </div>
                </a>
              </div>
              @php
              $i++;
              @endphp
            @endforeach         
          </div>
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="fa fa-angle-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="fa fa-angle-right"></span>
          </a>
        </div>
      </div>
    </div>
  </div>      
  @endif
@else
<br />
@endif
