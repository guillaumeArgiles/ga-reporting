<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use App\Http\Requests;
use App\Channel;
use App\State;
use Auth;

class Channels extends Controller
{
    public function channels(Request $request){
    	$channels = Channel::where(array('user_id' => Auth::id(), 'active' => 1))->get();
        $state = State::generateState(Auth::id());
    	return view('channels', array('channels' => $channels, 'state' => $state));
    }

    public function test(Request $request, $id_channel){
    	$channelToTest = Channel::find($id_channel);

    	if($channelToTest->user_id == Auth::id() AND $channelToTest->active == 1 ){

	    	$message = trans('app.channel_test_message'); 
			$params = "payload=" . json_encode(array(         
			        "channel"       =>  $channelToTest->channel_name,
			        "text"          =>  $message,
			    ));
			$url = $channelToTest->url;
			$result = $this->sendRequest($url, $params);

			if($result == "ok"){
    			return Redirect::route('channels')->with('success', trans('app.channel_test_success'));
			}
    	}
    	return Redirect::route('channels')->with('error', trans('app.channel_test_error'));

    }

    public function delete(Request $request, $id_channel){
    	$channelToEdit = Channel::find($id_channel);

    	if($channelToEdit->user_id == Auth::id()){

	    	$channelToEdit->active = 0;
	    	if($channelToEdit->save()){
    			return Redirect::route('channels')->with('success', trans('app.channel_delete_success'));
			}
    	}
    	return Redirect::route('channels')->with('error', trans('app.channel_delete_error'));

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
