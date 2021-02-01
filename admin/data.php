<?php 

  date_default_timezone_set('Asia/Jakarta');
  $page = "data";
  include('template/header.php');
  require_once "../config/functions.php";
  require_once "../config/config.php";

if(isset($_POST["add"])){
  if(addPasien($_POST)>0){
    echo"
       <script>
       alert('data berhasil di tambahkan!');
       document.location.href='data.php';
       </script>
       ";
      }else{
        echo"
         <script>
         alert('data gagal di tambahkan!');
         document.location.href='data.php';
         </script>
         ";
      }
}

if(isset($_POST["delete"])){
  if(deletePasien($_POST)>0){
    echo"
       <script>
       alert('data berhasil di hapus!');
       document.location.href='data.php';
       </script>
       ";
      }else{
        echo"
         <script>
         alert('data gagal di hapus!');
         document.location.href='data.php';
         </script>
         ";
      }
}

if(isset($_POST["edit"])){
  if(editPasien($_POST)>0){
    echo"
       <script>
       alert('data berhasil di ubah');
       document.location.href='data.php';
       </script>
       ";
      }else{
        echo"
       <script>
       alert('data gagal di ubah');
       document.location.href='data.php';
       </script>
       ";
      }
}

?>


 <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">
     
      </div>
    </section>

    <section class="inner-page">
      <div class="container">
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" 
              data-target="#modalTambah"> Tambah Pasien </button>
        <a href="../print/print.php" class="btn btn-warning btn-sm" target="_blank"> Download Rekap Data</a>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="table">
              <thead class="table-info">
               <tr>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Nomor Pasien</th>
                <th class="text-center">Usia</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>  

             <?php  
             $i=1;
             $pasien=mysqli_query($koneksi,"SELECT a.*,b.nm_status FROM pasien a 
                                            INNER JOIN status b USING (id_status) 
                                            ORDER BY tanggal DESC, no_pasien DESC");

             while($row = mysqli_fetch_array($pasien)): ?>

              <tr>
                <td class="text-center"><?=date('d-M-Y', strtotime($row['tanggal']));?></td>
                <td class="text-center"><?=$row['no_pasien'];?></td>
                <td class="text-center"><?=$row['usia'];?> th</td>
                <td class="text-center"><?=$row['nm_status'];?></td>
                <td class="text-center">
                  <form method="POST">
                    <button type="button" id="edit" name="edit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $row['no_pasien']; ?>">
                      <i class="fas fa-edit"></i> Edit</button>

                      <input type="hidden" name="no_pasien" value="<?=$row['no_pasien'];?>">
                      <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('yakin hapus <?=$row['no_pasien'] ?>?');">
                        <i class="fas fa-trash-alt"></i> Delete</button>
                      </form>
                    </td>
                  </tr>

                  <?php $i=$i+1;
                endwhile; ?>                     
              </tbody>
            </table> 
          </div>
        </div>
      </section>

</main>


        <!-- Modal Tambah Data -->
              <div class="modal fade" id="modalTambah" tabindex="-2" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                      <div class="modal-header modal-bg bg-success text-white" back>
                        <h5 class="modal-title modal-text" id="modalTambahTitle">Form Tambah Pasien</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <div class="modal-body">
                          <form>
                            <div class="form-group">
                              <label for="tanggal" class="col-form-label">Tanggal:</label>
                              <input type="text" class="form-control mt-1" id="tanggal" name="tanggal" value="<?=date("Y-m-d") ?>" required>
                            </div>

                            <?php 
                            $query = mysqli_query($koneksi, "SELECT max(no_pasien) as noTerbesar FROM pasien");
                            $data = mysqli_fetch_array($query);
                            $noPasien = $data['noTerbesar'];

                            $urutan = (int) substr($noPasien, 3, 3);
                            $urutan++;

                            $huruf = "NO_";
                            $noPasien = $huruf . sprintf("%03s", $urutan); 
                            ?>

                            <div class="form-group">
                              <label for="no_pasien" class="col-form-label">No Pasien:</label>
                              <input type="text" class="form-control mt-1" id="no_pasien" name="no_pasien" value="<?=$noPasien ?>" readonly>
                            </div>

                            <div class="form-group">
                              <label for="usia" class="col-form-label">Usia:</label>
                              <input type="number" class="form-control mt-1" id="usia" name="usia" min="0" required>
                            </div>

                            <div class="form-group">
                              <label for="status">Status:</label>
                              <select class="form-control" id="status" name="status">
                                <?php 
                                $status = query("SELECT * FROM status ORDER BY id_status ASC");
                                foreach ($status as $key) :?>
                                  <option value="<?=$key['id_status'];?>"><?=$key['nm_status'];?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" name="add" class="btn btn-primary">Insert</button>
                            </div>
                          </form>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

               <!-- Modal Edit Data -->
              <?php foreach ($pasien as $row)  : ?>
              <div class="modal fade" id="modalEdit<?=$row['no_pasien'] ?>" tabindex="-2" role="dialog" aria-labelledby="modalEditDataTitle" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                   <div class="modal-content">
                     <form method="post" enctype="multipart/form-data">
                       <div class="modal-header modal-bg bg-warning text-white" back>
                         <h5 class="modal-title modal-text" id="modalEditDataTitle">Form Edit Pasien</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <div class="modal-body">
                        <form>
                         <div class="form-group">
                              <label for="tanggal" class="col-form-label">Tanggal:</label>
                              <input type="date" class="form-control mt-1" id="tanggal" name="tanggal" 
                              value="<?=$row['tanggal'] ?>" readonly>
                            </div>

                            <div class="form-group">
                              <label for="no_pasien" class="col-form-label">No Pasien:</label>
                              <input type="text" class="form-control mt-1" id="no_pasien" name="no_pasien" value="<?=$row['no_pasien'] ?>" readonly>
                            </div>

                            <div class="form-group">
                              <label for="usia" class="col-form-label">Usia:</label>
                              <input type="number" class="form-control mt-1" id="usia" name="usia" min="0" value="<?=$row['usia'] ?>" required>
                            </div>

                            <div class="form-group">
                              <label for="status">Status:</label>
                              <select class="form-control" id="status" name="status">
                                <?php 
                                $status = query("SELECT * FROM status ORDER BY id_status ASC");
                                foreach ($status as $key) : ?>
                                  <option value="<?=$key['id_status']?>"
                                    <?php  if ($row['id_status']==$key['id_status']) {
                                      echo "selected";
                                    }else{
                                      echo "";
                                    }?>
                                    >
                                    <?=$key['nm_status'];?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>

                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button type="submit" name="edit" class="btn btn-primary">Update</button>
                         </div>
                       </form>
                     </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>

<?php 
  include('template/footer.php');
?>
