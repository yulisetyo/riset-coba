<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ZigzagController extends Controller
{
	/**
	 * description
	 */
	public function index()
	{
		return view('view-zigzag', []);
	}

	/**
	 * description
	 */
	public function zigzag()
	{
		echo "<pre>";

		echo '<p style="font-family:Consolas;font-size:24px;">';

		$text = "JANGKRIK";

		if (isset($_GET['text']) && $_GET['text'] != "") {
			$text = $_GET['text'];
		}

		$words = strtoupper($text);

		echo "plaintext: " . $words . '<br>';

		//~ echo "konversi:<br>";

		$cntWords = strlen($words);

		for ($i = 0; $i < $cntWords; $i++) {

			$piece[] = substr($words, $i, 1);

			$key[] = array_search($piece[$i], $this->arrChar());
		}

		$join = implode("|", $key);

		$zig = explode("|", $join);

		$cZig = count($zig);

		for ($i = 0; $i < $cZig; $i++) {

			$zag[] = $this->arrZigzag()[$zig[$i]];

			$hex[] = $this->arrHex()[$zig[$i]];

			$dec[] = $this->arrDec()[$zig[$i]];

			$bin[] = $this->arrBin()[$zig[$i]];
		}

		$newZag = implode("", $zag);

		$newHex = implode("", $hex);

		$newDec = implode("", $dec);

		$newBin = implode("", $bin);

		echo "- kata asli ke zizag: " . strtoupper($newZag) . '<br>';

		echo "- zigzag ke hexa: " . strtoupper($newHex) . '<br>';

		echo "- hex ke biner &nbsp;:" . strtoupper($newBin) . '<br>';

		echo "- reverse biner&nbsp;:" . strrev($newBin) . '<br>';

		$reverse = strrev($newBin);

		$cnb = strlen($newBin);

		for ($i = 0; $i < $cnb; $i++) {

			$pieceNb[] = substr($newBin, $i, 1);

			$pieceRv[] = substr($reverse, $i, 1);

			if ($pieceNb[$i] == 0 and $pieceRv[$i] == 0) {

				$exor[$i] = 0;
			} else if ($pieceNb[$i] == 1 and $pieceRv[$i] == 0) {

				$exor[$i] = 1;
			} else if ($pieceNb[$i] == 0 and $pieceRv[$i] == 1) {

				$exor[$i] = 1;
			} else {

				$exor[$i] = 0;
			}
		}

		$newExor = implode("", $exor);

		echo  "- exor biner &nbsp;&nbsp;&nbsp;:" . $newExor . '<br>';

		$cnx = strlen($newExor);

		//~ echo "jumlah karakter exor: ".$cnx."<br><br>";

		for ($i = 0; $i < $cnx; $i++) {

			if ($i == 0) {

				$strExor[] = substr($newExor, $i, 4);
			} else {

				$n = $i * 4;

				$max = $cnx - 4;

				if ($n < $max) {

					$strExor[] = substr($newExor, $n, 4);
				}

				if ($n == $max) {

					$strExor[] = substr($newExor, $max, 4);
				}
			}
		}

		for ($i = 0; $i < count($strExor); $i++) {

			$keys[] = array_search($strExor[$i], $this->arrExor());

			echo $strExor[$i]." => ".$keys[$i].'<br>';

		}

		//~ echo count($strExor).'<br>';

		$max = count($strExor) / 2;

		for ($i = 0; $i < count($strExor); $i++) {

			if ($i % 2 == 0) {

				$j = $i + 1;

				$rev2Char[] = (int)$keys[$i] + (int)$keys[$j];
			}
		}

		for ($i = 0; $i < count($rev2Char); $i++) {

			$strChar[] = $this->arrChar()[$rev2Char[$i]];	
		}

		$joinStrChar = implode("", $strChar);

		echo '<span style="color:#FF0000">';

		echo "ciphertext: " . $joinStrChar . '<br>';

		echo '</span>';

		echo '</p>';

		echo "</pre>";
	}

	/**
	 * description
	 */
	public function viewFoo()
	{
		$data = [
			'token' => csrf_token(),
		];

		return view('view-foo', $data);
	}

	/**
	 * description
	 */
	public function foo()
	{
		$string = "JUMPOVER";
		echo $string . "<br><br>";
		for ($i = 0; $i < strlen($string); $i++) {
			$pieces[] = substr($string, $i, 1);
			echo $pieces[$i] . '<br>';
			$key[] = array_search($pieces[$i], $this->arrChar());
		}
		echo '<br>';
		for ($i = 0; $i < strlen($string); $i++) {
			echo $this->arrZigzag()[$key[$i]] . '<br>';
			$fractions[] = $this->arrZigzag()[$key[$i]];
		}

		echo '<br>' . implode("", $fractions);
	}

	/**
	 * description
	 */
	public function viewBar()
	{
		$data = [
			'token' => csrf_token(),
		];

		return view('view-bar', $data);
	}

	/**
	 * description
	 */
	public function bar(Request $request)
	{
		$letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
		$this->validate($request, [
			'plaintext' => 'required|alpha|max:20',
			'sliding_key' => 'required|numeric'
		]);
		$g = abs($request->input('sliding_key'));
		$string = strtoupper($request->input('plaintext'));

		for ($i = 0; $i < count($letters); $i++) {
			$j = $i + $g;

			if ($j > 25) {
				$j = $j % 26;
			}

			$piece[] = $letters[$j];
		}

		echo '<pre><span style="font-size:32px;">';
		// echo json_encode($letter);
		// echo '<br>';
		// echo json_encode($piece);
		// echo '<br>';

		echo $string . " => ";
		echo "geser ke kanan sebanyak " . $g . " karakter <br>";
		
		for ($i = 0; $i < strlen($string); $i++) {
			$fragment[] = substr($string, $i, 1);
			$key[] = array_search($fragment[$i], $letters);
		}

		for ($i = 0; $i < count($key); $i++) {
			$new[] = $piece[$key[$i]];
		}

		echo implode("", $new) . "<br><br>";
		echo '<a href="' . url('zigzag/vbar') . '">Back</a>';
		echo '</span></pre>';
	}

	/**
	 * description
	 */
	public function letterConvertion($sentences = 'muhammad arsyad abyan')
	{
		$rows = $this->getRowNumber();

		foreach ($rows as $row) {
			$arrDec[] = $row->desimal;
			$arrHex[] = $row->heksadesimal;
			$arrBin[] = $row->biner;
			$arrChr[] = $row->karakter;
		}

		$output = '<pre>';
		$output .= '<p style="font-size:18px;">';
		$sentences = strtoupper($sentences);

		//echo $sentences . '<br>';

		$output .= $sentences . '<br>';

		echo $output;
		echo '<br>';
		echo implode('<br>', $this->slicingSentence($sentences));

		$cWrds = count($this->slicingSentence($sentences));

		echo '<br>';
		echo '<br>';

		for ($i = 0; $i < $cWrds; $i++) {
			$words[] = $this->slicingSentence($sentences)[$i];
			$letters[] = $this->slicingWord($words[$i]);
			for ($j = 0; $j < count($letters[$i]); $j++) {
				echo $letters[$i][$j] . ' => ' . array_search($letters[$i][$j], $arrChr) . ' => ' . $arrBin[array_search($letters[$i][$j], $arrChr)] . '<br>';
				// $letter[] = $letters[$i][$j] . ' => ' . array_search($letters[$i][$j], $arrChr) . ' => ' . $arrBin[array_search($letters[$i][$j], $arrChr)] . '';
				// echo $arrBin[array_search($letters[$i][$j], $arrChr)] . '<br>';
				// $huruf[] = $letters[$i][$j] . '<br>';
				// $arrHuruf[] = array_slice($huruf, 0, strlen($letters[$i][$j]));
			}
			echo '<br>';
		}
		// dd($huruf);
		// echo implode('<br>', $letter);
		// echo implode('<br>', $chr[0]);

		// for ($i = 0; $i < count($exploded); $i++) {
		// 	echo $exploded[$i].'<br>';
		// 	$words[] = $exploded[$i];
		// }

		// echo '<br>';

		// for ($i = 0; $i < count($exploded); $i++) {
		// 	for ($j = 0; $j < strlen($words[$i]); $j++) {
		// echo substr($words[$i], $j, 1).'<br>';
		// $dKey[] = array_search(substr($words[$i], $j, 1), $arrChr);
		// $strBin[] = $arrBin[$dKey[$j]];
		// 	}
		// 	echo '<br>';
		// }
		// echo implode("-", $words);
		// echo '<br>';

		// dd($dKey);
	}

	public function slicingSentence($sentences)
	{
		$words = explode(" ", $sentences);

		return $words;
	}

	public function slicingWord($words)
	{
		for ($i = 0; $i < strlen($words); $i++) {
			$letters[] = substr($words, $i, 1);
		}

		return $letters;
	}

	/**
	 * description
	 */
	public function getRowNumber()
	{
		$rows = DB::table('t_konversi_bilangan')
			->select('desimal', 'heksadesimal', 'biner', 'karakter', 'deskripsi')
			->get();

		return $rows;
	}
	
	/**
	 * description
	 */
	public function enkripsi(Request $request)
	{
		$plaintext = strtoupper($request->input('plaintext'));
		
		$cnt = strlen($plaintext);
		
		for	($i = 0; $i < $cnt; $i++) {
			$piece[] = substr($plaintext, $i, 1); // slicing plaintext into letters
			$key[] = array_search($piece[$i], $this->arrChar()); // getting key of array
			$hex[] = $this->arrHex()[$key[$i]]; // convert key of array of hex's array
			$zig[] = $this->arrZigzag()[$key[$i]]; // convert key of array to zigzag's array
			$bin[] = $this->arrBin()[$key[$i]];
			$cip[] = $this->arrZigzag()[$key[$i]];
		}
		
		$cipher = implode("", $cip);
		$heksa = implode("", $hex);
		$biner = implode("", $bin);
		$reverse = strrev($biner);
		
		$xor = [];
		
		for ($x = 0; $x < strlen($biner); $x++) {
			$pbin[] = substr($biner, $x, 1);
			$prev[] = substr($reverse, $x, 1);
			
			$xor[] = $this->logikaXor((int)$pbin[$x], (int)$prev[$x]);
		}
		
		$jxor = implode("", $xor);
		
		for ($n = 0; $n < strlen($jxor); $n++) {
			if ($n == 0) {
				$newDec[] = substr($jxor, 0, 4);
			} else {
				$z = $n * 4;
				
				$max = strlen($jxor) - 4;
				
				if ($z < $max) {
					$newDec[] = substr($jxor, $z, 4);
				}
				
				if ($z == $max) {
					$newDec[] = substr($jxor, $max, 4);
				}
			}
		}
		
		for ($a = 0; $a < count($newDec); $a++) {
			$knc[] = array_search($newDec[$a], $this->arrExor());
			
		}
		
		$newTxt = implode("", $knc);
		
		return [
			'cip' => $cipher,
			'hex' => $heksa,
			'bin' => $biner,
			'rev' => strrev($biner),
			'xor' => $jxor,
			'knc' => $newTxt,
		];
	}
	
	/**
	 * description
	 */
	public function venkripsi()
	{
		$data = [];
		
		return view('view-enkripsi', $data);
	}

	/**
	 * description
	 */
	public function arrChar()
	{
		$arrChar = [ // LETTER OF ASCII CHARACTER
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I',
			'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R',
			'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0',
			'1', '2', '3', '4', '5', '6', '7', '8', '9',
			' '
		];

		return $arrChar;
	}

	/**
	 * description
	 */
	public function arrZigzag()
	{
		$arrZigzag = [ // ASCII TO ZIGZAG
			'A', 'E', 'I', 'M', 'Q', 'U', 'Y', '2', '6',
			'7', 'B', 'F', 'J', 'N', 'R', 'V', 'Z', '3',
			'4', '8', 'C', 'G', 'K', 'O', 'S', 'W', '0',
			'1', '5', '9', 'D', 'H', 'L', 'P', 'T', 'X',
			' '
		];

		return $arrZigzag;
	}

	/**
	 * description
	 */
	public function arrDec()
	{
		$arrDec = [ // ZIGZAG TO DECIMAL
			'65', '69', '73', '77', '81', '85', '89', '50', '54',
			'55', '66', '70', '74', '78', '82', '86', '90', '51',
			'52', '56', '67', '71', '75', '79', '83', '87', '48',
			'49', '53', '57', '68', '72', '76', '80', '84', '88',
			' '
		];

		return $arrDec;
	}

	/**
	 * description
	 */
	public function arrHex()
	{
		$arrHex = [ // DECIMAL TO HEXADECIMAL
			'41', '45', '49', '4D', '51', '55', '59', '32', '36',
			'37', '42', '46', '4A', '4E', '52', '56', '5A', '33',
			'34', '38', '43', '47', '4B', '4F', '53', '57', '30',
			'31', '35', '39', '44', '48', '4C', '50', '54', '58',
			' '
		];

		return $arrHex;
	}

	/**
	 * description
	 */
	public function arrBin()
	{
		$arrBin = [ // HEXADECIMAL TO BINARY
			'01000001', '01000101', '01001001', '01001101', '01010001', '01010101', '01011001', '00110010', '00110110',
			'00110111', '01000010', '01000110', '01001010', '01001110', '01010010', '01010110', '01011010', '00110011',
			'00110100', '00111000', '01000011', '01000111', '01001011', '01001111', '01010011', '01010111', '00110000',
			'00110001', '00110101', '00111001', '01000100', '01001000', '01001100', '01010000', '01010100', '01011000',
			//~ '00100000'
			' '
		];

		return $arrBin;
	}

	/**
	 * description
	 */
	public function arrExor()
	{
		$arrExor = [
			'0000', '0001', '0010', '0011',
			'0100', '0101', '0110', '0111',
			'1000', '1001', '1010', '1011',
			'1100', '1101', '1110', '1111'
		];

		return $arrExor;
	}
	
	/**
	 * description
	 */
	public function logikaXor($p1, $p2)
	{
		if ($p1 == 0 && $p2 == 0) {
			return 0;
		} else if ($p1 == 1 && $p2 == 0) {
			return 1;
		} else if ($p1 == 0 && $p2 == 1) {
			return 1;
		} else {
			return 0;
		}
	}
}
