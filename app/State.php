<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    static function generateState($user_id){
        $state = State::firstOrNew(array('user_id' => $user_id));
        if(!$state->state){
    	   $uniqid = md5('token pour un utilisateur : '.$user_id);
    	   $state->state = $uniqid;
    	   $state->save();
        }else{
            $uniqid = $state->state;
        }

    	return $uniqid;
    }

    static function checkState($user_id, $state){
    	$state_saved = State::where('user_id', $user_id)->first();
    	if($state_saved->state == $state){
    		return true;
    	}
    	return false;
    }
}
