<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center">
        <div>
            <div>
                <p class="logo-name">QuizzMe</p>
            </div>
            <h3>Welcome to QuizzMe</h3>
            <p>QuizzMe is an application to  do Multiple Choice Question quizzes online in various topics. User can test their knowledge by making quizzes but it can also supply new questions and store them in the database.
            </p>
            <form method="post" action="sign_in.php">
                <div class="form-group">
                    <input name="login" type="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn  btn-primary" href="signup.php">Create an account</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
