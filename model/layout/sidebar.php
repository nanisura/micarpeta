<ul class="nav nav-sidebar">
<li id="output"></li>
   <?php
   		if (isset($_SESSION['pb'])) {
			$link=array("","absen","req_catatan","catatan", "katasandi&id=$_SESSION[id]","keluar");
			$name=array("","Daftar Survey","Konfirmasi Kritik dan Saran","Lihat Kritik dan Saran","Ubah Katasandi","Keluar");

			for ($i=1; $i <= count($link)-1 ; $i++) {
				if (strcmp($page, "$link[$i]")==0) {
			        $status = "class='active'";
			      } else {
			      	$status = "";
			      }
			    /*if (mysql_num_rows($query_tday)==0 && $link[$i]==="absen") {
					$warning = "<img src='./lib/img/warning.png' width='20' />";
				} else {
					$warning = "";
				} */
				echo "<li $status><a href='$link[$i]'>$name[$i]</a></li>";
			}
   		} elseif (isset($_SESSION['sw'])) {
   			$this_day = date("d");
			$sql = "SELECT*FROM data_absen NATURAL LEFT JOIN tanggal WHERE nama_tgl='$this_day' AND id_user='$_SESSION[id]'";
			$query = $conn->query($sql);

			$query_tday = $query->fetch_assoc();


			$link=array("","absen","tambah_catatan","catatan","keluar");
			$name=array("","Daftar Survey","Tambah Kritik dan Saran","Riwayat Kritik dan Saran","Keluar");
			
			for ($i=1; $i <= count($link)-1 ; $i++) {
				if (strcmp($page, "$link[$i]")==0) {
			        $status = "class='active'";
			      } else {
			      	$status = "";
			      }
			    if ($query->num_rows==0 && $link[$i]==="absen") {
				
				} else {
					$warning = "";
				}
				echo "<li $status><a href='$link[$i]'>$name[$i] </a></li>";
			}
   		}
	?>
</ul>