<?php
define('Host','localhost');
define('User','root');
define('Password','');
define('dbName','meeting');

class DB_con
 {
   function __construct()
   {

     $conn = mysql_connect(Host,User,Password) or die('error connecting to server'.mysql_error());
      mysql_select_db(dbName, $conn) or die('error connecting to database->'.mysql_error());
      mysql_query("SET NAMES UTF8");
    }
  }
	?>