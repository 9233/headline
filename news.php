 <?php
function cut( $from, $start, $end, $lt = false, $gt = false )
    {
        $str = explode( $start, $from );
        if ( isset( $str['1'] ) && $str['1'] != "" )
        {
            $str = explode( $end, $str['1']);
            $strs = $str['0'];
        }
        else
        {
            $strs = "";
        }
        if ( $lt )
        {
            $strs = $start.$strs;
        }
        if ( $gt )
        {
            $strs .= $end;
        }
        return $strs;
    }

$id = $_GET['id'];


$url = "https://headline.taobao.com/feed/feedDetail.htm?id=$id";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$contents33 = curl_exec($ch);
curl_close($ch);

$contents1=iconv('gbk', 'utf-8', $contents33);

$title =  cut($contents1,'<div class="detail-title">','</div>');



$newstext = cut($contents1,')</div>','<div class="link">');


	$parrten ='/<a class="item" href="https:\/\/item\.taobao\.com\/item.htm\?id=(.*)"(.*)<\/a>/isU';
	$newstext1 = preg_replace($parrten,'<a data-type="0" biz-itemid="$1" data-tmpl="628x100" data-tmplid="7" data-rd="2" data-style="2" data-border="1" href="https://item.taobao.com/item.htm?id=$1">https://item.taobao.com/item.htm?id=$1</a>',$newstext);
	
echo "
<div class='blank'></div> 
<div class='block'>
  <div class='box'>
   <div class='box_1'>
    <h3><span>{$title}</span></h3>
    <div class='boxCenterList'>
          {$newstext1}      </div>
   </div>
     <div class='blank5'></div>
";	


$tuijian = cut($contents1,'<div class="hot-title-text">','<div class="footer');

$tuijian2 = preg_replace("/<a class=\"item\" href=\"feedDetail\.htm\?id=(.*)\">/isU","<a class=\"item\" href=\"http://www.11tn.com/news-$1.html\"",$tuijian);


preg_match_all("/<a class=\"item\" href=\"(.*)\"/isU",$tuijian2,$tjlink);
preg_match_all("/<div class=\"item-title\">(.*)<\/div>/isU",$tuijian2,$tjtitle);


$tjlink1 =  $tjlink[1];
$tjtitle1 = $tjtitle[1];

for($i=0;$i<5;$i++){
$tjlink3 = $tjlink1[$i];
$tjtitle3 = $tjtitle1[$i];

echo "<h3><span><a href='$tjlink3'>$tjtitle3</a></span></h3><br />";


}

echo "</div>

</div>
<div class='blank'></div>";
?>
 
