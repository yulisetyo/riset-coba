<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Response;
use clsTinyButStrong;

class HomeController extends Controller
{
    /**
	 * description 
	 */
	public function index()
	{
		$data = [
			
		];
		return view('app', $data);
	}
}
