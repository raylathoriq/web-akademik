<?php
require "function/function.php";
$id = $_GET['id'];

if(deleteRuangan($id)>0){
    echo"<script>
         alert('berhasil dihapus');
         document.location.href = 'ruangan.php';
         </script>";
}else{
    echo"<script>
         alert('gagal dihapus');
         document.location.href = 'ruangan.php';
         </script>";
}


?>