<?php
session_start();
include("include/util.php");
$id = trim($_POST["quiz_id"]);
$user_ans = trim($_POST["ans"]);
$correct_ans = quiz_answer($id);
if($user_ans==$correct_ans)
	echo "y";
else
	echo "n";
?>