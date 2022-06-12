<?php
/*******************************************************************
UPLOADSCRIPT v2.0 
Copyright (c) 2017 Mocean. All rights reserved.
Homepage: http://eneskayalar.com
*******************************************************************/

extract ($_REQUEST);

$siteadi = "Depo";
//// site ismini girin.

$slogan = "Güvenli Dosya barındırma adresi !";
//// site sloganı

$scripturl = "http://mocean.co.nf/";
//// url'nizi girin '/' ile beraber

$linktlapi = "http://link.tl/api.php?key=rrrrr&uid=rrrr&adtype=int&url=";
//// link tl API'nizi alıp yukarıya aynı görüldüğü gibi yapıştırın.
//// kullanmayacaksanız boş bırakın.

$maxfilesize = 10;
//// maximum yüklencek dosya limiti

$downloadtimelimit = 1;
//// dakikada kaç dosya indirebilir.

$nolimitsize = 1;
//// dosya kaç megabayt üstünü alsın.// çevirisi o. bence kilobayt

$deleteafter = 999999;
$sg = "sınırsız";
//// kaç günde silceğini ikisinede yazın. eğer ilkine fazla değer verdiyseniz 2.sine sınırsız yıllık gibi kelimeler yazabilirsiniz.

$downloadtimer = 1;
//// dosya indirmeden önce kaç saniye beklesin

$allowedtypes = array("txt","pdf","avi","mp3","rar","exe","zip","mp4");
//// hangi dosya türleri yüklenebilir ?
?>