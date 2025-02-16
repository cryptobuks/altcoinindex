<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\CryptoCoinsIco;
use DB;

class CryptoIcoController extends Controller
{
	public function index()
	{
		$icos = DB::table('crypto_coins_icos')->where('hide', '=', 0)
				->where('crypto_coins_icos.alias', '!=', 'reuse-cash')
				->where('crypto_coins_icos.featured', '=', 1)
				->orderBy('crypto_coins_icos.start_time', 'desc')
				->leftjoin('crypto_markets', 'crypto_coins_icos.name', '=', 'crypto_markets.name')
				->select('crypto_coins_icos.*', 'crypto_markets.image as coin_image')
				->orderBy('crypto_coins_icos.end_time', 'desc')->paginate(102);
		if($icos) {
			$data = ['icos' => $icos];
			return view(getCurrentTemplate() . '.pages.icos', $data);
		}
		return redirect('/crypto-ico');
	}

	public function ico($ico)
	{
		$ico = DB::table('crypto_coins_icos')
				->where('crypto_coins_icos.alias', '=', $ico)
				->leftjoin('crypto_markets', 'crypto_coins_icos.name', '=', 'crypto_markets.name')
				->select('crypto_coins_icos.*', 'crypto_markets.image as coin_image')
				->where('crypto_coins_icos.hide', '=', 0)->first();
		if($ico) {
			$icos = DB::table('crypto_coins_icos')->where('hide', '=', 0)
				->where('crypto_coins_icos.alias', '!=', 'reuse-cash')
				->where('crypto_markets.image', '!=', '')
				->join('crypto_markets', 'crypto_coins_icos.name', '=', 'crypto_markets.name')
				->select('crypto_coins_icos.*', 'crypto_markets.image as coin_image')
				->inRandomOrder()->paginate(12);
			$data = ['ico' => $ico, 'icos' => $icos];
			return view(getCurrentTemplate() . '.pages.single_ico', $data);
		}
		return redirect('/crypto-ico');
	}

}
