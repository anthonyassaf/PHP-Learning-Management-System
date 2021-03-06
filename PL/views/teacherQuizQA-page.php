<?php
include_once('teacherQuizQA.php');
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
    <title>Create quiz</title>
    <!-- Favicon icon -->
    <link rel="stylesheet" href="../assets/icons/font-awesome/css/font-awesome.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/UAlogo.png">
    <!-- Custom CSS -->
    <link href="../styles/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/pages/adminUserAdd-page.css">

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
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/<?php echo $_SESSION['ppURL']?>" alt="user" class="img-circle" width="30"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15  m-b-10">
                                    <div class=""><img src="../assets/images/users/<?php echo $_SESSION['ppURL']?>" alt="user" class="img-circle" width="60"></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0"><?php echo $_SESSION['fname']; ?>
                                            <?php echo $_SESSION['lname']; ?></h4>
                                        <p class=" m-b-0"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="72041300071c32151f131b1e5c111d1f">
                                                <?php echo $_SESSION['email']; ?></a></p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off m-r-5 m-l-5"></i>Logout</a>
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
                    <li> <a class="waves-effect waves-dark" href="teacherDashboard-page.php" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
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
                        <h4 class="text-themecolor"></h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Create Quiz</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->

                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal form-material" method="POST" action="teacherQuizQA-page.php?quizTitle=<?php echo $_GET['quizTitle'] ?>&exam=<?php echo $_GET['exam'] ?>">
                            <center style="color: red"><?php include('errors.php'); ?></center>
                            <input type='hidden' name='idExam' value=<?php echo $_GET['exam'] ?>>
                            <div class="card">
                                <!-- Tab panes -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><u>Question</u></label><BR><BR>
                                        <textarea class="form-control" rows="3" name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Grade (points):</label>
                                        <input type="number" class="form-control" name="grade"></input>
                                    </div>
                                    Question Type :
                                    <br>
                                    <div>

                                        <div>
                                            <input type="radio" name="questionType" value="Text">
                                            <label>Text</label>
                                        </div>

                                        <div>
                                            <input type="radio" name="questionType" value="Upload">
                                            <label>Upload</label>
                                        </div>

                                        <input type="radio" name="questionType" value="MCQ">
                                        <label>MCQ</label>
                                        <div class="reveal-if-active">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Number of Answers : </label>
                                                <div class="col-sm-1">
                                                    <input type="number" id="numberAnswer" class="form-control" name="number">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input class="btn btn-success" id="btnNumAns" name="confirm" value="confirm">
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-sm-12" id="add">

                                                </div>
                                            </div>


                                        </div>

                                        <div>
                                            <input type="radio" name="questionType" value="True/False">
                                            <label>True/False</label>
                                            <div class="reveal-if-active">
                                                <input type="radio" id="true" name="bool" value="true">
                                                <label for="true">True</label><br>
                                                <input type="radio" id="false" name="bool" value="false">
                                                <label for="false">False</label><br>

                                            </div>
                                        </div>

                                    </div>
                                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="submit" class=" btn btn-success" name="addQuestion" value="Add Question">
                                    <input type="submit" class="btn btn-warning" name="finishAddQuestion" value="Add Last Question">
                                </div>
                            </div>
                        </form>
                        <hr>



                    </div>
                </div>
                <!-- End Page Content -->
            </div>
            <!-- End Container fluid  -->
        </div>
        <!-- End Page wrapper  -->

        <!-- footer -->
        <footer class="footer">
            ?? 2020 LEAD team</a>
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
    <!-- stickey kit -->
    <script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../scripts/custom.min.js"></script>
    <script src="../scripts/adminStudentAdd-page.js"></script>
    <script>
        function clearDiv(elementID) {
            document.getElementById(elementID).innerHTML = "";
        }

        $("#btnNumAns").click(function() {
            clearDiv("add");
            var $item = $("#numberAnswer").val();
            var $counter = 0;
            while ($item > 0) {
                $("#add").append('<div class="input-group"><input type="radio" name="isTrue" value =' + $counter + '> <input type="text" class="form-control" name="answer[]" placeholder = ' + ($counter + 1) + '></div>');
                $counter = $counter + 1;
                $item = $item - 1;
            }
        });
    </script>
</body>


</html>