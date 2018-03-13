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
		$action = "sign_in_form.php";
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>QuizzMe -- Error</title>
    <meta charset="utf-8" />
    <link href="css/main.css" type="text/css" rel="stylesheet" />
  </head>
<body>
	
	<div id="top_banner">
	
<?php
	if ( isset($_SESSION["login"]) ) {
		$name = get_name($_SESSION["login"]);
?>
		<span class="left"><?=$name?>'s <span id="logo">2DO</span> notes</span>
<?php
	} else {
?>
		<span class="left">Welcome to <span id="logo">QuizzMe</span></span>
<?php
	}
?>
	</div>
	
	<div id="content">
		<form method="get" action="<?=$action?>">
			<div id="error">
				<div><?= $message ?></div>
				<input class="button" type="submit" value="OK" />
			</div>
		</form>
		
</div>
</body>
</html>