<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\{Controller,CurlCallController};
use App\{FeedAggregator,CryptoNews};
use Cocur\Slugify\Slugify;

class CryptoNewsFeedAggregatorApiController extends Controller
{

	public $slugify;
	public function __construct() {
		$this->slugify = new Slugify();
	}

	public function getNews()
	{
		$arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        
		$feeds = FeedAggregator::where('status', '=', 1)->get();
		// dd($feeds);
		foreach ($feeds as $feed) {
			// dd($feed->feed);
			$news_feed = simplexml_load_string(file_get_contents($feed->feed, false, stream_context_create($arrContextOptions)), null, LIBXML_NOCDATA);
			// dd($news_feed);
	        foreach ($news_feed->channel->item as $news) {
	        	if(isset($news->description) && strlen($news->description) > 15 && isset($news->title) && strlen($news->title) > 4) {
		            $data = $this->prepareNewsData($news, $feed->source, $feed->lang);
		            // dd($data);
		            if($data) {
			            @CryptoNews::updateOrCreate(
			                ['alias' => $data['alias']],
			                $data
			            );
			        }
		        }
	        }	
	    }
	}

	public function prepareNewsData($news, $author, $lang)
	{
		$image = $this->getImage($news->description);
		if($image == '') {
			$image = 'no_preview.png';
		}
		return [
			'author' => $author,
			'title' => $news->title,
			'alias' => $this->slugify->slugify($news->title),
			'description' => strip_tags($news->description),
			'url' => isset($news->link) ? $news->link : '',
			'urlToImage' => $image,
			'publishedAt' => isset($news->pubDate) ? date("Y-m-d H:i:s", strtotime($news->pubDate)) : date("Y-m-d H:i:s"),
			'lang'=> $lang
		];
	}

	public function getImage($html)
	{
		$dom = new \DOMDocument();
		libxml_use_internal_errors(true);
	    $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
	    libxml_clear_errors();
	    $dom->preserveWhiteSpace = false;
	    $imgs  = $dom->getElementsByTagName("img");
	    $links = array();
	    for($i = 0; $i < $imgs->length; $i++) {
	       $links[] = $imgs->item($i)->getAttribute("src");
	    }
	    return isset($links[0]) ? $links[0] : '';
	}

}
