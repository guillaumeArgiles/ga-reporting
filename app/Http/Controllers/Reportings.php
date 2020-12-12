<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use Google_Client; 
use App\Reporting;
use App\Channel;
use App\Google_account;
use App\Notification;
use App\Metric;
use App\State;
use App\Datas;
use Auth;
use App\Http\Controllers\Google;
use App\Http\Controllers\Config;

class Reportings extends Controller
{

    public function reportings(){
    	$reportings = Reporting::where(array('user_id' => Auth::id(), 'active' => 1))->get();
    	return view('reportings', array('reportings' => $reportings));
    }

    public function add(Request $request){
    	$error = '';
    	$channel_id = $request->input('channel_id');
    	$google_account_id = $request->input('google_account_id');
    	$notification_id = $request->input('notification_id');
    	$color = $request->input('color');
    	$name = $request->input('name');
        $metrics = $request->input('metrics');
        $timezone = $request->input('timezone');

    	if(!empty($channel_id) AND !empty($google_account_id) AND !empty($notification_id)){

    		$channel = Channel::where(array('user_id' => Auth::id(),'id'=>$channel_id, 'active' => 1))->first();
			$account = Google_account::where(array('user_id' => Auth::id(),'id'=>$google_account_id, 'active' => 1))->first();
			$notification = Notification::where(array('id' => $notification_id, 'active' => 1))->first();
			$name = ($name != '') ? $name : 'Reporting';
			$color = ($color != '') ? $color : '#346fb7';
			$metrics = (!empty($metrics)) ? implode(',',$metrics) : '1';
            $lang = config('app.locale');
            $timezone = (!empty($timezone)) ? $timezone : config('app.timezone');

			if(!empty($channel) AND !empty($account) AND !empty($notification) AND !empty($name) AND !empty($color) AND !empty($metrics)){
                if(Reporting::saveReporting(Auth::id(), $channel->id, $account->id, $notification->id, $name, $color,$metrics, $timezone, $lang)){
                    return Redirect::route('reportings')->with('success', trans('app.reporting_add_success'));
				}
			}
			$error = trans('app.reporting_add_error');
    	}
    	$channels = Channel::where(array('user_id' => Auth::id(), 'active' => 1))->get();
		$accounts = Google_account::where(array('user_id' => Auth::id(), 'active' => 1))->get();
		$notifications = Notification::where(array('active' => 1))->get();
		$metrics = Metric::where(array('active' => 1))->get();
        $state = State::generateState(Auth::id());


		$googleaccounts = array();
		if(!empty($accounts)){
			foreach($accounts as $account){
				if(!array_key_exists($account->email, $googleaccounts)){
					$googleaccounts[$account->email] = array();
				}
				if(!array_key_exists($account->webProperty_name, $googleaccounts[$account->email])){
					$googleaccounts[$account->email][$account->webProperty_name] = array();
				}
				$googleaccounts[$account->email][$account->webProperty_name][$account->id] = $account->profile_name;
			}
		}

		return View('reporting-add', array('reporting' => new Reporting , 'channels' => $channels, "notifications" => $notifications, "googleaccounts" => $googleaccounts, "metrics" => $metrics, "state" => $state, 'timezones' => timezone_identifiers_list()))->with('error', $error);
    }

    public function edit(Request $request, $reporting_id){
    	$reporting = Reporting::where(array('user_id' => Auth::id(),'id'=>$reporting_id, 'active' => 1))->first();
    	// if(!count($reporting)){
    	// 	return Redirect::route('reporting-add');
    	// }
    	$reporting->metrics = explode(',', $reporting->metrics);

    	$error = '';
    	$channel_id = $request->input('channel_id');
    	$google_account_id = $request->input('google_account_id');
    	$notification_id = $request->input('notification_id');
    	$color = $request->input('color');
    	$name = $request->input('name');
        $metrics = $request->input('metrics');
        $lang = config('app.locale');
    	$timezone = $request->input('timezone');

    	if(!empty($channel_id) AND !empty($google_account_id) AND !empty($notification_id)){
    		$channel = Channel::where(array('user_id' => Auth::id(),'id'=>$channel_id, 'active' => 1))->first();
			$account = Google_account::where(array('user_id' => Auth::id(),'id'=>$google_account_id, 'active' => 1))->first();
			$notification = Notification::where(array('id' => $notification_id, 'active' => 1))->first();
			$name = ($name != '') ? $name : 'Reporting';
			$color = ($color != '') ? $color : '#346fb7';
			$metrics = (!empty($metrics)) ? implode(',',$metrics) : '1';
            $timezone = (!empty($timezone)) ? $timezone : config('app.timezone');

			if(!empty($channel) AND !empty($account) AND !empty($notification) AND !empty($name) AND !empty($color) AND !empty($metrics)){
				if(Reporting::updateReporting(Auth::id(), $channel->id, $account->id, $notification->id, $reporting_id, $name, $color, $metrics, $timezone, $lang)){
					return Redirect::route('reportings')->with('success', trans('app.reporting_edit_success'));
				}
			}

			$error = trans('app.reporting_edit_error');
    	}

    	$channels = Channel::where(array('user_id' => Auth::id(), 'active' => 1))->get();
		$accounts = Google_account::where(array('user_id' => Auth::id(), 'active' => 1))->get();
		$notifications = Notification::where(array('active' => 1))->get();
		$metrics = Metric::where(array('active' => 1))->get();
        $state = State::generateState(Auth::id());

		$googleaccounts = array();
		if(!empty($accounts)){
			foreach($accounts as $account){
				if(!array_key_exists($account->email, $googleaccounts)){
					$googleaccounts[$account->email] = array();
				}
				if(!array_key_exists($account->webProperty_name, $googleaccounts[$account->email])){
					$googleaccounts[$account->email][$account->webProperty_name] = array();
				}
				$googleaccounts[$account->email][$account->webProperty_name][$account->id] = $account->profile_name;
			}
		}

		return View('reporting-edit', array('reporting' => $reporting, 'channels' => $channels, "notifications" => $notifications, "googleaccounts" => $googleaccounts, "metrics" => $metrics, 'state' => $state, 'timezones' => timezone_identifiers_list()));

    }

    public function delete($reporting_id){
    	$reporting = Reporting::find($reporting_id);

    	if($reporting->user_id == Auth::id() ){

	    	$reporting->active = 0;
	    	if($reporting->save()){
    			return Redirect::route('reportings')->with('success', trans('app.reporting_delete_success'));
			}
    	}
    	return Redirect::route('reportings')->with('error', trans('app.reporting_delete_error'));
    }

    public function test($reporting_id){
    	$reporting = Reporting::where(array('user_id' => Auth::id(),'id'=>$reporting_id, 'active' => 1))->first();
    	if(!count($reporting)){
    		return Redirect::route('reportings');
    	}

		$channel = Channel::where(array('user_id' => Auth::id(),'id'=>$reporting->channel_id, 'active' => 1))->first();
		$account = Google_account::where(array('user_id' => Auth::id(),'id'=>$reporting->google_account_id, 'active' => 1))->first();
		$notification = Notification::where(array('id' => $reporting->notification_id, 'active' => 1))->first();
		$reporting->metrics = explode(',', $reporting->metrics);
		$metrics = Metric::whereIn('id', $reporting->metrics)->get();

		if(!empty($channel) AND !empty($account) AND !empty($notification)){

			$datas =$this->getGoogleDatas($metrics, $account, $reporting);

            $payload = $this->buildDataToSend($datas, $channel, $reporting, $account, $metrics); 

            $params = "payload=" . json_encode($payload);

            $url = $channel->url;
            $result = $this->sendRequest($url, $params);


			if($result == "ok"){
    			return Redirect::route('reportings')->with('success', trans('app.reporting_test_success'));
			}
		}
    	return Redirect::route('reportings')->with('error', trans('app.reporting_test_error'));
    }

    public function getGoogleDatas($metrics, $account, $reporting){
    	$google = new Google($account);
        $all_datas = array();
    	$metrics_text = '';
    	
    	date_default_timezone_set($reporting->timezone);

    	$metrics_text = substr($metrics_text, 0, -1);
    	if($reporting->notification_id == 1){
    		$begin = strtotime("yesterday");
    		$end = strtotime("yesterday");
    	}elseif($reporting->notification_id == 2){
    		$begin = strtotime('last monday');
    		$end = strtotime('last monday + 6 days');
    	}elseif($reporting->notification_id == 3){
			$begin = strtotime("first day of last month");
			$end = strtotime("last day of last month");
    	}
        if(empty($metrics)){
            $metrics = array();
            $metric = new stclass();
            $metric->metric = 'ga:sessions,';
            array_push($metrics, $metric); 
        }
        
        foreach($metrics as $metric){
            $params = array(
              'account'=>'ga:' . $account->profile_id,
              'begin'=> date('Y-m-d', $begin),
              'end'=>date('Y-m-d', $end + 86399),
              'metrics'=>$metric->metric ,
            );

            $datas = $google->getDatasFromGoogle($params,$account);

            if(!empty($datas['totalsForAllResults'])){
                $all_datas[$metric->metric] = $datas['totalsForAllResults'][$metric->metric];
            }
        }

        if(!empty($all_datas)){
            return $all_datas;
        }


    	return false;
    }

    public function buildDataToSend($datas, $channel, $reporting, $account, $metrics){
    	
    	if($reporting->notification_id == 1){
    		$begin = strtotime("yesterday");
    		$end = strtotime("yesterday");
    		$text = trans('app.reporting_report_daily_message', ['name' => $reporting->name] );
    	}else if($reporting->notification_id == 2){
    		$begin = strtotime('last monday -7 days');
    		$end = strtotime('last monday -1 days');
            $text = trans('app.reporting_report_weekly_message', ['name' => $reporting->name, 'first' => date('d-m-Y', $begin), 'last' => date('d-m-Y', $end)]);
        }else if($reporting->notification_id == 3){
            $begin = strtotime("first day of last month");
            $end = strtotime("last day of last month");
            $text = trans('app.reporting_report_weekly_message', ['name' => $reporting->name, 'first' => date('d-m-Y', $begin), 'last' => date('d-m-Y', $end)]);
    	}

    	$fields = array();
        $fallback_metrics = '';
    	if(!empty($datas)){
    		foreach($datas as $key => $data){
                $fallback_metrics .= $key.':'.round($data).' , ';
    			$field = array(
		                    "title"=> $key,
		                    "value"=> round($data),
		                    "short"=> true
		                );

    			array_push($fields, $field);
    		}
            $fallback_metrics = substr($fallback_metrics,0, -3);
    	}

    	$analytics_name = urlencode($account->account_name)." - ".urlencode($account->webProperty_name)." - ".urlencode($account->profile_name);

        $fallback = $analytics_name . ' -> ' . $fallback_metrics;

    	$attachments = array(array(
                "fallback" => $fallback,
	            "color"			=> $reporting->color,
	            "fields"		=> $fields,
	            "author_name" 	=> $analytics_name,
	         ));

    	$payload = array(         
	        "channel"       =>  $channel->channel_name,
	        "attachments" 	=>  $attachments,
	        "text" 			=> $text
	    );

    	return $payload;
    }


    public function sendRequest($url, $params){
        Datas::incrementReportsSent();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        return $result = curl_exec($ch);
    }

    public function getNbSent(){
        echo Datas::getReportsSent();
    	return;
    }
}
