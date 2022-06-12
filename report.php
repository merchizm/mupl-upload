<?php

include("./ayarlar.php");
include("./header.php");

if(isset($_GET['file'])){
$thisfile=$_GET['file'];
}else{
echo "tekrar şikayet etmeyi deneyiniz."; 
include("./footer.php");
die();
}

$foundfile=0;
if (file_exists("./depodata/".$thisfile.".txt")) {
	$fh1=fopen("./depodata/".$thisfile.".txt",r);
	$foundfile= explode('|', fgets($fh1));
	fclose($fh1);
}

if($foundfile==0){
echo "tekrar şikayet etmeyi deneyiniz"; 
include("./footer.php");
die();
}

$bans=file("./bans.txt");
foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
    echo "sizin dosya şikayet etmeniz yasak :)";
    include("./footer.php");
    die();
  }
}

$reported = 0;
$fc=file("./reports.txt");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] == $thisfile)
    $reported = 1;
}

if($reported == 1) {
echo "Dosya Bildirildi. Teşekkürler.";
include("./footer.php");
die();
}

$filelist = fopen("./reports.txt","a+");
fwrite($filelist, $thisfile ."|". $_SERVER['REMOTE_ADDR'] ."\n");

echo "Dosya Bildirildi. Teşekkürler.";
include("./footer.php");

?>