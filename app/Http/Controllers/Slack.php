<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\State;
use App\Channel;
use Auth;


class Slack extends Controller
{
	private $client_id = '###CLIENTID###';
	private $client_secret = '###CLIENTSECRET###';

    public function login(Request $request){
    	$code = $request->input('code');
    	$state = $request->input('state');
    	if($this->verifyState($state)){
    		return $this->connect($code);
    	}else{
            return Redirect::route('install')->with('error', trans('app.slack_install_error'));
    	}
    }

    private function connect($code){
    	$url = 'https://slack.com/api/oauth.access';
    	$params = 'code='.$code.'&client_id='.$this->client_id.'&client_secret='.$this->client_secret;

    	$result = $this->sendRequest($url, $params);
    	$result_array = json_decode($result, true);

    	if(!empty($result_array['ok'])){

    		$access_token = (!empty($result_array['access_token'])) ? $result_array['access_token'] : '';
			$scope = (!empty($result_array['scope'])) ? $result_array['scope'] : '';
			$team_name = (!empty($result_array['team_name'])) ? $result_array['team_name'] : '';
			$team_id = (!empty($result_array['team_id'])) ? $result_array['team_id'] : '';
			$incoming_webhook = (!empty($result_array['incoming_webhook'])) ? $result_array['incoming_webhook'] : '';

			if(!empty($incoming_webhook)){
				$channel_name = (!empty($incoming_webhook['channel'])) ? $incoming_webhook['channel'] : '';
				$channel_id = (!empty($incoming_webhook['channel_id'])) ? $incoming_webhook['channel_id'] : '';
				$configuration_url = (!empty($incoming_webhook['configuration_url'])) ? $incoming_webhook['configuration_url'] : '';
				$url = (!empty($incoming_webhook['url'])) ? $incoming_webhook['url'] : '';
			
                $saved = Channel::saveChannel(Auth::id(), $access_token, $scope, $team_name, $team_id, $channel_name, $channel_id, $configuration_url, $url);
                if($saved){
                    return Redirect::route('channels')->with('success', trans('app.slack_add_success'));
                }else{
                }
            }else{
            }
        }else{
    	}
        return Redirect::route('channels')->with('error', trans('app.slack_add_success'));
    }

    private function verifyState($state){
    	$user_id = Auth::id();
    	return State::checkState($user_id, $state);
    }

    private function sendRequest($url, $params){
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		return $result = curl_exec($ch);
    }



}
