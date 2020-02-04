<?php
header('content-type: application/json');
$html = file_get_contents('https://tala.ir/prayer-times/'.$_REQUEST['city']);

$doc = new DOMDocument();

$doc->loadHTML('<?xml encoding="UTF-8">' . $html);

$xpath = new DOMXPath($doc);

$q = $xpath->query('//div[@class="left"]/div');

$sobh = $q[0]->nodeValue;
$tolo = $q[1]->nodeValue;
$zohr = $q[2]->nodeValue;
$ghorob = $q[3]->nodeValue;
$maghreb = $q[4]->nodeValue;
$esha = $q[5]->nodeValue;
$length = $q->length;
if($length > 0){
$data = [
    'sobh'=> $sobh,
    'tolo'=> $tolo,
    'zohr'=> $zohr,
    'ghorob'=> $ghorob,
    'maghreb'=> $maghreb,
    'esha'=> $esha
];
}else{
     $data = ['error'=> "No city found"];
}
echo json_encode($data,128|256);