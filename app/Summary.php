<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'user_id', 'channel_id','google_account_id', 'notification_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'access_token', 'refresh_token', 'refresh_token_expire'
    ];

    protected function saveSummary($user_id, $channel_id, $google_account_id, $notification_id, $name, $color, $metrics){
        $summary = Summary::firstOrNew(array('user_id' => $user_id,'channel_id' => $channel_id, 'google_account_id' => $google_account_id, 'notification_id' => $notification_id));
        $summary->metrics=$metrics;
        $summary->color=$color;
        $summary->name=$name;
        $summary->active = 1;
        return $summary->save();

    }
    protected function updateSummary($user_id, $channel_id, $google_account_id, $notification_id, $summary_id, $name, $color, $metrics){
        $summary = Summary::where(array('user_id' => $user_id,'id' => $summary_id))->first();
        $summary->channel_id = $channel_id;
        $summary->google_account_id = $google_account_id;
        $summary->notification_id = $notification_id;
        $summary->metrics=$metrics;
        $summary->color=$color;
        $summary->name=$name;

        return $summary->save();
    }
}
