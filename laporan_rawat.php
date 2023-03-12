<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM rawat";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<ul class="breadcrumb">
				<li>
					LAPORAN DATA RAWAT PASIEN
				</li>
</ul>

<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
  <tr>
    <th><strong>No</strong></th>
    <th><strong>No. Rawat </strong></th>
    <th><strong>Tgl. Rawat </strong></th>
    <th><strong>Nomor RM </strong></th>
    <th><strong>Nama Pasien  </strong></th>
    <th><strong> Bayar (Rp) </strong></th>
    <th><strong>Hasil Diagnosa </strong></th>
    <th><strong>Tools</strong></th>
  </tr>
  </thead>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi rawat
	$mySql = "SELECT rawat.*, pasien.nm_pasien FROM rawat 
				LEFT JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				ORDER BY rawat.no_rawat ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;		
		
	# Membaca Nomor Rawat
	$noRawat = $myData['no_rawat']; 
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['no_rawat']; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_rawat']); ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td align="right"><?php echo format_angka($myData['uang_bayar']); ?></td>
    <td><?php echo $myData['hasil_diagnosa']; ?></td>
    <td align="center"><a href="cetak/rawat_cetak.php?noRawat=<?php echo $noRawat; ?>" target="_blank" class="halflings-icon print"></a></td>
  </tr>
  <?php } ?>
  
</table>
