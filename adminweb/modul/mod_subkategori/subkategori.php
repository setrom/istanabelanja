<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_subkategori/aksi_subkategori.php";
switch($_GET['act']){
  // Tampil Kategori
  default:
    echo "<h2>Kategori Produk</h2>
          <input type=button class='tombol' value='Tambah Kategori' 
          onclick=\"window.location.href='?module=subkategori&act=tambah';\">
          <table>
          <tr><th>No</th><th>Nama Kategori</th><th>Parent Kategori</th><th>Aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM subkat ORDER BY subkat_id DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[subkat_nama]</td>
			 <td>";
			 if($r['kategori_induk']=='0') {
				 echo "Kategori Induk"; }else{
				 $ambilkat = mysql_query("SELECT nama_kategori FROM kategori WHERE id_kategori=$r[id_kategori]");
				 $nakat = mysql_fetch_array($ambilkat);
				 echo $nakat['nama_kategori'];
				 }
			 echo "</td>
             <td><a href=?module=subkategori&act=edit&id=$r[subkat_id]><b>Edit</b></a> | 
	               <a href=$aksi?module=subkategori&act=hapus&id=$r[subkat_id]><b>Hapus</b></a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  // Form Tambah Kategori
  case "tambah":
    echo "<h2>Tambah Kategori</h2>
          <form method=POST enctype='multipart/form-data' action='$aksi?module=subkategori&act=input'>
          <table>
          <tr><td>Nama Kategori</td><td> : <input type=text name='subkat_nama'></td></tr>
		  <tr><td>Kategori Induk</td><td> : <select name='id_kategori'>
		  									<option value=0 selected>- Pilih Kategori Utama -</option>";
            								$tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori");
            								while($r=mysql_fetch_array($tampil)){
              									echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            								}
    										echo "</select>
		  </td></tr>
		  <tr><td>Gambar</td>      <td> : <input type=file name='fupload' size=40> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>
          <tr><td colspan=2><input type=submit name=submit class='tombol'  value=Simpan>
                            <input type=button class='tombol'  value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Kategori  
  case "edit":
    $edit=mysql_query("SELECT * FROM subkat WHERE subkat_id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Kategori</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=subkategori&act=update>
          <input type=hidden name=id value='$r[subkat_id]'>
          <table>
          <tr><td>Nama Kategori</td><td>  <input type=text name='subkat_nama' value='$r[subkat_nama]'></td></tr>
		  <tr><td>Kategori Utama</td>  <td>  <select name='id_kategori'>";
 
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori");
          if ($r[id_kategori]==0){
            echo "<option value=0 selected>- Pilih Kategori Utama -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
    echo "</select></td></tr>
	<tr><td style='height: 350px;'>Keterangan</td><td><textarea name='subkat_ket' id='loko' style='width: 200px; height: 250px; '>$r[subkat_ket]</textarea> </td></tr>
	<tr><td>Gambar</td>       <td>   ";
          if ($r[subkat_gambar]!=''){
              echo "<img src='../foto_kategori/small_$r[subkat_gambar]'>";  
          }
    echo "</td></tr>
          <tr><td>Ganti Gbr</td>    <td>  <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
