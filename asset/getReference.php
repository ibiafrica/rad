<?php
define('HOSTNAME','localhost');
define('DB_USERNAME','ibiafric_auto2');
define('DB_PASSWORD','ibiafric_auto2');
define('DB_NAME', 'ibiafric_auto2');
//global $con;
$con = mysqli_connect(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME) or die ("error");
$con->set_charset("utf8");
// Check connection
if(mysqli_connect_errno($con))  echo "Failed to connect MySQL: " .mysqli_connect_error();


if(isset($_POST['c_id'])) {
  $sql = "select * from autotec_ibi_article_original where article_origin_id=".$_POST['c_id'];
  //echo $sql;
  $res = mysqli_query($con, $sql);
  if(mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_object($res)) {
   
       echo $row->article_origin_ref_original;
          
    }
  }
} else {
  header('location: ./');
}
?>