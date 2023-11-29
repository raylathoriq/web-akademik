<?php
require "function/function.php";
$nim= $_GET['nim'];
$id = $_GET['id'];

if(deleteNilai($id)>0){
    echo"<script>
         alert('berhasil dihapus');
         document.location.href = 'detail.php?nim=$nim';
         </script>";
}else{
    echo"<script>
         alert('gagal dihapus');
         document.location.href = 'detail.php?nim=$nim';
         </script>";
}


?>