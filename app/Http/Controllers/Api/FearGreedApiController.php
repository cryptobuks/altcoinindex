<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\{Controller,CurlCallController};
use App\FearGreedIndexes;
use App\Helpers\BulkInsertUpdate;
class FearGreedApiController extends Controller
{

	public $fear_greed_indexes;	
	public function __construct()
	{
		$this->fear_greed_indexes = new FearGreedIndexes;
	}

	public function getFearGreedIndexes()
	{
		$details = json_decode(CurlCallController::curl('https://api.alternative.me/fng/?limit=0'), true);

		foreach ($details['data'] as $detail) {
            $data[] = $this->prepareFearGreedData($detail);
        }
        if(isset($data) && count($data) > 0) {
            BulkInsertUpdate::do($this->fear_greed_indexes->getTable(), $data);
        }
	}

	public function prepareFearGreedData($detail)
	{
		return [
			'value' => $detail['value'],
			'value_classification' => $detail['value_classification'],
			'timestamp' => $detail['timestamp'],
			'time_until_update' => isset($detail['time_until_update']) ? $detail['time_until_update'] : 0
		];
	}

}