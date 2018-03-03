<?php
include("include/util.php");
$content = trim($_POST["content"]);
$domain = trim($_POST["domain"]);
//useless line
$diff = trim($_POST["diff"]);
$choiceA = "A---" . trim($_POST["choiceA"]);
$choiceB = "B---" . trim($_POST["choiceB"]);
$choiceC = "C---" . trim($_POST["choiceC"]);
$choiceD = "D---" . trim($_POST["choiceD"]);
$answer = trim($_POST["answer"]);

$quiz_id = get_max() + 1;
$contents = $content . "\n" . $diff . "\n" . $domain . "\n"
			 . $choiceA . "\n" . $choiceB . "\n"
			 . $choiceC . "\n" . $choiceD . "\n" . $answer;
file_put_contents(quizdbpath() . "/" . $quiz_id, $contents);
echo quizdbpath() . $quiz_id;
?>