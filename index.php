		<?php

$url = 'https://headline.taobao.com/feed/feedQuery.do?columnId=0';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_HEADER,0);

curl_setopt($ch, CURLOPT_ENCODING, 'gzip');

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$contents33 = curl_exec($ch);
curl_close($ch);

$contents22=iconv('gbk', 'utf-8', $contents33);

$contents = preg_replace("/\"detailUrl\":\"http:\/\/headline.taobao.com\/feed\/feedDetail.htm\?id=(.*)\"/isU","\"detailUrl\":\"http://www.11tn.com/news-$1.html\"",$contents22);



preg_match_all("/detailUrl\":\"(.*)\"/isU",$contents,$link);
preg_match_all("/\"name\":\"(.*)\"/isU",$contents,$title);



$link1 =  $link[1];
$title1 = $title[1];
//var_dump($title1);
for($i=0;$i<20;$i++){
$link3 = $link1[$i];
$title3 = $title1[$i];

echo "<li><a href='$link3'>$title3</a></li>";
}

?>
