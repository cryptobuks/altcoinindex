<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\{CryptoNews, NewsLetter, Tags};
use TCG\Voyager\Models\Post;
use LaravelLocalization;
use DB, Validator, Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
class CryptoNewsController extends Controller
{
	public function index($tag = '')
	{
		$tag = str_replace('-', ' ', $tag);
		$crypto_news = CryptoNews::where('status', '=', 1)
						->orderBy('publishedAt', 'desc')
						->where('title', 'like', '%' . $tag . '%')
						->whereIn('lang', ['en'])
						->limit(40)->get()->toArray();
		$lang_news = [];
		if(LaravelLocalization::getCurrentLocale() != 'en') {
			$news_object = CryptoNews::where('status', '=', 1)
						->orderBy('publishedAt', 'desc')
						->where('title', 'like', '%' . $tag . '%')
						->where('lang', '=', LaravelLocalization::getCurrentLocale())
						->limit(40);
			if($news_object->count() > 0) {
				$lang_news = $news_object->get()->toArray();
			}
			if($news_object->count() > 40) {
				$crypto_news = $lang_news;
			} else {
				$crypto_news = array_merge($lang_news, array_slice($crypto_news, 0, 40-$news_object->count()));
			}
		}
		$editors_news = 3;
		$ccn_news = 5;
		if(getCurrentTemplate() == 'classic') {
			$editors_news = 5;
			$ccn_news = 3;
		}

		$tags = Tags::where('status', '=', 1)->get();

		$data = [
			'crypto_news' => array_slice($crypto_news, 0, 5), //slider
			'ccn_news' => array_slice($crypto_news, 5, $ccn_news), //latest

			'btc_magazine_news' => array_slice($crypto_news, $ccn_news+5, 1), //related
			'news_btc_news' => array_slice($crypto_news, $ccn_news+6, 5),

			'magnates_news' => array_slice($crypto_news, $ccn_news+11, 1), //featured
			'coin_desk_news' => array_slice($crypto_news, $ccn_news+12, 3),

			'trust_nodes_news' => array_slice($crypto_news, $ccn_news+15, 1), //trending
			'coin_telegraph_news' => array_slice($crypto_news, $ccn_news+16, 3),

			'bitcoinist_news' => array_slice($crypto_news, $ccn_news+19, 5), //top

			'live_btc_news' => array_slice($crypto_news, $ccn_news+24, 1),
			'the_merkle_news' => array_slice($crypto_news, $ccn_news+25, 5),

			'crypto_globe_news' => array_slice($crypto_news, $ccn_news+30, $editors_news), //editors

			'tags' => $tags
		];
		return view(getCurrentTemplate() . '.pages.news', $data);
	}

	public function tag($slug)
	{
		if($slug) {
			return $this->index($slug);	
		}
		return redirect('/crypto-coins-news-headlines');
	}

	public function getNewsByAutors($author, $limit)
	{
		return CryptoNews::orderBy('publishedAt', 'desc')
				->where('author', '=', $author)->take($limit)->get();
	}

	public function news($id, $alias)
	{
		$crypto_news = CryptoNews::where('id', $id)->first();
		if(isset($crypto_news->title)) {
			$data = [
				'crypto_news' => $crypto_news,
				'crypto_related_news' => $this->getRelatedNews($id, 6),
				'crypto_most_read_news' => $this->getMostReadNews($id, 8, 6),
				'crypto_news_from_bitcoin' => $this->getNewsFromBitcoin($id, 9)
			];
			return view(getCurrentTemplate() . '.pages.single_news', $data);
		}
		return redirect('/crypto-coins-news-headlines');
	}

	public function getRelatedNews($id, $limit)
	{
		$crypto_news = CryptoNews::take($limit)
			->where('status', '=', 1)
			->where('urlToImage', '!=', 'no_preview.png')
			->where('urlToImage', '!=', '')
			->where('lang', 'en')->where('id', '!=', $id)
			->orderBy('publishedAt', 'desc')->get()->toArray();
		$lang_news = [];			
		if(LaravelLocalization::getCurrentLocale() != 'en') {
			$news_object = CryptoNews::take($limit)
				->where('status', '=', 1)
				->where('urlToImage', '!=', 'no_preview.png')
				->where('urlToImage', '!=', '')->where('id', '!=', $id)
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

	public function getMostReadNews($id, $limit, $skip)
	{
		$crypto_news = CryptoNews::take($limit)->skip($skip)
			->where('status', '=', 1)
			->where('urlToImage', '!=', 'no_preview.png')
			->where('urlToImage', '!=', '')
			->where('lang', 'en')->where('id', '!=', $id)
			->orderBy('publishedAt', 'desc')->get()->toArray();
		$lang_news = [];			
		if(LaravelLocalization::getCurrentLocale() != 'en') {
			$news_object = CryptoNews::take($limit)->skip($skip)
				->where('status', '=', 1)
				->where('urlToImage', '!=', 'no_preview.png')
				->where('urlToImage', '!=', '')->where('id', '!=', $id)
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

	public function getNewsFromBitcoin($id, $limit)
	{
		return CryptoNews::where('status', '=', 1)
				->orderBy('publishedAt', 'desc')->take($limit)
				->where('lang', LaravelLocalization::getCurrentLocale())
				->where('id', '!=', $id)
				->get();
	}

	public function searchNews()
	{
		$query = $like = '';
		if(isset($_GET['q'])) {
			$query = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
			$params = explode(' ', $query);
			foreach ($params as $value) {
				$like .= " `title` LIKE '%".$value."%' OR ";
			}
		}
		$news = DB::select( 
					DB::raw("SELECT id, author, title, alias, description, publishedAt 
					FROM `crypto_news` WHERE `status` = 1 AND 
					" . $like . " `title` LIKE '%".$query."%'
					AND `publishedAt` BETWEEN " . (time()-7890000) . " AND " . time() . " ORDER BY publishedAt DESC LIMIT 50") 
				);
		return view(getCurrentTemplate() . '.pages.news_search', ['crypto_news' => $news, 'query' => $query]);
	}

	/**
	* Newsletter related code
	**/

	public function saveNewsLetterSubscription()
	{
		$rules = [
		    'email'    => 'required|email|min:5|max:250',
		];
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
		    return 'false';
		} else {
		    if (NewsLetter::updateOrCreate(request(['email']))) {
		    	return 'true';
		    } else {
		    	return 'false';
		    }
		}
	}

	public function composeNewsLetter()
	{
		$news = CryptoNews::where('lang', '=', 'en')
					->where('status', '=', 1)
					->where('urlToImage', '!=', 'no_preview.png')
					->where('urlToImage', '!=', '')
					->orderBy('publishedAt', 'desc')->take(10)->get();
		$post = Post::orderBy('created_at', 'desc')->first();
		$emails = NewsLetter::select('email')->get();
		foreach ($emails as $email) {
			$data = ['news' => $news, 'post' => $post];
			Mail::send('emails.newsletter', $data, function ($message) use ($email) {
			    $message->from(env('MAIL_EMAIL_ADDRESS'), setting('site.site_name'));
			    $message->subject(__(setting('site.site_name') . ' - Newsletter'));
			    $message->to($email->email);
			});
		}
	}


}
