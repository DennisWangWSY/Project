<?php

# returns the relative path of the user database folder
function userdbpath() {
	return "userDB/";
}
# returns the relative path of the record folder of a given user
function recordpath($login) {
	return userdbpath() . $login . "/records/";
}
# returns the fomatted time of a record
function recordTime($str){
	$arr = explode("_", $str);
	$time = $arr[2] . "." . $arr[1] . "." . $arr[0] . ".  " . $arr[3] . ":" . $arr[4] . ":" . $arr[5] . " in " . $arr[6] . ".";
	return $time;
}
# returns the score of a record
function recordScore($record) {
	return $record[0];
}
# returns the quizs of a record
function recordQuiz($record) {
	$quiz = explode("," , $record[1]);
	$arr = array();
	for($i=0; $i<count($quiz); $i++) {
		array_push($arr, explode("/", $quiz[$i])[1]);
	}
	sort($arr);
	return $arr;
}
# returns the quizs that were answered correctly of a record
function recordCorrect($record) {
	$arr = array();
	if(count($record)>2){ 
		$quiz = explode("," , $record[2]);
		for($i=0; $i<count($quiz); $i++) {
			array_push($arr, explode("/", $quiz[$i])[1]);
		}
		sort($arr);
	}
	return $arr;
}
# returns the relative path of the quiz database folder
function quizdbpath() {
	return "quizDB/";
}
# returns the max id of all the quizs
function get_max() {
	$quizs = scandir(quizdbpath());
	return max($quizs);
}
# returns the number of quizs
function quiz_num() {
	return count(glob(quizdbpath() ."/*"));
}
# returns the content of a quiz
function quiz_content($quiz) {
	return $quiz[0];
}
# returns the difficulty of a quiz
function quiz_difficulty($quiz) {
	return $quiz[1];
}
# returns the domain of a quiz
function quiz_domain($quiz) {
	return $quiz[2];
}
# returns the A choice of a quiz
function quiz_choicesA($quiz) {
	return $quiz[3];	
}
# returns the B choice of a quiz
function quiz_choicesB($quiz) {
	return $quiz[4];	
}
# returns the C choice of a quiz
function quiz_choicesC($quiz) {
	return $quiz[5];	
}
# returns the D choice of a quiz
function quiz_choicesD($quiz) {
	return $quiz[6];	
}
# returns the correct answers of a quiz
function quiz_answer($quizid) {
	$quiz = file($quizid, FILE_IGNORE_NEW_LINES);
	return $quiz[7];
}
# returns the first name of the user of login $login
function get_name($login) {
	$info = file(userdbpath() . $login . "/info.txt", FILE_IGNORE_NEW_LINES);
	return $info[1];
}
?>
