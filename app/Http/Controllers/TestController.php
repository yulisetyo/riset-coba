<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    /**
	 * description
	 */
	public function split($sentences)
	{
		$arr = explode(" ", strtoupper($sentences));
		return $arr;
	}
	
	/**
	 * description
	 */
	public function arrWords()
	{
		$sentences = "tindak lanjut mitigasi";
		$arrWords = $this->split($sentences);
		return $arrWords;
	}
	
	public function cipher1($word)
	{
		$sentences = "tindak lanjut mitigasi";
		$arrWords = $this->split($sentences); // memecah kalimat menjadi beberapa kata
		$obj = new ZigzagController(); // instansiasi kelas baru dari kelas ZigZagController
		
		for ($i = 0; $i < count($arrWords[0]); $i++) { // loop sejumlah huruf dalam suatu kata
			$piece[] = substr($arrWords[0], 0, 1); // memecah kata menjadi beberapa huruf
			$keys[] = array_search($piece[$i], $obj->arrChar()); // mengambil key dari array karakter awal
		}
		
	}
}
