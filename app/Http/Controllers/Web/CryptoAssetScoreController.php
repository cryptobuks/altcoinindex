<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\{FcasListings, CryptoMarkets};
use Carbon\Carbon;


class CryptoAssetScoreController extends Controller
{
  public function cryptoAssetScore()
  {
    $fcas = $this->getCryptoAssetScore();
    if(count($fcas) == 0) {
        // $date = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
        $fcas = $this->getCryptoAssetScore(); //$date
    }
    return view(getCurrentTemplate() . '.pages.fcas_listings', ['fcas_listings' => $fcas]);
  }

  public function getCryptoAssetScore() //$date = "Y-m-d"
  {
    return FcasListings::with(['cryptoMarkets' => function($query) {
      $query->select('symbol', 'rank', 'name', 'image', 'alias');
    }])->orderBy('score', 'desc')->orderBy('last_updated', 'desc')
        ->whereDate('last_updated', '>', Carbon::now()->subDays(30))
        ->get(); 
    //->where('last_updated', date($date))
  }

  public function cryptoAssetScoreDetails($alias)
  {
    if($alias !== '') {
      return view(getCurrentTemplate() . '.pages.fcas_listing_details', [
        'market' => CryptoMarkets::where('alias', '=', $alias)->first(),
        'fcas_listings' => '',
      ]);
    }
    return redirect('/fundamental-crypto-asset-score');
  }

}
