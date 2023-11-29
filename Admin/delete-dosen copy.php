<?php
require "function/function.php";
$nim= $_GET['ni,'];

if(deleteMahasiswa($nim)>0){
    echo"<script>
         alert('berhasil dihapus');
         document.location.href = 'mahasiswa.php';
         </script>";
}else{
    echo"<script>
         alert('gagal dihapus');
         document.location.href = 'mahasiswa.php';
         </script>";
}


?>