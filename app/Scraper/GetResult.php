<?php

namespace App\Scraper;

use App\Models\Home;
use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class GetReSult
{

    public function scrape()
    {
        // $url = 'https://www.minhngoc.net.vn/ket-qua-xo-so/mien-nam/an-giang/29-09-2022.html';
        $url = 'https://xoso.me/mien-nam/xsla-1-10-2022-ket-qua-xo-so-long-an-ngay-1-10-2022-p16.html';

        $client = new Client();

        $crawler = $client->request('GET', $url);

        $crawler->filter('table.kqtinh')->first()->each(
            function (Crawler $node) {
                $giaidb = $node->filter('.v-gdb')->text();
                $giai1 = $node->filter('.v-g1')->text();
                $giai2 = $node->filter('.v-g2')->text();
                $giai30 = $node->filter('.v-g3-0')->text();
                $giai31 = $node->filter('.v-g3-1')->text();
                $giai40 = $node->filter('.v-g4-0')->text();
                $giai41 = $node->filter('.v-g4-1')->text();
                $giai42 = $node->filter('.v-g4-2')->text();
                $giai43 = $node->filter('.v-g4-3')->text();
                $giai44 = $node->filter('.v-g4-4')->text();
                $giai45 = $node->filter('.v-g4-5')->text();
                $giai46 = $node->filter('.v-g4-6')->text();
                $giai5 = $node->filter('.v-g5')->text();
                $giai60 = $node->filter('.v-g6-0')->text();
                $giai61 = $node->filter('.v-g6-1')->text();
                $giai62 = $node->filter('.v-g6-2')->text();
                $giai7 = $node->filter('.v-g7')->text();
                $giai8 = $node->filter('.v-g8')->text();

                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 8, 'result'  => $giai8]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 7, 'result'  => $giai7]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 6, 'result'  => $giai60]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 6, 'result'  => $giai61]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 6, 'result'  => $giai62]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 5, 'result'  => $giai5]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 4, 'result'  => $giai40]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 4, 'result'  => $giai41]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 4, 'result'  => $giai42]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 4, 'result'  => $giai43]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 4, 'result'  => $giai44]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 4, 'result'  => $giai45]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 4, 'result'  => $giai46]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 3, 'result'  => $giai30]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 3, 'result'  => $giai31]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 2, 'result'  => $giai2]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 1, 'result'  => $giai1]);
                Home::create(['provinces' => 'An Giang', 'ticket_type' => 'AG-9K5', 'date' => '29-09-2022', 'giai' => 0, 'result'  => $giaidb]);
            }
        );
    }
}
