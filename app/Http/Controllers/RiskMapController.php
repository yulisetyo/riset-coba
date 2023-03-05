<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class RiskMapController extends Controller
{
	protected static $tbl = 't_map_matriks';

	public function index()
	{
		$rows = DB::table(self::$tbl)
			//~ ->where('id_header_y', 'A')
			->pluck('warna'); // query

		$cRows = count($rows); // jumlah total
		$chx = $cRows / 5; // jumlah header
		$cdx = $chx / 3; // jumlah detil
		//~ echo "<pre>";
		for ($i = 0; $i < $cRows; $i++) {
			if ($i == 0) {
				$pie[] = array_slice($rows, $i, $chx);
			} else {
				$n = $i * $chx;
				$max = $cRows - $chx;
				if ($n < $max) {
					$pie[] = array_slice($rows, $n, $chx);
				}

				if ($n == $max) {
					$pie[] = array_slice($rows, $max, $chx);
				}
			}
		}

		for ($j = 0; $j < count($pie); $j++) {
			echo json_encode($pie[$j]);
		}


		//~ return response()->json($pie);
	}

	public function map()
	{
		// $rows = DB::table(self::$tbl)
		// 	->select('nilai', 'warna')
		// 	->orderBy('nilai', 'asc')
		// 	->get();
		$rows = DB::select("
		SELECT distinct nilai, warna FROM t_map_matriks
		", []);
		$cRows = count($rows); // jumlah total
		$chx = $cRows / 5; // jumlah header
		$cdx = $chx / 3; // jumlah detil
		$html = '';

		// $dtl = DB::select("
		// SELECT a.id, a.nm_risiko, b.nilai_risiko, b.no_urut
		// FROM d_risiko a
		// LEFT JOIN t_matriks_risiko b ON (a.id_lvl_dampak=b.id_lvl_dampak AND a.id_lvl_kemungkinan=b.id_kemungkinan)
		// ORDER BY nilai_risiko DESC
		// ");

		for ($i = 0; $i < 5; $i++) {
		
			$td1[] = '<td style="with:135px;border:1px solid #000;background-color:' . $rows[$i]->warna . '">';
			// $td1[] .= '<div style="position:absolute;z-index: 1;font-size: 70px;color:#BFBFBF;">' . $rows[$i]->nilai . '</div>';	
			
			for ($d = 0; $d < 7; $d++) {
				$dtl = DB::select("
				SELECT a.id, b.nilai_risiko
				FROM d_risiko a
				LEFT JOIN t_matriks_risiko b ON (a.id_lvl_dampak=b.id_lvl_dampak AND a.id_lvl_kemungkinan=b.id_kemungkinan)
				ORDER BY nilai_risiko DESC
				", []);
				if ($rows[$i]->nilai == $dtl[$d]->nilai_risiko) {
					$td1[] .= '<div style="position:absolute;height:35px;width:35px;float: left;">';
					$td1[] .= '
						<svg viewBox="0 0 10 9" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<desc>Created with Sketch.</desc>
							<defs></defs>
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon id="Star" fill="white" points="5 7.5 2.06107374 9.04508497 2.62235871 5.77254249 0.244717419 3.45491503 3.53053687 2.97745751 5 0 6.46946313 2.97745751 9.75528258 3.45491503 7.37764129 5.77254249 7.93892626 9.04508497"></polygon>
								<text font-family="OpenSans, Open Sans" font-size="5" font-weight="bold" letter-spacing="0.0079861125" fill="#000">
									<tspan x="3.27668186" y="6">' . $dtl[$d]->id . '</tspan>
								</text>
							</g>
						</svg>';
					$td1[] .= '</div>';
				} else {
					$td1[] .= '<div style="height:35px;width:35px;float: left;">';
					$td1[] .= '';
					$td1[] .= '</div>';
				}
			}
			$td1[] .= '</td>';
		}

		for ($i = 5; $i < 10; $i++) {
			$td2[] = '<td style="with:135px;border:1px solid #000;background-color:' . $rows[$i]->warna . '">';
			// $td2[] .= '<div style="position:absolute;z-index: 1;font-size: 70px;color:#BFBFBF;">' . $rows[$i]->nilai . '</div>';
			for ($d = 0; $d < count($dtl); $d++) {
				if ($rows[$i]->nilai == $dtl[$d]->nilai_risiko) {
					$td2[] .= '<div style="height:35px;width:35px;float: left;">';
					$td2[] .= '
						<svg viewBox="0 0 10 9" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<desc>Created with Sketch.</desc>
							<defs></defs>
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon id="Star" fill="white" points="5 7.5 2.06107374 9.04508497 2.62235871 5.77254249 0.244717419 3.45491503 3.53053687 2.97745751 5 0 6.46946313 2.97745751 9.75528258 3.45491503 7.37764129 5.77254249 7.93892626 9.04508497"></polygon>
								<text font-family="OpenSans, Open Sans" font-size="5" font-weight="bold" letter-spacing="0.0079861125" fill="#000">
									<tspan x="3.27668186" y="6">' . $dtl[$d]->id . '</tspan>
								</text>
							</g>
						</svg>';
					$td2[] .= '</div>';
				} else {
					$td2[] .= '<div style="height:35px;width:35px;float: left;">';
					$td2[] .= '';
					$td2[] .= '</div>';
				}
			}
			$td2[] .= '</td>';
		}
/*
		for ($i = 10; $i < 15; $i++) {
			$td3[] = '<td style="border:1px solid #000;background-color:' . $rows[$i]->warna . '">';
			// $td3[] .= '<div style="position:absolute;z-index: 1;font-size: 70px;color:#BFBFBF;">' . $rows[$i]->nilai . '</div>';
			for ($d = 0; $d < count($dtl); $d++) {
				if ($rows[$i]->nilai == $dtl[$d]->nilai_risiko) {
					$td3[] .= '<div style="height:35px;width:35px;float: left;">';
					$td3[] .= '
						<svg viewBox="0 0 10 9" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<desc>Created with Sketch.</desc>
							<defs></defs>
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon id="Star" fill="white" points="5 7.5 2.06107374 9.04508497 2.62235871 5.77254249 0.244717419 3.45491503 3.53053687 2.97745751 5 0 6.46946313 2.97745751 9.75528258 3.45491503 7.37764129 5.77254249 7.93892626 9.04508497"></polygon>
								<text font-family="OpenSans, Open Sans" font-size="5" font-weight="bold" letter-spacing="0.0079861125" fill="#E73C02">
									<tspan x="3.27668186" y="6">' . $dtl[$d]->id . '</tspan>
								</text>
							</g>
						</svg>';
					$td3[] .= '</div>';
				} else {
					$td3[] .= '<div style="height:35px;width:35px;float: left;">';
					$td3[] .= '';
					$td3[] .= '</div>';
				}
			}
			$td3[] .= '</td>';
		}

		for ($i = 15; $i < 20; $i++) {
			$td4[] = '<td style="border:1px solid #000;background-color:' . $rows[$i]->warna . '">';
			// $td4[] .= '<div style="position:absolute;z-index: 1;font-size: 70px;color:#BFBFBF;">' . $rows[$i]->nilai . '</div>';
			for ($d = 0; $d < count($dtl); $d++) {
				if ($rows[$i]->nilai == $dtl[$d]->nilai_risiko) {
					$td4[] .= '<div style="height:35px;width:35px;float: left;">';
					$td4[] .= '
						<svg viewBox="0 0 10 9" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<desc>Created with Sketch.</desc>
							<defs></defs>
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon id="Star" fill="white" points="5 7.5 2.06107374 9.04508497 2.62235871 5.77254249 0.244717419 3.45491503 3.53053687 2.97745751 5 0 6.46946313 2.97745751 9.75528258 3.45491503 7.37764129 5.77254249 7.93892626 9.04508497"></polygon>
								<text font-family="OpenSans, Open Sans" font-size="5" font-weight="bold" letter-spacing="0.0079861125" fill="#E73C02">
									<tspan x="3.27668186" y="6">' . $dtl[$d]->id . '</tspan>
								</text>
							</g>
						</svg>';
					$td4[] .= '</div>';
				} else {
					$td4[] .= '<div style="height:35px;width:35px;float: left;">';
					$td4[] .= '';
					$td4[] .= '</div>';
				}
			}
			$td4[] .= '</td>';
		}

		for ($i = 20; $i < 25; $i++) {
			$td5[] = '<td style="border:1px solid #000;background-color:' . $rows[$i]->warna . '">';
			// $td5[] .= '<div style="position:absolute;z-index: 1;font-size: 70px;color:#BFBFBF;">' . $rows[$i]->nilai . '</div>';
			for ($d = 0; $d < count($dtl); $d++) {
				if ($rows[$i]->nilai == $dtl[$d]->nilai_risiko) {
					$td5[] .= '<div style="height:35px;width:35px;float: left;">';
					$td5[] .= '
						<svg viewBox="0 0 10 9" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<desc>Created with Sketch.</desc>
							<defs></defs>
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon id="Star" fill="white" points="5 7.5 2.06107374 9.04508497 2.62235871 5.77254249 0.244717419 3.45491503 3.53053687 2.97745751 5 0 6.46946313 2.97745751 9.75528258 3.45491503 7.37764129 5.77254249 7.93892626 9.04508497"></polygon>
								<text font-family="OpenSans, Open Sans" font-size="5" font-weight="bold" letter-spacing="0.0079861125" fill="#E73C02">
									<tspan x="3.27668186" y="6">' . $dtl[$d]->id . '</tspan>
								</text>
							</g>
						</svg>';
					$td5[] .= '</div>';
				} else {
					$td5[] .= '<div style="height:35px;width:35px;float: left;">';
					$td5[] .= '';
					$td5[] .= '</div>';
				}
			}
			$td5[] .= '</td>';
		}
*/
		$data = [
			'td1' => implode('', $td1),
			'td2' => implode('', $td2),
			// 'td3' => implode('', $td3),
			// 'td4' => implode('', $td4),
			// 'td5' => implode('', $td5),
		];

		return view('riskmap', $data); 

		// for ($i = 0; $i < $cRows; $i++) {
		/*
			if ($i == 0) {
				// $pie[] = array_slice($rows, $i, $chx);
				$pie[] = '<td style="background-color:' . $rows[$i]->warna . ';font-size:24px;">' . $rows[$i]->nilai . '</td>';
				$i_plus = $i + 1;
				$dtl = DB::select("
					SELECT a.id, a.nm_risiko, a.id_lvl_dampak, a.id_lvl_kemungkinan, b.nilai_risiko, b.no_urut
					FROM d_risiko a
					LEFT JOIN t_matriks_risiko b ON (a.id_lvl_dampak=b.id_lvl_dampak AND a.id_lvl_kemungkinan=b.id_kemungkinan)
					WHERE b.no_urut = ?
				", [
					$i_plus
				]);

				for ($a = 0; $a < 9; $a++) {
					// $par[] = '<div style="height:35px;width:35px;float: left;">' . $dtl[$a]->no_urut . '</div>';
				} 
			} else {
				$n = $i * $chx;
				$max = $cRows - $chx;
				$n_plus = $n + 1;
				if ($n < $max) {
					// $pie[] = array_slice($rows, $n, $chx);
					$pie[] = '<td style="background-color:' . $rows[$n]->warna . ';font-size:24px;">' . $rows[$n]->nilai . '</td>';
					$dtl = DB::select("
						SELECT a.id, a.nm_risiko, a.id_lvl_dampak, a.id_lvl_kemungkinan, b.nilai_risiko, b.no_urut
						FROM d_risiko a
						LEFT JOIN t_matriks_risiko b ON (a.id_lvl_dampak=b.id_lvl_dampak AND a.id_lvl_kemungkinan=b.id_kemungkinan)
						WHERE b.no_urut = ?
					", [
						$n_plus
					]);
					for ($a = $n; $a < $max; $a++) {
						// $par[] = '<div style="height:35px;width:35px;float: left;">' . $dtl[$a]->no_urut . '</div>';
					}
				}

				if ($n == $max) {
					// $pie[] = array_slice($rows, $max, $chx);
					$pie[] = '<td style="background-color:' . $rows[$max]->warna . ';font-size:24px;">' . $rows[$max]->nilai . '</td>';
				}
			}
			*/
		// }
	}
}
