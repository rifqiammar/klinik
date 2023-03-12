<?php
if(isset($_SESSION['SES_ADMIN'])){
# JIKA YANG LOGIN LEVEL ADMIN, menu di bawah yang dijalankan
?>
<ul class="nav nav-tabs nav-stacked main-menu">
	<li><a href='?page' title='Halaman Utama'>Home</a></li>
   <li><a href="#" class="dropmenu"><i class=""></i><span class=""> Master Data</span><b class=""></b></a>
			<ul class="submenu" >
		<li><a href='?page=Tindakan-Data' title='Tindakan'>Data Tindakan</a></li>
		<li><a href='?page=Petugas-Data' title='Petugas'>Data Petugas</a></li>
		<li><a href='?page=Dokter-Data' title='Dokter' target="_self">Data Dokter</a></li>
		<li><a href='?page=Obat-Data' title='Obat'>Data Obat</a></li>
		<li><a href='?page=Pasien-Data' title='Pasien'>Data Pasien</a> </li>
	</ul></li>
     <li><a href="#" class="dropmenu"><i class=""></i><span class=""> Transaksi Data</span><b class=""></b></a>
			<ul class="submenu" >
		<li><a href='?page=Pendaftaran' title='Pendaftaran Pasien'>Pendaftaran Pasien</a> </li>
		<li><a href='?page=Rawat-Baru' title='Rawat Pasien'>Rawat Jalan Pasien</a> </li>
		<li><a href='?page=Penjualan-Baru' title='Penjualan Apotek'>Penjualan Apotek</a> </li>
      </ul></li>
         <li><a href="#" class="dropmenu"><i class=""></i><span class="">Laporan Master Data</span><b class=""></b></a>
    		<ul class="submenu">
            <li><a href="?page=Laporan-Petugas">Data Petugas</a></li>
			<li><a href="?page=Laporan-Tindakan">Data Tindakan</a></li>
			<li><a href="?page=Laporan-Obat">Data Obat</a></li>
			<li><a href="?page=Laporan-Dokter">Data Dokter</a></li>
			<li><a href="?page=Laporan-Pasien">Data Pasien</a></li>
            </ul></li>
             <li><a href="#" class="dropmenu"><i class=""></i><span class=""> Laporan Transaksi Data</span><b class=""></b></a>
			<ul class="submenu" >
			<li><a href="?page=Laporan-Pendaftaran">Pendaftaran</a></li>
			<li><a href="?page=Laporan-Pendaftaran-Periode">Pendaftaran per Periode</a></li>
			<li><a href="?page=Laporan-Rawat">Rawat Pasien</a></li>
			<li><a href="?page=Laporan-Rawat-Periode">Rawat Pasien per Periode</a></li>
			<li><a href="?page=Laporan-Rawat-Pasien">Rawat Pasien per Pasien</a></li>
			<li><a href="?page=Laporan-Penjualan">Penjualan Obat</a></li>
			<li><a href="?page=Laporan-Penjualan-Periode">Penjualan Obat per Periode</a></li>
            </ul></li>
</ul>
<?php
}
elseif(isset($_SESSION['SES_KLINIK'])){
# JIKA YANG LOGIN LEVEL PETUGAS JAGA KLINIK, menu di bawah yang dijalankan
?>
<ul class="nav nav-tabs nav-stacked main-menu">
	<li><a href='?page' title='Halaman Utama'>Home</a></li>
	<li><a href='?page=Pendaftaran' title='Pendaftaran Pasien'>Pendaftaran Pasien</a> </li>
	<li><a href='?page=Rawat-Baru' title='Rawat Pasien'>Rawat Jalan Pasien</a> </li>
	<li><a href='?page=Logout' title='Logout (Exit)'>Logout</a></li>
</ul>
<?php
}
elseif(isset($_SESSION['SES_APOTEK'])){
# JIKA YANG LOGIN LEVEL KASIR APOTEK, menu di bawah yang dijalankan
?>
<ul class="nav nav-tabs nav-stacked main-menu">
	<li><a href='?page' title='Halaman Utama'>Home</a></li>
	<li><a href='?page=Penjualan-Baru' title='Penjualan Apotek'>Penjualan Apotek</a> </li>
	<li><a href='?page=Logout' title='Logout (Exit)'>Logout</a></li>
</ul>
<?php
}
else {
# JIKA BELUM LOGIN (BELUM ADA SESION LEVEL YG DIBACA)
?>
<ul class="nav nav-tabs nav-stacked main-menu">
	<li><a href='index.php' title='Login System'>Login</a></li>	
</ul>
<?php
}
?>