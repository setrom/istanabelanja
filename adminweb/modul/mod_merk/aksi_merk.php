<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../../config/koneksi.php";
//include "../../../config/fungsi_seo.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];
$folderimg="../../../images/merk/"; // Tempat upload file gambar

// Hapus Perusahaan Pengiriman
if ($module=="$module" AND $act=='hapus'){
      mysql_query("DELETE FROM merk WHERE merk_id='$_GET[id]'");
      //$sub=mysql_query("SELECT * FROM kota where id_perusahaan='$_GET[id]'");
     //   while (mysql_fetch_array($sub)){
     //           mysql_query("DELETE FROM kota WHERE id_perusahaan='$_GET[id]'");	      
     // }
      
  header('location:../../media.php?module='.$module);
}

// Input Perusahaan Pengiriman
elseif ($module=="$module" AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
   if (!empty($lokasi_file)){
    UploadMerk($nama_file_unik);
  				mysql_query("INSERT INTO merk(merk_nama,merk_logo,merk_ket) 
                            VALUES('$_POST[merk_nama]','$nama_file_unik','$_POST[merk_ket]')");      
  				header('location:../../media.php?module='.$module);
			} else {
				mysql_query("INSERT INTO merk(merk_nama,merk_ket) 
                            VALUES('$_POST[merk_nama]','$_POST[merk_ket]')");      
  				header('location:../../media.php?module='.$module);
			}
}
// Update Perusahaan Pengiriman
elseif ($module=="$module" AND $act=='update'){
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
  	$tipe_file      = $_FILES['fupload']['type'];
  	$nama_file      = $_FILES['fupload']['name'];
  	$acak           = rand(1,99);
  	$nama_file_unik = $acak.$nama_file; 
	//$subkat_seo = seo_title($_POST['subkat_nama']);
	
	//echo $_POST['id'];
	if (empty($lokasi_file)){
	   	mysql_query("UPDATE merk SET merk_nama 		='$_POST[merk_nama]',
									 merk_ket 		='$_POST[merk_ket]'
									 WHERE merk_id 	='$_POST[id]'");
  		header('location:../../media.php?module='.$module);
		
  		} else {
			
 		UploadMerk($nama_file_unik);
  		mysql_query("UPDATE merk SET 	 merk_nama 		='$_POST[merk_nama]',
										 merk_logo 		='$nama_file_unik',
										 merk_ket		='$_POST[merk_ket]'
										 WHERE merk_id 	='$_POST[id]'");
		
  		header('location:../../media.php?module='.$module);
		
		}
	}
}
?>
