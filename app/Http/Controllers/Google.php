<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use Google_Client; 
use Google_Service_Analytics;
use Auth;
use App\Google_account;




class Google extends Controller
{
	private $client_id = '##CLIENTIDGOOGLE##';
	private $client_secret = '##CLIENTSECRETGOOGLE##';
	private $redirect_uri = 'https://ga-reporting.ga-creation.fr/ga/login';
	private $scope = 'https://www.googleapis.com/auth/analytics.readonly';
	private $ga_client = null;

	function __construct(){
		$client = new Google_Client();
		$client->setClientId($this->client_id);
		$client->setClientSecret($this->client_secret);
		$client->setRedirectUri($this->redirect_uri);
		$client->addScope($this->scope);
		$client->setAccessType('offline');
		$client->setApprovalPrompt('force'); 
		$this->ga_client = $client;
	}


    public function login(Request $request){
    	$client = $this->ga_client;

    	$code = $request->input('code');
		if (!empty($code)) {
		  $client->authenticate($code);
		  session(['access_token' => $client->getAccessToken()]);
		  return Redirect::route('ga-save-accounts');
		}
	
		$authUrl = $client->createAuthUrl();
		return Redirect::away($authUrl);
    }

    public function save_accounts(Request $request){
    	$client = $this->ga_client;
		if(!empty(session('access_token'))){
			$client->setAccessToken(session('access_token'));
			if ($client->getAccessToken()) {
			    $service = new Google_Service_Analytics($client);    

		    	// request user accounts
		    	$accounts = $service->management_accountSummaries->listManagementAccountSummaries();
    			
    			if(empty($accounts->getUsername()))	
    				return Redirect::route('ga-accounts')->with('error', trans('app.google_add_empty_account'));;

			    $this->save_google_accounts($accounts);
			}
   			$request->session()->forget('access_token');
		}
    	return Redirect::route('ga-accounts')->with('success', trans('app.google_add_success'));;
    }

    public function accounts(){

		$accounts = Google_account::where(array('user_id' => Auth::id(), 'active' => 1))->get();
		return view('ga-accounts', array('accounts' => $accounts));

    }

    public function logout(Request $request){
    	$request->session()->forget('access_token');
    	return Redirect::route('ga-accounts')->with('success', trans('app.google_logout_success'));;
    }

    public function save_google_accounts($accounts){
    	$client = $this->ga_client;
    	$access_token = $client->getAccessToken(); 
    	$refresh_token = $client->getRefreshToken();
    	$refresh_token_expire = time() + 3600; 

    	$user_id = Auth::id();
    	$email = $accounts->getUsername();
    	foreach ($accounts->getItems() as $item) {
    		$account_name = $item['name'];
    		$account_id = $item['id'];
		    foreach($item->getWebProperties() as $wp) {
		    	$webProperty_id = $wp['id'];
		    	$webProperty_name = $wp['name'];
		    	$internalWebProperty_id = $wp['internalWebPropertyId'];
		        $views = $wp->getProfiles();
		        if (!is_null($views)) {
		            foreach($wp->getProfiles() as $view) {
		            	$profile_id = $view['id'];
		            	$profile_name = $view['name'];
		            	$profile_type = $view['type'];
		            	Google_account::saveGoogleAccount($access_token,$refresh_token,$refresh_token_expire,$user_id,$email,$account_name,$account_id,$webProperty_id,$webProperty_name,$internalWebProperty_id,$profile_id,$profile_name,$profile_type);
		            }
		        }
		    }
		}
		return;
    }


    public function test(Request $request, $id_google_account){
    	$google_account = Google_account::find($id_google_account);

     	if($google_account->user_id == Auth::id() AND $google_account->active == 1 ){

     		$params = array(
			      'account' => 'ga:' . $google_account->profile_id,
			      'begin' => '7daysAgo',
			      'end' =>'today',
			      'metrics' =>'ga:sessions');
     		$datas = $this->getDatasFromGoogle($params, $google_account);
     		$nb_sessions = (!empty($datas['totalsForAllResults']["ga:sessions"])) ? $datas['totalsForAllResults']["ga:sessions"] : 0 ;

    		$datas = $google_account->webProperty_name . ' - '. $google_account->profile_name . " : " . $nb_sessions;
    		return Redirect::route('ga-accounts')->with('success', trans('app.google_test_success',['datas' => $datas]));
     	
     	}else{
    		return Redirect::route('ga-accounts')->with('error', trans('app.google_test_error'));
     	}
    }

    public function getDatasFromGoogle($params, $google_account){
	    $client = $this->ga_client;
 		$client->setAccessToken($google_account->access_token);
 		$client->refreshToken($google_account->refresh_token);
 		$service = new Google_Service_Analytics($client); 

 		return $datas = $service->data_ga->get($params['account'], $params['begin'], $params['end'], $params['metrics']);
    }

    public function delete(Request $request, $id_google_account){
    	$google_account = Google_account::find($id_google_account);

    	if($google_account->user_id == Auth::id()){

	    	$google_account->active = 0;
	    	if($google_account->save()){
    			return Redirect::route('ga-accounts')->with('success', trans('app.google_delete_success'));
			}
    	}
    	return Redirect::route('ga-accounts')->with('error', trans('app.google_delete_error'));

    }
}
