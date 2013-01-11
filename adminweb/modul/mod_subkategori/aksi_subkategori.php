<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";


$module=$_GET['module'];
$act=$_GET['act'];

// Hapus Kategori
if ($module=='subkategori' AND $act=='hapus'){
  mysql_query("DELETE FROM subkat WHERE subkat_id='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='subkategori' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
   
  $subkat_seo = seo_title($_POST['subkat_nama']);
  
   // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadKat($nama_file_unik);
		mysql_query("INSERT INTO subkat(id_kategori,
										  subkat_nama,
										  subkat_gambar,
										  subkat_ket,
										  subkat_seo) 		
								   VALUES('$_POST[id_kategori]',
								   		  '$_POST[subkat_nama]',
										  '$nama_file_unik',
										  '$_POST[subkat_ket]',
								   	      '$subkat_seo')");
		
  		header('location:../../media.php?module='.$module);
		
  } else {
	  
  		mysql_query("INSERT INTO subkat(id_kategori,
										  subkat_nama,
										  
										  subkat_ket,
										  subkat_seo)
								 VALUES('$_POST[id_kategori]',
								   		  '$_POST[subkat_nama]',
										  
										  '$_POST[subkat_ket]',
								   	      '$subkat_seo')");
  		header('location:../../media.php?module='.$module);
  }
}

// Update kategori
elseif ($module=='subkategori' AND $act=='update'){
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
  	$tipe_file      = $_FILES['fupload']['type'];
  	$nama_file      = $_FILES['fupload']['name'];
  	$acak           = rand(1,99);
  	$nama_file_unik = $acak.$nama_file; 
	$subkat_seo = seo_title($_POST['subkat_nama']);
	
  if (empty($lokasi_file)){
	   	mysql_query("UPDATE subkat SET   id_kategori 		='$_POST[id_kategori]',
										 subkat_nama 		='$_POST[subkat_nama]',
										 subkat_seo			='$subkat_seo',
										 subkat_ket			='$_POST[subkat_ket]'
										 WHERE subkat_id 	='$_POST[id]'");
  		header('location:../../media.php?module='.$module);
		
		
  } else {
	  	UploadKat($nama_file_unik);
  		mysql_query("UPDATE subkat SET 	 id_kategori 		='$_POST[id_kategori]',
										 subkat_nama 		='$_POST[subkat_nama]',
										 subkat_seo			='$subkat_seo',
										 subkat_ket			='$_POST[subkat_ket]',
										 subkat_gambar     	='$nama_file_unik'
										 WHERE subkat_id 	='$_POST[id]'");
		
  		header('location:../../media.php?module='.$module);
 
  }
}
?>
