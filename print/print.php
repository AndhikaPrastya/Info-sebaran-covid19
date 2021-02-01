<?php
date_default_timezone_set('Asia/Jakarta');
require_once "../vendor/autoload.php";
require_once "../config/functions.php";
require_once "../config/config.php";

$mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);
$data = '
<!DOCTYPE html>
<html>
<head>
   <title>Cetak Rekap Data</title>
</head>
<body>
   <table margin="auto">
         <tr>
            <td width="10%">
               <center>
                     <img src="../assets/img/logo-c19.png" width="150px" height="100px">
               </center>
            </td>
         </tr>
   </table>
   <table margin="auto">
         <tr>
            <td width="10%">
               <center>
                     <font size="5">Rekap Data Monitoring Sebaran Covid 19</font><br>
               </center>
            </td>
         </tr>
   </table>
   <br>

   <table border="1" cellpadding="10" cellspacing="0" autosize="1" width="100%">
                   </thead>
                     <tr bgcolor=#ced8d9>
                        <th  style="text-align: center;vertical-align: middle;"class="text-center">Tanggal</th>';
            $status=query("SELECT * FROM status GROUP BY id_status DESC");
            foreach ($status as $row1) :
            $data .= '
                      <th  style="text-align: center;vertical-align: middle;"class="text-center">Jumlah Pasien '. $row1['nm_status'].'</th>';
            endforeach;
            $data .= '</tr>
                        <th  style="text-align: center;vertical-align: middle;"class="text-center">Total</th>
                      </tr>
                    </thead>';
            $tanggal=query("SELECT a.*,b.nm_status FROM pasien a 
                            INNER JOIN status b USING (id_status) 
                            GROUP BY tanggal ORDER BY tanggal DESC, id_status DESC");
            foreach ($tanggal as $row) :
            $tgl = $row['tanggal'];
            $data .= '<tbody>
                         <tr>
                            <td style="text-align: center;vertical-align: middle;">'.$row['tanggal']. '</td>';
            foreach ($status as $key) :
            $sts = $key['id_status'];
            $hasil = query("SELECT a.no_pasien FROM pasien a INNER JOIN status b USING (id_status) 
                                WHERE a.id_status = $sts AND a.tanggal = '$tgl'"); 
            $jumlah = count($hasil); 
            $data .= '<td style="text-align: center;vertical-align: middle;">'. $jumlah .'</td>';
            endforeach; 
            $hasil_tgl = query("SELECT a.no_pasien FROM pasien a INNER JOIN status b USING (id_status) 
                                 WHERE a.tanggal = '$tgl'"); 
            $total_tgl = count($hasil_tgl); 
            $data .= '<td style="text-align: center;vertical-align: middle;">'. $total_tgl .'</td>
                      </tr>';
            endforeach; 
            $data .='<tr bgcolor=#ced8d9>
                      <th style="text-align: center;vertical-align: middle;">Jumlah</td>';
            foreach ($status as $key) :
            $sts = $key['id_status'];
            $hasil_sts = query("SELECT a.no_pasien FROM pasien a INNER JOIN status b USING (id_status) 
                                WHERE a.id_status = $sts"); 
            $total_sts = count($hasil_sts);
            $data .='<th style="text-align: center;vertical-align: middle;">'. $total_sts .'</th>';
            endforeach; 
            $hasil_all = query("SELECT a.no_pasien FROM pasien a INNER JOIN status b USING (id_status)"); 
            $total_all = count($hasil_all); 
            $data .='<th style="text-align: center;vertical-align: middle;">'. $total_all .'</th>
                     </tr>
            </tbody>
  </table>

</body>
</html>
';
$mpdf->WriteHTML($data);
$mpdf->Output();
?>