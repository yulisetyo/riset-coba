<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;

class WetonController extends Controller
{
    public function index()
    {
        $html = '<pre>';
        $arrHari = ['Ahad', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $arrPasaran = ['Pahing', 'Pon', 'Wage', 'Kliwon', 'Legi'];
        $arrWuku = [
            'Sinta', 'Landep', 'Wukir', 'Kurantil', 'Tolu', 'Gumbreg', 'Warigalit', 'Wariagung', 'Julungwangi', 'Sungsang',
            'Galungan', 'Kuningan', 'Langkir', 'Mandhasiya', 'Julungpujut', 'Pahang', 'Kuruwelut', 'Marakih', 'Tambir', 'Medhangkungan',
            'Maktal', 'Wuye', 'Menahil', 'Prangbakat', 'Bala', 'Wugu', 'Wayang', 'Kelawu', 'Dhukut', 'Watugunung'
        ];
        $days = 7;

        if (isset($_GET['days'])) {
            $days = $_GET['days'];
        }

        $cntDay = strlen($days);

        $getHari = $days % count($arrHari);
        $getPasaran = $days % count($arrPasaran);

        // echo $arrHari[$getHari] . " " . $arrPasaran[$getPasaran] . "<br><br>";

        for ($i = 0; $i < $days; $i++) {

            if ($i > 6) {
                $j = $i % 7;
            } else {
                $j = $i;
            }

            // echo $arrHari[$j] . " ";
            $pieHari[] = $arrHari[$j];

            if ($i > 4) {
                $k = $i % 5;
            } else {
                $k = $i;
            }

            // echo $arrPasaran[$k] . "<br>";
            $piePasaran[] = $arrPasaran[$k];

            if ($i % 7 == 0) {
                $wuku[] = $i;
            }

            if (strlen($i) < $cntDay) {
                $pieHarPas[] = substr($arrHari[$j], 0, 3) . 0 . $i . substr($arrPasaran[$k], 0, 3);
            } else {
                $pieHarPas[] = substr($arrHari[$j], 0, 3) . $i . substr($arrPasaran[$k], 0, 3);
            }
        }

        $html .= implode("<br>", $pieHarPas);
        $html .= '<br><br>';

        $c = count($wuku);

        // echo "<br>" . $c . "<br>";

        for ($x = 0; $x < $c; $x++) {
            if ($x > 29) {

                $y = $x % 30;

                $pieWuku[] = substr($arrWuku[$y], 0, 3);

                // echo $arrWuku[$y] . "<br>";
            } else {

                $y = $x;

                $pieWuku[] = substr($arrWuku[$y], 0, 3);

                // echo $arrWuku[$y] . "<br>";
            }
        }

        $html .= "wuku: " . implode(", ", $pieWuku);
        $html .= '</pre>';

        return $html;
    }
}
