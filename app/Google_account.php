<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Google_account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'user_id', 'account_id','email', 'webProperty_id', 'profile_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'access_token', 'refresh_token', 'refresh_token_expire'
    ];

    protected function saveGoogleAccount($access_token,$refresh_token,$refresh_token_expire,$user_id,$email,$account_name,$account_id,$webProperty_id,$webProperty_name,$internalWebProperty_id,$profile_id,$profile_name,$profile_type){
        $google_account = Google_account::firstOrNew(array('user_id' => $user_id,'email' => $email, 'account_id' => $account_id, 'webProperty_id' => $webProperty_id, 'profile_id' => $profile_id));

        $google_account->access_token = $access_token;
        $google_account->refresh_token = $refresh_token;
        $google_account->refresh_token_expire = $refresh_token_expire;
        $google_account->account_name = $account_name;
        $google_account->webProperty_name = $webProperty_name;
        $google_account->internalWebProperty_id = $internalWebProperty_id;
        $google_account->profile_name = $profile_name;
        $google_account->profile_type = $profile_type;
        $google_account->active = 1;

        return $google_account->save();

    }
}
