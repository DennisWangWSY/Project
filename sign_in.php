<!--
Assignment #5
ID:2017229052 Name:Wang Shanyu (Dennis)

This php file is to handle the sign_in operation.
-->
<?php
session_start();
include("include/util.php");
$login = htmlspecialchars($_POST["login"]);
$password = htmlspecialchars($_POST["password"]);
$infoPath = userdbpath() . $login . "/info.txt";
if(!file_exists($infoPath)){
	header("Location: error.php?type=login1");
	die();
}
$info = file($infoPath, FILE_IGNORE_NEW_LINES);
if($password != $info[0]){
	header("Location: error.php?type=login2");
	die();
}else{
	$_SESSION["login"] = $login;
	header("Location: my.php");
}

?>