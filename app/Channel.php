<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'user_id', 'team_id', 'channel_id', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    protected function saveChannel($user_id, $access_token, $scope, $team_name, $team_id, $channel_name, $channel_id, $configuration_url, $url){
        $channel = Channel::firstOrNew(array('user_id' => $user_id, 'team_id' => $team_id, 'channel_id' => $channel_id));

        $channel->access_token = $access_token;
        $channel->scope = $scope;
        $channel->team_name = $team_name;
        $channel->channel_name = $channel_name;
        $channel->configuration_url = $configuration_url;
        $channel->active = 1;
        $channel->url = $url;

        return $channel->save();

    }


}
