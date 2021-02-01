<?php
  require_once "../config/functions.php";
  require_once "../config/config.php";

  $result= mysqli_query($koneksi, "SELECT a.tanggal AS kodey, COUNT(a.no_pasien) AS kodex FROM pasien a 
                                    INNER JOIN status b USING (id_status) 
                                    GROUP BY tanggal ORDER BY tanggal ASC, id_status DESC");
  $result1= mysqli_query($koneksi, "SELECT COUNT(a.no_pasien) AS kodex FROM pasien a 
                                    INNER JOIN status b USING (id_status) 
                                    GROUP BY tanggal ORDER BY tanggal ASC, id_status DESC");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Grafik Jumlah Pasien Covid 19</title>
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
        <canvas id="linechart" width="100%" height="60%"></canvas>
    </div>

  </body>
</html>

<script  type="text/javascript">
  var ctx = document.getElementById("linechart").getContext("2d");
  var data = {
            labels: [<?php while ($p = mysqli_fetch_array($result)) { echo '"' . $p['kodey'] . '",';}?>],
            datasets: [
                  {
                    label: "Pasien Covid 19",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#29B0D0",
                    borderColor: "#29B0D0",
                    pointHoverBackgroundColor: "#29B0D0",
                    pointHoverBorderColor: "#29B0D0",
                    data: 
                    [<?php while ($x = mysqli_fetch_array($result1)) { echo '"' . $x['kodex'] . '",';}?>]
                  } 
                  ]
          };

  var myBarChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
            legend: {
              display: true
            },
            barValueSpacing: 20,
            scales: {
              yAxes: [{
                  ticks: {
                      min: 0,
                  }
              }],
              xAxes: [{
                          gridLines: {
                              color: "rgba(0, 0, 0, 0)",
                          }
                      }]
              }
          }
        });
</script>