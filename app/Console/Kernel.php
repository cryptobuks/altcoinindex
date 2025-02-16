<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call('App\Http\Controllers\Api\CoinMarketCapApiController@cryptoGlobalData')->everyFiveMinutes();
        $schedule->call('App\Http\Controllers\Api\CoinMarketCapApiController@topCoinsMarketCap')->everyFiveMinutes();
        $schedule->call('App\Http\Controllers\Api\CoinMarketCapApiController@allCoinsMarketCap')->everyThirtyMinutes();

        //$schedule->call('App\Http\Controllers\Api\CryptoCompareApiController@cryptoCoinsRates')->hourly();
        $schedule->call('App\Http\Controllers\Api\CryptoNewsApiController@getNews')->hourly();
        $schedule->call('App\Http\Controllers\Api\FixerCurrencyRateApiController@getCurrenciesRatesData')->hourly();
        $schedule->call('App\Http\Controllers\Api\CoinMarketCapApiController@getFcasListing')->daily();
        // $schedule->call('App\Http\Controllers\Api\CryptoCCTNewsApiController@getNews')->daily();
        $schedule->call('App\Http\Controllers\Api\CryptoCCTNewsFeedController@insertPost')->daily();
        // $schedule->call('App\Http\Controllers\Api\CryptoTurkishNewsApiController@getNews')->daily();
        $schedule->call('App\Http\Controllers\Api\CryptoCompareApiController@getDailyHistoricalDayData')->daily();
        $schedule->call('App\Http\Controllers\Api\CryptoNewsFeedAggregatorApiController@getNews')->cron('15 11 * * *'); //daily 
        $schedule->call('App\Http\Controllers\Api\FearGreedApiController@getFearGreedIndexes')->twiceDaily(1, 2);
        //cron('0 0 * * *'); //daily at midnight 
        $schedule->call('App\Http\Controllers\Web\SitemapGeneratorController@generate')->cron('15 21 * * *'); //daily at 21:15
        //$schedule->call('App\Http\Controllers\Api\IcoWatchListApiController@getICOs')->daily(); // not active yet

        //$schedule->call('App\Http\Controllers\Api\CryptoCompareApiController@cryptoCoinsFullDetails')->daily();

        $schedule->call('App\Http\Controllers\Api\CoinGeckoController@cryptoEvents')->weekly();
        $schedule->call('App\Http\Controllers\Api\CryptoCompareApiController@getPairs')->weekly();
        $schedule->call('App\Http\Controllers\Api\CryptoCompareApiController@getAllExchangesPairs')->weekly();
        $schedule->call('App\Http\Controllers\Web\ClearCacheController@index')->weekly(); // clear cache on server
        $schedule->call('App\Http\Controllers\Api\CoinMarketCapApiController@cryptoIcons')->weekly(); //To load crypto icons

        /**
         * Twitter Auto Post APIs
         */
        $schedule->call('App\Http\Controllers\Web\TwitterAutoPostController@postNews')->cron('25 */6 * * *'); //every 3 hrs
        $schedule->call('App\Http\Controllers\Web\TwitterAutoPostController@getTopCoinsPrices')->cron('10 8 * * *'); // daily at 8 am
        //$schedule->call('App\Http\Controllers\Web\TwitterAutoPostController@getTopLosers')->cron('15 14 * * *'); // daily at 2 pm
        //$schedule->call('App\Http\Controllers\Web\TwitterAutoPostController@getTopGainers')->cron('20 18 * * *'); // daily at 6 pm

        $schedule->call('App\Http\Controllers\Api\CryptoCompareApiController@miningPools')->monthly();
        $schedule->call('App\Http\Controllers\Api\CryptoCompareApiController@wallets')->monthly();
        $schedule->call('App\Http\Controllers\Api\CryptoCompareApiController@getExchanges')->monthly();
        $schedule->call('App\Http\Controllers\Api\CryptoCompareApiController@cryptoMiningEquipment')->monthly();

        /**
        * Send newsletter
        **/
        $schedule->call('App\Http\Controllers\Web\CryptoNewsController@composeNewsLetter')->cron('15 23 * * 7'); //weekly on sunday at 23:15

        /**
         * Time and resource consuming call.
         * Call on demand - Contact to script owner before opening these
         */
        //$schedule->call('App\Http\Controllers\Api\CryptoCompareApiController@getExchangesVolumeByPairs')->weekly();
        // $schedule->call('App\Http\Controllers\Api\CryptoCompareApiController@getAllHistoricalDayData')->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
