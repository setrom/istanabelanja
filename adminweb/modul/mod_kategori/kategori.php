<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<h2>Kategori Produk</h2>
          <input type=button class='tombol' value='Tambah Kategori' 
          onclick=\"window.location.href='?module=kategori&act=tambahkategori';\">
          <table>
          <tr><th>No</th><th>Nama Kategori</th><th>Parent Kategori</th><th>Aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_kategori]</td>
			 <td>";
			 if($r['kategori_induk']=='0') {
				 echo "Kategori Induk"; }else{
				 $ambilkat = mysql_query("SELECT nama_kategori FROM kategori WHERE id_kategori=$r[kategori_induk]");
				 $nakat = mysql_fetch_array($ambilkat);
				 echo $nakat['nama_kategori'];
				 }
			 echo "</td>
             <td><a href=?module=kategori&act=editkategori&id=$r[id_kategori]><b>Edit</b></a> | 
	               <a href=$aksi?module=kategori&act=hapus&id=$r[id_kategori]><b>Hapus</b></a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  // Form Tambah Kategori
  case "tambahkategori":
    echo "<h2>Tambah Kategori</h2>
          <form method=POST enctype='multipart/form-data' action='$aksi?module=kategori&act=input'>
          <table>
          <tr><td>Nama Kategori</td><td> : <input type=text name='nama_kategori'></td></tr>
		  <tr><td>Kategori Induk</td><td> : <select name='kategori_induk'>
		  									<option value=0 selected>- Pilih Kategori Utama -</option>";
            								$tampil=mysql_query("SELECT * FROM kategori WHERE kategori_induk='0' ORDER BY id_kategori");
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
  case "editkategori":
    $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Kategori</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=kategori&act=update>
          <input type=hidden name=id value='$r[id_kategori]'>
          <table>
          <tr><td>Nama Kategori</td><td> : <input type=text name='nama_kategori' value='$r[nama_kategori]'></td></tr>
		  <tr><td>Kategori Utama</td>  <td> : <select name='kategori_induk'>";
 
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori");
          if ($r[kategori_induk]==0){
            echo "<option value=0 selected>- Pilih Kategori Utama -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[kategori_induk]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
    echo "</select></td></tr>
	<tr><td>Gambar</td>       <td> :  ";
          if ($r[gambar_kat]!=''){
              echo "<img src='../foto_kategori/small_$r[gambar_kat]'>";  
          }
    echo "</td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit class='tombol' value=Update>
                            <input type=button class='tombol' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
