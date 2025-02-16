<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\{CryptoDictionaryTerms,Tags};
use LaravelLocalization;
class CryptoDictionaryController extends Controller
{

	public function cryptoDictionary()
	{
		$data = CryptoDictionaryTerms::where('lang', LaravelLocalization::getCurrentLocale())
					->orderBy('term', 'asc')->paginate(7);
		return view(getCurrentTemplate() . '.pages.dictionary', [
			'terms' => $data,
			'newest_terms' => CryptoDictionaryTerms::where('lang', '=', LaravelLocalization::getCurrentLocale())
								->select('term','alias')->inRandomOrder()->limit(15)->get(),
			'crypto_tags' => Tags::where('status', 1)->get()
		]);
	}

	public function cryptoDictionaryTerm($term)
	{
		if ($term == '') {
			return redirect('/crypto-dictionary');
		}
		$data = CryptoDictionaryTerms::where('lang', LaravelLocalization::getCurrentLocale())
					->where('alias', $term)->paginate(1);

		$other_terms = [];
		if(isset($data[0]['id'])) {
			$other_terms = CryptoDictionaryTerms::where('lang', LaravelLocalization::getCurrentLocale())
						->where('id', '!=', $data[0]['id'])
						->inRandomOrder()->limit(5)->get();
		}
		if(count($data) > 0) {
			return view(getCurrentTemplate() . '.pages.dictionary', [
				'terms' => $data,
				'other_terms' => $other_terms,
				'newest_terms' => CryptoDictionaryTerms::where('lang', '=', LaravelLocalization::getCurrentLocale())
									->select('term','alias')->inRandomOrder()->limit(15)->get(),
				'crypto_tags' => Tags::where('status', 1)->get(),
				'single' => 1
			]);
		}
		return redirect('/crypto-dictionary');
	}

	public function getDictionaryTerm()
	{
		$lang = $_GET['lang'];
		$query = $_GET['q'];
		return CryptoDictionaryTerms::where('term', 'LIKE', '%'.$query.'%')
					->select('alias as value', 'term as label')->where('lang', $lang)->get();
	}

}