<?php
    session_start();
    require 'function/function.php';

    $query = mysqli_query($conn,"SELECT *, AVG(nilai) AS Nilai FROM mahasiswa LEFT JOIN nilai USING(NIM) GROUP BY NIM");
    $matkul = mysqli_query($conn,"SELECT * FROM matkul ORDER BY nama_matkul ASC");

    if(isset($_POST['kirim'])){
        if(tambahNilai($_POST)> 0 ){
            echo"<script>
            alert('berhasil di tambahkan');
            document.location.href = 'nilai.php';
            </script>";
    }
    else{
        echo"<script>
            alert('gagal ditambahkan');
            document.location.href = 'nilai.php';
            </script>"; 
    }  
}

    
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
        <link rel="stylesheet" href="assets/css/datatables.min.css">
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css"/>

    </head>

    <body data-sidebar="dark" data-layout-mode="light">

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
                                    <h4 class="mb-sm-0 font-size-18">Nilai</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Daftar Nilai</a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahNilai"> <i class="bx bx-plus"></i> Tambah Nilai</button>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered border border-3 border-dark align-middle text-center" id="table">
                                    
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>Predikat</th>

                                        </tr>
                                    </thead>
                                    <?php $no = 1;   ?>
                                    <?php foreach($query as $nama):?>      
                                    <?php 
                                        if($nama['Nilai'] >=4){
                                            $nama['Nilai'] = 'A';
                                        } elseif($nama['Nilai'] >=3){
                                            $nama['Nilai'] = 'B';
                                        } elseif($nama['Nilai'] >=2){
                                            $nama['Nilai'] = 'C';
                                        } elseif($nama['Nilai'] >=1){
                                            $nama['Nilai'] = 'D';
                                        }
                                    ?>     
                                    <tbody>
                                        <tr>
                                            <td><?= $no++;?></td>
                                            <td><?= $nama['nama'];?></td>
                                            <td><?= $nama['NIM'];?></td>
                                            <td><a href="detail.php?nim=<?= $nama['NIM'];?>" class="text-decoration-none\ "> <?= $nama['Nilai'];?> (Klik untuk lihat detail nilai)</a>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                    <?php endforeach;?>
                                </table>
                            </div>
                        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <?php include "component/rightbar.php";?>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>




        <!-- MODAL CREATE -->
        <div class="modal fade" id="tambahNilai" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Tambah Nilai</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <label for="" class="form-label">Nama</label>
                            <select name="nim" id="" class="form-select mb-3">
                            <?php foreach($query as $nama) :?>
                                <option value="<?= $nama['NIM'];?>"><?= $nama['nama'];?></option>
                            <?php endforeach;?>
                            </select>

                            <label for="" class="form-label">Mata Kuliah</label>
                            <select name="matkul" id="" class="form-select mb-3">
                            <?php foreach($matkul as $m):?>
                                <option value="<?=$m['id_matkul'];?>"><?=$m['nama_matkul'];?></option>
                            <?php endforeach;?>
                            </select>

                            <label for="" class="form-label">Predikat</label>
                            <select name="predikat" id="" class="form-select mb-3">
                                <option value="4">A</option>
                                <option value="3">B</option>
                                <option value="2">C</option>
                                <option value="1">D</option>
                            </select>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" name="kirim" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
        <script src="assets/js/script.js"></script>
        <script src="assets/js/jquery-3.7.1.slim.min.js"></script>
        <script src="assets/js/datatables.min.js"></script>
    </body>

</html