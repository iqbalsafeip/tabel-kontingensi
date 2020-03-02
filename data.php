<?php
    include 'koneksi.php';

    $hasil = mysqli_query($koneksi, "SELECT * FROM pegawai");
    
    $result = [];
    while($fetched = mysqli_fetch_assoc($hasil)){
        $result[] = $fetched;
    }
   

?>
<html>
    <head>
        <title>Halaman Data</title>
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>
        <div class="container mt-4" >
            <div class="row">
                <a href="index.php" class="btn btn-success" >Kembali</a>
            </div>
            <h1>Halaman Data</h1>

            <table class="table table-dark table-bordered bg-dark" >
                <tr>
                    <th>No</th>
                    <th>Golongan</th>
                    <th>Usia</th>
                    <th>Kelamin</th>
                    <th>Aksi</th>
                </tr>
                <?php $i=1 ?>
                <?php foreach($result as $res) : ?>
                    <tr>
                        <th><?php echo $i ?></th>
                        <td><?php echo $res["golongan"] ?></td>
                        <td><?php echo $res["usia"] ?></td>
                        <td><?php echo $res["gender"] ?></td>
                        <td>
                            <a href="hapus_data.php?id=<?php echo $res["id"] ?>" class="btn btn-danger" >Hapus</a>
                        </td>
                    </tr>
                <?php $i++ ?>
                <?php endforeach ?>
            </table>
        </div>
    </body>
</html>