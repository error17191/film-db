<?php

require_once 'vendor/autoload.php';

use Goutte\Client;

$url = 'https://www.elcinema.com/index/country/eg?page=';

$stats = json_decode(file_get_contents('data/stats.json'));

$films = json_decode(file_get_contents('data/films.json'));


$client = new Client();

for ($i = $stats->last_page + 1; true; $i++) {
    /** @var Symfony\Component\DomCrawler\Crawler $crawler */
    echo "Fetching Page #{$i}\n";
    $crawler = $client->request('GET', $url . $i);
    echo "Page Fetched ..";
    if ($client->getResponse()->getStatus() !== 200) {
        echo "Seems We Reached End For Now .. Page Number {$i}\n";
        echo "Total Movies: {$stats->films_count}\n";
        exit();
    }
    //Skip the first tr which includes th's
    $crawler = $crawler->filter('table tr')->slice(1);
    $pageFilms = 0;
    $crawler->each(function ($subCrawler) use (&$films, &$stats, &$pageFilms) {
        /** @var  Symfony\Component\DomCrawler\Crawler $subCrawler */
        $tds = $subCrawler->filter('td');

        $type = mb_strlen($tds->eq(2)->text());

        if ($type == 4) { // is a film ?
            $stats->films_count++;
            $pageFilms++;

            $name = $tds->eq(1)->filter('a')
                ->eq(1)->text();

            $path = $tds->eq(1)->filter('a')
                ->eq(1)->attr('href');
            $pathParts = explode('/', $path);

            $uid = (int) $pathParts[2];

            $year = (int) $tds->eq(3)->text();

            if($year < 1918){
                return;
            }

            $films[] = compact('name', 'year', 'uid');
            echo "Found a film : {$name}\n";
        }
    });
    $stats->last_page++;
    file_put_contents('data/films.json', json_encode($films, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    file_put_contents('data/stats.json', json_encode($stats, JSON_PRETTY_PRINT));
    echo "Saved {$pageFilms} film(s) from page #{$i}\n";
}

