<?php
include('login.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="stylesheet" href="../assets/icons/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../styles/pages/adminDashboard-page.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/UAlogo.png">
    <!-- Custom CSS -->
    <link href="../styles/style.css" rel="stylesheet">
</head>

<body class="skin-default-dark fixed-layout">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Panel</p>
        </div>
    </div>

    <!-- Main wrapper - style you can find in pages.scss -->

    <div id="main-wrapper">

        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
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
                        <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light"
                                href="javascript:void(0)"><i class="fa fa-bars"></i></a></li>
                        <!-- Search -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                                href="javascript:void(0)"><i class="fa fa-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                                    class="srh-btn"><i class="fa fa-times"></i></a>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <!-- User profile and search -->
                        <li class="nav-item dropdown"> <?php echo $_SESSION['fname']?>  <?php echo $_SESSION['lname']; ?>
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="../assets/images/users/1.jpg" alt="user" class="img-circle" width="30"></a>
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
                <span><img src="../assets/images/UAlogo.png" alt="elegant admin template">Admin Panel</span>
                <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i
                        class="fa fa-bars"></i></a>
                <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i
                        class="fa fa-bars ti-close"></i></a>
            </div>
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="adminDashboard.php" aria-expanded="false"><i
                            class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="adminManageUsers.php" aria-expanded="false"><i
                            class="fa fa-home"></i><span class="hide-menu">Manage Users</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="adminManageCourses.php" aria-expanded="false"><i
                            class="fa fa-calendar"></i><span class="hide-menu">Manage courses</span></a></li>
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
                        <h4 class="text-themecolor">Admin Dashboard</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Page Name</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->

                <!-- Start Page Content -->
                <center>
                <div class="row" id="actionTable">
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="row d-flex justify-content-center">
                                <img src=../assets/images/addTeacher.png class="dashboardActionImage">
                        </div>
                        <div class="row d-flex justify-content-center">
                            <a href="adminUserAdd.php" class="btn btn-success">Add User</a>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-4">  
                        <div class="row d-flex justify-content-center">
                            <img src=../assets/images/addCourse.png class="dashboardActionImage">
                        </div>
                        <div class="row d-flex justify-content-center">
                            <a href="adminCourseAdd.php" class="btn btn-success">Add course</a>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="row d-flex justify-content-center">
                                <img src=../assets/images/addStudent.png class="dashboardActionImage">
                        </div>
                        <div class="row d-flex justify-content-center">
                            <a href="#" class="btn btn-success">Manage course students</a>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="row d-flex justify-content-center">
                            <img src=../assets/images/addTeacher.png class="dashboardActionImage">
                        </div>
                        <div class="row d-flex justify-content-center">
                            <a href="#" class="btn btn-success">Manage course teachers</a>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-4">  
                        <div class="row d-flex justify-content-center">
                            <img src=../assets/images/addCourse.png class="dashboardActionImage">
                        </div>
                        <div class="row d-flex justify-content-center">
                            <a href="#" class="btn btn-success">Manage courses</a>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="row d-flex justify-content-center">
                                <img src=../assets/images/addStudent.png class="dashboardActionImage">
                        </div>
                        <div class="row d-flex justify-content-center">
                            <a href="adminStudentEdit.php" class="btn btn-success">Manage students</a>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <div class="row d-flex justify-content-center">
                            <img src=../assets/images/addTeacher.png class="dashboardActionImage">
                        </div>
                        <div class="row d-flex justify-content-center">
                            <a href="adminTeacherEdit.php" class="btn btn-success">Manage teachers</a>
                        </div>
                    </div>
                    <br><br><br><br><br><br><br><br><br><br>
                </div>
            </center>
                <!-- End PAge Content -->
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