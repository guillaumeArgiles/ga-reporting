<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;

class Language extends Controller
{

    public function select(Request $request, $lang){

		session(['locale' => $lang]);
	    return Redirect::back();
	}
}
