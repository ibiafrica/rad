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
  $sql1 = "SELECT * from `autotec_ibi_article_original` where article_origin_id=".$_POST['c_id'];
  //echo "test";
  //echo $sql1;
  $res1 = mysqli_query($con, $sql1);
  if(mysqli_num_rows($res1) > 0) {
    
    while($row1 = mysqli_fetch_object($res1)) {

      echo "<option style='width:200px;' value='".$row1->article_origin_id."'>".$row1->article_origin_ref_original."</option>";

      $sql = "SELECT * from `autotec_ibi_article_original` where article_link='".$row1->article_origin_ref_original."'";
      //echo $sql;
      $res = mysqli_query($con, $sql);
      if(mysqli_num_rows($res) > 0) {

        while($row = mysqli_fetch_object($res)) {
   
           echo "<option style='width:200px;' value='".$row->article_origin_id."'>".$row->article_origin_ref_original."</option>";
        }
      }
    }
  }
} else {
  header('location: ./');
}
?>