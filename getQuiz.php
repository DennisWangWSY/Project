<?php
session_start();
include("include/util.php");
$id = trim($_POST["quiz_id"]);
$quiz = file(quizdbpath() . $id);
$data = array(
	"id" => $id,
	"content" => quiz_content($quiz),
	"difficulty" => quiz_difficulty($quiz),
	"quiz_choicesA" => quiz_choicesA($quiz),
	"quiz_choicesB" => quiz_choicesB($quiz),
	"quiz_choicesC" => quiz_choicesC($quiz),
	"quiz_choicesD" => quiz_choicesD($quiz),
	"domain" => quiz_domain($quiz)
);

print(json_encode($data));

?>