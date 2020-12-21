<?php
include_once('login.php');
?>

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
        <form method="post" autocomplete="off" action="loginForm.php">
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
            <center>
                <p>If you do not know your login information or having problems signing in, please contact IT HelpDesk at 05 927 000 ext. 1398 or by email at ithelpdesk@ua.edu.lb</p>
            </center>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#btnCheckNamePost').click(function(event) { //Trigger on form submit

                var formData = { //Fetch form data
                    'email': $('input[name=email]').val(),
                    'password': $('input[name=password]').val()
                };

                $.ajax({ //Process the form using $.ajax()
                    type: 'POST', //Method type
                    url: 'login.php', //Your form processing file url
                    data: formData, //Forms name
                    dataType: 'json',
                    success: function(d) {
                        if (!d.success) { //If fails
                            $('.error').fadeIn(1000).html(d.message); //Throw relevant error
                            $('#success').empty();
                        } else {
                            $('#success').fadeIn(1000).append('<p>' + d.message + '</p>'); //If successful, than throw a success message
                            $('.error').empty();
                        }
                    }
                });
                event.preventDefault(); //Prevent the default submit
            });

        });
    </script>

</body>

</html>