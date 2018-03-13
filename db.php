<?php
session_start();
include("include/util.php");
$login = $_SESSION["login"];
if(!isset($login)){
	header("Location: error.php?type=nologin");
	die();
}
$quizs = glob(quizdbpath() ."*");
$leftcount =round(count($quizs)/2);
$rightcount = $leftcount+1;
$k = 0;
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Blog</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/newquiz.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <script src="js/simpleajax.js"></script>
    <script src="js/db.js"></script>
    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

</head>

<body class="gray-bg">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div>
                <span id="dbhead1">Welcome to Quize Home.     </span>
                <div id="logout">
                   <a href="my.php">
                    <i id="dbhead2" class="fa fa-sign-out"></i><span id="dbhead2">    Home</span>
                </a>
            </div>    
        </div>
        <div id="dipth">
            <div class="col-lg-10">  
            </div>
        </div>

        <div class="wrapper">
            <div class="row">
            	<div id="left" class="col-lg-6">
            		<?php
            		for($i = 1; $i <= $leftcount; $i++){
            			$quizContent = file($quizs[$k], FILE_IGNORE_NEW_LINES); $k++;?>
            			<div class="ibox" quiz_id="<?= $quizs[$k-1]; ?>">
            				<div class="ibox-content">
            					<div id="content">
            						<form class="list left" quiz_id="<?= $quizs[$k-1]; ?>">	
            							<div class="quiz_title">
            								<?= quiz_domain($quizContent);?> -- Difficulty: <?= quiz_difficulty($quizContent);?>
            								<input id="delete_quiz" class="btn btn-warning btn-sm" type="submit" name="delete_quiz" value="X" quiz_id="<?= $quizs[$k-1]; ?>" title="delete this quiz"/>
            							</div>	
            							<ul>
            								<li><span class="todo"><?= quiz_content($quizContent);?></span></li>
            								<li><span class="todo"><?= quiz_choicesA($quizContent);?></span></li>
            								<li><span class="todo"><?= quiz_choicesB($quizContent);?></span></li>
            								<li><span class="todo"><?= quiz_choicesC($quizContent);?></span></li>
            								<li><span class="todo"><?= quiz_choicesD($quizContent);?></span></li>
            							</ul>
            						</form>
            					</div>
            				</div>
            			</div>
            			<?php
            		}
            		?>
            	</div>
                <div id="right" class="col-lg-6">
                	<?php
                	for($i = $rightcount; $i <= count($quizs); $i++){
                		$quizContent = file($quizs[$k], FILE_IGNORE_NEW_LINES); $k++;?>
                		<div class="ibox" quiz_id="<?= $quizs[$k-1]; ?>">
                			<div class="ibox-content">
                				<div id="content">
                					<form class="list left" quiz_id="<?= $quizs[$k-1]; ?>">	
                						<div class="quiz_title">
                							<?= quiz_domain($quizContent);?> -- Difficulty: <?= quiz_difficulty($quizContent);?>
                							<input id="delete_quiz" class="btn btn-warning btn-sm" class="button right" type="submit" name="delete_quiz" value="X" quiz_id="<?= $quizs[$k-1]; ?>" title="delete this quiz"/>
                						</div>	
                						<ul>
                							<li><span class="todo"><?= quiz_content($quizContent);?></span></li>
                							<li><span class="todo"><?= quiz_choicesA($quizContent);?></span></li>
                							<li><span class="todo"><?= quiz_choicesB($quizContent);?></span></li>
                							<li><span class="todo"><?= quiz_choicesC($quizContent);?></span></li>
                							<li><span class="todo"><?= quiz_choicesD($quizContent);?></span></li>
                						</ul>
                					</form>
                				</div>
                			</div>
                		</div>
                		<?php
                	}
                	?>
                </div>
            </div>
            <div id="newquizdiv">
               <div id="contact-form" class="clearfix">
                <h1>Add new Quiz</h1>
                <h2>Fill in the form here to add your new quiz to our Quiz Database!</h2>
                <form method="post">
                    <label for="content">Quiz Content: <span class="required">*</span></label>
                    <textarea name="content" placeholder="Your quiz content must be greater than 20 charcters" required="required" data-minlength="20"></textarea>
                    <label for="Domain">Domain: <span class="required">*</span></label>
                    <select name="domain">
                        <option value="General">General</option>
                        <option value="History">History</option>
                        <option value="Sports">Sports</option>
                        <option value="Literature">Literature</option>
                        <option value="Geography">Geography</option>
                        <option value="Architecture">Architecture</option>
                        <option value="Arts">Arts</option>
                        <option value="IT">IT</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Biology">Biology</option>
                        <option value="Maths">Maths</option>
                    </select>
                    <label for="difficulty">Difficulty: <span class="required">*</span></label>
                    <input name="difficulty" type="range" min="1" max="10" step="1" value="1" class="difficulty" />

                    <label for="domain">Choice A: <span class="required">*</span><input type="checkbox" name="choice" value="A" /></label>
                    <input type="text" name="A" value="" placeholder="Choice A" required="required" />

                    <label for="domain">Choice B: <span class="required">*</span><input type="checkbox" name="choice" value="B" /></label>
                    <input type="text" name="B" value="" placeholder="Choice B" required="required" />

                    <label for="domain">Choice C: <span class="required">*</span><input type="checkbox" name="choice" value="C" /></label>
                    <input type="text" name="C" value="" placeholder="Choice C" required="required" />

                    <label for="domain">Choice D: <span class="required">*</span><input type="checkbox" name="choice" value="D" /></label>
                    <input type="text" name="D" value="" placeholder="Choice D" required="required" />

                    <input id="submit-button" type="submit" value="Add quiz" />
                    <p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
                    <p id="req-field-desc"> Check the correct answers of your quiz!</p>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

</html>
