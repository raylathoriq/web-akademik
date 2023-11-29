<?php
    session_start();
    require "../config/config.php";


    if(isset($_POST['login'])){
        $nama  = $_POST['nama'];
        $password = $_POST['password'];

        $result = mysqli_query($conn,"SELECT * FROM admin WHERE username = '$nama'");

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if($password == $row['password']){
                $_SESSION['login'] = true;
                $_SESSION['nama'] = $row['username'];
                echo "<script>
                document.location.href='../index.php';
                </script>";
            } else{
                echo "<script>
                alert('email atau password salah');
                document.location.href='login.php';
                </script>";
            }
            
        }
        $nama = $_POST['nama'];
        $password = $_POST['password'];
        $mhs = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE nama = '$nama'");

            if(mysqli_num_rows($mhs) === 1){
            $ms = mysqli_fetch_assoc($mhs);
            if($password == $ms['NIM']){
                $_SESSION['mahasiswa'] = true;
                $_SESSION['nama'] = $ms['nama'];
                echo "<script>
                document.location.href='../../mahasiswa/index.php';
                </script>";
            } else{
                echo "<script>
                alert('username atau password salah');
                document.location.href='login.php';
                </script>";
            }
            }
    }

    


    


?>


<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Login Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- owl.carousel css -->
        <link rel="stylesheet" href="../assets/libs/owl.carousel/assets/owl.carousel.min.css">

        <link rel="stylesheet" href="../assets/libs/owl.carousel/assets/owl.theme.default.min.css">

        <!-- Bootstrap Css -->
        <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Selamat Datang!</h5>
                                            <p>Login untuk masuk ke Dashboard Admin</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="p-4">
                                    <form class="form-horizontal" action="" method="post">
        
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="nama" id="username" placeholder="Enter username">
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" name="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" name="login" type="submit">Log In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="mt-3 text-center">
                            <div>
                                <p>D ? <a href="auth-register.html" class="fw-medium text-primary"> Signup now </a> </p>
                                <p>© <script>document.write(new Date().getFullYear())</script> Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
        <!-- end account-pages -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        
        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>
</html>
