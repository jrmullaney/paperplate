<!DOCTYPE html>
<html lang="en">

  <head>
    <title>SimpleCMS</title>
  </head>

  <body>
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
  </body>

</html>