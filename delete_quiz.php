<?php
session_start();
include("include/util.php");
$id = $_POST["id"];
if(quiz_num()<=5)
	echo "no";
else{
	unlink($id);
	echo $id;
}
?>