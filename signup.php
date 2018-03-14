<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quizeme Register</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">QuizzMe</h1>

            </div>
            <h3>Register to Quizeme</h3>
            <p>Create account to join the quize.</p>
            <form class="m-t" role="form" method="post" action="sign_up.php">
                <div class="form-group">
                    <input name="firstname" type="text" class="form-control" placeholder="Firstname" required="">
                </div>
                <div class="form-group">
                    <input name="lastname" type="text" class="form-control" placeholder="Lastname" required="">
                </div>
                <div class="form-group">
                    <input name="login" type="text" class="form-control" placeholder="Login" required="">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-primary btn-block" href="home.php">Login</a>
            </form>
            <p class="m-t"> <small>This is a web app for users to quiz base on PHP &copy; 2018</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
