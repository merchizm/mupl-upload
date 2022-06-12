 <title>VirusTotal</title>
 <?
$filecrc = $_GET['dosya'];
$file_name_with_full_path = realpath('./depo/'.$filecrc);
$api_key = 'API KEY';
$cfile = curl_file_create($file_name_with_full_path);
 
$post = array('apikey' => $api_key,'file'=> $cfile);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/scan');
curl_setopt($ch, CURLOPT_POST, True);
curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging
curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data
curl_setopt($ch, CURLOPT_USERAGENT, "gzip, My php curl client");
curl_setopt($ch, CURLOPT_RETURNTRANSFER ,True);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
 
$result=curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
print("status = $status_code\n");
if ($status_code == 200) { // OK
  $js = json_decode($result, true);
  print_r($js);
?>
<script>
window.location="<? echo $js['permalink']; ?>";
</script>
  <?
} else {
  print($result);
}
curl_close ($ch);
?>