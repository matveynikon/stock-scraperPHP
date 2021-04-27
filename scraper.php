<?php
error_reporting(E_ERROR | E_PARSE);
require 'vendor/autoload.php';
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
$client = new Client();
$step = 3;
$x = 0;
for ($x = 0; $x <= 24; $x++) {
    try {
      define($prev = $stonk, true);
    }
    catch(exception $e){
        print("still at first itteration");
    }
    $crawler = $client->request('GET', 'https://finance.yahoo.com/quote/TSLA?p=TSLA&.tsrc=fin-srch');
    $output = $crawler->filterXpath('//*[@id="quote-header-info"]/div[3]/div[1]/div/span[1]');
    $stonk = $output->text();
    if($stonk > $prev){
        if($x == 0){
            print("+  {$stonk} <== first price\n");
        }
        else{
            $inc = $stonk - $prev;
            $i2 = round($inc * $step, 2) / $step;
            print("+  {$stonk}| increase: {$i2}\n");
        }
    }
    elseif($prev > $stonk){
        if($x == 0){
            print("+  {$stonk} <== first price\n");
        }
        else{
            $dec = $prev - $stonk;
            $d2 = round($dec * $step, 2) / $step;
            print("-  {$stonk}| decrease: {$d2}\n");
        }
    }
    else{
        if($x == 0){
            print("+  {$stonk} <== first price\n");
        }
        else{
            print("=  {$stonk}| no change\n");
        }
    }
    sleep(1);
}
?>
