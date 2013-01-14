<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";


$module=$_GET['module'];
$act=$_GET['act'];

// Hapus Kategori
if ($module=='kategori' AND $act=='hapus'){
  mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='kategori' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
   
  $kategori_seo = seo_title($_POST['nama_kategori']);
  
   // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadKat($nama_file_unik);
		mysql_query("INSERT INTO kategori(nama_kategori,
										  kategori_seo,
										  kategori_induk,
										  gambar_kat) 		
								   VALUES('$_POST[nama_kategori]',
								   	      '$kategori_seo',
										  '$_POST[kategori_induk]',
										  '$nama_file_unik')");
		
  		header('location:../../media.php?module='.$module);
		
  } else {
	  
  		mysql_query("INSERT INTO kategori(nama_kategori,kategori_seo,kategori_induk) 		VALUES('$_POST[nama_kategori]','$kategori_seo','$_POST[kategori_induk]')");
  		header('location:../../media.php?module='.$module);
  }
}

// Update kategori
elseif ($module=='kategori' AND $act=='update'){
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
  	$tipe_file      = $_FILES['fupload']['type'];
  	$nama_file      = $_FILES['fupload']['name'];
  	$acak           = rand(1,99);
  	$nama_file_unik = $acak.$nama_file; 
	$kategori_seo = seo_title($_POST['nama_kategori']);
	
  if (empty($lokasi_file)){
	   	mysql_query("UPDATE kategori SET nama_kategori 		='$_POST[nama_kategori]',
										 kategori_seo		='$kategori_seo',
										 kategori_induk		='$_POST[kategori_induk]'
										 WHERE id_kategori 	='$_POST[id]'");
  		header('location:../../media.php?module='.$module);
		
  } else {
	  	UploadKat($nama_file_unik);
  		mysql_query("UPDATE kategori SET nama_kategori 		='$_POST[nama_kategori]',
										 kategori_seo		='$kategori_seo',
										 kategori_induk		='$_POST[kategori_induk]', 
										 gambar_kat     	='$nama_file_unik'
										 WHERE id_kategori 	='$_POST[id]'");
		
  		header('location:../../media.php?module='.$module);
 
  }
}
?>
