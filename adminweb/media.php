<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>


 <center><br><br><br><br><br><br>Maaf, untuk masuk <b>Halaman Administrator</b><br>
  <center>anda harus <b>Login</b> dahulu!<br><br>";
 echo "<div> <a href='index.php'><img src='images/kunci.png'  height=176 width=143></a>
             </div>";
  echo "<input type=button class=simplebtn value='LOGIN DI SINI' onclick=location.href='index.php'></a></center>";
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta name="robots" content="ALL,FOLLOW"/>
<meta name="Author" content="Rizal Faizal"/>
<meta http-equiv="imagetoolbar" content="no"/>
<title>.::Halaman Administrator::.</title>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<link rel="stylesheet" href="css/reset.css" type="text/css"/>
<link rel="stylesheet" href="css/screen.css" type="text/css"/>
<link rel="stylesheet" href="css/fancybox.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.ui.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize-light.css" type="text/css"/>
	

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.visualize.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/jquery.idtabs.js"></script>
<script type="text/javascript" src="js/jquery.datatables.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.js"></script>
<script type="text/javascript" src="js/jquery.ui.js"></script>

<script type="text/javascript" src="js/excanvas.js"></script>
<script type="text/javascript" src="js/cufon.js"></script>
<script type="text/javascript" src="js/Geometr231_Hv_BT_400.font.js"></script>

<script src="../tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
<script src="../tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>

<style type="text/css">
<!--
.style3 {
	color: #62A621;
	font-weight: bold;
}
-->
</style>
</head>

<body>
	
	<div class="sidebar">
		<div class="logo clear"><img src="images/logo.png" alt="" width="185" height="80" /></div>
		
		<div class="menu">
		  <ul><li><a href="#">MENU UTAMA</a>
			  <ul>
				  <?php include "menu.php"; ?>
			  </ul>
			</li>
			  <li><a href="#">MODUL WEB </a>
			    <ul>
				  <?php include "menu2.php"; ?>
				</ul>
			</li>
				  <li><a href="#">MANAJEMEN ADMIN</a>
				  <ul>
					<?php include "menu3.php"; ?>
				</ul>
			</li>
			</ul>
	  </div>
	</div>
	
	
	<div class="main"> <!-- *** mainpage layout *** -->
	<div class="main-wrap">
		<div class="header clear">
			<ul class="links clear">
			<li>:::: <strong>Selamat Datang <?=$_SESSION[namalengkap]?></strong>&nbsp;::::&nbsp;</li>
			<li><a href="?module=home"><img src="images/home.png" alt="" class="icon" /> <span class="text">Beranda</span></a></li>
			<li><a href="../" target="_new"><img src="images/ico_view_24.png" alt="" class="icon" /> <span class="text">Lihat Website</span></li>
			
			<li><a href="logout.php"><img src="images/ico_logout_24.png" alt="" class="icon" /> <span class="text">Keluar</span></a></li>
			</ul>
		</div>
		
		<div class="page clear">			
			<!-- MODAL WINDOW -->
			<div id="modal" class="modal-window">
				<!-- <div class="modal-head clear"><a onclick="$.fancybox.close();" href="javascript:;" class="close-modal">Close</a></div> -->
				
				
			</div>
			
			<!-- CONTENT BOXES -->
			<!-- end of content-box -->
<div class="notification note-success">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="2%">&nbsp;</td>
      <td width="95%"><?php include "content.php"; ?></td>
      <td width="3%">&nbsp;</td>
    </tr>
  </table>
</div>
			<div class="clear">
				<!-- end of content-box -->
			
		</div><!-- end of page -->
		
		<div class="footer clear"></div>
	</div>
	</div>
</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-12958851-7']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>

<meta http-equiv="content-type" content="text/html;charset=UTF-8">
</html>
<?php
}
?>