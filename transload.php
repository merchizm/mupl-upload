<?php

error_reporting(E_ERROR | E_PARSE);

include("./ayarlar.php");
include("./header.php");

function urlerror() {
	echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">Verdiğiniz Link/URL Yanlış veya Verdiğiniz Site Kullanım Dışı.</a>';
    include ("footer.php");
	die;
}

$url = $_POST[from];
$filename = substr(strrchr($url, "/"),1);
$invalidchars = array ("\"",";",":","<",">","=");
if (!stristr($url,'http://')) $invalidurl=true;
if (stristr($filename,$invalidchars)) $invalidfilename=true;
if (($invalidurl) || ($invalidfilename)) {
	urlerror();
}


if ($_GET[xfer]) {
	if (($url == "") || ($url == "Paste file url here")) {
		print '<a href="#" class="btn btn-block btn-lg btn-default disabled">URL Yazmayı unuttun :)</a>';
	    include("./footer.php");
	    die();
	} else {
		$movefile = "./urltemp/" . $filename;
		copy("$_POST[from]", $movefile)
						or die (urlerror());
		$filecrc = md5_file("./urltemp/" . $filename);
	}
}

$filesize = filesize("./urltemp/$filename");

$bans=file("./bans.txt");
foreach($bans as $line)
{
  if ($line==$filecrc."\n"){
    echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">bu dosya kurallara aykırı olduğu için yüklenmemekte.</a>';
	unlink ("./urltemp/" . $filename);
    include("./footer.php");
    die();
  }
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
    echo "You are not allowed to upload files.";
	unlink ("./urltemp/" . $filename);
    include("./footer.php");
    die();
  }
}

$dirname = "./depodata";
$dh = opendir( $dirname ) or die("couldn't open directory");
while ( $file = readdir( $dh ) ) {
  if ($file != '.' && $file != '..' && $file != '.htaccess') {
	$fh = fopen ("./depodata/".$file,r);
	$filedata= explode('|', fgets($fh));
	$newfilecrc = str_replace(".txt","",$file);
	  if ($newfilecrc == $filecrc){
	    echo "Bu Dosya Zaten Yüklendi.<br /><br />";
	    echo "Dosya Adı: " . $filedata[0] . "<br /><br />";
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
   echo "Geçeriz Dosya Türü.";
   unlink ("./urltemp/" . $filename);
   include("./footer.php");
   die();
}
}

if($filesize==0) {
echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">dosya seçmediniz :)</a>';
include("./footer.php");
die();
}

$filesize = $filesize / 1048576;

if($filesize > $maxfilesize) {
echo '<a href="#" class="btn btn-block btn-lg btn-default disabled">seçtiğiniz dosya boyutu çok yüksek max. '.$maxfilesize.' MB Yükleyebilirsiniz.</a>';
unlink ("./urltemp/" . $filename);
include("./footer.php");
die();
}

$userip = $_SERVER['REMOTE_ADDR'];
$time = time();

$passkey = rand(100000, 999999);

$movefile = "./depo/" . $filecrc;
rename("urltemp/$filename", $movefile);


$filedata = fopen("./depodata/".$filecrc.".txt","w");
fwrite($filedata, $filename ."|". $passkey ."|". $userip ."|". $time."|0\n");

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


echo "</div>";
include("./footer.php");
?>