<?php 
    $id = $_GET["id"];
    include 'koneksi.php';

    mysqli_query($koneksi, "DELETE FROM pegawai WHERE id='$id'");

    if(mysqli_affected_rows($koneksi)>0){
        echo "<script>
            alert('data berhasil dihapus')
            window.location.href = 'data.php'
        </script>";
    }
    
    
