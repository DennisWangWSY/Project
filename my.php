<?php
session_start();
include("include/util.php");
$login = $_SESSION["login"];
if(!isset($login)){
	header("Location: error.php?type=nologin");
	die();
}
$records = glob(userdbpath() . $_SESSION["login"] . "/records/*");

$leftcount =round(count($records)/2);
$rightcount = $leftcount;
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>QuizMe | Home</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <script src="js/simpleajax.js"></script>
    <script src="js/db.js"></script>

    <script src="js/modal.js"></script>

    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>


    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="ibox">
                    <div class="ibox-content">
                        <div>
                            <form>  
                                <div class="quiz_title">
                                    <span id="domain"></span> -- Difficulty: <span id="difficulty"></span>
                                </div>  
                                <ul>
                                    <li><span class="todo" id="content"></span></li>
                                    <li><span class="todo" id="a"></span></li>
                                    <li><span class="todo" id="b"></span></li>
                                    <li><span class="todo" id="c"></span></li>
                                    <li><span class="todo" id="d"></span></li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <div id="wraper">
        <div id="page-wrapper" class="gray-bg"><div>
                        <a id="logout_btn" href="logout.php" type="button" class="btn btn-primary">
                Logout
            </a>
                        <a id="quize_btn" href="quiz.php" type="button" class="btn btn-primary">
                Start quiz
            </a>

            <a id="db_btn" href="db.php" type="button" class="btn btn-primary">
                Manage quiz
            </a>

        <span id="dbhead1">
        <?php  
        if(isset($_SESSION["login"]))
            print $_SESSION["login"] . "'s Home";
        ?>
        </span>
    </div>
    <div id="dipth">
        <div class="col-lg-10"></div>
    </div>

    <div class="wrapper">
        <div class="wrapper" id="board">
            <div class="col-md-12 column">
                <div class="jumbotron">
                    <h1>
                        Quiz report
                    </h1>
                    <p>
                        Personal Quiz Records on the left
                    </p>
                    <ul>
                        <li><strong>Date:</strong>The time when the quiz happend</li>
                        <li><strong>Quiz:</strong>Quiz you did in this record</li>
                        <li><strong>Correct:</strong>Those you were corrected</li>
                        <li><strong>Click on the id to review the quiz!</strong></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div id="left" class="col-lg-6">
                <?php
                for($i = 0; $i < $leftcount; $i++){
                    $recordContent = file($records[$i], FILE_IGNORE_NEW_LINES);
                ?>

                <div class="ibox">
                    <div class="ibox-content">
                        <div id="content">
                            <form class="list left">
                                <div class="quiz_title">
                                    Score:
                                    <?= recordScore($recordContent) ?>
                                </div>
                                <div class="panel-footer">
                                    Date:<?= recordTime(basename($records[$i])) ?>
                                </div>
                                <div class="panel-footer">
                                    Quiz:
                                    <?php
                                    $arr = recordQuiz($recordContent);
                                    for($j=0; $j<count($arr); $j++) {
                                        ?>
                                    <a class="showmodal" data-target="#myModal" data-toggle="modal">
                                    <?php
                                        print $arr[$j] . ". ";
                                        }
                                    ?>
                                    </a>
                                </div>
                                <div class="panel-footer">
                                    Correct: 
                                    <?php
                                    $arr = recordCorrect($recordContent);
                                    for($j=0; $j<count($arr); $j++) {
                                        ?>
                                        <a class="showmodal" data-target="#myModal" data-toggle="modal">
                                            <?php
                                            print $arr[$j] . ". ";
                                        }
                                        ?>
                                    </a>
                                </div>
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
                for($i = $rightcount; $i < count($records); $i++){
                    $recordContent = file($records[$i], FILE_IGNORE_NEW_LINES);
                ?>
                <div class="ibox">
                    <div class="ibox-content">
                        <div id="content">
                            <form class="list left">  
                                <div class="quiz_title">
                                    Score:
                                    <?= recordScore($recordContent) ?>
                                </div>
                                <div class="panel-footer">
                                    Date:<?= recordTime(basename($records[$i])) ?>
                                </div>

                                <div class="panel-footer">
                                    Quiz:
                                    <?php
                                    $arr = recordQuiz($recordContent);
                                    for($j=0; $j<count($arr); $j++) {
                                        ?>
                                    <a class="showmodal" data-target="#myModal" data-toggle="modal">
                                        <?php
                                            print $arr[$j] . ". ";
                                            }
                                        ?>
                                    </a>
                                </div>
                                <div class="panel-footer">
                                    Correct: 
                                    <?php
                                    $arr = recordCorrect($recordContent);
                                    for($j=0; $j<count($arr); $j++) {
                                    ?>
                                    <a class="showmodal" data-target="#myModal" data-toggle="modal">
                                        <?php
                                            print $arr[$j] . ". ";
                                        }
                                        ?>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
