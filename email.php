<? 
include("./ayarlar.php");
include("./header.php");

extract ($_POST);
$email = $_POST['email']; 
$filename = $_POST['filename']; 
$filesize = $_POST['filesize']; 
$timestamp = $_POST['timestamp']; 
$downloadlink = $_POST['downloadlink']; 
$deletelink = $_POST['deletelink']; 
$senderip = $_POST['senderip']; 
$sitename = $_POST['sitename']; 
$siteurl = $_POST['siteurl']; 
$subject = "File Link: " . $filename;

$body="

$sitename sitesinden yüklediğiniz dosyanın bilgileri

dosya adı: $filename
dosya boyutu : $filesize MB
Zaman : $timestamp

İndirme linki:
$downloadlink

kaldırma linki:
$deletelink

dosyayı barındıran ip adresi: $senderip

daha fazla dosya yüklemek için ise,
$siteurl


////Mocean Software Support Team
";

// mail("EMAIL TO","SUBJECT","MESSAGE","From: name <email>");

mail($email, $subject, $body, "From: $email"); 

echo "dosya adı: " . $filename . "<br />";
echo "dosya boyutu: " . $filesize . " MB <br />";
echo "yüklenme zamanı: " . $timestamp . "<br /><br />";
echo "indirme linki: <br />";
echo $downloadlink . "<br /><br />";
echo "silme linki: <br />";
echo $deletelink . "<br /><br />";
echo "IP: " . $senderip . "<br /><br />";
echo "bilgiler " . $email . " adresine gönderildi.!<br /><br />";
echo "</div>";
include("./footer.php");

?>