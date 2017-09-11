<?php

class simpleCMS {
    var $host;
    var $username;
    var $password;
    var $table;

    public function display_public() {
        $q = "SELECT * FROM arXiv";
        $r = mysql_query($q);
    
        if ( $r !== false && mysql_num_rows($r) > 0 ) {
          while ( $a = mysql_fetch_assoc($r) ) {
            $title = $a['title'];
            $author = $a['prim_author'];
    
            $entry_display .= "<h2>$title</h2><p>$author</p>";
    
          }
        } else {
          $entry_display = <<<ENTRY_DISPLAY
    
<h2>This Page Is Under Construction</h2>;
<p>
No entries have been made on this page. 
Please check back soon, or click the
link below to add an entry!
</p>
    
ENTRY_DISPLAY;
        }
        return $entry_display;
      }

    public function connect() {
        mysql_connect($this->host,$this->username,$this->password) or die("Could not connect. " . mysql_error());
        mysql_select_db($this->table) or die("Could not select database. " . mysql_error());
    
        #return $this->buildDB();
    }
}
?>