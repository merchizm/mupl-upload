<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $siteadi; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="css/flat-ui.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
        <div class="demo-headline">
        <h1 class="demo-logo">
          <div class="logo"></div>
          Dosya Yükle
          <small>Hızlı ve basit</small>
        </h1>
      </div>
	<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <a class="navbar-brand" href="./admin.php">Main</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-01">
              <ul class="nav navbar-nav navbar-left">
				<li><a href="./admin.php?act=reports">Şikayet edilen dosyalar</a></li>
				<li><a href="./admin.php?act=bans">Banlananları yönet</a></li>
				<li><a href="./admin.php?act=newpass">şifreyi değiştir</a></li>
				<li><a href="./admin.php?act=delete">eski dosyaları sil</a></li>
				<li><a href="./admin.php?act=check">dosyaları denetle</a></li>
				<li><a href="./admin.php?act=logout">çıkış</a></li>
          </nav><!-- /navbar -->