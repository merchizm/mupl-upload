<?php

include("./ayarlar.php");
include("./header.php");

$filename = $_FILES['upfile']['name'];
$filesize = $_FILES['upfile']['size'];

if($filesize==0) {
echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">Dosyayı seçmeyi unuttunuz. :)</a>';
include("./footer.php");
die();
}

$filecrc = md5_file($_FILES['upfile']['tmp_name']);

$bans=file("./bans.txt");
foreach($bans as $line)
{
  if ($line==$filecrc."\n"){
    echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">bu dosya kurallara aykırı olduğu için yüklenmemekte.</a>';
    include("./footer.php");
    die();
  }
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
    echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">sizin dosya yüklemeniz yasaklanmış.</a>';
    include("./footer.php");
    die();
  }
}

$dirname = "./depodata";
$dh = opendir( $dirname ) or die("hata verdi. error : couldn't open directory");
while ( $file = readdir( $dh ) ) {
  if ($file != '.' && $file != '..' && $file != '.htaccess') {
	$fh = fopen ("./depodata/".$file,r);
	$filedata= explode('|', fgets($fh));
	$newfilecrc = str_replace(".txt","",$file);
	  if ($newfilecrc == $filecrc){
	    echo "Dosya önceden yüklenmiş.<br /><br />";
	    echo "Dosya İsmi: " . $filedata[0] . "<br /><br />";
	    echo "İndirme Linki:<BR><a href=\"" . $scripturl . "indir.php?dosya=" . $filecrc . "\">". $scripturl . "indir.php?dosya=" . $filecrc . "</a><br />";
	    include("./footer.php");
	    die();
	  }
	fclose ($fh);
  }
}
closedir( $dh );

if(isset($allowedtypes)){
$allowed = 0;
foreach($allowedtypes as $ext) {
  if(substr($filename, (0 - (strlen($ext)+1) )) == ".".$ext)
    $allowed = 1;
}
if($allowed==0) {
   echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">Öngörülen Dosya Türü Geçersiz...</a>';
   include("./footer.php");
   die();
}
}

$filesize = $filesize / 1048576;

if($filesize > $maxfilesize) {
echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">Yüklediğiniz Dosyanın Boyutu Çok Büyük!</a>';
include("./footer.php");
die();
}

$userip = $_SERVER['REMOTE_ADDR'];
$time = time();

$passkey = rand(100000, 999999);

$filename = basename($_FILES['upfile']['name']);

$filedata = fopen("./depodata/".$filecrc.".txt","w");
fwrite($filedata, $filename ."|". $passkey ."|". $userip ."|". $time."|0\n");

$movefile = "./depo/" . $filecrc;
move_uploaded_file($_FILES['upfile']['tmp_name'], $movefile);

$downloadlink = $scripturl . "indir.php?dosya=" . $filecrc;
$deletelink = $scripturl . "indir.php?dosya=" . $filecrc . "&sil=" . $passkey;
$timestamp = date('F j, Y, g:i a');
$senderip = $_SERVER['REMOTE_ADDR'];
$filesize = round($filesize,2);
echo "<center>";
echo "Dosyanız, " . $filename . " Yüklendi!<br /><br />";
echo "<h3>Linkler ;</h3>";
echo "Dosyayı İndirmek İçin:<br /><a href=\"$downloadlink\">$downloadlink</a><br /><br />";
echo "Dosyayı Silmek İçin:<br /><a href=\"$deletelink\">$deletelink</a>";
echo "<h3>Dosya bilgisi</h3>";
echo "<br>dosya yüklenme tarihi : ".$timestamp."";
echo '<br>yükleyen : '.$senderip.'';
echo '<br>dosya boyutu : '.$filesize.'';
echo '<br>dosya ismi '.$filename.'';
echo '</center>';
include("./footer.php");
?>