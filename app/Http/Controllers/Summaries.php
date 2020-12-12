<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use Google_Client; 
use App\Summary;
use App\Channel;
use App\Google_account;
use App\Notification;
use App\Metric;
use App\State;
use Auth;
use App\Http\Controllers\Google;

class Summaries extends Controller
{

    public function summaries(){
    	$summaries = Summary::where(array('user_id' => Auth::id(), 'active' => 1))->get();
    	return view('summaries', array('summaries' => $summaries));
    }

    public function add(Request $request){
    	$error = '';
    	$channel_id = $request->input('channel_id');
    	$google_account_id = $request->input('google_account_id');
    	$notification_id = $request->input('notification_id');
    	$color = $request->input('color');
    	$name = $request->input('name');
    	$metrics = $request->input('metrics');

    	if(!empty($channel_id) AND !empty($google_account_id) AND !empty($notification_id)){

    		$channel = Channel::where(array('user_id' => Auth::id(),'id'=>$channel_id, 'active' => 1))->first();
			$account = Google_account::where(array('user_id' => Auth::id(),'id'=>$google_account_id, 'active' => 1))->first();
			$notification = Notification::where(array('id' => $notification_id, 'active' => 1))->first();
			$name = ($name != '') ? $name : 'Summary';
			$color = ($color != '') ? $color : '#346fb7';
			$metrics = (!empty($metrics)) ? implode(',',$metrics) : '1';


			if(!empty($channel) AND !empty($account) AND !empty($notification) AND !empty($name) AND !empty($color) AND !empty($metrics)){
				if(Summary::saveSummary(Auth::id(), $channel->id, $account->id, $notification->id, $name, $color,$metrics)){
					return Redirect::route('summaries')->with('success', 'Rapport enregistré');
				}
			}

			$error = "Erreur durant l'enregistrement de votre rapport";
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

		return View('summaries-add', array('summary' => new Summary , 'channels' => $channels, "notifications" => $notifications, "googleaccounts" => $googleaccounts, "metrics" => $metrics, "state" => $state))->with('error', $error);
    }

    public function edit(Request $request, $summary_id){
    	$summary = Summary::where(array('user_id' => Auth::id(),'id'=>$summary_id, 'active' => 1))->first();
    	if(!count($summary)){
    		return Redirect::route('summaries-add');
    	}
    	$summary->metrics = explode(',', $summary->metrics);

    	$error = '';
    	$channel_id = $request->input('channel_id');
    	$google_account_id = $request->input('google_account_id');
    	$notification_id = $request->input('notification_id');
    	$color = $request->input('color');
    	$name = $request->input('name');
    	$metrics = $request->input('metrics');

    	if(!empty($channel_id) AND !empty($google_account_id) AND !empty($notification_id)){
    		$channel = Channel::where(array('user_id' => Auth::id(),'id'=>$channel_id, 'active' => 1))->first();
			$account = Google_account::where(array('user_id' => Auth::id(),'id'=>$google_account_id, 'active' => 1))->first();
			$notification = Notification::where(array('id' => $notification_id, 'active' => 1))->first();
			$name = ($name != '') ? $name : 'Summary';
			$color = ($color != '') ? $color : '#346fb7';
			$metrics = (!empty($metrics)) ? implode(',',$metrics) : '1';

			if(!empty($channel) AND !empty($account) AND !empty($notification) AND !empty($name) AND !empty($color) AND !empty($metrics)){
				if(Summary::updateSummary(Auth::id(), $channel->id, $account->id, $notification->id, $summary_id, $name, $color, $metrics)){
					return Redirect::route('summaries')->with('success', 'Rapport modifié');
				}
			}

			$error = "Erreur durant la modification du rapport";
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

		return View('summaries-edit', array('summary' => $summary, 'channels' => $channels, "notifications" => $notifications, "googleaccounts" => $googleaccounts, "metrics" => $metrics, 'state' => $state));

    }

    public function delete($summary_id){
    	$summary = Summary::find($summary_id);

    	if($summary->user_id == Auth::id() ){

	    	$summary->active = 0;
	    	if($summary->save()){
    			return Redirect::route('summaries')->with('success', 'Rapport supprimé');
			}
    	}
    	return Redirect::route('summaries')->with('error', 'Erreur durant la suppression du rapport');
    }

    public function test($summary_id){
    	$summary = Summary::where(array('user_id' => Auth::id(),'id'=>$summary_id, 'active' => 1))->first();
    	if(!count($summary)){
    		return Redirect::route('summaries');
    	}

		$channel = Channel::where(array('user_id' => Auth::id(),'id'=>$summary->channel_id, 'active' => 1))->first();
		$account = Google_account::where(array('user_id' => Auth::id(),'id'=>$summary->google_account_id, 'active' => 1))->first();
		$notification = Notification::where(array('id' => $summary->notification_id, 'active' => 1))->first();
		$summary->metrics = explode(',', $summary->metrics);
		$metrics = Metric::whereIn('id', $summary->metrics)->get();

		if(!empty($channel) AND !empty($account) AND !empty($notification)){

			$datas =$this->getGoogleDatas($metrics, $account, $summary);

	    	$payload = $this->buildDataToSend($datas, $channel, $summary, $account, $metrics); 

			$params = "payload=" . json_encode($payload);

			$url = $channel->url;
			$result = $this->sendRequest($url, $params);

			if($result == "ok"){
    			return Redirect::route('summaries')->with('success', 'Rapport envoyé');
			}
		}
    	return Redirect::route('summaries')->with('error', "Erreur durant l'envoie du rapport");
    }

    public function getGoogleDatas($metrics, $account, $summary){
    	$google = new Google($account);
    	$metrics_text = '';
    	if(!empty($metrics)){
    		foreach($metrics as $metric){
    			$metrics_text .= $metric->metric . ',';
    		}

    	}else{
    		$metrics_text = 'ga:sessions,';
    	}
    	date_default_timezone_set('Europe/Paris');

    	$metrics_text = substr($metrics_text, 0, -1);
    	if($summary->notification_id == 1){
    		$begin = strtotime("yesterday");
    		$end = strtotime("yesterday");
    	}elseif($summary->notification_id == 2){
    		$begin = strtotime('last monday -7 days');
    		$end = strtotime('last monday -1 days');
    	}elseif($summary->notification_id == 3){
			$begin = strtotime("first day of last month");
			$end = strtotime("last day of last month");
    	}

    	$params = array(
	      'account'=>'ga:' . $account->profile_id,
	      'begin'=> date('Y-m-d', $begin),
	      'end'=>date('Y-m-d', $end),
	      'metrics'=>$metrics_text);

    	$datas = $google->getDatasFromGoogle($params,$account);
    	if(!empty($datas['totalsForAllResults'])){
    		return $datas['totalsForAllResults'];
    	}
    	return false;
    }

    public function buildDataToSend($datas, $channel, $summary, $account, $metrics){
    	
    	if($summary->notification_id == 1){
    		$begin = strtotime("yesterday");
    		$end = strtotime("yesterday");
    		$text = "Résumé *" . $summary->name . "* de la journée d'hier";
    	}else if($summary->notification_id == 2){
    		$begin = strtotime('last monday -7 days');
    		$end = strtotime('last monday -1 days');
    		$text = "Résumé *" . $summary->name . "* du ". date('d-m-Y', $begin) . ' au ' . date('d-m-Y', $end);
    	}else if($summary->notification_id == 3){
			$begin = strtotime("first day of last month");
			$end = strtotime("last day of last month");
    		$text = "Résumé *" . $summary->name . "* du ". date('d-m-Y', $begin) . ' au ' . date('d-m-Y', $end);
    	}


    	$metric_name = array();
    	foreach($metrics as $metric){
    		$metric_name[$metric->metric] = $metric->name;
    	}

    	$fields = array();
    	if(!empty($datas)){
    		foreach($datas as $key => $data){
    			$field = array(
		                    "title"=> $metric_name[$key],
		                    "value"=> round($data),
		                    "short"=> true
		                );

    			array_push($fields, $field);
    		}
    	}

    	$analytics_name = $account->account_name." - ".$account->webProperty_name." - ".$account->profile_name;

    	$attachments = array(array(
	            "color"			=> $summary->color,
	            "fields"		=> $fields,
	            "author_name" 	=> $analytics_name,
	         ));

    	$message = "Vos données sont prêtes";
    	$payload = array(         
	        "channel"       =>  $channel->channel_name,
	        "attachments" 	=>  $attachments,
	        "text" 			=> $text
	    );

    	return $payload;
    }


    public function sendRequest($url, $params){
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		return $result = curl_exec($ch);
    }
}
