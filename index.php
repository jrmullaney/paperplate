<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>paperplate</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="apple-touch-icon" href="apple-touch-icon.png">
      <!-- Place favicon.ico in the root directory -->

      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/main.css">
      <script src="js/vendor/modernizr-2.8.3.min.js"></script>
      <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
  </head>
  <body>
        <!--[if lt IE 8]>ÏÏ
   <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


<!-- Add your site or application content here -->
    <div class="topbar">
	    <picture id="leftlogo">
	      <source srcset="img/mlogo.png" media="(max-device-width: 760px)">
	      <source srcset="img/logo.png">
	      <img src="img/logo.png" id="leftlogo" style="width:auto;">
	    </picture>
	    <div class="icons">a</div>
	    <div class="icons">a</div>
	    <div class="icons">a</div>
	  </div>
	
    <div class="mainpanel">
	    <div class="grid" 
	      data-isotope='{ "itemSelector": ".grid-item",
	      "masonry": {"columnWidth":0, "fitWidth":true, "gutter": 10 }}'>
	      <?php

          include_once('_class/simpleCMS.php');
          $obj = new simpleCMS();
          $obj->host = 'localhost';
          $obj->username = 'James';
          $obj->password = '8Y2wKwAD4';
          $obj->table = 'paperplate';
          $obj->connect();

          if ( $_POST )
            $obj->write($_POST);

          echo ( $_GET['admin'] == 1 ) ? $obj->display_admin() : $obj->display_public();

        ?>
	    </div>  
    </div>
	  
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script                src="js/vendor/jquery-1.12.0.min.js"><\/script>')
    </script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X','auto');ga('send','pageview');
    </script>
  </body>
</html>
