
<!------------------------------------------------
Copyright (c) 2017 Mocean. All rights reserved.
Homepage: http://eneskayalar.com
------------------------------------------------->

<?php


include("./ayarlar.php");
include("./header.php");

if(isset($_GET['page']))
  $p = $_GET['page'];
else
  $p = "0";

switch($p) {
case "dyr": include("./p/duyurular.phtml"); break;
case "sss": include("./p/sss.php"); break;
case "ks": include("./p/kullanimsartlari.php"); break;
default: include("./p/index.php"); break;
}

include("./footer.php");
?>