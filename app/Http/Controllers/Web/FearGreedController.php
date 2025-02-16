<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\FearGreedIndexes;
class FearGreedController extends Controller
{

	public function index()
	{
		$fear_greed_indexes = FearGreedIndexes::orderBy('timestamp', 'desc')->get();
		$data = [
			'latest_fear_greed_index' => isset($fear_greed_indexes[0]) ? $fear_greed_indexes[0] : 0,
			'fear_greed_indexes' => $fear_greed_indexes
		];
		return view(getCurrentTemplate() . '.pages.fear_greed', $data);
	}

}