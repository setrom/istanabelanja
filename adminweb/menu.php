<?php
include "../config/koneksi.php";

if ($_SESSION[leveluser]=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
}

if ($m=mysql_fetch_array($sql)){  
echo "<li><a href='?module=menuutama'><b>Menu Utama</b></a></li>";
echo "<li><a href='?module=submenu'><b>Sub Menu</b></a></li>";
echo "<li><a href='?module=profil'><b>Profil</b></a></li>"; 
echo "<li><a href='?module=welcome'><b>Selamat Datang</b></a></li>"; 
echo "<li><a href='?module=carabeli'><b>Cara Pembelian</b></a></li>"; 
echo "<li><b>Kategori</b></li>"; 
echo "<ul>
		<li><a href='?module=kategori'><b>Kategori Utama</b></a></li>
		<li><a href='?module=subkategori'><b>Kategori Produk</b></a></li></ul>
	 </li>";
echo "<li><a href='?module=merk'><b>Merk</b></a></li>"; 
echo "<li><a href='?module=produk'><b>Produk</b></a></li>"; 
echo "<li><a href='?module=order'><b>Order Masuk</b></a></li>"; 
echo "<li><a href='?module=hubungi'><b>Pesan Masuk</b></a></li>"; 
echo "<li><a href='?module=ongkoskirim'><b>Ongkos Kirim</b></a></li>"; 
echo "<li><a href='?module=jasapengiriman'><b>Jasa Pengiriman</b></a></li>"; 
echo "<li><a href='?module=laporan'><b>Laporan Transaksi</b></a></li>";   
}
?>
