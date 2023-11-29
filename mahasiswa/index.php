<?php
    session_start();
    require "../Admin/config/config.php";

    if(!isset($_SESSION['mahasiswa'])){
        echo"
            <script>
            alert('harus login terlebih dahulu')
            document.location.href ='../Admin/auth/login.php'
            </script>
        ";
    }

    $nm_mhs =$_SESSION['nama'];
    
    $avg = mysqli_query($conn,"SELECT *, AVG(nilai) AS Nilai, SUM(sks) AS SKS FROM mahasiswa LEFT JOIN nilai USING(NIM) WHERE nama = '$nm_mhs' GROUP BY NIM ");
?>

<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Dashboard | Admin </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark" data-layout-mode="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
    <?php include "component/topbar.php";?>
    <?php include "component/sidebar.php";?>
        <!-- Begin page -->
        <div id="layout-wrapper">
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Dashboard Admin</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card overflow-hidden">
                                    <div class="bg-primary bg-soft">
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="text-primary p-3">
                                                    <h5 class="text-white">Selamat Datang ! </h5>
                                                    <p class="text-white">Admin Dashboard</p>
                                                </div>
                                            </div>
                                            <div class="col-5 align-self-end">
                                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="avatar-md profile-user-wid mb-4">
                                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="img-thumbnail rounded-circle">
                                                </div>
                                                <h5 class="font-size-15 text-truncate"><?= $_SESSION['nama'];?></h5>
                                            </div>
                                                <p class="text-muted mb-0 text-truncate">admin</p>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xl-8">
                                <?php foreach($avg as $m):?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card text-white bg-light">
                                          <div class="card-body">
                                            <h4 class="card-title">IPK : </h4>
                                            <p class="card-text">
                                                <?php if($m['Nilai']== null){
                                                    echo"Gapunya IPK";
                                                }?>
                                                <?= $m['Nilai']?></p>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card text-white bg-light">
                                          <div class="card-body">
                                            <h4 class="card-title">SKS </h4>
                                            <p class="card-text">
                                                <?php if($sk['sks']== null){
                                                    echo"Gapunya SKS";
                                                }?>
                                                <?= $sk['sks']?></p>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
                            </div>
                                <!-- end row -->
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <?php include "component/rightbar.php";?>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- dashboard init -->
        <script src="assets/js/pages/dashboard.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>