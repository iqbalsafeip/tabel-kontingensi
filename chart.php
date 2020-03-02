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
        <title>Halaman Chart</title>
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body>
        <div class="container mt-4">
            <div class="row">
                <a href="index.php" class="btn btn-success" >Kembali</a>
            </div>

            <h3 class="text-center">PIE CHART GOLONGAN</h3>
            <canvas id="chartpie" ></canvas>
            <h3 class="text-center mt-3">GROUP COLUMN CHART GOLONGAN VS GENDER</h3>
            <canvas id="groupchart" ></canvas>
        </div>
    <script src="chart.js"></script>
    <script>
        let data = <?php echo json_encode($result) ?>;

        let gol1 = data.filter(d=> d.golongan === "1")
        let gol2 = data.filter(d=> d.golongan === "2")
        let gol3 = data.filter(d=> d.golongan === "3")
        let gol4 = data.filter(d=> d.golongan === "4")
        console.log(data);
        var ctx = document.getElementById('chartpie').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',

            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    label: '1',
                    backgroundColor: [
                        "rgb(252, 186, 3)",
                        "rgb(69, 252, 3)",
                        "rgb(3, 252, 252)",
                        "rgb(231, 3, 252)"
                    ],
                    borderColor: 'rgb(255, 99, 132)',
                    data: [gol1.length, gol2.length, gol3.length,gol4.length]
                }]
            },

            options: {}
        });

        let Laki1 = data.filter(d => d.golongan === "1" && d.gender === "L")
        let Laki2 = data.filter(d => d.golongan === "2" && d.gender === "L")
        let Laki3 = data.filter(d => d.golongan === "3" && d.gender === "L")
        let Laki4 = data.filter(d => d.golongan === "4" && d.gender === "L")

        let p1 = data.filter(d => d.golongan === "1" && d.gender === "P")
        let p2 = data.filter(d => d.golongan === "2" && d.gender === "P")
        let p3 = data.filter(d => d.golongan === "3" && d.gender === "P")
        let p4 = data.filter(d => d.golongan === "4" && d.gender === "P")

        var ctx = document.getElementById('groupchart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: ['1','2','3','4'],
                datasets: [{
                    label: 'Laki-Laki',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [Laki1.length, Laki2.length, Laki3.length, Laki4.length, 0]
                },
                {
                    label: 'Perempuan',
                    backgroundColor: 'rgb(231, 3, 252)',
                    borderColor: 'rgb(231, 3, 252)',
                    data: [p1.length, p2.length, p3.length, p4.length, 0]
                }]
            },

            // Configuration options go here
            options: {}
        });
    </script>
    </body>
</html>