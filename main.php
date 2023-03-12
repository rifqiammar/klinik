<?php
if(isset($_SESSION['SES_ADMIN'])) {
	include "dasboardslider.php";
	exit;
}
else if(isset($_SESSION['SES_KLINIK'])) {
	include "dasboardslider.php";
	exit;
}
else if(isset($_SESSION['SES_APOTEK'])) {
	include "dasboardslider.php";
	exit;
}
else {
	echo "<h2>Selamat datang di Sistem Informasi Rawat Jalan dan Penjualan Obat!</h2>";
	echo "<b>Anda belum login, silahkan <a href='index.php' alt='Login'>login </a>untuk mengakses sitem ini ";	
}
?>