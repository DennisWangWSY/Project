<?php
session_start();
include("include/util.php");
$login = $_SESSION["login"];
if(isset($login)){
	$score = $_POST["score"];
	$ids = $_POST["ids"];
	$corrects = $_POST["corrects"];
	$dirpath = userdbpath() . $login . "/records/";
	$name = date("Y_m_d_H_i_s_T");
	$info = $score . "\n" . $ids . "\n" . $corrects;
	file_put_contents($dirpath . $name, $info);
}
?>