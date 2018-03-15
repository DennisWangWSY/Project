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

    <title>INSPINIA | Blog</title>

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
                <div class="modal-body" id = "difficulty"></div>
                <div class="modal-body" id = "content"></div>
                <div class="modal-body" id = "domain"></div>
                <div class="modal-body" id = "a"></div>
                <div class="modal-body" id = "b"></div>
                <div class="modal-body" id = "c"></div>
                <div class="modal-body" id = "d"></div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <div id="wraper">
        <div id="page-wrapper" class="gray-bg"><div>
        <span id="dbhead1">
        <?php  
        if(isset($_SESSION["login"]))
            print $_SESSION["login"] . "'s Home";
        ?>
        </span>
        <div id="logout">
            <a href="quiz.php" type="button" class="btn-primary">
                Start quiz
            </a>

            <a href="db.php" type="button" class="btn-primary">
                Manage quiz
            </a>

            <a href="logout.php" type="button" class="btn-primary">
                Logout
            </a>

        </div>
    </div>
    <div id="dipth">
        <div class="col-lg-10"></div>
    </div>

    <div class="wrapper">
        <div class="wrapper" id="board">
                <h1>Personal Quiz Records on the left</h1>
                <h2>Click on the quiz id to review the quiz!</h2>
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

                                <ul>
                                    <li>Data:<?= basename($records[$i]) ?></li>
                                    <li>Quiz:
                                        <?php
                                        $arr = recordQuiz($recordContent);

                                        for($j=0; $j<count($arr); $j++) {
                                            ?>
                                            <a class="showmodal" data-target="#myModal" data-toggle="modal">
                                                <?php
                                                print $arr[$j] . " ";
                                            }
                                            ?>
                                            </a>
                                    </li>
                                    <li>Correct: <?php
                                    $arr = recordCorrect($recordContent);
                                    for($j=0; $j<count($arr); $j++) {
                                            ?>
                                            <a class="showmodal" data-target="#myModal" data-toggle="modal">
                                                <?php
                                                print $arr[$j] . " ";
                                            }
                                            ?>
                                            </a>
                                    </li>
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

                                <ul>
                                    <li>Data:<?= basename($records[$i]) ?></li>
                                    <li>Quiz:
                                        <?php
                                        $arr = recordQuiz($recordContent);

                                        for($j=0; $j<count($arr); $j++) {
                                            ?>
                                            <a class="showmodal" data-target="#myModal" data-toggle="modal">
                                                <?php
                                                print $arr[$j] . " ";
                                            }
                                            ?>
                                        </a>

                                    </li>
                                    <li>Correct: <?php
                                    $arr = recordCorrect($recordContent);
                                    for($j=0; $j<count($arr); $j++) {
                                            ?>
                                            <a class="showmodal" data-target="#myModal" data-toggle="modal">
                                                <?php
                                                print $arr[$j] . " ";
                                            }
                                            ?>
                                            </a>
                                    </li>
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
    </div>
</body>

</html>
