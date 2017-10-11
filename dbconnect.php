<?php
$server = "localhost";  //own database server name
$username = "root"; //own database username
$password = "root";  //own database password
$database = "lukedb";  //own database name

  //CONNECT TO SERVER
$mydatabase = new mysqli($server, $username, $password, $database);
  //IF CONNECTION FAILED
if (!$mydatabase) {
  die( '<div style="color: #ffffff; font-size: 12pt; text-align:center;">'.'Error: Unable to connect to database.'.'</div');
}//END
?>