<?php
require "function/function.php";
$id = $_GET['id'];

if(deleteDosen($id)>0){
    echo"<script>
         alert('berhasil dihapus');
         document.location.href = 'dosen.php';
         </script>";
}else{
    echo"<script>
         alert('gagal dihapus');
         document.location.href = 'dosen.php';
         </script>";
}


?>