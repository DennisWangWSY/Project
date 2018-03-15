<?php
	session_start();
	include("include/util.php");
	
	$type = $_GET["type"];
	if ( $type === "login1" ) {
		$message = "Your login is incorrect";
		$action = "home.php";
	} elseif ( $type === "login2" ) {
		$message = "Your  password is incorrect";
		$action = "home.php";	
	} elseif ( $type === "firstname" ) {
		$message = "First name is incorrect";
		$action = "signup.php";
	} elseif ( $type === "lastname" ) {
		$message = "Last name is incorrect";
		$action = "signup.php";
	} elseif ( $type === "logup" ) {
		$message = "Login is incorrect";
		$action = "signup.php";
	} elseif ( $type === "pwdup" ) {
		$message = "Password is incorrect";
		$action = "signup.php";		
	} else { # type === nologin
		$message = "You must sign in to use this feature";
		$action = "home.php";
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>QuizzMe -- Error</title>
    <meta charset="utf-8" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
<body class="gray-bg">
	
	<div id="error_head">
	
<?php
	if ( isset($_SESSION["login"]) ) {
		$name = get_name($_SESSION["login"]);
?>
		<span><?=$name?>'s <span id="logo">2DO</span> notes</span>
<?php
	} else {
?>
		<span>Welcome to <span id="logo">QuizzMe</span></span>
<?php
	}
?>
	</div>
		<div id="error_dipth"></div>
	</div>
	<div id="content">
		<form method="get" action="<?=$action?>">
			<div id="error">
				<div id="error_message"><?= $message ?></div>
				<input class="button" type="submit" value="OK" />
			</div>
		</form>
		
</div>
</body>
</html>