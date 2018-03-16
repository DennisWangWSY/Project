<?php
include("include/util.php");
$first = htmlspecialchars($_POST["firstname"]);
$last = htmlspecialchars($_POST["lastname"]);
$login = htmlspecialchars($_POST["login"]);
$password = htmlspecialchars($_POST["password"]);
$users = scandir(userdbpath());
if(!preg_match("/^[A-Za-z]+(-[A-Za-z]+)?$/", $first)){
	header("Location: error.php?type=firstname");
	die();
}else if(!preg_match("/^[A-Za-z]+(-[A-Za-z]+)?$/", $last)){
	header("Location: error.php?type=lastname");
	die();
}else if(!preg_match("/^[a-zA-Z0-9_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]+$/", $login)
	|| in_array($login, $users)){
	header("Location: error.php?type=logup");
	die();
}else if(!preg_match("/^[a-zA-Z\d_]{1,}$/", $password)){
	header("Location: error.php?type=pwdup");
	die();
}else{
	$dirpath = userdbpath() . $login;
	mkdir($dirpath);
	mkdir($dirpath . "/records");
	$info = $password . "\n" . $first . "\n" . $last;
	file_put_contents($dirpath . "/info.txt", $info);
	header("Location: home.php");
}
?>