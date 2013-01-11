<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

?>

<script language="javascript">
function validasi(form){
  if (form.nama_perusahaan.value == ""){
    alert("Anda belum mengisikan nama kategori produknya.");
    form.nama_kategori.focus();
    return (false);
  }
   return (true);
}
</script>

<?php

$aksi="modul/mod_merk/aksi_merk.php";
$module=$_GET['module'];

switch($_GET['act']){
  // Tampil Kategori
  default:
    echo "<h2>Merk</h2>
          <input type=button class='tombol' value='Tambah Merk' 
          onclick=\"window.location.href='?module=$module&act=tambah';\">";
    // Cek jikalau data dalam database kosong
    // Jika kosong
    $tampil2 = mysql_query("SELECT * FROM merk");
    $r2=mysql_fetch_array($tampil2);
    if($r2['merk_id']==0){
		echo"";
		
    }else{
            // Jika tidak kosong
            
              echo"<table>
              <tr><th>No</th><th>Nama Merk</th><th>Aksi</th></tr>"; 
        $tampil=mysql_query("SELECT * FROM merk ORDER BY merk_id DESC");
        $no=1;
        while ($r=mysql_fetch_array($tampil)){
            
            // Kolom Warna
            if(($no%2)==0){
            $warna="ganjil";
            }else{
            $warna="genap";
            }
            // Kolom Warna
            
           echo "<tr class='$warna'><td>$no</td>
                 <td>$r[merk_nama]</td>
                 <td><a href=?module=$module&act=edit&id=$r[merk_id]><b>Edit</b></a> | 
    	               <a href=$aksi?module=$module&act=hapus&id=$r[merk_id]&namafile=$r[gambar]><b>Hapus</b></a>
                 </td></tr>";
          $no++;
        }
        echo "</table>";
    }
    break;
  
  // Form Tambah Perusahaan Pengiriman
  case "tambah":
    echo "<h2>Tambah Merk</h2>
          <form method=POST action='$aksi?module=$module&act=input' enctype='multipart/form-data' onSubmit=\"return validasi(this)\">
          <table>
          <tr><td>Nama Merk</td><td> : <input type=text name='merk_nama'></td></tr>
		  <tr><td>Keterangan Merk</td>  <td> <textarea name='merk_ket'  id='loko' style='width: 600px; height: 350px;'></textarea></td></tr>
		  <tr><td>Logo</td>      <td> : <input type=file name='fupload' size=40> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>
          <tr><td colspan=2><input type=submit class='tombol' name=submit value=Simpan>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Perusahaan Pengiriman  
  case "edit":
    $edit=mysql_query("SELECT * FROM merk WHERE merk_id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Merk</h2>
          <form method=POST action=$aksi?module=$module&act=update enctype='multipart/form-data' onSubmit=\"return validasi(this)\">
          <input type=hidden name=id value='$r[merk_id]'>
          <table>
          <tr><td>Nama Merk</td><td> : <input type=text name='merk_nama' value='$r[merk_nama]'></td></tr>
          <tr><td style='height: 350px;'>Keterangan MErk</td><td><textarea name='merk_ket' id='loko' style='width: 200px; height: 250px; '>$r[merk_ket]</textarea> </td></tr>
	<tr><td>Logo</td>       <td>   ";
          if ($r['merk_logo']!=''){
              echo "<img src='../images/merk/small_$r[merk_logo]'>";  
          }
    echo "</td></tr>
          <tr><td>Ganti Logo</td>    <td>  <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila logo tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}

}
?>
