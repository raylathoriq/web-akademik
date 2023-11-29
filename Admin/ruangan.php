<?php
    require "function/function.php";
    $query = mysqli_query($conn,"SELECT * FROM ruangan");
    $no = 1;
    if(isset($_POST['kirim'])){
        if(tambahRuangan($_POST)>0){
            
            echo"<script>
                alert('berhasil di tambahkan');
                document.location.href = 'ruangan.php';
                </script>";
        }
        else{
            echo"<script>
                alert('gagal ditambahkan');
                document.location.href = 'ruangan.php';
                </script>"; 
    }
}

        if(isset($_POST['edit'])){
            if(updateRuangan($_POST)>0){
                
                echo"<script>
                    alert('berhasil di edit');
                    document.location.href = 'ruangan.php';
                    </script>";
            }
            else{
                echo"<script>
                    alert('gagal di edit');
                    document.location.href = 'ruangan.php';
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
                                    <h4 class="mb-sm-0 font-size-18">Daftar Ruangan</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Daftar Ruangan</a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahRuangan" ><i class="bx bx-plus"></i>Tambah Ruangan</button>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered border-3 border border-dark align-middle text-center" id="table">
                                    
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Ruangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($query as $data):?>
                                    <tbody>
                                        <tr>
                                            <td><?= $no++;?></td>
                                            <td><?= $data['nama_ruangan'];?></td>
                                            <td> <a href="" class="badge bg-warning px-3 py-2"  data-bs-target="#updateRuangan<?=$data['id_ruangan'];?>" data-bs-toggle="modal" ><i class="bx bxs-pencil "></i></a>
                                                 <a href="delete-ruangan.php?id=<?= $data['id_ruangan'];?>" class="badge bg-danger px-3 py-2" onclick="return confirm('yakin?')"><i class="bx bxs-trash"></i></a>

                                            </td>
                                        </tr>
                                        <div class="modal fade" id="updateRuangan<?= $data['id_ruangan'];?>" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog   modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                                <div class="modal-content">
                                                       <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">Update Ruangan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <input type="hidden" name ="id_ruangan" value ="<?= $data['id_ruangan'];?>">
                                                            <label for="" class="form-label">Nama Ruangan</label>
                                                            <input type="text" class="form-control mb-3" name="nama_ruangan" id="" placeholder="Nama Ruangan" value="<?= $data['nama_ruangan'];?>">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tbody>
                                    <?php endforeach ;?>
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
         <div class="modal fade" id="tambahRuangan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Tambah Ruangan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <label for="" class="form-label">Nama Ruangan</label>
                            <input type="text" class="form-control mb-3" name="nama_ruangan" id="" placeholder="Nama Ruangan ">
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