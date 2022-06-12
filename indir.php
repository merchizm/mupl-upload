<?php
/*******************************************************************
MOCEAN SOFTWARE

*******************************************************************/

include("./ayarlar.php");
include("./header.php");
echo '<center>';
function shortlink($site)
 {

  $ch = curl_init();
  $hc = "YahooSeeker-Testing/v3.9 (compatible; Mozilla 4.0; MSIE 5.5; Yahoo! Search - Web Search)";
  curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com');
  curl_setopt($ch, CURLOPT_URL, $site);
  curl_setopt($ch, CURLOPT_USERAGENT, $hc);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $veri = curl_exec($ch);
  curl_close($ch);
  
  $site = explode("/", $veri);
  echo $site[3];
 }

//ban kontrol
$bans=file("./bans.txt");
foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']){
    echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">İndirme cezanız bulunmaktadır.</a>';
	die();
  }
}
// dosya kontrol
$foundfile=0;
if (isset($_GET['dosya']) && file_exists("./depodata/".($_GET['dosya']).".txt")) {
	$filecrc = $_GET['dosya'];
	$fh1=fopen("./depodata/".$filecrc.".txt",r);
	$foundfile= explode('|', fgets($fh1));
	fclose($fh1);
  
} else {
  echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">Geçerli bir indirme bağlantısı değil.</a>';
  include("./ads.html");
  include("./footer.php");
  die();
}


// dosya silme protokolü
if(isset($_GET['sil'])) {
$deleted=0;
$filecrc = $_GET['dosya'];
$filecrctxt = $filecrc . ".txt";
$passcode = $_GET['sil'];
if (file_exists("./depodata/".$filecrctxt)) {
	$fh2=fopen ("./depodata/".$filecrctxt,r);
	$filedata= explode('|', fgets($fh2));
	if($filedata[1] == $passcode){
		$deleted=1;
		unlink("./depodata/".$filecrctxt);
	}

}
if($deleted==1){
unlink("./depo/".$_GET['dosya']);
echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">Dosya silindi.</a>';
} else {
echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">geçerli bir dosya silme protokolü bulunamadı</a>';
}
include("./ads.html");
include("./footer.php");
die();

}

/// dosya boyutu hesaplama
$filesize = filesize("./depo/".$_GET['dosya']);
$filesize = $filesize / 1048576;
$fsize = 0;
$fsizetxt = "";
  if ($filesize < 1)
  {
     $fsize = round($filesize*1024,2);
     $fsizetxt = "".$fsize." KB";

  }
  else
    {
     $fsize = round($filesize,2);
     $fsizetxt = "".$fsize." MB";
  }

$fh3 = fopen("./depodata/".$_GET['dosya'].".txt" ,r);
$filedata= explode('|', fgets($fh3));

echo "<h2>".$filedata[0]."</h2>";

if (strpos($filedata[0],".txt")){
     $dosyatur = "txt";
}else{
     if (strpos($filedata[0],".exe")){
     $dosyatur = "exe";
}else{
     if (strpos($filedata[0],".rar")){
     $dosyatur = "rar";
}else{
    if (strpos($filedata[0],".zip")){
     $dosyatur = "zip";
}else{
  if (strpos($filedata[0],".mp3")){
     $dosyatur = "mp3";
}else{
  if (strpos($filedata[0],".mp4")){
     $dosyatur = "mp3";
}else{
     if (strpos($filedata[0],".avi")){
     $dosyatur = "avi";
}else{
     if (strpos($filedata[0],".pdf")){
     $dosyatur = "pdf";
}else{
     $dosyatur = "idn";
}}}}}}}}

echo '    <title>'.$siteadi.' - '.$filedata[0].' indir</title>';
echo '<div class="demo-download"><img src="tur/'.$dosyatur.'.png"></div></center><div class="information"><div class="informationyazi">Dosya Boyutu : '.$fsizetxt.'</br>Toplam İndirme : '.$filedata[4].'</br>MD5 Hash : '.$_GET['dosya'].'</br><center><a href="./scan.php?dosya='.$filecrc.'">dosyayı tara</a></br>';
?>
</div></div><center><br>
<?php
$dlink = $scripturl . "dl.php?file=". $filecrc;
$url = $linktlapi.$dlink;	
if($linktlapi == ""){
// reklamsız	
?>	
<a href="<?php echo $dlink; ?>" class="btn btn-primary btn-lg btn-block" style=width:70px>İndir</a>
<?php
}else{
// reklamlı
?>	
<a href="http://link.tl/<? shortlink($url); ?>" class="btn btn-primary btn-lg btn-block" style=width:70px>İndir</a>
<?php
}
?>
</script>

<p class="demo-download-text">5 saniye bekleyin ve "reklamı geç" butonuna basın.</p>
<br /><p>
<a href="report.php?file=<?php echo $filecrc;?>" class="btn btn-block btn-lg btn-danger" style=width:120px>Şikayet et</a></p>
<?php
include("./ads.html");
echo'</center>';
include("./footer.php");
?>