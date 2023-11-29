<?php
include "config/config.php";



    function tambahDosen($data){
        global $conn;
        
        $nama = $data['nama'];
        $nip = $data['nip'];
        
        mysqli_query($conn,"INSERT INTO dosen VALUES('','$nama','$nip')");
        return mysqli_affected_rows($conn);
    }

    function deleteDosen($id){
        global $conn;
        mysqli_query($conn,"DELETE FROM dosen WHERE id_dosen = '$id'");
        return mysqli_affected_rows($conn);
    }

    function updateDosen($data){
        global $conn;
        $nama = $data['nama'];
        $nip = $data['nip'];
        mysqli_query($conn,"UPDATE dosen SET nama_dosen = '$nama', nip = '$nip' WHERE id_dosen = '$_POST[id_dosen]'");
        return mysqli_affected_rows($conn);
    }


    function tambahRuangan($data){
        global $conn;
        $nama_ruangan = $data['nama_ruangan'];
        mysqli_query($conn,"INSERT INTO ruangan VALUES('','$nama_ruangan')");
        return mysqli_affected_rows($conn);
    }

    function deleteRuangan($id){
        global $conn;
        mysqli_query($conn,"DELETE FROM ruangan WHERE id_ruangan = '$id'");
        return mysqli_affected_rows($conn);
    }

    function updateRuangan($data){
        global $conn;

        $nama_ruangan = $data['nama_ruangan'];
        mysqli_query($conn,"UPDATE ruangan SET nama_ruangan = '$nama_ruangan' WHERE id_ruangan = '$_POST[id_ruangan]'");
        return mysqli_affected_rows($conn);
    }

    function tambahMatkul($data){
        global $conn;

        $matkul = $data['matkul'];
        $sks = $data['sks'];
        $semester = $data['semester'];

        mysqli_query($conn,"INSERT INTO matkul VALUES ('','$matkul','$sks','$semester')");
        return mysqli_affected_rows($conn);
    }

    function updateMatkul($data){
        global $conn;

        $matkul = $data['matkul'];
        $sks = $data['sks'];
        $semester = $data['semester'];

        mysqli_query($conn,"UPDATE matkul SET nama_matkul = '$matkul', sks = '$sks', semester = '$semester' WHERE id_matkul = '$_POST[id_matkul]'");
        return mysqli_affected_rows($conn);

    }

    function deleteMatkul($id){
        global $conn;

        mysqli_query($conn,"DELETE FROM matkul WHERE id_matkul = '$id'");
        return mysqli_affected_rows($conn);
    }


    function tambahMahasiswa($data){
        global $conn;
        $nim = $data['nim'];
        $nama = $data['nama'];
        $tingkat = $data['tingkat'];
        $alamat =$data['alamat'];

        mysqli_query($conn,"INSERT INTO mahasiswa VALUES('$nim','$nama','$tingkat','$alamat')");
        return mysqli_affected_rows($conn);

    }

    function updateMahasiswa($data){
        global $conn;
        $nim_lama = $data['nim_lama'];
        $nim = $data['nim'];
        $nama = $data['nama'];
        $tingkat = $data['tingkat'];
        $alamat =$data['alamat'];
        mysqli_query($conn,"UPDATE mahasiswa   SET nama ='$nama', NIM = '$nim', tingkat = '$tingkat' , alamat = '$alamat' WHERE NIM = '$nim_lama'");
        return mysqli_affected_rows($conn);
    }


    function deleteMahasiswa($nim){
        global $conn;
        mysqli_query($conn,"DELETE FROM mahasiswa WHERE NIM = '$nim' ");
        return mysqli_affected_rows($conn);
    }


    function tambahNilai($data){
        global $conn; 

        $nim = $data['nim'];
        $matkul = $data['matkul'];
        $predikat = $data['predikat'];

        mysqli_query($conn,"INSERT INTO nilai VALUES('','$matkul', '$nim','$predikat')");
        return mysqli_affected_rows($conn);
    }

    function deleteNilai($id){
        global $conn;
        mysqli_query($conn,"DELETE FROM nilai WHERE id_nilai = '$id' ");
        return mysqli_affected_rows($conn);
    }
    function updateNilai($data){
        global $conn;
        $id = $data['id_nilai'];
        $nilai = $data['nilai'];
        mysqli_query($conn,"UPDATE nilai SET nilai = '$nilai' WHERE id_nilai = '$id'");
        return mysqli_affected_rows($conn);
    }


    function tambahJadwal($data){
        global $conn;

        $dosen = $data['dosen'];
        $matkul = $data['matkul'];
        $ruangan = $data['ruangan'];
        $hari = $data['hari'];
        $masuk = $data['masuk'];
        $keluar = $data['keluar'];

        mysqli_query($conn,"INSERT INTO jadwal VALUES ('','$dosen','$matkul','$ruangan','$hari','$masuk','$keluar')");
        return mysqli_affected_rows($conn);
    }

    function updateJadwal($data){
        global $conn;
        
        $dosen = $data['dosen'];
        $matkul = $data['matkul'];
        $ruangan = $data['ruangan'];
        $hari = $data['hari'];
        $masuk = $data['masuk'];
        $keluar = $data['keluar'];

        mysqli_query($conn,"UPDATE jadwal SET id_dosen = '$dosen', id_matkul = '$matkul' , id_ruangan = '$ruangan' , hari = '$hari', jam_masuk = '$masuk' , jam_keluar = '$keluar' WHERE id_jadwal = '$_POST[id]'");
        return mysqli_affected_rows($conn);
    }

    function deleteJadwal($id){
        global $conn;

        mysqli_query($conn,"DELETE FROM jadwal WHERE id_jadwal = '$id'");
        return mysqli_affected_rows($conn);
    }
?> 