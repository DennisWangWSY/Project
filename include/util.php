<?php

function connectDB() {
	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error)
		return null;
	else
		return $conn;
}
# returns the relative path of the database folder
function userdbpath() {
	return "userDB/";
}
function recordpath($login) {
	return userdbpath() . $login . "/records/";
}
function recordScore($record) {
	return $record[0];
}
function recordQuiz($record) {
	$quiz = explode("," , $record[1]);
	$arr = array();
	for($i=0; $i<count($quiz); $i++) {
		array_push($arr, explode("/", $quiz[$i])[1]);
	}
	sort($arr);
	return $arr;
}
function recordCorrect($record) {
	$quiz = explode("," , $record[2]);
	$arr = array();
	for($i=0; $i<count($quiz); $i++) {
		array_push($arr, explode("/", $quiz[$i])[1]);
	}
	sort($arr);
	return $arr;
}
function quizdbpath() {
	return "quizDB/";
}

function get_max() {
	$quizs = scandir(quizdbpath());
	return max($quizs);
}
function quiz_num() {
	return count(glob(quizdbpath() ."/*"));
}

function quiz_content($quiz) {
	return $quiz[0];
}
function quiz_difficulty($quiz) {
	return $quiz[1];
}
function quiz_domain($quiz) {
	return $quiz[2];
}
function quiz_choicesA($quiz) {
	return $quiz[3];	
}
function quiz_choicesB($quiz) {
	return $quiz[4];	
}
function quiz_choicesC($quiz) {
	return $quiz[5];	
}
function quiz_choicesD($quiz) {
	return $quiz[6];	
}
function quiz_answer($quizid) {
	// $quizpath = quizdbpath() . $quizid;
	$quiz = file($quizid, FILE_IGNORE_NEW_LINES);
	return $quiz[7];
}
# returns the first name of the user of login $login
function get_name($login) {
	$info = file(userdbpath() . $login . "/info.txt", FILE_IGNORE_NEW_LINES);
	return $info[1];
}

# extract the note id (a number) from the file path
# of the file. For example, note_id("2doDB/marc/notes/3") returns "3"
function note_id($note_file) {
	$strs = explode("/", $note_file);
	return $strs[3];
}

# returns the title of the $note array
function get_title($note) {
	return $note[0];
}

# returns the date of the $note array
function get_date($note) {
	return $note[1];
}

?>
