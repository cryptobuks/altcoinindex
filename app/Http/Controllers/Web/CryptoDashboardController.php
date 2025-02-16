<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\{Controller, CurlCallController};
use App\{CryptoMarkets, CryptoGlobals, CryptoTwitterFeed, CryptoTopPairs, CryptoNews, CryptoCoinsIco, DashboardSlider};
use DB, LaravelLocalization;
class CryptoDashboardController extends Controller
{

	public $top_coins = '';
	public $market_cap = '';
	public function index()
	{
		$crypto_globals = CryptoGlobals::first();
		$this->market_cap = isset($crypto_globals) ? str_replace(array('$', ','), '', $crypto_globals['total_market_cap_usd']) : 0;
		$top_10 = $this->getTop10Coins();
		$streaming_data = [];
		foreach ($top_10 as $market) {
			$market_symbol = $market->symbol;
			if($market_symbol == 'MIOTA') {
				$market_symbol = 'IOT';
			} else if($market_symbol == 'NANO') {
				$market_symbol = 'XRB';
			}
			if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $market_symbol)) {
				$streaming_data[] = "'5~CCCAGG~".$market_symbol."~USD'";
			}
		}
		$data = [
			'crypto_globals' => isset($crypto_globals) ? $crypto_globals : [], 
			'total_markets' => CryptoMarkets::all()->count(), 
			'crypto_top_markets' => $top_10,
			'streaming_data' => trim(implode(',', $streaming_data), ','),
			'pairs' => $this->getTopTradingPairs(),
			'top_pairs' => $this->getTopTradingCoins(),
			'dominance_data' => $this->getDominanceData(),
			'news_data' => $this->getNews(),
			'icos' => $this->getIcos(),
			'slider_images' => DashboardSlider::where('status', '=', 1)->get()
		];
		return view(getCurrentTemplate() . '.pages.dashboard', $data);
	}

	public function getTop10Coins()
	{
		$this->top_coins =  CryptoMarkets::where('rank', '>', 0)
								->take(10)->orderBy('rank', 'asc')->get();
		return $this->top_coins;
	}

	public function getTopTradingPairs($coin = 'BTC')
	{
		return CryptoTopPairs::where('symbol', $coin)->limit(5)
		->orderBy('volume24h_from', 'DESC')->orderBy('volume24h_to', 'DESC')
		->get();	
	}

	public function getTopTradingCoins()
	{
		return $this->top_coins;	
	}

	public function getDominanceData()
	{
		$dominance_data = [];
		$markets = $this->top_coins;
		$i = 0;
		if ($this->market_cap == 0) {
			return;
		}
		foreach($markets as $coin) {
			if($i < 4) {
				$dominance_data[$i]['label'] = $coin['name'] . ' Market %';
				$dominance_data[$i]['value'] = number_format(($coin['market_cap_usd'] / $this->market_cap) * 100, 2);
				$i++;
			}
		}
		return json_encode($dominance_data);
	}

	public function getNews()
	{
		$limit = 10;
		if(getCurrentTemplate() == 'default') {
			$limit = 7;
		} else if(getCurrentTemplate() == 'classic') {
			$limit = 6;
		}
		$crypto_news = CryptoNews::take($limit)
					->where('status', '=', 1)
					->where('urlToImage', '!=', 'no_preview.png')
					->where('urlToImage', '!=', '')
					->where('lang', 'en')
					->orderBy('publishedAt', 'desc')->get()->toArray();
		$lang_news = [];			
		if(LaravelLocalization::getCurrentLocale() != 'en') {
			$news_object = CryptoNews::take($limit)
					->where('status', '=', 1)
					->where('urlToImage', '!=', 'no_preview.png')
					->where('urlToImage', '!=', '')
					->where('lang', LaravelLocalization::getCurrentLocale())
					->orderBy('publishedAt', 'desc');	
			if($news_object->count() > 0) {
				$lang_news = $news_object->get()->toArray();
			}
			if($news_object->count() > $limit) {
				$crypto_news = $lang_news;
			} else {
				$crypto_news = array_merge($lang_news, array_slice($crypto_news, 0, $limit-$news_object->count()));
			}
		}
		return $crypto_news;
	}

	public function getIcos()
	{
		return DB::table('crypto_coins_icos')->where('hide', '=', 0)
			->where('crypto_coins_icos.alias', '!=', 'reuse-cash')
			->where('crypto_coins_icos.featured', '=', 1)
			->leftjoin('crypto_markets', 'crypto_coins_icos.name', '=', 'crypto_markets.name')
			->select('crypto_coins_icos.*', 'crypto_markets.image as coin_image')
			->inRandomOrder()->paginate(1000);
	}

}