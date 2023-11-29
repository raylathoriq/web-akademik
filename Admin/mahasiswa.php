<?php
    require "function/function.php";
    if(isset($_POST['kirim'])){
        if(tambahMahasiswa($_POST)>0){
            
            echo"<script>
                alert('berhasil di tambahkan');
                document.location.href = 'mahasiswa.php';
                </script>";
        }
        else{
            echo"<script>
                alert('gagal ditambahkan');
                document.location.href = 'mahasiswa.php';
                </script>"; 
    }
}
    if(isset($_POST['edit'])){
        if(updateMahasiswa($_POST)>0){
            
            echo"<script>
                alert('berhasil di edit');
                document.location.href = 'mahasiswa.php';
                </script>";
        }
        else{
            echo"<script>
                alert('gagal di edit');
                document.location.href = 'mahasiswa.php';
                </script>"; 
    }
}


    
    $query = mysqli_query($conn,"SELECT * FROM mahasiswa");
    $no = 1;
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
                                    <h4 class="mb-sm-0 font-size-18">Mahasiswa</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Daftar Mahasiswa</a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahMahasiswa"> <i class="bx bx-plus"></i> Tambah Mahasiswa</button>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered border border-3 border-dark align-middle text-center" id="table">
                                    
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIM</th>
                                            <th>Tingkat</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($query as $mhs):?>
                                        <tr>
                                            <td><?= $no++;?></td>
                                            <td><?= $mhs['nama'];?></td>
                                            <td><?= $mhs['NIM'];?></td>
                                            <td><?= $mhs['tingkat'];?></td>
                                            <td><?= $mhs['alamat'];?></td>
                                            <td> <button class="badge bg-warning px-3 py-2 d-inline-block border-0" data-bs-target="#updateMahasiswa<?=$mhs['NIM'];?>" data-bs-toggle="modal"><i class="bx bxs-pencil "></i></button>
                                                 <a href="delete-mhs.php?nim=<?= $mhs['NIM'];?>" class="badge bg-danger px-3 py-2" onclick="return confirm('yakin?')"><i class="bx bxs-trash"></i></a>   
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="updateMahasiswa<?= $mhs['NIM'];?>" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                                <div class="modal-content">
                                                       <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">Update Dosen</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                        <input type="hidden" name="nim_lama" value="<?= $mhs['NIM']?>">
                                                        <label for="" class="form-label">Nama Lengkap</label>
                                                        <input type="text" class="form-control mb-3" name="nama" id="" placeholder="Nama" value ="<?= $mhs['nama'];?>">
                                                        <label for="" class="form-label">NIM</label>
                                                        <input type="hidden" class="form-control mb-3" name="nim" placeholder="NIM" value ="<?= $mhs['NIM'];?>">
                                                        <input type="number" class="form-control mb-3" name="nim" placeholder="NIM" value ="<?= $mhs['NIM'];?>">
                                                        <label for="" class="form-label ">Tingkat</label>
                                                        <input type="text" class="form-control mb-3" name="tingkat" placeholder="Tingkat" value ="<?= $mhs['tingkat'];?>">
                                                        <label for="" class="form-label">Alamat</label>
                                                        <input type="text" class="form-control mb-3" name="alamat" placeholder="Alamat" value ="<?= $mhs['alamat'];?>">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach ; ?>
                                    </tbody>
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
        <div class="modal fade" id="tambahMahasiswa" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Tambah Mahasiswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <label for="" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control mb-3" name="nama" id="" placeholder="Nama ">
                            <label for="" class="form-label">NIM</label>
                            <input type="number" class="form-control mb-3" name="nim" placeholder="NIM">
                            <label for="" class="form-label ">Tingkat</label>
                            <input type="text" class="form-control mb-3" name="tingkat" placeholder="Tingkat">
                            <label for="" class="form-label">Alamat</label>
                            <input type="text" class="form-control mb-3" name="alamat" placeholder="Alamat">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" name="kirim" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL UPDATE -->
        
        
        
        <!-- Optional: Place to the bottom of scripts -->
        

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