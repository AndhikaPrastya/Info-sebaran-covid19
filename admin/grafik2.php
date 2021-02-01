<?php
 require_once "../config/functions.php";
 require_once "../config/config.php";

$min= query("SELECT a.no_pasien AS min FROM pasien a 
             INNER JOIN status b USING (id_status) WHERE a.usia < 17");
$jml_min = count($min);
$mid= query("SELECT a.no_pasien AS mid FROM pasien a 
             INNER JOIN status b USING (id_status) WHERE a.usia >= 17 AND a.usia <= 40");
$jml_mid = count($mid);
$max= query("SELECT a.no_pasien AS max FROM pasien a 
             INNER JOIN status b USING (id_status) WHERE a.usia > 40");
$jml_max = count($max);

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
            labels: ['<17 Th','17 Th - 40 Th','40> Th'],
            datasets: [
            {
              label: "Penjualan Barang",
              data: [<?php echo $jml_min.','.$jml_mid.','.$jml_max;?> ],
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