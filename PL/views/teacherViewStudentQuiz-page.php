<?php
include_once('../../BLL/userManager.php');
include_once('../../BLL/quizManager.php');
include_once("teacherViewStudentQuiz.php");
session_start();
if (($_SESSION['isLoggedIn']) != true) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginForm.php');
}elseif($_SESSION['role']!=2){
    header('location:index.php');
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
    <link href="../styles/pages/studentDashboard-page.css" rel="stylesheet">
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
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light" href="javascript:void(0)"><i class="fa fa-bars"></i></a></li>
                        <!-- Search -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="fa fa-times"></i></a>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <!-- User profile and search -->
                        <li class="nav-item dropdown"> <?php echo $_SESSION['fname']; ?>
                            <?php echo $_SESSION['lname']; ?>
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/5.jpg" alt="user" class="img-circle" width="30"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15  m-b-10">
                                    <div class=""><img src="../assets/images/users/5.jpg" alt="user" class="img-circle" width="60"></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0"><?php echo $_SESSION['fname']; ?>
                                            <?php echo $_SESSION['lname']; ?></h4>
                                        <p class=" m-b-0"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="72041300071c32151f131b1e5c111d1f">
                                                <?php echo $_SESSION['email']; ?></a></p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="studentProfile.php""><i class=" fa fa-user"></i> My
                                    Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-book"></i> Grades</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-envelope"></i>
                                    Messages</a>
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

        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <aside class="left-sidebar">
            <div class="d-flex no-block nav-text-box align-items-center">
                <span style="font-family: 'Lucida Console', Courier, monospace;"><img src="../assets/images/UAlogo.png" alt="elegant admin template">ECOURSES</span>
                <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i class="fa fa-bars fa-lg"></i></a>
                <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i class="fa fa-close"></i></a>
            </div>
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="studentDashboard.html" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="siteHome.html" aria-expanded="false"><i class="fa fa-home fa-lg"></i><span class="hide-menu">Site Home</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="calendar.html" aria-expanded="false"><i class="fa fa-calendar"></i><span class="hide-menu">Calendar</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="studentFiles.html" aria-expanded="false"><i class="fa fa-file"></i><span class="hide-menu">Private Files</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="studentProfile.html" aria-expanded="false"><i class="fa fa-user-circle-o"></i><span class="hide-menu">Profile</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="studentCourses.html" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu"></span>My Courses</a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->



        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">View Exam</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">View Exam</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->

                <!-- Start Page Content -->
                <?php
                $idExamEntry = $_GET['quizId'];
                $examEntryInformation = getExamEntryDetails($idExamEntry);
                $idStudent = $examEntryInformation['idStudentEnrolled'];
                $idClass = $examEntryInformation['idClassEnrolled'];
                $idExam = $examEntryInformation['idExam'];
                $isCorrected = $examEntryInformation['isCorrected'];
                $student = getStudentInformation($idStudent);
                $quiz = getExamDetails($idExam);
                $studentAnswers = getStudentAnswers($idExam, $idClass, $idStudent);
                $questionCounter = 0;
                $correctableAnswersCount=0;
                ?>
                <h3><?php echo $quiz['quizTitle'] ?></h3>
                <h4><?php echo $student['firstname'] . " " . $student['lastname'] ?></h4>


                <div class="row">
                    <div class="col-12">

                        <?php if ($isCorrected == 0) { ?>
                            <form method="POST" action="teacherViewStudentQuiz-page.php?quizId=<?php echo $idExamEntry ?>">
                            <center style="color: red"><?php include('errors.php'); ?></center>    
                            <input type="hidden" name="quizId" value="<?php echo $quiz['id'] ?>">
                            <input type="hidden" name="idStudentQuiz" value="<?php echo $idExamEntry?>">
                                <?php foreach ($studentAnswers as $studentAnswer) {
                                ?><div class=" card">
                                        <div class="card-body">
                                            <?php
                                            $questionCounter = $questionCounter + 1;
                                            $question = getQuestion($studentAnswer['idQuestion']);
                                            ?>
                                            <h5><b><?php echo $questionCounter . ")" . $question['description'] . "(" . $question['grade'] . "pts)" ?></b></h5>
                                            <?php
                                            if ($question['idType'] == '1' || $question['idType'] == '2') { // mcq or boolean for auto correction
                                                autoCorrectAnswer($studentAnswer['id']);
                                                $updatedAnswerData = getStudentAnswer($studentAnswer['id']);
                                            ?>
                                                <br>
                                                <h6>Answer:<b><?php echo $updatedAnswerData['answer'] ?></b> </h6>
                                                <br>
                                                <label> Grade:<?php echo $updatedAnswerData['grade'] ?> </label>
                                            <?php
                                            } elseif ($question['idType'] == '3') { // text
                                                $correctableAnswersCount = $correctableAnswersCount+1;
                                            ?>
                                                <br>
                                                <h6>Answer:<b><?php echo $studentAnswer['answer'] ?></b> </h6>
                                                <input type="hidden" name="studentAnswerId[]" value="<?php echo $studentAnswer['id'] ?>">
                                                <input type="hidden" name="maxGrade[]" value="<?php echo $question['grade'] ?>">
                                                <br>
                                                <label>Grade :</label> <input type="number" name="grade[]" style="width: 50px;">
                                            <?php
                                            } elseif ($question['idType'] == '4') { // upload
                                                $correctableAnswersCount = $correctableAnswersCount+1;
                                            ?>
                                                <br>
                                                <h6>Answer:<b><a href="Test<?php //@Assaf 
                                                                            ?>">Test<?php //@Assaf 
                                                                                                    ?></a></b></h6>
                                                <input type="hidden" name="studentAnswerId[]" value="<?php echo $studentAnswer['id'] ?>">
                                                <input type="hidden" name="maxGrade[]" value="<?php echo $question['grade'] ?>">
                                                <br>
                                                <label>Grade :</label> <input type="number" name="grade[]" style="width: 50px;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <br>
                                <input type="hidden" name="numCorrectableAnswers" value="<?php echo $correctableAnswersCount?>">
                                <input type="submit" class="btn btn-success" name="SubmitAnswerCorrection" value="Submit Correction">
                            </form>
                        <?php
                        } elseif ($isCorrected == 1) { ?>
                            <label> You have already corrected this exam entry. </label>
                            <?php foreach ($studentAnswers as $studentAnswer) {
                                $questionCounter = $questionCounter + 1;
                                $question = getQuestion($studentAnswer['idQuestion']);
                            ?>
                                <h5><b><?php echo $questionCounter . ")" . $question['description'] . "(" . $question['grade'] . "pts)" ?></b></h5>
                                <label>Answer:<?php echo $studentAnswer['answer'] ?> </label>
                                <label> Grade:<?php echo $studentAnswer['grade'] ?> </label>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- End Page Content -->
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Page wrapper  -->

    <!-- footer -->
    <footer class="footer">
        © 2020 LEAD team</a>
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

</body>


</html>