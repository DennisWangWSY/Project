<!--
Assignment #4
ID:2017229052 Name:Wang Shanyu (Dennis)

This php file is to display all the quizs of the signed_in user
-->
<?php
session_start();
include("include/util.php");
$login = $_SESSION["login"];
if(!isset($login)){
	header("Location: error.php?type=nologin");
	die();
}
$quizs = glob(quizdbpath() ."*");
?>
<!DOCTYPE html>
<html>
<head>
	<title>QuizzMe -- Quiz Managment</title>
	<meta charset="utf-8" />
	<link href="css/main.css" type="text/css" rel="stylesheet" />
	<script src="js/simpleajax.js"></script>
	<script src="js/db.js"></script>
</head>
<body>	
	<div id="top_banner">
			<div>
				<span class="left"> Existing <span id="logo">Quiz</span></span>
				<a href="my.php">
					<input class="button" type="button" value="home" />
				</a>
			</div>
	</div>
	<form id="newQuiz">
		Quiz: <textarea name="content"></textarea>
		Domain: <input name="domain" class="domain" />
		Diff: <input name="difficulty" type="range" min="1" max="10" step="1" value="1" class="difficulty" />
		Choice A: <input name="A" class="choice" />
		Choice B: <input name="B" class="choice" />
		Choice C: <input name="C" class="choice" />
		Choice D: <input name="D" class="choice" />
		Answer:
		<div><label>A<input type="checkbox" name="choice" value="A" /></label>
			<label>B<input type="checkbox" name="choice" value="B" /></label>
			<label>C<input type="checkbox" name="choice" value="C" /></label>
			<label>D<input type="checkbox" name="choice" value="D" /></label>
		</div>
		<input class="button" type="submit" value="Add quiz" title="add a new quiz"/>
	</form>
	<div id="content">
		<?php
		foreach($quizs as $quiz){
			$quizContent = file($quiz, FILE_IGNORE_NEW_LINES); ?>
			<form class="list left" quiz_id="<?= $quiz; ?>">	
				<div class="quiz_title">
					<?= quiz_domain($quizContent);?> -- Difficulty: <?= quiz_difficulty($quizContent);?>
					<input class="button right" type="submit" name="delete_quiz" value="X" quiz_id="<?= $quiz; ?>" title="delete this quiz"/>
				</div>	
				<ul>
					<li><span class="todo"><?= quiz_content($quizContent);?></span></li>
					<li><span class="todo"><?= quiz_choicesA($quizContent);?></span></li>
					<li><span class="todo"><?= quiz_choicesB($quizContent);?></span></li>
					<li><span class="todo"><?= quiz_choicesC($quizContent);?></span></li>
					<li><span class="todo"><?= quiz_choicesD($quizContent);?></span></li>
				</ul>
			</form>
			<?php
		}
		?>

	</div>
</body>
</html>