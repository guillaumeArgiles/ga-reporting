<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datas extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'name', 'value'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected function incrementReportsSent(){
        $data = Datas::firstOrNew(array('name' => 'nb_reports_sent'));
        $data->value = $data->value +1;
        return $data->save();

    }
    protected function getReportsSent(){
        $data = Datas::firstOrNew(array('name' => 'nb_reports_sent'));
        return $data->value;
    }
}
