<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">         <span class="sr-only">Toggle navigation</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
</button>
  <a class="navbar-brand" href="home"> SISTEM INFORMASI PENAMPIL PENGISI SURVEY (SIPPS)</a>
  </div>
<div id="navbar" class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right visible-xs visible-sm">
<li id="output_m"></li>
<?php
	if (isset($_SESSION['pb'])) {
   			$link=array("","absen","req_catatan","catatan", "katasandi&id=$_SESSION[id]","keluar");
			$name=array("","Daftar Survey","Konfirmasi Kritik dan Saran","Lihat Kritik dan Saran","Ubah Katasandi","Keluar");

			for ($i=1; $i <= count($link)-1 ; $i++) {
				echo "<li><a href='$link[$i]'>$name[$i]</a></li>";
			}
   		} elseif (isset($_SESSION['sw'])) {
			$link=array("","absen","tambah_catatan","catatan","keluar");
			$name=array("","Daftar Survey","Tambah Kritik dan Saran","Riwayat Kritik dan Saran","Keluar");
			
			for ($i=1; $i <= count($link)-1 ; $i++) {
				
				echo "<li><a href='$link[$i]'>$name[$i]</a></li>";
			}
   		}
 ?>
</ul>
</div>