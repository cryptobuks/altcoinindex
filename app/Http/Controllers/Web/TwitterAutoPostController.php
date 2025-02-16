<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Twitter, Storage, File;
use App\{CryptoNews, CryptoMarkets};
class TwitterAutoPostController extends Controller
{

	public function post($post)
	{
		Twitter::postTweet(['status' => $post, 'format' => 'json']);

		// Twitter::reconfig([
		//     "consumer_key" => $consumer_key,
		//     "consumer_secret"  => $consumer_secret,
		//     "token" => $access_token,
		//     "secret" => $access_token_secret,
		// ]);

		// Twitter::postTweet(['status' => $post, 'format' => 'json']);		
	}

	public function postNews()
	{
		$news = $this->getNews();
		if($news) {
			$url = $this->bitlyUrlShorten(env('SITE_URL') . "/en/crypto-news/". $news->id . "/" . $news->alias);
			$status = $news->title . "\n" . $this->getHashTags(8) . "\n" . $url;
			if(strlen($status) > 280) {
				$status = $this->getHashTags(8) . " " . $url;
			}
			if(strlen($status) <= 280) {
				$this->post($status);
			} else {
				$this->getTopCoinsPrices();
			}
			CryptoNews::where('id', $news->id)->update(['twitter_post' => 1]);
		}
	}

	public function getNews()
	{
		$news = CryptoNews::where('twitter_post', '=', 0)->select('id', 'title', 'alias')
					->orderBy('created_at', 'desc')->first();
		if($news) {
			$news->title = $this->getHashBasedTitle($news->title);
			return $news;
		}
	}

	public function getTopCoinsPrices()
	{
		$markets = CryptoMarkets::select('name', 'price_usd')->orderBy('rank', 'asc')->limit(5)->get();
		$coins = "Top 5 #cryptocurrencies \n Alert Time: " . date("Y-m-d H:i:s", time()+10800) . "\n";
		foreach ($markets as $market) {
			$coins .= "#" . str_replace(' ', '', $market->name) . ": $" . number_format($market->price_usd, 5) . "\n";
		}
		$this->post($coins . $this->getHashTags(4) . "\n\n" . env('SITE_URL'));
	}
	
	public function getTopGainers()
	{
		$markets = CryptoMarkets::where('status', '=', 1)->where('percent_change_day', '>', 0)->orderBy('percent_change_day', 'desc')->limit(5)->get();
		$coins = "Top 5 #crypto gainers \n Alert Time: " . date("Y-m-d H:i:s", time()+10800) . "\n";
		foreach ($markets as $market) {
			$coins .= "#" . str_replace(' ', '', $market->name) . ": $" . number_format($market->price_usd, 5) . "\n";
		}
		$this->post($coins . $this->getHashTags(4) . "\n\n" . env('SITE_URL'));
	}

	public function getTopLosers()
	{
		$markets = CryptoMarkets::where('status', '=', 1)->where('percent_change_day', '<', 0)->orderBy('percent_change_day', 'asc')->limit(5)->get();
		$coins = "Top 5 #crypto losers \n Alert Time: " . date("Y-m-d H:i:s", time()+10800) . "\n";
		foreach ($markets as $market) {
			$coins .= "#" . str_replace(' ', '', $market->name) . ": $" . number_format($market->price_usd, 5) . "\n";
		}
		$this->post($coins . $this->getHashTags(4) . "\n\n" . env('SITE_URL'));
	}

	public function getHashBasedTitle($title)
	{
		return $title;
		$stopWords = stopWords();
		$news_title = explode(' ', $title);
		$title = '';
		foreach ($news_title as $word) {
			if(!in_array(strtolower(trim($word)), $stopWords)) {
				$title .= '#' . $word . ' ';
			} else {
				$title .= $word . ' ';
			}
		}
		return ucfirst(strtolower($title));
	}

	public function getHashTags($cloudSize)
	{
		return implode(' ', array_values($this->hashCloud($cloudSize)));
	}

	public function hashCloud($cloudSize)
	{
		$hashCloud = [
			'#instacryptocurrency',
		 	'#instabitcoin', '#instablockchain', '#instacrypto',
		 	'#instabtc', '#instaico',
		 	'#instaethereum', '#instaeth',
		 	'#instavenezuela', '#instanews',
		 	'#instaairdrop', '#cryptocurrency',
		 	'#bitcoin', '#blockchain', '#crypto',
		 	'#btc', '#btcnews', '#ico', '#ethereum', '#airdrop',
		 	'#xrp', '#ripple', '#ripplenews', '#trx',
		 	'#trading', '#altcoin', '#altcoins', '#monero',
		 	'#cryptocurrencymarket', '#newcryptocurrency',
		 	'#cryptocurrencymarket', '#pumpanddump',
		 	'#coinbase', '#binance', '#bittrex', '#SmartContracts', 
		 	'#SecretContracts', '#FreeCoin', '#SmartCash', '#fintech',
		 	'#cryptonews', '#IoT', '#AI', '#BigData', '#dapp', 
		 	'#decentralized', '#trading', '#ltc', '#enigma', '#digialcurrency', '#virtualcurrency',
		 	'#tothemoon','#investing','#hodl','#shill','#lambo','#buyorders','#sellorders','#FUD',
		 	'#hardfork','#altcoins','#mining','#trading','#investor','#investments','#btfd','#fomo',
		 	'#ath','#alltimehigh','#moon','#bullrun','#bearrun','#softcap','#hotwallet','#coldwallet',
		 	'#coldstorage','#publickey','#node','#premining','#hashrate','#pow','#pos','#proofofwork','#proofofstake',
		 	'#dapps', '#hardcap','#dash','#neo','#stellar','#cardano','#eos','#zcash','#kucoin','#bitfinex','#er20', '#erc20',
		 	'#cryptokitties', '#coinmarketcap', '#bitcoincash', '#bch', '#steemit', '#steem'
		];
		$rand_numbers = array_rand($hashCloud, $cloudSize);
		$hashes = [];
		foreach ($rand_numbers as $rand_number) {
			$hashes[] = $hashCloud[$rand_number];
		}
		return $hashes;
	}

	function bitlyUrlShorten($url) 
	{
		$params = array('longUrl' => $url);
        $results = $this->bitlyUrlShortenCall('v3/shorten', $params);
        if(isset($results['url'])) {
            return $results['url'];
        }
        return $url;
	}

	function bitlyUrlShortenCall($endpoint, Array $params=null) 
	{

		if ($params === null) {
            $params = array();
        }
        $url = 'https://api-ssl.bitly.com/' . $endpoint;
        $params['format'] = 'json';
        $params['access_token'] = env('BITLY_ACCESS_TOKEN');

        // Convert booleans to 'true'/'false'.
        foreach($params as $k => &$v) {
            if (is_bool($v)) {
                $v = $v ? 'true' : 'false';
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP/' . phpversion() . ' bitly_api/0.1.0');
    
        $query = build_query($params);
        $url .= '?' . $query;
        curl_setopt($ch, CURLOPT_URL, $url);
        
        $result = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($status_code !== 200) {
            return $result;
        }
        $result = json_decode($result, true);
        if ($result['status_code'] !== 200) {
            return $result;
        }
        return $result['data'];
	}

}
