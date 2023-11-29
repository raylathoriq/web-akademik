<?php
require "function/function.php";
$id = $_GET['id'];

if(deleteJadwal($id)>0){
    echo"<script>
         alert('berhasil dihapus');
         document.location.href = 'jadwal.php';
         </script>";
}else{
    echo"<script>
         alert('gagal dihapus');
         document.location.href = 'jadwal.php';
         </script>";
}
?>