<?php

include("./ayarlar.php");


if(isset($_GET['adw'])){
	$gpass = $_GET['adw'];
	$contents = file("password.txt");
	$pass = md5(implode($contents));
	if($gpass != $pass){
		die("Yönetici izni geçersiz.");
	}
}else{
if($linktlapi != ""){
if(isset($_SERVER['HTTP_REFERER'])){
preg_match('@^(?:http://)?([^/]+)@i', $_SERVER['HTTP_REFERER'], $gelenurl);
$gurl = $gelenurl[1];
if($gurl != "link.tl"){
	    echo "zaman aşımına uğradı tekrar deneyiniz.";
        die();
}}}}

if(!isset($_GET['file']))
{
  echo "<script>window.location = '".$scripturl."?err';</script>";
}

$validdownload = 0;

$filecrc = $_GET['file'];
$filecrctxt = $filecrc.".txt";
if (file_exists("./depodata/".$filecrctxt)) {
	$fh = fopen ("./depodata/".$filecrctxt,r);
	$filedata= explode('|', fgets($fh));
		$validdownload=$filedata;
	fclose($fh);
}

if($validdownload==0) {
    echo "geçerli bir indirme urlsi değil.";
    include("./footer.php");
    die();
}

$userip = $_SERVER['REMOTE_ADDR'];
$time = time();

$filesize = filesize("./depo/".$filecrc);
$filesize = $filesize / 1048576;

if($filesize > $nolimitsize) {
$downloaders = fopen("./downloaders.txt","a+");
fputs($downloaders,"$userip|$time\n");
fclose($downloaders);
}

$validdownload[3] = time();

$newfile = "./depodata/$filecrc" . ".txt";
$f=fopen($newfile, "w");
fwrite ($f,$validdownload[0]."|". $validdownload[1]."|". $validdownload[2]."|". $validdownload[3]."|".($validdownload[4]+1)."\n");
fclose($f);

header('Content-type: application/octetstream');
header('Content-Length: ' . filesize("./depo/".$filecrc));
header('Content-Disposition: attachment; filename="'.$validdownload[0].'"');
readfile("./depo/".$filecrc);

?>