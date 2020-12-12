<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'user_id', 'channel_id','google_account_id', 'notification_id', 'lang', 'timezone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected function saveReporting($user_id, $channel_id, $google_account_id, $notification_id, $name, $color, $metrics, $timezone, $lang){
        $reporting = Reporting::firstOrNew(array('user_id' => $user_id,'channel_id' => $channel_id, 'google_account_id' => $google_account_id, 'notification_id' => $notification_id));
        $reporting->metrics=$metrics;
        $reporting->color=$color;
        $reporting->name=$name;
        $reporting->active = 1;
        $reporting->lang = $lang;
        $reporting->timezone = $timezone;
        return $reporting->save();

    }
    protected function updateReporting($user_id, $channel_id, $google_account_id, $notification_id, $reporting_id, $name, $color, $metrics, $timezone, $lang){
        $reporting = Reporting::where(array('user_id' => $user_id,'id' => $reporting_id))->first();
        $reporting->channel_id = $channel_id;
        $reporting->google_account_id = $google_account_id;
        $reporting->notification_id = $notification_id;
        $reporting->metrics=$metrics;
        $reporting->color=$color;
        $reporting->name=$name;
        $reporting->timezone = $timezone;
        $reporting->lang = $lang;

        return $reporting->save();
    }
}
