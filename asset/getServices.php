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
  $sql = "SELECT * from `travaux` where categorie=".$_POST['c_id'];
  //echo $sql;
  $res = mysqli_query($con, $sql);
  if(mysqli_num_rows($res) > 0) {
    echo "<option style='width:200px;' value=''>------- Select --------</option>";
    while($row = mysqli_fetch_object($res)) {
   
       echo "<option style='width:200px;' value='".$row->id."'>".$row->designation.' &nbsp&nbsp'.number_format($row->cout)."</option>";
          
    }
  }
} else {
  header('location: ./');
}
?>