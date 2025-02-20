<?php
/**
 * To create SEO oriented URLs
 * @param  [type] $str string to convert into SEO oriented URL
 * @return [type]      [description]
 */
function slugify($str) {
    $search = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
    $replace = array('s', 't', 's', 't', 's', 't', 's', 't', 'i', 'a', 'a', 'i', 'a', 'a', 'e', 'E');
    $str = str_ireplace($search, $replace, strtolower(trim($str)));
    $str = preg_replace('/[^\w\d\-\ ]/', '', $str);
    $str = str_replace(' ', '-', $str);
    return preg_replace('/\-{2,}/', '-', $str);
}

function makeUrl($url_segment = '')
{
	if($url_segment != '' && $url_segment != '/') {
		$segment = '/' . trim($url_segment, '/');
	} else {
		$segment = '';
	}
	return url(LaravelLocalization::getCurrentLocale()) . $segment;
}

function getProfileImage()
{
	if(Auth::user()) {
		return Auth::user()->avatar;
	} else {
		return URL::asset('public/images/default-user.jpg');
	}
}

function formatHistoricalPrices($price)
{
	if($price < 0) {
		return $price;
	}
	$decimal = 7;
	if($price > 0.0050 && $price < 0.0099) {
		$decimal = 6;
	} else if($price > 0.050 && $price < 0.099) {
		$decimal = 4;
	} else if($price > 1 || $price == 1) {
		$decimal = 2;
	}
	return '$'.number_format($price, $decimal);
}

function formatBTCPrice($price)
{
	if($price < 0) {
		return $price;
	}
	$decimal = 8;
	if($price > 1 || $price == 1) {
	    $decimal = 2;
	}
	return number_format($price, $decimal);
}

function getCoinMarketCapAPI($key_text)
{
	$keys = explode(',', setting('3rdparty.cmc_api_key'));
    $key = array_rand($keys);
    return $key_text . $keys[$key];
}

function getCryptoCompareAPI()
{
	return setting('3rdparty.cryptocompare_api_key');
	// $keys = explode(',', setting('3rdparty.cryptocompare_api_key'));
 	// $key = array_rand($keys);
    //$this->api_key = $this->api_key . $keys[$key];
}

function getColor($value)
{
	if($value == 'Extreme Greed') {
		return '#96bb7c';
	} elseif($value == 'Greed') {
		return '#ade498';
	} elseif($value == 'Fear') {
		return '#ffe78f';
	}
	return '#ff847c';
}

function getCurrentTemplate()
{
	if(setting('site.template') != '') {
		return setting('site.template');
	}
	return $template = 'default';
}

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function build_query(Array $params) {
    $ret = array();
    $fmt = '%s=%s';
    $separator = '&';
    foreach ($params as $k => $v) {
        if (is_array($v)) {
            foreach ($v as $_v) {
                array_push($ret, sprintf($fmt, $k, urlencode($_v)));
            }
        } else {
            array_push($ret, sprintf($fmt, $k, urlencode($v)));
        }
    }
    return implode($separator, $ret);
}

function stopWords()
{
	return [
		'a','able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully','b','back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by','c','came','can','cannot','cant','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn\'t','course','c\'s','currently','d','dare','daren\'t','definitely','described','despite','did','didn\'t','different','directly','do','does','doesn\'t','doing','done','don\'t','down','downwards','during','e','each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except','f','fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore','g','get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings','h','had','hadn\'t','half','happens','hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here\'s','hereupon','hers','herself','he\'s','hi','him','himself','his','hither','hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored','i\'ll','i\'m','immediate','in','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just','k','keep','keeps','kept','know','known','knows','l','last','lately','later','latter','latterly','least','less','lest','let','let\'s','like','liked','likely','likewise','little','look','looking','looks','low','lower','ltd','m','made','mainly','make','makes','many','may','maybe','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn\'t','my','myself','n','name','namely','nd','near','nearly','necessary','need','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own','p','particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides','q','que','quite','qv','r','rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','s','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure','t','take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d','therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve','these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually','v','value','various','versus','very','via','viz','vs','w','want','wants','was','wasn\'t','way','we','we\'d','welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever','what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won\'t','would','wouldn\'t','x','y','yes','yet','you','you\'d','you\'ll','your','you\'re','yours','yourself','yourselves','you\'ve','z','zero',
	    'win','lose','lost',
	    'one','two','three','four',
	    'press','release','join','whether',
	    'ahead','last','took','hit','admits','admit','wrong','back','front',
	    'may','june','july','august','september',
	    '-', '/','=', '%','_'
	];
}