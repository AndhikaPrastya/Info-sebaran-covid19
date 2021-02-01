<?php 

  $page = "dashboard";
  include('template/header.php');
  // require_once "../config/functions.php";

?>
 <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">
     
      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
      <div class="container">

        <div class="col-sm-12">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading"><b>Grafik Jumlah Pasien Covid 19</b></div>
              <div class="panel-body"><iframe src="grafik1.php" width="100%" height="300"></iframe></div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-sm-6">
            <div class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading"><b>Grafik Pasien Positif Berdasarkan Umur</b></div>
                <div class="panel-body"><iframe src="grafik2.php" width="100%" height="300"></iframe></div>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading"><b>Grafik Jumlah Pasien Berdasarkan Status</b></div>
                <div class="panel-body"><iframe src="grafik3.php" width="100%" height="300"></iframe></div>
              </div>
            </div>
          </div>

        </div>
      </section>

</main><!-- End #main -->

<?php 
include('template/footer.php');
?>