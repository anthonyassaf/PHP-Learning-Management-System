<?php include_once('login.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../styles/pages/login-page.css">
</head>

<body>

    <div class="login-form">
        <form method="post" id="contactForm" name="contactForm" autocomplete="off" action="loginForm.php">
       <center style="color: red"><?php include('errors.php'); ?></center> 
            <h2>Login</h2>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email*" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password*" required>
            </div>

            <div class="form-group">
                <input type="submit" id="btn" class="btn btn-success btn-lg btn-block" value="Login" name="login_user">
            </div>
            <center><p>If you do not know your login information or having problems signing in, please contact IT HelpDesk at 05 927 000 ext. 1398 or by email at ithelpdesk@ua.edu.lb</p></center>
        </form>
    </div>

</body>

</html>