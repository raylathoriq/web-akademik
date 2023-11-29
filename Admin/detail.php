<?php
    session_start();
    require "function/function.php";
    $nim = $_GET['nim'];    

    if(isset($_POST['edit'])){
        if(updateNilai($_POST)>0){
            
            echo"<script>
                alert('berhasil di edit');
                document.location.href = 'detail.php?nim=$nim';
                </script>";
        }
        else{
            echo"<script>
                alert('gagal di edit');
                document.location.href = 'detail.php?nim=$nim';
                </script>"; 
    }
}


    $avg = mysqli_query($conn,"SELECT *,nilai, AVG(nilai) AS Nilai FROM mahasiswa LEFT JOIN nilai USING(NIM) WHERE NIM = '$nim' GROUP BY NIM");
    $query = mysqli_query($conn,"SELECT * FROM mahasiswa LEFT JOIN nilai USING(NIM) JOIN matkul USING(id_matkul) WHERE NIM = '$nim'");

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
                                    <h4 class="mb-sm-0 font-size-18">Detail Nilai</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Detail Nilai</a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <?php foreach ($avg as $nama):?>
                            <h5>Nama : <?= $nama['nama'];?></h5>
                        <?php endforeach;?>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table align-middle table-bordered border border-3 border-dark" id="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mata Kuliah</th>
                                            <th>Nilai</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($query as $nilai):?>
                                        <tr>
                                            <td><?= $no++;?></td>
                                            <td><?= $nilai['nama_matkul'];?></td>
                                            <td><?= $nilai['nilai'];?></td>
                                            <td class="text-center"> 
                                                 <button class="badge bg-warning px-3 py-2 d-inline-block border-0" data-bs-target="#updateNilai<?=$nilai['id_nilai'];?>" data-bs-toggle="modal"><i class="bx bxs-pencil "></i></button>
                                                 <a href="delete-nilai.php?id=<?= $nilai['id_nilai'];?>" class="badge bg-danger px-3 py-2" onclick="return confirm('yakin?')"><i class="bx bxs-trash"></i></a>
                                                
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="updateNilai<?= $nilai['id_nilai'];?>" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                                <div class="modal-content">
                                                       <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">Update Nilai</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <input type="hidden" name ="id_nilai" value ="<?= $nilai['id_nilai'];?>">
                                                            <label for="" class="form-label">Nilai</label>
                                                            <input type="number" class="form-control" name="nilai" placeholder="Nilai" value="<?= $nilai['nilai'];?>">
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
                                        <tr>    
                                            <td colspan="3">Rata-rata</td>
                                        <?php foreach($avg as $r):?>
                                            <td colspan="2" class="text-center"><?= $r['Nilai'];?></td>
                                        <?php endforeach;?>
                                        </tr>
                                        <tr>
                                        <?php foreach($avg as $average) :?>
                                            <?php 
                                        if($average['Nilai'] >=4){
                                            $average['Nilai'] = 'A';
                                        } elseif($average['Nilai'] >=3){
                                            $average['Nilai'] = 'B';
                                        } elseif($average['Nilai'] >=2){
                                            $average['Nilai'] = 'C';
                                        } elseif($average['Nilai'] >=1){
                                            $average['Nilai'] = 'D';
                                        }
                                        ?>     
                                            <td colspan="3">Predikat</td>
                                            <td colspan="2" class="text-center"><?= $average['Nilai'];?></td>
                                        <?php endforeach;?>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="wrapper  table-responsive" style="width:18rem;">
                                    <table class="table table-bordered border border-dark text-center">
                                        <thead>
                                            <tr>
                                                <th>Nilai</th>
                                                <th>Predikat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>4</td>
                                                <td>A</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>B</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>C</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>D</td>
                                            </tr>
                                        </tbody>
                                    </table>        
                                </div>
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