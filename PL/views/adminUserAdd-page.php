<?php
session_start();
include_once('../../BLL/userManager.php');
if (($_SESSION['isLoggedIn']) != true) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginForm.php');
}elseif($_SESSION['role']!=1){
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
    <title>Add User</title>
    <!-- Favicon icon -->
    <link rel="stylesheet" href="../assets/icons/font-awesome/css/font-awesome.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/UAlogo.png">
    <!-- Custom CSS -->
    <link href="../styles/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/pages/adminUserAdd-page.css">
    <style>
    .error {
        color: tomato;
        font-size: 12px;
        display: none;
    }

    #success {
        display: none;
        font-family: Arial;
        color: green;
        margin-left: 85px;
        font-size: 14px;
    }
    </style>
</head>

<body class="skin-default-dark fixed-layout">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Dashboard</p>
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
                        <li class="nav-item dropdown"> <?php echo $_SESSION['fname']; ?>
                            <?php echo $_SESSION['lname']; ?>
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="../assets/images/users/<?php echo $_SESSION['ppURL']?>" alt="user"
                                    class="img-circle" width="30"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15  m-b-10">
                                    <div class=""><img src="../assets/images/users/<?php echo $_SESSION['ppURL']?>"
                                            alt="user" class="img-circle" width="60"></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0"><?php echo $_SESSION['fname']; ?>
                                            <?php echo $_SESSION['lname']; ?></h4>
                                        <p class=" m-b-0"><?php echo $_SESSION['email']; ?></p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off m-r-5 m-l-5"></i>
                                    Logout</a>
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
                <span><img src="../assets/images/UAlogo.png" alt="elegant admin template">Admin Panel</span>
                <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i
                        class="fa fa-bars fa-lg"></i></a>
                <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i
                        class="fa fa-bars fa-close"></i></a>
            </div>
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="adminDashboard-page.php" aria-expanded="false"><i
                                    class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="adminUserAdd-page.php" aria-expanded="false"><i
                                    class="fa fa-plus"></i><span class="hide-menu">Add Users</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="adminManageCourses-page.php"
                                aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Manage
                                    courses</span></a></li>
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
                        <h4 class="text-themecolor">Add User</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="adminDashboard-page.php">Admin Dashboard</a></li>
                                <li class="breadcrumb-item active">Add User</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->

                <!-- Start Page Content -->
                <div class="card">
                    <!-- Tab panes -->
                    <div class="card-body">

                        <form id="form" class="form-horizontal form-material" method="POST" action="">
                            <center>
                                <div id="success"></div>
                                <span class="error"></span>
                            </center>
                            <div class="form-group">
                                <label class="col-md-12">First Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="firstname" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Last Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="lastname" class="form-control form-control-line"
                                        name="example-email" id="example-email">
                                </div>
                            </div>


                            <div>
                                <input type="radio" id="radioCreateStudent" name="createUser" value="createStudent"
                                    checked>
                                <label for="radioStudent">Student</label>
                                <div class="reveal-if-active">
                                    <div class="form-group">
                                        <label class="col-sm-12">Faculty</label>
                                        <div class="col-sm-12">
                                            <select name="studentFaculty" id="studentFaculty"
                                                class="form-control form-control-line">
                                                <option></option>
                                                <option>Engineering</option>
                                                <option>Public Health</option>
                                                <option>Sports Science</option>
                                                <option>Business</option>
                                            </select>
                                        </div>
                                    </div> <br><br>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="col-sm-12">Status</label>
                                            <div class="col-sm-12">
                                                <select name="studentStatus" id="studentStatus"
                                                    class="form-control form-control-line">
                                                    <option></option>
                                                    <option>Graduate</option>
                                                    <option>Undergraduate</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> <br><br>
                                </div>
                            </div>
                            <div>
                                <input type="radio" id="radioCreateTeacher" name="createUser" value="createTeacher">
                                <label for="radioTeacher">Teacher</label>
                                <div class="reveal-if-active">
                                    <div class="form-group">
                                        <label class="col-sm-12">Academic Rank</label>
                                        <div class="col-sm-12">
                                            <select name="teacherRank" id="teacherRank"
                                                class="form-control form-control-line">
                                                <option></option>
                                                <option>Assistant Professor</option>
                                                <option>Associate Professor</option>
                                                <option>Professor</option>
                                                <option>Part-Time Instructor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br><br><br><br><br><br><br>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="submit" class="btn btn-success" value="Add User" name="add_user">
                                </div>
                            </div>

                        </form>

                    </div>
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
    <!--stickey kit -->
    <script src="../assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../scripts/custom.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#form').on('submit', function(e) {
            var formData;
            e.preventDefault();
            if ($('input[name="createUser"]:checked').val() == 'createStudent') {
                var facultySelection = document.getElementById("studentFaculty");
                var facultyOptionValue = facultySelection.options[facultySelection.selectedIndex].text;
                var statusSelection = document.getElementById("studentStatus");
                var statusOptionValue = statusSelection.options[statusSelection.selectedIndex].text;
                formData = {
                    'firstname': $('input[name="firstname"]').val(),
                    'lastname': $('input[name="lastname"]').val(),
                    'createUser': "createStudent",
                    'studentStatus': statusOptionValue,
                    'studentFaculty': facultyOptionValue,
                    'teacherRank': "",
                };
            };
            if ($('input[name="createUser"]:checked').val() == 'createTeacher') {
                var rankSelection = document.getElementById("teacherRank");
                var rankOptionValue = rankSelection.options[rankSelection.selectedIndex].text;
                formData = {
                    'firstname': $('input[name="firstname"]').val(),
                    'lastname': $('input[name="lastname"]').val(),
                    'createUser': "createTeacher",
                    'studentStatus': "",
                    'studentFaculty': "",
                    'teacherRank': rankOptionValue,
                };
            };
            $.ajax({
                type: 'POST',
                url: 'adminUserAdd.php',
                data: formData,
                dataType: 'json',
                success: function(d) {
                    if (!d.success) {
                        $('.error').empty();
                        $('.error').fadeIn(1000).html(d.message);
                        $('#success').empty();

                    } else {
                        $('#success').empty();
                        $('#success').fadeIn(1000).append('<p>' + d.message + '</p>');
                        $('.error').empty();
                        document.getElementById("form").reset();
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });

        });
    })
    </script>
</body>

</html>