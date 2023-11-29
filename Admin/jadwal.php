<?php
    require "function/function.php";
    if(isset($_POST['kirim'])){
        if(tambahJadwal($_POST)>0){
            
            echo"<script>
                alert('berhasil di tambahkan');
                document.location.href = 'jadwal.php';
                </script>";
        }
        else{
            echo"<script>
                alert('gagal ditambahkan');
                document.location.href = 'jadwal.php';
                </script>"; 
    }
}

    if(isset($_POST['edit'])){
        if(updateJadwal($_POST) > 0){
            echo"<script>
            alert('berhasil di edit');
            document.location.href = 'jadwal.php';
            </script>";
    }
    else{
        echo"<script>
            alert('gagal di edit');
            document.location.href = 'jadwal.php';
            </script>";
        }
    }


    
    $query = mysqli_query($conn,"SELECT * FROM dosen");
    $ruangan = mysqli_query($conn,"SELECT * FROM ruangan");
    $matkul =mysqli_query($conn,"SELECT * FROM matkul");
    $jadwal = mysqli_query($conn,"SELECT * FROM jadwal join dosen AS d USING(id_dosen) join matkul as m USING(id_matkul) join ruangan as r USING(id_ruangan)");

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

    
    
    
    <body data-sidebar="dark" data-layout-mode="light">$transaksi = mysqli_query($conn,"SELECT * FROM transaksi JOIN outlet USING(id_outlet) JOIN member USING('id_member)");

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
                                    <h4 class="mb-sm-0 font-size-18">Jadwal</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Daftar Jadwal</a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahDosen"> <i class="bx bx-plus"></i> Tambah Jadwal  </button>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center border border-3 border-dark" id="table">
                                    
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Dosen</th>
                                            <th>Mata Kuliah</th>
                                            <th>Hari</th>
                                            <th>Waktu</th>
                                            <th>Ruangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($jadwal as $j):?>
                                            
                                        <tr>
                                            <td><?= $no++;?></td>
                                            <td><?= $j['nama_dosen'];?></td>
                                            <td><?= $j['nama_matkul'];?></td>
                                            <td><?= $j['hari'];?></td>
                                            <td><?= $j['jam_masuk'] .'-'.  $j['jam_keluar']?></td>
                                            <td><?= $j['nama_ruangan'];?></td>
                                            <td> <button class="badge bg-warning px-3 py-2 d-inline-block border-0" data-bs-target="#updateDosen<?=$j['id_jadwal'];?>" data-bs-toggle="modal"><i class="bx bxs-pencil "></i></button>
                                                 <a href="delete-jadwal.php?id=<?= $j['id_jadwal'];?>" class="badge bg-danger px-3 py-2" onclick="return confirm('yakin?')"><i class="bx bxs-trash"></i></a>   
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="updateDosen<?= $j['id_jadwal'];?>" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                                <div class="modal-content">
                                                       <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">Update Dosen</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id" value="<?= $j['id_jadwal']?>">
                                                            <label for="" class="form-label">Nama Dosen</label>
                                                            <select name="dosen" id="" class="form-select mb-3">
                                                                <?php foreach($query as $d):?>
                                                                <option value="<?= $d['id_dosen'];?>" <?= $j['id_dosen'] == $d['id_dosen'] ? 'selected' : '';?> ><?=$d['nama_dosen'];?></option>
                                                                <?php endforeach ;?>
                                                            </select>
                                                            <label for="" class="form-label">Mata Kuliah</label>
                                                            <select name="matkul" id="" class="form-select mb-3">
                                                                <?php foreach($matkul as $m):?>
                                                                <option value="<?= $m['id_matkul'];?>" <?= $j['id_matkul'] == $m['id_matkul'] ? 'seleted' : '';?>><?= $m['nama_matkul'];?></option>       
                                                                <?php endforeach;?>
                                                            </select>
                                                            <label for="" class="form-label">Ruangan</label>
                                                            <select name="ruangan" id="" class="form-select mb-3">
                                                                <?php foreach($ruangan as $r):?>
                                                                <option value="<?= $r['id_ruangan'];?>" <?= $j['id_ruangan'] == $r['id_ruangan'] ? 'selected' : ''?>><?= $r['nama_ruangan'];?></option>       
                                                                <?php endforeach;?>
                                                            </select>
                                                            <label for="" class="form-label">Hari</label>
                                                            <select name="hari" id="" class="form-select mb-3">
                                                                <option value="Senin" <?= $j['hari'] == 'Senin' ? 'selected' : ''?>>Senin</option>
                                                                <option value="Selasa" <?= $j['hari'] == 'Selasa' ? 'selected' : ''?>>Selasa</option>
                                                                <option value="Rabu" <?= $j['hari'] == 'Rabu' ? 'selected' : ''?>>Rabu</option>
                                                                <option value="Kamis" <?= $j['hari'] == 'Kamis' ? 'selected' : ''?>>Kamis</option>
                                                                <option value="Jumat" <?= $j['hari'] == 'Jumat' ? 'selected' : ''?>>Jumat</option>
                                                                <option value="Sabtu" <?= $j['hari'] == 'Sabtu' ? 'selected' : ''?>>Sabtu</option>
                                                            </select>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="" class="form-label">Jam Masuk</label>
                                                                    <input type="time" name="masuk" id="" class="form-control mb-3" value ="<?= $j['jam_masuk']?>">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="" class="form-label">Jam Keluar</label>
                                                                    <input type="time" name="keluar" id="" class="form-control mb-3" value ="<?= $j['jam_keluar']?>" >
                                                                </div>
                                                            </div>
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
        <div class="modal fade" id="tambahDosen" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Tambah Jadwal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <label for="" class="form-label">Nama Dosen</label>
                            <select name="dosen" id="" class="form-select mb-3">
                                <?php foreach($query as $d):?>
                                <option value="<?= $d['id_dosen'];?>"><?=$d['nama_dosen'];?></option>
                                <?php endforeach ;?>
                            </select>
                            <label for="" class="form-label">Mata Kuliah</label>
                            <select name="matkul" id="" class="form-select mb-3">
                                <?php foreach($matkul as $m):?>
                                <option value="<?= $m['id_matkul'];?>"><?= $m['nama_matkul'];?></option>       
                                <?php endforeach;?>
                            </select>
                            <label for="" class="form-label">Ruangan</label>
                            <select name="ruangan" id="" class="form-select mb-3">
                                <?php foreach($ruangan as $r):?>
                                <option value="<?= $r['id_ruangan'];?>"><?= $r['nama_ruangan'];?></option>       
                                <?php endforeach;?>
                            </select>
                            <label for="" class="form-label">Hari</label>
                            <select name="hari" id="" class="form-select mb-3">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="form-label">Jam Masuk</label>
                                    <input type="time" name="masuk" id="" class="form-control mb-3">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Jam Keluar</label>
                                    <input type="time" name="keluar" id="" class="form-control mb-3">
                                </div>
                            </div>
                            

                            
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