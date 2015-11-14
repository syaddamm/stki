
<?php  
$host='localhost';
  $dbname='buat_STKI';
  $user='root';
  $pass='';

  $con=mysqli_connect($host, $user, $pass, $dbname);
  mysql_connect($host, $user, $pass);
  mysql_select_db($dbname);
  if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }
?>