<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Google_Client; 
use App\Reporting;
use App\Channel;
use App\Google_account;
use App\Notification;
use App\Metric;
use App\Http\Controllers\Google;
use App\Http\Controllers\Reportings;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            set_time_limit(0);
            $timestamp = time();
            $reportings = Reporting::where(array('active' => 1))->get();

            if(!empty($reportings)){
                foreach($reportings as $reporting){
                    if(empty($reporting->timezone))
                        continue;
                    app()->setLocale($reporting->lang);
                    date_default_timezone_set($reporting->timezone);
                    $notification_id = 1;
                    $send = true;
                    if(date('j', $timestamp) != '1' AND $reporting->notification_id == 3) 
                        $send = false;

                    elseif(date('D', $timestamp) != 'Mon' AND $reporting->notification_id == 2) 
                        $send = false;

                    if(date('H', $timestamp) != 9 OR !$send){
                        continue;
                    }
            
                    $channel = Channel::where(array('id'=>$reporting->channel_id, 'active' => 1))->first();
                    $account = Google_account::where(array('id'=>$reporting->google_account_id, 'active' => 1))->first();
                    $notification = Notification::where(array('id' => $reporting->notification_id, 'active' => 1))->first();
                    $reporting->metrics = explode(',', $reporting->metrics);
                    $metrics = Metric::whereIn('id', $reporting->metrics)->get();
                    if(!empty($channel) AND !empty($account) AND !empty($notification)){
                        $Reportings_object = new Reportings();
                        $datas = $Reportings_object->getGoogleDatas($metrics, $account, $reporting);
                        $payload = $Reportings_object->buildDataToSend($datas, $channel, $reporting, $account, $metrics); 

                        $params = "payload=" . json_encode($payload);

                        $url = $channel->url;
                        $result = $Reportings_object->sendRequest($url, $params);
                    }
                }
            }
        })->everyMinute();

    }
}
