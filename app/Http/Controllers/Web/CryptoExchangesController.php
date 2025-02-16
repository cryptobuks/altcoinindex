<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Exchanges;
class CryptoExchangesController extends Controller
{

	public function index()
	{
		$crypto_exchanges = Exchanges::where('status', '=', 1)->orderBy('order_no', 'asc')->get();
		$data = ['crypto_exchanges' => $crypto_exchanges];
		return view(getCurrentTemplate() . '.pages.exchanges', $data);
	}

	public function exchange($exchange)
	{
		$crypto_exchanges = Exchanges::where('status', '=', 1)->inRandomOrder()->paginate(12);
		$crypto_exchange = Exchanges::where('status', '=', 1)->where('alias', '=', $exchange)->first();
		$data = ['crypto_exchange' => $crypto_exchange, 'crypto_exchanges' => $crypto_exchanges];
		return view(getCurrentTemplate() . '.pages.single_exchange', $data);
	}

}