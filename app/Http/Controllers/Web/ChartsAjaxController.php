<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\{CryptoHistoricalDayData, CryptoMarkets,FearGreedIndexes};

class ChartsAjaxController extends Controller
{
	public function getHistoricalDayData($coin = 'BTC', $time_frame = '3 months', $currency = 'USD')
	{
		if(!request()->ajax()) {
			return [':)'];
		}
		if ($time_frame == 'all') {
			$time_frame = "100 year";
		}
		$fromDate = strtotime(date("Y-m-d", strtotime('-'.$time_frame)));
		$toDate = strtotime(date("Y-m-d"));
		$results = CryptoHistoricalDayData::select('time', 'open')
						->where('coin', $coin)
						->whereBetween('time', [$fromDate, $toDate])->orderBy('time', 'asc')->get()
						->toArray();	
		$coin_latest_price = CryptoMarkets::select('price_usd')->where('symbol', '=', $coin)->first();
		$data = $res = [];
		foreach ($results as $result) {
			$res['date'] = $result['time'];
			$res['visits'] = $result['open'];
			$data[] = $res;
		}	
		$res['date'] = date("Y-m-d H:i:s");
		$res['visits'] = number_format($coin_latest_price['price_usd'], 2);
		$data[] = $res;
		return json_encode($data);
	}

	public function getHistoricalDayDataCandle($coin = 'BTC', $time_frame = '3 months', $currency = 'USD')
	{
		if(!request()->ajax()) {
			return [':)'];
		}
		if ($time_frame == 'all') {
			$time_frame = "100 year";
		}
		$fromDate = strtotime(date("Y-m-d", strtotime('-'.$time_frame)));
		$toDate = strtotime(date("Y-m-d"));
		$results = CryptoHistoricalDayData::select('time', 'open', 'high', 'low', 'close')->where('coin', $coin)
						->whereBetween('time', [$fromDate, $toDate])->orderBy('time', 'asc')->get()
						->toArray();
		$coin_latest_price = CryptoMarkets::select('price_usd')->where('symbol', '=', $coin)->first();				
		$data = $res = [];	
		foreach ($results as $result) {
			$res['date'] = $result['time'];
			$res['open'] = $result['open'];
			$res['high'] = $result['high'];
			$res['low'] = $result['low'];
			$res['close'] = $result['close'];
			$data[] = $res;
		}
		return json_encode($data);
	}

	public function getFearGreedData($time_frame = '3 months')
	{
		if(!request()->ajax()) {
			return [':)'];
		}
		if ($time_frame == 'all') {
			$time_frame = "100 year";
		}
		$fromDate = strtotime(date("Y-m-d", strtotime('-'.$time_frame)));
		$toDate = strtotime(date("Y-m-d"));

		$fear_greed_indexes = FearGreedIndexes::whereBetween('timestamp', [$fromDate, $toDate])
								->orderBy('timestamp', 'asc')->get()->toArray();
		$data = $res = [];
		foreach ($fear_greed_indexes as $fear_greed_index) {
			$res['date'] = date("Y-m-d", $fear_greed_index['timestamp']);
			$res['visits'] = $fear_greed_index['value'];
			$data[] = $res;
		}	
		return json_encode($data);
	}

}