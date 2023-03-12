<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pendaftaran";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<ul class="breadcrumb">
				<li>
					LAPORAN DATA PENDAFTARAN
				</li>
</ul>
<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
  <tr>
    <th><strong>No</strong></th>
    <th><strong>No. Daftar </strong></th>
    <th><strong>Tgl. Daftar </strong></th>
    <th><strong>Nomor RM </strong></th>
    <th><strong>Nama Pasien  </strong></th>
    <th><strong>Tgl. Janji </strong></th>
    <th><strong>Jam. Janji </strong></th>
    <th><strong>Tindakan</strong></th>
    <th><strong>Antri</strong></th>
  </tr>
</thead>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi pendaftaran
	$mySql = "SELECT pendaftaran.*, pasien.nm_pasien, tindakan.nm_tindakan 
				FROM pendaftaran 
				LEFT JOIN pasien ON pendaftaran.nomor_rm = pasien.nomor_rm
				LEFT JOIN tindakan ON pendaftaran.kd_tindakan = tindakan.kd_tindakan
				ORDER BY pendaftaran.no_daftar ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;		
		
	# Membaca Kode pendaftaran/ Nomor transaksi
	$noDaftar = $myData['no_daftar']; 
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['no_daftar']; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_daftar']); ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_janji']); ?></td>
    <td><?php echo $myData['jam_janji']; ?></td>
    <td><?php echo $myData['nm_tindakan']; ?></td>
    <td align="center"><?php echo $myData['nomor_antri']; ?></td>
  </tr>
  <?php } ?>
  
</table>
