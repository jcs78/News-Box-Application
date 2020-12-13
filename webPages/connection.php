<?php
error_reporting(E_ALL);
set_error_handler("handleError");
$con = msqli_connect('localhost','root','notify');

if($con)
{
  echo('connected')
}
else{
  echo mysqli_error($con);
}



?>
