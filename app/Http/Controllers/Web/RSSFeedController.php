<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\CryptoNews;
class RSSFeedController extends Controller
{
	public function index()
	{
		header('Content-Type: application/rss+xml; charset=utf-8');

		$rssfeed = '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	
	xmlns:georss="http://www.georss.org/georss"
	xmlns:geo="http://www.w3.org/2003/01/geo/wgs84_pos#"
	>
<channel>
        <title>Cryptocurrency News RSS feed</title>
        <link>' . env('SITE_URL') . '</link>
        <description>This is an example RSS feed</description>
        <language>en-us</language>
        <copyright>Copyright (C) ' . date("Y") . ' ' . env('SITE_URL') . '</copyright>';

	    $news = CryptoNews::orderBy('publishedAt', 'desc')->limit(15)->get();

	    foreach ($news as $single_news) {
        $rssfeed .= '
        <item>
            <title>' . $single_news->title . '</title>
            <link>' . env('SITE_URL') . '/en/crypto-news/' . $single_news->id .'/'. $single_news->alias . '</link>
            <pubDate>' . date("D, d M Y H:i:s O", strtotime($single_news->publishedAt)) . '</pubDate>
            <description><![CDATA[' . str_limit($single_news->description, 1500) . ']]</description>
            <image>' . $single_news->urlToImage . '</image>
        </item>';
	    }
	 
	    $rssfeed .= '
    </channel>
</rss>';
	    echo $rssfeed;
	}	

}