<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<?php 
	if (strpos($_SERVER['SCRIPT_NAME'],"indir.php")){

}else{
	echo '<title>'.$siteadi.' - '.$slogan.'</title>';
} 
	?>
	<meta name="clckd" content="d39a9f790dc4a7773e3ea1ad1abfc0f2" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/flat-ui.min.css" rel="stylesheet">
    <link href="css/down.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico">
    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="kapsayan">
    <div class="icerik">
    <div class="container">
        <h1>
          <?php echo $siteadi; ?>
         <small><font size="4"><?php echo $slogan; ?></font></small>
        </h1>
	<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <a class="navbar-brand" href="./index.php">Ana Sayfa</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-01">
              <ul class="nav navbar-nav navbar-left">
                <li><a href="./index.php?page=dyr">Duyurular<span class="navbar-unread">2</span></a></li>
				<li><a href="./index.php?page=sss">Sık Sorulan Sorular</a></li>
				<li><a href="mailto:ben@eneskayalar.com">İletişim</a></li>
          </nav><!-- /navbar -->
		<center><?php include "./ADS1.html"; ?></center>