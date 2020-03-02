<?php 
    include 'koneksi.php';

    if(isset($_POST["submit"])){
       $golongan = $_POST ["golongan"];
       $usia = $_POST["usia"];
       $gender = $_POST["gender"];
       #query insert to database
       mysqli_query($koneksi, "INSERT INTO pegawai VALUES ('', '$golongan', '$gender', '$usia')");
    }

    #query untuk menghitung jumlah
    function query($usia, $gender, $golongan){
        global $koneksi;
        $hasil = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM pegawai WHERE " . $usia . " AND gender='$gender' AND golongan='$golongan'");
        $fetched = mysqli_fetch_assoc($hasil);
        return $fetched["jml"];
    }

    function countGolongan($golongan){
        global $koneksi;
        $hasil = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM pegawai WHERE golongan='$golongan'");
        $fetched = mysqli_fetch_assoc($hasil);
        return $fetched["jml"];
    }

    function countGolonganGender($golongan, $gender){
        global $koneksi;
        $hasil = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM pegawai WHERE golongan='$golongan' AND gender='$gender'");
        $fetched = mysqli_fetch_assoc($hasil);
        return $fetched["jml"];
    }


    $dataQuery = [
        ["usia" => "usia < 20", "gender" => "P"],
        ["usia" => "usia < 20", "gender" => "L"],
        ["usia" => "usia BETWEEN 20 AND 40", "gender" => "P"],
        ["usia" => "usia BETWEEN 20 AND 40", "gender" => "L"],
        ["usia" => "usia > 40", "gender" => "P"],
        ["usia" => "usia > 40", "gender" => "L"],
    ];

    $dataQueryGender = [
        ["gender"=> "P"],
        ["gender"=> "L"]
    ];


?>

<html>
    <head>
        <title>Tabel Kontingen</title>
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>
        <div class="container mt-4">
        <div class="row">
            <a href="data.php" class="btn btn-success" >Lihat data</a>
            <a href="chart.php" class="btn btn-warning ml-2" >Lihat Chart</a>
        </div>
        <form action="" method="POST" class="card card-body mt-4" >
            <table class="form-group">
                <tr>
                    <td>
                        <label for="golongan">Golongan : </label>
                    </td>
                    <td>
                        <select name="golongan" id="golongan" class="form-control" >
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="gender">Gender : </label>
                    </td>
                    <td>
                        <label for="P">Perempuan</label>
                        <input type="radio" id="P" value="P" name="gender"  >
                        <label for="L">Laki - Laki</label>
                        <input type="radio" id="L" value="L" name="gender"  >
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="usia">Usia : </label>
                    </td>
                    <td>
                        <input type="number" max="60" min="15" name="usia" class="form-control" >
                    </td>
                </tr>
            </table>

            <button type="submit" name="submit" class="btn btn-primary" >Tambah</button>
        </form>


        <!-- table 1 arah -->
        <table class="table table-info table-bordered bg-info" >
            <caption>Tabel 1 Arah</caption>
            <tr>
                <th>Golongan</th>
                <th>Jumlah Orang</th>
            </tr>
            <?php for($i=1; $i<=4; $i++) { ?>
            <tr>
                <th><?php echo $i ?></th>
                <td><?php echo countGolongan($i) ?></td>
            </tr>
            <?php } ?>
        </table>

        <!-- table 2 arah -->
        <table class="table table-warning table-bordered bg-warning">
            <caption>Tabel 2 Arah</caption>
            <tr>
                <th>Golongan</th>
                <th>P</th>
                <th>L</th>
            </tr>
            <?php for($i = 1;$i<=4;$i++) { ?>
            <tr>
                <th><?php echo $i ?></th>
                <?php foreach($dataQueryGender as $gender) : ?>
                    <td><?php echo countGolonganGender($i, $gender["gender"]) ?></td>
                <?php endforeach ?>
            </tr>
            <?php } ?>
        </table>

        <!-- table 3 arah -->
        <table border="1" class="table table-bordered table-light bg-light" >
            <caption>Tabel 3 Arah</caption>
            <tr>
                <th rowspan="2">Golongan</th>
                <th colspan="2">Usia < 20</th>
                <th colspan="2">20 < usia < 40 </th>
                <th colspan="2">Usia > 40</th>
            </tr>
            <tr>
                <th>P</th>
                <th>L</th>
                <th>P</th>
                <th>L</th>
                <th>P</th>
                <th>L</th>
            </tr>
            <?php for($i = 1; $i <=4; $i++) { ?>
            <tr>
                <th><?php echo $i; ?></th>
                <?php foreach($dataQuery as $data) : ?>
                    <td><?php echo query($data["usia"], $data["gender"], $i) ?></td>
                <?php endforeach ?>
            </tr>
            <?php } ?>
        </table>

        </div>
    </body>
</html>