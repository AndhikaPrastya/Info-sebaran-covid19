<?php

function query($query){
	include('config.php');

	$result=mysqli_query($koneksi,$query);
	$rows=[];
	while($row=mysqli_fetch_assoc($result)){
		$rows[]=$row;
	}return $rows;
}

function addPasien($data)
{
	include('config.php');

	$no_pasien 	= $data["no_pasien"];
	$tanggal	= $data["tanggal"];
	$no_pasien 	= $data["no_pasien"];
	$usia	    = $data["usia"];
	$status     = $data["status"];

	$result = mysqli_query($koneksi, "SELECT no_pasien FROM pasien WHERE no_pasien = '$no_pasien' ");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
 				alert('Nomor Pasien sudah Ada!')
 			  </script>";
		return false;
	}

	$query = "INSERT INTO pasien VAlUES ('$no_pasien','$tanggal','$usia','$status')";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

function deletePasien($data) {
	include('config.php');

	$no_pasien=$data["no_pasien"];

	$query 	= "DELETE FROM pasien WHERE no_pasien='$no_pasien'";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);

}

function editPasien($data){
	include('config.php');
// var_dump($data);die;
	$no_pasien  = $data["no_pasien"];
	$tanggal	= $data["tanggal"];
	$no_pasien 	= $data["no_pasien"];
	$usia	    = $data["usia"];
	$status     = $data["status"];

 	$query = "UPDATE pasien SET tanggal='$tanggal',usia='$usia',id_status='$status' WHERE no_pasien='$no_pasien'";

 	mysqli_query($koneksi,$query);
 	return mysqli_affected_rows($koneksi);

}
