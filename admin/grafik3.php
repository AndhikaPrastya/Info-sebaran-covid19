<?php
 require_once "../config/functions.php";
 require_once "../config/config.php";

$result= mysqli_query($koneksi, "SELECT nm_status AS kodey FROM status");
$result1= mysqli_query($koneksi, "SELECT b.nm_status, COUNT(a.no_pasien) AS kodex FROM pasien a 
                                  RIGHT JOIN status b USING (id_status) GROUP BY id_status");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Chartjs, PHP dan MySQL Demo Grafik Lingkaran</title>
    <script src="../assets/js/Chart.js"></script>
    <style type="text/css">
            .container {
                width: 40%;
                margin: 15px auto;
            }
    </style>
  </head>
  <body>

    <div class="container">
        <canvas id="piechart" width="100" height="100"></canvas>
    </div>
  </body>
</html>

<script  type="text/javascript">
  var ctx = document.getElementById("piechart").getContext("2d");
  var data = {
            labels: [<?php while ($p = mysqli_fetch_array($result)) { echo '"' . $p['kodey'] . '",';}?>],
            datasets: [
            {
              label: "Penjualan Barang",
              data: [<?php while ($p = mysqli_fetch_array($result1)) { echo '"' . $p['kodex'] . '",';}?> ],
              backgroundColor: [
                '#29B0D0',
                '#2A516E',
                '#F07124',
                '#CBE0E3',
                '#979193'
              ]
            }
            ]
            };

  var myPieChart = new Chart(ctx, {
                  type: 'pie',
                  data: data,
                  options: {
                    responsive: true
                }
              });

</script>