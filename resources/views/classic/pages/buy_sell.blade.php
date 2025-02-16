@extends(getCurrentTemplate() . '.layouts.default') @section('meta_title')@lang('seo.BUY_SELL_PAGE_TITLE')@stop @section('meta_desc')@lang('seo.BUY_SELL_PAGE_DESC')@stop @section('meta_link'){{ Request::url() }}@stop @section('meta_image'){{ URL::asset('public/images/pages/images')
. '/buy_sell.png' }}@stop @section('scripts') 
@stop @section('content')
<div class="row">
  <div class="col-md-12">
    <div class="ui segment coins_page_headings">
      <div class="ui teal large ribbon label"><i class="tag icon"></i></div>
      <h1>@lang('menu.BUY_SELL')</h1>
    </div>
  </div>
<div class="row">
  <div class="col-md-12">
    <div class="login-panel panel panel-default" style="margin:0">
      <div class="panel-body form-section" style="margin-top: 10px;">

        <script src="https://widget.changelly.com/affiliate.js"></script> <iframe src="https://widget.changelly.com?from=*&to=*&amount=1&address={{env('SITE_URL')}}&fromDefault=btc&toDefault=eth&theme=aqua&merchant_id={{ setting('3rdparty.changelly_affiliate_id') }}&payment_id=&v=2" width="100%" height="500" class="changelly" scrolling="no" onLoad="function at(t){var e=t.target,i=e.parentNode,n=e.contentWindow,r=function(){return n.postMessage({width:i.offsetWidth},it.url)};window.addEventListener('resize',r),r()};at.apply(this, arguments);" style="min-width: 100%; overflow-y: hidden; border: none">Can't load widget</iframe>    

      <div class="row table-benefits text-center">
      <section class="col-xs-4" style="padding:0 60px">
        <h2 class="text-bold"><span>@lang('v6.CHANGELLY_FAIR')</span></h2><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjEwIiBoZWlnaHQ9IjIyNSIgdmlld0JveD0iMCAwIDIxMCAyMjUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHRpdGxlPmljX2ZhaXI8L3RpdGxlPjxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PHBhdGggZD0iTTY4Ljg1NSAxNUwxNSA2OC44NTUiIGZpbGw9IiMwRURBN0MiLz48cGF0aCBkPSJNNjguODU1IDE1TDE1IDY4Ljg1NSIgc3Ryb2tlLW9wYWNpdHk9Ii43IiBzdHJva2U9IiNGNUY1RjUiIHN0cm9rZS13aWR0aD0iMzAiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPjxwYXRoIGQ9Ik0xMjYuNjg3IDI5LjQ1OGwtOTcuNTkgOTcuNTkiIGZpbGw9IiMwRURBN0MiLz48cGF0aCBkPSJNMTI2LjY4NyAyOS40NThsLTk3LjU5IDk3LjU5IiBzdHJva2Utb3BhY2l0eT0iLjciIHN0cm9rZT0iI0Y1RjVGNSIgc3Ryb2tlLXdpZHRoPSIzMCIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZD0iTTE4NS4yNDEgNDMuMTkzbC0xMDIuNjUgMTAyLjY1IiBmaWxsPSIjMEVEQTdDIi8+PHBhdGggZD0iTTE4NS4yNDEgNDMuMTkzbC0xMDIuNjUgMTAyLjY1IiBzdHJva2Utb3BhY2l0eT0iLjciIHN0cm9rZT0iI0Y1RjVGNSIgc3Ryb2tlLXdpZHRoPSIzMCIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZD0iTTE5NC42MzkgMTA2LjA4NEw5MS4yNjUgMjA5LjQ1OCIgZmlsbD0iIzBFREE3QyIvPjxwYXRoIGQ9Ik0xOTQuNjM5IDEwNi4wODRMOTEuMjY1IDIwOS40NTgiIHN0cm9rZS1vcGFjaXR5PSIuNyIgc3Ryb2tlPSIjRjVGNUY1IiBzdHJva2Utd2lkdGg9IjMwIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz48cGF0aCBkPSJNMTY0LjI0NCA5MC4zNTNhNS42NzIgNS42NzIgMCAxIDEtMTEuMzQ0IDAgNS42NzIgNS42NzIgMCAwIDEgMTEuMzQ0IDB6TTU0LjU4IDQxLjE5M2E1LjY3MiA1LjY3MiAwIDEgMS0xMS4zNDQuMDAxIDUuNjcyIDUuNjcyIDAgMCAxIDExLjM0NCAwem0xNi4zODYtNS42NzJhMi41MjEgMi41MjEgMCAxIDEtNS4wNDIgMCAyLjUyMSAyLjUyMSAwIDAgMSA1LjA0MiAwek03Ny44OCAxNTYuNTNIMzMuNzgyQTMuNzgyIDMuNzgyIDAgMCAxIDMwIDE1Mi43NDdWNjEuOTkyYTMuNzgyIDMuNzgyIDAgMCAxIDMuNzgxLTMuNzgyaDEwMi4xMDFhMy43ODIgMy43ODIgMCAwIDEgMy43ODIgMy43ODJ2MzkuNzA3bS0xMDAuODQgMTUuMTI2di0xMy40NzciIHN0cm9rZT0iIzYxNjE2MSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz48cGF0aCBkPSJNNzcuODgxIDE0Ny43MDZINDEuMzQ0YTIuNTIxIDIuNTIxIDAgMCAxLTIuNTItMi41MjF2LTcuMzM2bTAtNjAuODg5di03LjQwNmEyLjUyMSAyLjUyMSAwIDAgMSAyLjUyLTIuNTJoODYuOTc1YTIuNTIxIDIuNTIxIDAgMCAxIDIuNTIxIDIuNTJ2MjcuNzI3IiBzdHJva2U9IiM2MTYxNjEiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZD0iTTgxLjY4IDEzMi41OGMwIC41NzMuMDEzIDEuMTQuMDQ1IDEuNzA4YTI2Ljg5IDI2Ljg5IDAgMCAxLTEwLjUxMy0zLjQ4Yy01LjItNC45NC04LjQzOS0xMS45MTctOC40MzktMTkuNjU3IDAtMTQuOTY4IDEyLjEzMi0yNy4xIDI3LjEtMjcuMSA0Ljk2NyAwIDkuNjE5IDEuMzM2IDEzLjYyIDMuNjYxYTI3LjAyMiAyNy4wMjIgMCAwIDEgNi4xOSA4LjgzYy0xNi4wOTcgNC4wODQtMjguMDAyIDE4LjY3NC0yOC4wMDIgMzYuMDM4IiBmaWxsPSIjMTBEMDc4Ii8+PHBhdGggZD0iTTgxLjcyNSAxMzQuMjk0Yy0xMy41MDctMS41MzctMjMuOTk0LTEzLjAwOC0yMy45OTQtMjYuOTI0IDAtMTQuOTY5IDEyLjEzMi0yNy4xMDEgMjcuMS0yNy4xMDEgMTEuMTE4IDAgMjAuNjczIDYuNjkzIDI0Ljg1MiAxNi4yNzNNODQuODMyIDg1Ljk0MXY2LjkzM20tMjEuNzQ0IDE0LjgxMWg2LjkzM20tLjU2NC0xNS4zNzVsNC45MDIgNC45MDJtLTQuOTAyIDI1Ljg0OGw0LjkwMi00LjkwMm0yMC45NDYtMjAuOTQ2bDQuOTAyLTQuOTAyIiBzdHJva2U9IiM2MTYxNjEiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZD0iTTQ3LjAxNyAxMDAuNDM3aC02LjMwM2ExLjI2IDEuMjYgMCAwIDEtMS4yNi0xLjI2Vjg1Ljk0YzAtLjY5Ni41NjQtMS4yNiAxLjI2LTEuMjZoNi4zMDNjLjY5NiAwIDEuMjYuNTY0IDEuMjYgMS4yNnYxMy4yMzVhMS4yNiAxLjI2IDAgMCAxLTEuMjYgMS4yNjFtMCAzNC42NjRoLTYuMzAzYTEuMjYgMS4yNiAwIDAgMS0xLjI2LTEuMjZ2LTEzLjIzNWMwLS42OTYuNTY0LTEuMjYgMS4yNi0xLjI2aDYuMzAzYy42OTYgMCAxLjI2LjU2NCAxLjI2IDEuMjZ2MTMuMjM1YTEuMjYgMS4yNiAwIDAgMS0xLjI2IDEuMjYiIGZpbGw9IiMxMEQwNzgiLz48cGF0aCBkPSJNNDMuODY2IDk3LjkxNmgtNi4zMDNhMS4yNiAxLjI2IDAgMCAxLTEuMjYtMS4yNlY4My40MmMwLS42OTYuNTY0LTEuMjYgMS4yNi0xLjI2aDYuMzAzYy42OTUgMCAxLjI2LjU2NCAxLjI2IDEuMjZ2MTMuMjM1YzAgLjY5Ni0uNTY1IDEuMjYxLTEuMjYgMS4yNjF6bTAgMzQuNjY0aC02LjMwM2ExLjI2IDEuMjYgMCAwIDEtMS4yNi0xLjI2di0xMy4yMzZjMC0uNjk2LjU2NC0xLjI2IDEuMjYtMS4yNmg2LjMwM2MuNjk1IDAgMS4yNi41NjQgMS4yNiAxLjI2djEzLjIzNWExLjI2IDEuMjYgMCAwIDEtMS4yNiAxLjI2em0yMC4xNjggMjMuOTV2NS4wNDFINDcuMDE3bTc3LjUyMS03OC4xNTF2LTguMTkzYTEuODkgMS44OSAwIDAgMC0xLjg5LTEuODloLTguMTk0bTM1LjI1NyA4MC4wMTZjLTYuNjgxIDkuOS0xOC4wMDMgMTYuNDEyLTMwLjg0NiAxNi40MTItMjAuNTM2IDAtMzcuMTg0LTE2LjY0OC0zNy4xODQtMzcuMTg1IDAtMjAuNTM3IDE2LjY0OC0zNy4xODUgMzcuMTg0LTM3LjE4NSAyMC41MzcgMCAzNy4xODUgMTYuNjQ4IDM3LjE4NSAzNy4xODUgMCA0LjQxNC0uNzcgOC42NS0yLjE4IDEyLjU3OU04OS4yNDQgMTMyLjU4YzAtMTMuMSA4LjU0Ny0yNC4yNCAyMC4zNTctMjguMTM4bS0xNi4xOTUgNDMuMjY2YTI5LjQwOCAyOS40MDggMCAwIDEtMy42OTMtOS44Nm01OS44ODItNjkuMDg2bDUuMzQ4LTUuMzQ3bTAgNS4zNDdsLTUuMzQ4LTUuMzQ3IiBzdHJva2U9IiM2MTYxNjEiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZD0iTTExNS4wODQgMTI1LjAxN2E1LjA0MiA1LjA0MiAwIDEgMS0xMC4wODQgMCA1LjA0MiA1LjA0MiAwIDAgMSAxMC4wODQgMHptMTYuMzg2IDE2LjM4NmE1LjA0MiA1LjA0MiAwIDEgMS0xMC4wODQgMCA1LjA0MiA1LjA0MiAwIDAgMSAxMC4wODUgMHptMi41MjItMjMuOTQ5bC0zMC4yNTMgMzAuMjUybTUwLjQyMS0yLjUyMUgxODBtLTMwLjI1MiA4LjE5M2gxNS4xMjZtLTIyLjA1OSA4LjE5M2g4LjgyNG0tNjYuNDYxLTQ0Ljc1NGMtLjExMy4wMDctLjIzMy4wMDctLjM0Ni4wMDctNS4yMTkgMC05LjQ1NC00LjIzNi05LjQ1NC05LjQ1NCAwLTUuMjIgNC4yMzUtOS40NTQgOS40NTQtOS40NTQgNC4zODYgMCA4LjA3MyAyLjk4NyA5LjE0NSA3LjA0IiBzdHJva2U9IiM2MTYxNjEiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PC9nPjwvc3ZnPg==">
        <p><span>@lang('v6.CHANGELLY_1')</span></p>
      </section>
      <section class="col-xs-4" style="padding:0 60px">
        <h2 class="text-bold"><span>@lang('v6.CHANGELLY_FAST')</span></h2><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjEwIiBoZWlnaHQ9IjIyNSIgdmlld0JveD0iMCAwIDIxMCAyMjUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHRpdGxlPmljX2Zhc3Q8L3RpdGxlPjxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PHBhdGggZD0iTTY4Ljg1NSAxNUwxNSA2OC44NTUiIGZpbGw9IiMwRURBN0MiLz48cGF0aCBkPSJNNjguODU1IDE1TDE1IDY4Ljg1NSIgc3Ryb2tlLW9wYWNpdHk9Ii43IiBzdHJva2U9IiNGNUY1RjUiIHN0cm9rZS13aWR0aD0iMzAiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPjxwYXRoIGQ9Ik0xMjYuNjg3IDI5LjQ1OGwtOTcuNTkgOTcuNTkiIGZpbGw9IiMwRURBN0MiLz48cGF0aCBkPSJNMTI2LjY4NyAyOS40NThsLTk3LjU5IDk3LjU5IiBzdHJva2Utb3BhY2l0eT0iLjciIHN0cm9rZT0iI0Y1RjVGNSIgc3Ryb2tlLXdpZHRoPSIzMCIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZD0iTTE4NS4yNDEgNDMuMTkzbC0xMDIuNjUgMTAyLjY1IiBmaWxsPSIjMEVEQTdDIi8+PHBhdGggZD0iTTE4NS4yNDEgNDMuMTkzbC0xMDIuNjUgMTAyLjY1IiBzdHJva2Utb3BhY2l0eT0iLjciIHN0cm9rZT0iI0Y1RjVGNSIgc3Ryb2tlLXdpZHRoPSIzMCIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZD0iTTE5NC42MzkgMTA2LjA4NEw5MS4yNjUgMjA5LjQ1OCIgZmlsbD0iIzBFREE3QyIvPjxwYXRoIGQ9Ik0xOTQuNjM5IDEwNi4wODRMOTEuMjY1IDIwOS40NTgiIHN0cm9rZS1vcGFjaXR5PSIuNyIgc3Ryb2tlPSIjRjVGNUY1IiBzdHJva2Utd2lkdGg9IjMwIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz48cGF0aCBkPSJNMTI2LjIzNiAxMjMuNTRoLTMwLjg1Yy0xLjM2Ni04LjMzNy00LjE3Ny0yNy43NS0zLjE0My00MS4yMTYgMi41NDctMzMuMDc0IDIwLjk0Ni00NS4yNyAyMC45NDYtNDUuMjdzLjY2My40NCAxLjc1NyAxLjM3OGM1LjYyMSA2LjQyNiAxMy41MjcgMTguOTggMTUuMTM1IDM5LjgzOCAxLjM1MSAxNy41NjgtMy44NDUgNDUuMjctMy44NDUgNDUuMjciIGZpbGw9IiMxMEQwNzgiLz48cGF0aCBkPSJNNTEuNjA3IDE0My44ODhjLTMuODQtOC4yMzQtNS45ODUtMTcuNDE4LTUuOTg1LTI3LjEwNCAwLTIwLjA3NCA5LjIxNS0zOCAyMy42NDktNDkuNzdtODEuMDgtLjAwMUMxNjQuNzg0IDc4Ljc4MyAxNzQgOTYuNzEgMTc0IDExNi43ODNjMCAzNS40NTMtMjguNzM2IDY0LjE5LTY0LjE5IDY0LjE5LTIyLjQ0NiAwLTQyLjItMTEuNTItNTMuNjc0LTI4Ljk3MSIgc3Ryb2tlPSIjNjE2MTYxIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPjxwYXRoIGQ9Ik0xMjEuMjk3IDEyMy41NHYzLjM3OWE0LjA1NSA0LjA1NSAwIDAgMS00LjA1NCA0LjA1NEg5OC4zMjRtMTkuNTk1LTUwLjY3NmE4LjEwOCA4LjEwOCAwIDEgMS0xNi4yMTcgMCA4LjEwOCA4LjEwOCAwIDAgMSAxNi4yMTcgMHoiIHN0cm9rZT0iIzYxNjE2MSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz48cGF0aCBkPSJNMTE3LjkxOSA4MC4yOTdhOC4xMDggOC4xMDggMCAxIDEtMTYuMjE3IDAgOC4xMDggOC4xMDggMCAwIDEgMTYuMjE3IDB6bS0xMi4xNjIgMGE0LjA1OCA0LjA1OCAwIDAgMSA0LjA1NC00LjA1NG00LjcyOSA1NC43M3YyMy42NDltLTkuNDU5LTIzLjY0OXYxMS40ODZtOS40NTkgMTIuMTYzYzAtNi4zNDQgNS4xNDMtMTEuNDg3IDExLjQ4Ny0xMS40ODdzMTEuNDg3IDUuMTQzIDExLjQ4NyAxMS40ODdtLTQuNzk0LTkuMzMyYTEyLjE1MSAxMi4xNTEgMCAwIDEgMTAuMi01LjUzMyAxMi4xMSAxMi4xMSAwIDAgMSA3Ljc3NCAyLjgxbS0zLjg5NC0yLjE3NWMxLjY0Ny02LjAxMyA3LjE1LTEwLjQzMyAxMy42ODctMTAuNDMzTTk4LjMzOCAxNDYuNWExMS40NSAxMS40NSAwIDAgMC04LjEyMi0zLjM2NWMtNi4zNDMgMC0xMS40ODcgNS4xNDMtMTEuNDg3IDExLjQ4NyIgc3Ryb2tlPSIjNjE2MTYxIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPjxwYXRoIGQ9Ik04My41MjMgMTQ1LjI5YTEyLjE1MSAxMi4xNTEgMCAwIDAtMTAuMTk5LTUuNTMzIDEyLjExNiAxMi4xMTYgMCAwIDAtNy43NzUgMi44MW0zLjg5NC0yLjE3NWMtMS42NDYtNi4wMTMtNy4xNS0xMC40MzMtMTMuNjg2LTEwLjQzM20zNi4yNzMtNi40MTlzLTUuMTkzLTI3LjcwMi0zLjg0MS00NS4yN0M5MC43MzMgNDUuMTk4IDEwOS4xMzUgMzMgMTA5LjEzNSAzM3MxOC40MDIgMTIuMTk4IDIwLjk0NiA0NS4yN2MxLjM1MSAxNy41NjgtMy44NDEgNDUuMjctMy44NDEgNDUuMjdIOTIuMDN6IiBzdHJva2U9IiM2MTYxNjEiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZD0iTTEyNi4yMzYgMTIzLjU0SDkyLjAzNHMtNS4xOTYtMjcuNzAyLTMuODQ1LTQ1LjI3QzkwLjczNiA0NS4xOTYgMTA5LjEzNSAzMyAxMDkuMTM1IDMzczIuNTEzIDEuNjYyIDUuODEgNS40MzJjNS42MjIgNi40MjYgMTMuNTI4IDE4Ljk4IDE1LjEzNiAzOS44MzggMS4zNTEgMTcuNTY4LTMuODQ1IDQ1LjI3LTMuODQ1IDQ1LjI3ek0xMDkuODEgNjMuNDA1aDE3LjU2OG0tMjUuNjc1IDBoNC4wNTQiIHN0cm9rZT0iIzYxNjE2MSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz48cGF0aCBkPSJNMTMwLjAxNCA5OC41NGM3LjE4MiAxLjY2MyAxMi41NCA4LjEwMiAxMi41NCAxNS43OTEgMCA3LjcxNi01LjM5MiAxNC4xNzYtMTIuNjE1IDE1LjgwNGExNi4wOTIgMTYuMDkyIDAgMCAwLTMuMjM2LTYuNTA3TTg4LjU2NyA5OC41NGMtNy4xODIgMS42NjMtMTIuNTQgOC4xMDItMTIuNTQgMTUuNzkxIDAgNy43MTYgNS4zOTIgMTQuMTc2IDEyLjYxNSAxNS44MDRhMTYuMDkyIDE2LjA5MiAwIDAgMSAzLjIzNi02LjUwN20tMTAuNDQ2LTguODcxYzAtMy4zOCAxLjQ2LTYuNDIgMy43ODUtOC41MjJtLTIuMzEyIDE0LjE1M2ExMS40NDQgMTEuNDQ0IDAgMCAxLTEuMDQzLTIuNTA4TTYzLjg2NSA0Ny44NjVhNi4wOCA2LjA4IDAgMSAxLTEyLjE2MiAwIDYuMDggNi4wOCAwIDEgMSAxMi4xNjIgMHptOTYuNjIxIDYuNzU3YTMuMzc4IDMuMzc4IDAgMSAxLTYuNzU2IDAgMy4zNzggMy4zNzggMCAwIDEgNi43NTYgMHpNODQuMTM1IDM1LjcwM2EyLjcwMyAyLjcwMyAwIDEgMS01LjQwNiAwIDIuNzAzIDIuNzAzIDAgMCAxIDUuNDA2IDB6bTU0LjU2NiA4LjYxbDUuNzMzLTUuNzMzbTAgNS43MzNMMTM4LjcgMzguNThNNTEuNzAzIDE0My44MUgyNG0zMS43NTcgOC4xMDlIMzkuNTRtMjIuOTc0IDguNzg0aC05LjQ2IiBzdHJva2U9IiM2MTYxNjEiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PC9nPjwvc3ZnPg==">
        <p><span>@lang('v6.CHANGELLY_2')</span></p>
      </section>
      <section class="col-xs-4" style="padding:0 60px">
        <h2 class="text-bold"><span>@lang('v6.CHANGELLY_TRUSTY')</span></h2><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjEwIiBoZWlnaHQ9IjIyNSIgdmlld0JveD0iMCAwIDIxMCAyMjUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHRpdGxlPmljX1RydXN0eTwvdGl0bGU+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNNjguODU1IDE1TDE1IDY4Ljg1NSIgZmlsbD0iIzBFREE3QyIvPjxwYXRoIGQ9Ik02OC44NTUgMTVMMTUgNjguODU1IiBzdHJva2Utb3BhY2l0eT0iLjciIHN0cm9rZT0iI0Y1RjVGNSIgc3Ryb2tlLXdpZHRoPSIzMCIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZD0iTTEyNi42ODcgMjkuNDU4bC05Ny41OSA5Ny41OSIgZmlsbD0iIzBFREE3QyIvPjxwYXRoIGQ9Ik0xMjYuNjg3IDI5LjQ1OGwtOTcuNTkgOTcuNTkiIHN0cm9rZS1vcGFjaXR5PSIuNyIgc3Ryb2tlPSIjRjVGNUY1IiBzdHJva2Utd2lkdGg9IjMwIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz48cGF0aCBkPSJNMTg1LjI0MSA0My4xOTNsLTEwMi42NSAxMDIuNjUiIGZpbGw9IiMwRURBN0MiLz48cGF0aCBkPSJNMTg1LjI0MSA0My4xOTNsLTEwMi42NSAxMDIuNjUiIHN0cm9rZS1vcGFjaXR5PSIuNyIgc3Ryb2tlPSIjRjVGNUY1IiBzdHJva2Utd2lkdGg9IjMwIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz48cGF0aCBkPSJNMTk0LjYzOSAxMDYuMDg0TDkxLjI2NSAyMDkuNDU4IiBmaWxsPSIjMEVEQTdDIi8+PHBhdGggZD0iTTE5NC42MzkgMTA2LjA4NEw5MS4yNjUgMjA5LjQ1OCIgc3Ryb2tlLW9wYWNpdHk9Ii43IiBzdHJva2U9IiNGNUY1RjUiIHN0cm9rZS13aWR0aD0iMzAiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPjxwYXRoIHN0cm9rZT0iIzYxNjE2MSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIGQ9Ik0xMDMuMDY2IDg4LjYxM1Y3Ny43ODVoNDUuNjM2djQ5LjUwMmgtOS4yODIiLz48cGF0aCBkPSJNNTYuMTAyIDE0MS45ODNINDUuODNhMy44NjcgMy44NjcgMCAwIDEtMy44NjgtMy44NjdWNDcuNjE5YTMuODY3IDMuODY3IDAgMCAxIDMuODY4LTMuODY4aDExMy43YTMuODY4IDMuODY4IDAgMCAxIDMuODY3IDMuODY4djkwLjQ5N2EzLjg2OCAzLjg2OCAwIDAgMS0zLjg2NyAzLjg2N2gtMjAuMTFNMTIzLjk1IDI1Ljk2MWE2Ljk2IDYuOTYgMCAwIDEtNi45NjEgNi45NjIgNi45NiA2Ljk2IDAgMCAxLTYuOTYxLTYuOTYyQTYuOTYgNi45NiAwIDAgMSAxMTYuOTg5IDE5YTYuOTYgNi45NiAwIDAgMSA2Ljk2MSA2Ljk2MXptMjAuMTEtMy4wOTRhMy4wOTQgMy4wOTQgMCAxIDEtNi4xODcgMCAzLjA5NCAzLjA5NCAwIDAgMSA2LjE4OCAwek0xNzUgMTcyLjkyM2EzLjg2NyAzLjg2NyAwIDEgMS03LjczNSAwIDMuODY3IDMuODY3IDAgMCAxIDcuNzM1IDB6bS0yNC45MzktMTEuODAybDYuNTYyLTYuNTYzbS4wMDEgNi41NjNsLTYuNTYyLTYuNTYzbTEzLjMzNi04OS4xNDlINTUuODg0bTk4LjIzMi0xMC4wNTVIODQuNTAzIiBzdHJva2U9IiM2MTYxNjEiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZD0iTTU4LjIwNCA1Ni45YTMuMDk0IDMuMDk0IDAgMSAxLTYuMTg4IDAgMy4wOTQgMy4wOTQgMCAwIDEgNi4xODggMG0xMC4wNTYgMGEzLjA5NCAzLjA5NCAwIDEgMS02LjE4OCAwIDMuMDk0IDMuMDk0IDAgMCAxIDYuMTg4IDBtMTAuMDU1IDBhMy4wOTQgMy4wOTQgMCAxIDEtNi4xODggMCAzLjA5NCAzLjA5NCAwIDAgMSA2LjE4OCAwIi8+PHBhdGggZD0iTTU2LjY1NyA1NS4zNTRhMy4wOTQgMy4wOTQgMCAxIDEtNi4xODggMCAzLjA5NCAzLjA5NCAwIDAgMSA2LjE4OCAwem0xMC4wNTYgMGEzLjA5NCAzLjA5NCAwIDEgMS02LjE4OCAwIDMuMDk0IDMuMDk0IDAgMCAxIDYuMTg4IDB6bTEwLjA1NSAwYTMuMDk0IDMuMDk0IDAgMSAxLTYuMTg4IDAgMy4wOTQgMy4wOTQgMCAwIDEgNi4xODggMHoiIHN0cm9rZT0iIzYxNjE2MSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz48cGF0aCBkPSJNMTM5LjQyIDExMy4wMzJWMTU5cy0xLjA1MiA5LjgtMTMuMTUgMjAuODg0Yy05LjI4MSA4LjUwOC0yMy4yMDQgMTIuMzc2LTIzLjIwNCAxMi4zNzZzLTEzLjA1Ni0zLjYyOC0yMi4zMTUtMTEuNTg3bC0uMDA3LS4wMDhjLTcuODQzLTkuMDUtOC42MTctMTYuMjUtOC42MTctMTYuMjVWMTEyLjU5czIyLjQzMSAzLjg2OCAzNi4zNTQtMTAuODI4YzkuNjYgMTAuMjAyIDIzLjQyIDExLjQ1NSAzMC45MzkgMTEuMjciIGZpbGw9IiMxMEQwNzgiLz48cGF0aCBkPSJNNzAuMzg1IDE2OC40MDVjMS45NTcgMy4zNDYgNC45NCA3LjMyMyA5LjQ3NyAxMS40NzkuMjk0LjI2My41ODguNTI2Ljg4Mi43ODFsLjAwNy4wMDhjOS4yNTkgNy45NTkgMjIuMzE1IDExLjU4NiAyMi4zMTUgMTEuNTg2czEzLjkyMy0zLjg2NyAyMy4yMDUtMTIuMzc1QzEzOC4zNjggMTY4LjggMTM5LjQyIDE1OSAxMzkuNDIgMTU5di00NS45NjhtMCAwdi01Ljg1NXMtMjIuNDMxIDMuODY3LTM2LjM1NC0xMC44M2MtMTMuOTIyIDE0LjY5Ny0zNi4zNTMgMTAuODMtMzYuMzUzIDEwLjgzVjE1OW0xMi4zNzUtODEuMjE1SDUzLjU2NG00MC4yMjEgMTAuODI4SDUzLjU2NG0xMy4xNDkgMzUuNThoLTEzLjE1bTEzLjE1LTkuMjgxaC0xMy4xNU02Ni43MTMgMTU5SDM1bTM0LjgwNyA5LjI4MmgtMTcuNzltMjYuMjk4IDEwLjA1NUg2Ny40ODYiIHN0cm9rZT0iIzYxNjE2MSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz48cGF0aCBzdHJva2U9IiM2MTYxNjEiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBkPSJNODYuNDM2IDE2Ni4zNDhoMzIuNDg3di0yNC43NTFIODYuNDM2em01LjAyOC0zMi40ODZjMC02LjE5NCA1LjAyMi0xMS4yMTYgMTEuMjE2LTExLjIxNiA2LjE5NCAwIDExLjIxNSA1LjAyMiAxMS4yMTUgMTEuMjE2bTAgLjM4N3Y2Ljk2Ii8+PHBhdGggZD0iTTEwNi45MzQgMTU2LjY4YTMuODY3IDMuODY3IDAgMSAxLTcuNzM1IDAgMy44NjcgMy44NjcgMCAwIDEgNy43MzUgMHptLTMuODY4LTEwLjA1NnY2LjE4OCIgc3Ryb2tlPSIjNjE2MTYxIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPjwvZz48L3N2Zz4=">
        <p><span>@lang('v6.CHANGELLY_2')</span></p>
      </section>
    </div>
      </div>
    </div>
  </div>
</div> <br />
@stop
