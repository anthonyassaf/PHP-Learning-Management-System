<?php include_once('studentProfile.php');
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
                        <li class="nav-item dropdown">  <?php echo $_SESSION['fname']; ?>  <?php echo $_SESSION['lname']; ?>
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/5.jpg" alt="user" class="img-circle" width="30"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15  m-b-10">
                                    <div class=""><img src="../assets/images/users/5.jpg" alt="user" class="img-circle" width="60"></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0"><?php echo $_SESSION['fname']; ?>  <?php echo $_SESSION['lname']; ?></h4>
                                        <p class=" m-b-0"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="72041300071c32151f131b1e5c111d1f"> <?php echo $_SESSION['email']; ?></a></p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="studentProfile.php""><i class="fa fa-user" ></i> My Profile</a>
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

        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <aside class="left-sidebar">
            <div class="d-flex no-block nav-text-box align-items-center">
                <span style="font-family: 'Lucida Console', Courier, monospace;"><img src="../assets/images/UAlogo.png" alt="elegant admin template">ECOURSES</span>
                <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i
                        class="fa fa-bars fa-lg"></i></a>
                <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i
                        class="fa fa-close"></i></a>
            </div>
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="studentDashboard.html" aria-expanded="false"><i
                                    class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="siteHome.html" aria-expanded="false"><i
                                    class="fa fa-home fa-lg"></i><span class="hide-menu">Site Home</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="calendar.html" aria-expanded="false"><i
                                    class="fa fa-calendar"></i><span class="hide-menu">Calendar</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="studentFiles.html" aria-expanded="false"><i
                                    class="fa fa-file"></i><span class="hide-menu">Private Files</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="studentProfile.html" aria-expanded="false"><i
                                    class="fa fa-user-circle-o"></i><span class="hide-menu">Profile</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="studentCourses.html" aria-expanded="false"><i
                                    class="fa fa-book"></i><span class="hide-menu"></span>My Courses</a></li>
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
                        <h4 class="text-themecolor">Profile</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->

              <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="../assets/images/users/5.jpg" class="img-circle"
                                        width="150" />
                                    <h4 class="card-title m-t-10"><?php echo $_SESSION['fname']; ?>  <?php echo $_SESSION['lname']; ?></h4>
                                    <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                    <center style="color: red"><?php include('errors.php'); ?></center> 
                        <div class="card">
                            <!-- Tab panes -->
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="post" autocomplete="off" action="studentProfile-page.php">
                                <div class="form-group">
                                        <label class="col-md-12">First Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name = "firstname"
                                                class="form-control form-control-line" required value="<?php echo $_SESSION['fname'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Last Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name = "lastname"
                                                class="form-control form-control-line" required value="<?php echo $_SESSION['lname'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">ID</label>
                                        <div class="col-md-12">
                                            <input type="email" readonly
                                                class="form-control form-control-line" name="userId"
                                                id="example-email" value="<?php echo $_SESSION['userId'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" readonly
                                                class="form-control form-control-line" name="email"
                                                id="example-email" value="<?php echo $_SESSION['email'];?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Current Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name ="currentPassword" 
                                                class="form-control form-control-line" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">New Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="newPassword"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" name="update_user">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- End Page Content -->
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