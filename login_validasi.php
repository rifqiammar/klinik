<?php 
if(isset($_POST['btnLogin'])){
	$pesanError = array();
	if ( trim($_POST['txtUser'])=="") {
		$pesanError[] = "Data <b> Username </b>  tidak boleh kosong !";		
	}
	if (trim($_POST['txtPassword'])=="") {
		$pesanError[] = "Data <b> Password </b> tidak boleh kosong !";		
	}
	if (trim($_POST['cmbLevel'])=="KOSONG") {
		$pesanError[] = "Data <b>Level</b> belum dipilih !";		
	}
	
	# Baca variabel form
	$txtUser 	= $_POST['txtUser'];
	$txtUser 	= str_replace("'","&acute;",$txtUser);
	
	$txtPassword=$_POST['txtPassword'];
	$txtPassword= str_replace("'","&acute;",$txtPassword);
	
	$cmbLevel	=$_POST['cmbLevel'];
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
		
		// Tampilkan lagi form login
		include "login.php";
	}
	else {
		# LOGIN CEK KE TABEL USER LOGIN
		$mySql = "SELECT * FROM petugas WHERE username='".$txtUser."' AND password='".md5($txtPassword)."' AND level='$cmbLevel'";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Query Salah : ".mysql_error());
		$myData= mysql_fetch_array($myQry);
		
		# JIKA LOGIN SUKSES
		if(mysql_num_rows($myQry) >=1) {
			$_SESSION['SES_LOGIN'] = $myData['kd_petugas']; 
			$_SESSION['SES_USER'] = $myData['username']; 
			
			// Jika yang login Administrator
			if($cmbLevel=="Admin") {
				$_SESSION['SES_ADMIN'] = "Admin";
			}
			
			// Jika yang login Klinik
			if($cmbLevel=="Klinik") {
				$_SESSION['SES_KLINIK'] = "Klinik";
			}
			
			// Jika yang login Apotek
			if($cmbLevel=="Apotek") {
				$_SESSION['SES_APOTEK'] = "Apotek";
			}
			
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=?page=Halaman-Utama'>";
		}
		else {
			 echo "Login Anda bukan Level ".$_POST['cmbLevel'];
		}
	}
} // End POST
?>
 
