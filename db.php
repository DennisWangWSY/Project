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
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <script src="js/simpleajax.js"></script>
	<script src="js/db.js"></script>


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
            	<div id="left" class="col-lg-4">
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
                <div id="right" class="col-lg-4">
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
            <div class="col-lg-4">
            	<div id="newquizdiv">
            		<form id="newQuiz" class="form-horizontal">
            			<div class="form-group"><label class="col-sm-2 control-label">Quiz:</label ><div class="col-sm-10"><textarea name="content"></textarea></div></div>
            			<div class="form-group"><label class="col-sm-2 control-label">Domain:</label><div class="col-sm-10"> <input name="domain" class="domain" /></div></div>
            			<div class="form-group"><label class="col-sm-2 control-label">Diff:</label><div class="col-sm-10"><input name="difficulty" type="range" min="1" max="10" step="1" value="1" class="difficulty" /></div></div>
            			<div class="form-group"><label class="col-sm-2 control-label">Choice A:</label><div class="col-sm-10"><input name="A" class="choice" /></div></div>
            			<div class="form-group"><label class="col-sm-2 control-label">Choice B:</label><div class="col-sm-10"><input name="B" class="choice" /></div></div>
            			<div class="form-group"><label class="col-sm-2 control-label">Choice C:</label><div class="col-sm-10"><input name="C" class="choice" /></div></div>
            			<div class="form-group"><label class="col-sm-2 control-label">Choice D:</label><div class="col-sm-10"><input name="D" class="choice" /></div></div>
            			<div class="form-group"><label class="col-sm-2 control-label">Answer:</label><div class="col-sm-10">
            			<div><label>A<input type="checkbox" name="choice" value="A" /></label>
            				<label>B<input type="checkbox" name="choice" value="B" /></label>
            				<label>C<input type="checkbox" name="choice" value="C" /></label>
            				<label>D<input type="checkbox" name="choice" value="D" /></label>
            			</div></div></div>
            			<input id="addquizButton" class="btn btn-info" type="submit" value="Add quiz" title="add a new quiz"/>
            		</form>
            	</div>
            	
            </div>

        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2015
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

</body>

</html>
