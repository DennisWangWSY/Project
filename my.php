<?php
session_start();
include("include/util.php");
$login = $_SESSION["login"];
if(!isset($login)){
	header("Location: error.php?type=nologin");
	die();
}
$records = glob(recordpath($login) ."*");
?>
<html>
<head>
	<title>QuizzMe  -- My Home</title>
	<meta charset="utf-8" />
	<link href="css/main.css" type="text/css" rel="stylesheet" />
	<link href="css/form1.css" type="text/css" rel="stylesheet" />
</head>

<body>
	
	<div id="top_banner">
		<form method="post" action="sign_in_form.php">
			<div>
				<span class="left"><?=$_SESSION["login"]?>'s <span id="logo">Home</span></span>
			</div>
			<span>
				<a href="logout.php">
					<input class="button" type="button" value="Logout" />
				</a>
			</span>
			<span>
				<a href="quiz.php">
					<input class="button" type="button" value="Start quiz" />
				</a>
			</span>
			<span>
				<a href="db.php">
					<input class="button" type="button" value="Manage quiz" />
				</a>
			</span>
		</form>
	</div>
	
		<?php
		foreach($records as $record){
			$recordContent = file($record, FILE_IGNORE_NEW_LINES); ?>
			<form class="list left" quiz_id="<?= $quiz; ?>">	
				<div class="quiz_title">
					Score: <?= recordScore($recordContent);?>
				</div>	
				<ul>
					<li><span class="todo">Date: <?= basename($record);?></span></li>
					<li><span class="todo">Quiz: <?php 
					$arr = recordQuiz($recordContent);
					for($i=0; $i<count($arr); $i++) {
						print $arr[$i] . " ";
					}
					?></span></li>
					<li><span class="todo">Correct: <?php 
					$arr = recordCorrect($recordContent);
					for($i=0; $i<count($arr); $i++) {
						print $arr[$i] . " ";
					}
					?></span></li>
				</ul>
			</form>
			<?php
		}
		?>
</body>
</html>
