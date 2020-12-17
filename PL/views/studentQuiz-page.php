<?php
include_once('../../BLL/quizManager.php');
session_start();
if (($_SESSION['isLoggedIn']) != true) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginForm.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Dashboard</title>
    <!-- Favicon icon -->
    <link rel="stylesheet" href="../assets/icons/font-awesome/css/font-awesome.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/UAlogo.png">
    <!-- Custom CSS -->
    <link href="../styles/style.css" rel="stylesheet">
    <style>
        .footer {
            margin-left: 0px;
        }

        .navbar-brand {
            margin-left: 0px
        }

        .container-fluid {
            padding-right: 75px;
        }

        @media only screen and (max-width: 1000px) {
            .container-fluid {
                padding-right: 15px;
            }
        }
    </style>
</head>

<body class="skin-default-dark fixed-layout">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">ECOURSES</p>
        </div>
    </div>

    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper">

        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon --><b>
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/UAlogoName.png" alt="homepage" class="dark-logo" />
                        </b>
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto ml-auto mt-1">
                        <center>
                            <b><span style="color : black; text-shadow: 2px 2px #ffcccb;">You still have :</span>
                                <p style="color:black; text-shadow: 2px 2px #ffcccb;" id="demo"></p>
                            </b>
                        </center>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <!-- User profile and search -->
                        <li class="nav-item dropdown"> <?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['lname']; ?>
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/5.jpg" alt="user" class="img-circle" width="30"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15  m-b-10">
                                    <div class=""><img src="../assets/images/users/5.jpg" alt="user" class="img-circle" width="60"></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0"><?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['lname']; ?></h4>
                                        <p class=" m-b-0"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="72041300071c32151f131b1e5c111d1f"> <?php echo $_SESSION['email']; ?></a></p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="studentProfile.php""><i class=" fa fa-user"></i> My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-book"></i> Grades</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-envelope"></i> Messages</a>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                            </div>
                        </li>
                        <!-- User profile and search -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- End Topbar header -->

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <br>
                <br>
                <div class="row">
                    <div class="col-12">

                        <?php
                        $i = 1;
                        $exam = getExamDetails($_GET['quizId']);
                        $questions = getExamQuestions($_GET['quizId']);
                        ?>
                        <input type="hidden" name="examId" value="<?php echo $_GET['quizId'] ?>">
                        <input type="hidden" name="classId" value="<?php echo $exam['idClass'] ?>">
                        <?php
                        foreach ($questions as $question) :
                        ?>
                            <div class=" card">
                        <div class="card-body">
                            <input type="hidden" name="questionId[]" value=<?php echo $question['id'] ?>>
                            <input type="hidden" name="questionType[]" value=<?php echo $question['idType'] ?>>
                            <div class="card-title"><?php echo $i++ . ") " . $question['description'] ?></div>
                            <?php $questionId = $question['id'];
                            $answers = getQuestionAnswers($questionId);
                            ?>
                            <?php if ($question['idType'] == 1) : ?>
                                <?php foreach ($answers as $answer) : ?>
                                    <div>
                                        <input type="radio" name="mcq[]" value=<?php echo $answer['description'] ?> mdbInput>
                                        <label for="defaultUnchecked"><?php echo $answer['description'] ?></label>
                                    </div>
                                <?php endforeach ?>
                            <?php elseif ($question['idType'] == 2) : ?>
                                <div>
                                    <input type="radio" id="true" name="bool[]" value="true">
                                    <label for="true">True</label><br>
                                    <input type="radio" id="false" name="bool[]" value="false">
                                    <label for="false">False</label><br>
                                </div>
                            <?php elseif ($question['idType'] == 3) : ?>
                                <div class="form-group">
                                    <textarea class="form-control rounded-0" name="text[]" id="exampleFormControlTextarea1" rows="20"></textarea>
                                </div>
                            <?php elseif ($question['idType'] == 4) : ?>
                                <input type="File" name="file">
                                <input type="hidden" name="cid[]" value="">

                            <?php endif ?>
                        </div>
                    </div>
                    <hr>
                <?php endforeach ?>
                <input class="btn btn-success float-center btn-block" name="submitQuizAnswers" value="Submit All" type="submit">
                </div>
            </div>
            <!-- End Page Content -->
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Page wrapper  -->

    <!-- footer -->
    <footer class="footer">
        <a>© 2020 LEAD team</a>
    </footer>
    <!-- End footer -->

    </div>
    <!-- End Wrapper -->

    <!-- All Jquery -->
    <script src="../assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/node_modules/popper/popper.min.js"></script>
    <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../scripts/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="../scripts/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../scripts/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../scripts/custom.min.js"></script>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date(<?php echo strtotime($exam['endDate']) * 1000; ?>).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
</body>


</html>