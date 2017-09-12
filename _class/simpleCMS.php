<?php

class simpleCMS {
  var $host;
  var $username;
  var $password;
  var $table;

  public function display_public() {
    $q = "SELECT * FROM arxiv";
    $r = mysql_query($q);

    if ( $r !== false && mysql_num_rows($r) > 0 ) {
      while ( $a = mysql_fetch_assoc($r) ) {
        $title = stripslashes($a['title']);
        $author = stripslashes($a['prim_author']);

        $entry_display .= <<<ENTRY_DISPLAY
        <div class="grid-item">
        <div id="title"><a href="http://www.diy.com">$title</a>
        </div>
        <div id="author">$author</div>
        <div id="gridicon">
        <a href="http://www.google.co.uk">
        <img src="img/arxiv-logo.png" id="gridimage"></a>
        </div>
        <div id="gridicon">
        <a href="http://www.sheffield.ac.uk">
        <img src="img/pdf-logo.png" id="gridimage"></a>
        </div>
        <div id="gridicon">
        <a href="http://www.dur.ac.uk">
        <img src="img/ads-logo.png" id="gridimage"></a>
        </div>
        </div>
ENTRY_DISPLAY;
      }
    } else {
      $entry_display = <<<ENTRY_DISPLAY

    <h2>This Page Is Under Construction</h2>
    <p>
      No entries have been made on this page. 
      Please check back soon, or click the
      link below to add an entry!
    </p>

ENTRY_DISPLAY;
    }
    $entry_display .= <<<ADMIN_OPTION

    <p class="admin_link">
      <a href="{$_SERVER['PHP_SELF']}?admin=1">Add a New Entry</a>
    </p>

ADMIN_OPTION;

    return $entry_display;
  }
  
  public function connect() {
    mysql_connect($this->host,$this->username,$this->password) or die("Could not connect. " . mysql_error());
    mysql_select_db($this->table) or die("Could not select database. " . mysql_error());
    
    #return $this->buildDB();
  }
}
?>