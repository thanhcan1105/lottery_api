<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\DomCrawler\Crawler;

class HomeController extends Controller
{
    //

    public function getResult(Request $request)
    {
        $validatorD = Validator::make(
            $request->all(),
            [
                'date' => 'required|unique:xskt',
            ]
        );
        $validatorP = Validator::make(
            $request->all(),
            [
                'provinces' => 'required|unique:xskt',
            ]
        );
        if ($validatorD->fails() && $validatorP->fails()) {
            $result = Home::where('provinces', $request->provinces)->where('date', $request->date)->get();
            return response()->json($result);
        } else {
            switch ($request->provinces) {
                case 'AN GIANG':
                    $url = 'https://xoso.me/mien-nam/xsag-' . $request->date . '-ket-qua-xo-so-an-giang-ngay-' . $request->date . '-p2.html';
                    break;
                case 'LONG AN':
                    $url = 'https://xoso.me/mien-nam/xsla-' . $request->date . '-ket-qua-xo-so-long-an-ngay-' . $request->date . '-p16.html';
                    break;
                case 'TP HỒ CHÍ MINH':
                    $url = 'https://xoso.me/mien-nam/xshcm-' . $request->date . '-ket-qua-xo-so-thanh-pho-ho-chi-minh-ngay-' . $request->date . '-p14.html';
                    break;
                case 'ĐÀ LẠT':
                    $url = 'https://xoso.me/mien-nam/xsdl-' . $request->date . '-ket-qua-xo-so-da-lat-ngay-' . $request->date . '-p10.html';
                    break;
                case 'KIÊN GIANG':
                    $url = 'https://xoso.me/mien-nam/xskg-' . $request->date . '-ket-qua-xo-so-kien-giang-ngay-' . $request->date . '-p15.html';
                    break;
                case 'TIỀN GIANG':
                    $url = 'https://xoso.me/mien-nam/xstg-' . $request->date . '-ket-qua-xo-so-tien-giang-ngay-' . $request->date . '-p19.html';
                    break;
                case 'CÀ MAU':
                    $url = 'https://xoso.me/mien-nam/xscm-' . $request->date . '-ket-qua-xo-so-ca-mau-ngay-' . $request->date . '-p8.html';
                    break;
                case 'ĐÔNG THÁP':
                    $url = 'https://xoso.me/mien-nam/xsdt-' . $request->date . '-ket-qua-xo-so-dong-thap-ngay-' . $request->date . '-p12.html';
                    break;
                case 'BẠC LIÊU':
                    $url = 'https://xoso.me/mien-nam/xsbl-' . $request->date . '-ket-qua-xo-so-bac-lieu-ngay-' . $request->date . '-p3.html';
                    break;
                case 'BẾN TRE':
                    $url = 'https://xoso.me/mien-nam/xsbt-' . $request->date . '-ket-qua-xo-so-ben-tre-ngay-' . $request->date . '-p4.html';
                    break;
                case 'VŨNG TÀU':
                    $url = 'https://xoso.me/mien-nam/xsvt-' . $request->date . '-ket-qua-xo-so-vung-tau-ngay-' . $request->date . '-p22.html';
                    break;
                case 'CẦN THƠ':
                    $url = 'https://xoso.me/mien-nam/xsct-' . $request->date . '-ket-qua-xo-so-can-tho-ngay-' . $request->date . '-p9.html';
                    break;
                case 'ĐỒNG NAI':
                    $url = 'https://xoso.me/mien-nam/xsdn-' . $request->date . '-ket-qua-xo-so-dong-nai-ngay-' . $request->date . '-p11.html';
                    break;
                case 'SÓC TRĂNG':
                    $url = 'https://xoso.me/mien-nam/xsst-' . $request->date . '-ket-qua-xo-so-soc-trang-ngay-' . $request->date . '-p17.html';
                    break;
                case 'BÌNH THUẬN':
                    $url = 'https://xoso.me/mien-nam/xsbth-' . $request->date . '-ket-qua-xo-so-binh-thuan-ngay-' . $request->date . '-p7.html';
                    break;
                case 'TÂY NINH':
                    $url = 'https://xoso.me/mien-nam/xstn-' . $request->date . '-ket-qua-xo-so-tay-ninh-ngay-' . $request->date . '-p18.html';
                    break;
                case 'BÌNH DƯƠNG':
                    $url = 'https://xoso.me/mien-nam/xsbd-' . $request->date . '-ket-qua-xo-so-binh-duong-ngay-' . $request->date . '-p5.html';
                    break;
                case 'TRÀ VINH':
                    $url = 'https://xoso.me/mien-nam/xstv-' . $request->date . '-ket-qua-xo-so-tra-vinh-ngay-' . $request->date . '-p20.html';
                    break;
                case 'VĨNH LONG':
                    $url = 'https://xoso.me/mien-nam/xsvl-' . $request->date . '-ket-qua-xo-so-vinh-long-ngay-' . $request->date . '-p21.html';
                    break;
                case 'BÌNH PHƯỚC':
                    $url = 'https://xoso.me/mien-nam/xsbp-' . $request->date . '-ket-qua-xo-so-binh-phuoc-ngay-' . $request->date . '-p6.html';
                    break;
                case 'HẬU GIANG':
                    $url = 'https://xoso.me/mien-nam/xshg-' . $request->date . '-ket-qua-xo-so-hau-giang-ngay-' . $request->date . '-p13.html';
                    break;
                default;
            }

            $client = new Client();

            $crawler = $client->request('GET', $url);

            $crawler->each(
                function (Crawler $node) {
                    $giaidb = $node->filter('.v-gdb')->text();
                    $giai1  = $node->filter('.v-g1')->text();
                    $giai2  = $node->filter('.v-g2')->text();
                    $giai30 = $node->filter('.v-g3-0')->text();
                    $giai31 = $node->filter('.v-g3-1')->text();
                    $giai40 = $node->filter('.v-g4-0')->text();
                    $giai41 = $node->filter('.v-g4-1')->text();
                    $giai42 = $node->filter('.v-g4-2')->text();
                    $giai43 = $node->filter('.v-g4-3')->text();
                    $giai44 = $node->filter('.v-g4-4')->text();
                    $giai45 = $node->filter('.v-g4-5')->text();
                    $giai46 = $node->filter('.v-g4-6')->text();
                    $giai5  = $node->filter('.v-g5')->text();
                    $giai60 = $node->filter('.v-g6-0')->text();
                    $giai61 = $node->filter('.v-g6-1')->text();
                    $giai62 = $node->filter('.v-g6-2')->text();
                    $giai7  = $node->filter('.v-g7')->text();
                    $giai8  = $node->filter('.v-g8')->text();

                    $data = $node->filter('h2.tit-mien')->text();

                    $list = [
                        'Tiền Giang',
                        'Vĩnh Long',
                        'Đồng Tháp',
                        'Cà Mau',
                        'Kiên Giang',
                        'TP Hồ Chí Minh',
                        'Bến Tre',
                        'Vũng Tàu',
                        'Bạc Liêu',
                        'Đồng Nai',
                        'Cần Thơ',
                        'Sóc Trăng',
                        'Tây Ninh',
                        'An Giang',
                        'Bình Thuận',
                        'Bình Dương',
                        'Trà Vinh',
                        'Long An',
                        'Bình Phước',
                        'Hậu Giang',
                        'Đà Lạt'
                    ];

                    foreach ($list as $key => $value) {
                        // print($value);
                        if (str_contains($data, $value)) {
                            $provinces = $value;
                        }
                    }

                    $list_data = explode(" ", $data);

                    if ($provinces == 'TP Hồ Chí Minh') {
                        $date = $list_data[10];
                        print($date);
                    } else {
                        $date = $list_data[8];
                    }

                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 8, 'result'  => $giai8]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 7, 'result'  => $giai7]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 6, 'result'  => $giai60]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 6, 'result'  => $giai61]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 6, 'result'  => $giai62]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 5, 'result'  => $giai5]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 4, 'result'  => $giai40]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 4, 'result'  => $giai41]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 4, 'result'  => $giai42]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 4, 'result'  => $giai43]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 4, 'result'  => $giai44]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 4, 'result'  => $giai45]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 4, 'result'  => $giai46]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 3, 'result'  => $giai30]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 3, 'result'  => $giai31]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 2, 'result'  => $giai2]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 1, 'result'  => $giai1]);
                    Home::create(['provinces' => $provinces, 'ticket_type' => '', 'date' => $date, 'giai' => 0, 'result'  => $giaidb]);
                }
            );

            $result = Home::where('provinces', $request->provinces)->where('date', $request->date)->get();
            return response()->json($result);
        }
    }
}
