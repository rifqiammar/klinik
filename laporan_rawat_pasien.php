<?php
include_once "library/inc.seslogin.php";

// Variabel SQL
$filterSQL= "";

// Temporary Variabel form
$dataPasien	= isset($_POST['cmbPasien']) ? $_POST['cmbPasien'] : 'SEMUA';

# PENCARIAN DATA BERDASARKAN FILTER DATA
if(isset($_POST['btnTampil'])) {
	# PILIH pasien
	if (trim($_POST['cmbPasien']) =="KOSONG") {
		$filterSQL = "";
	}
	else {
		$filterSQL = "WHERE rawat.nomor_rm='$dataPasien'";
	}
}
else {
	$filterSQL= "";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM rawat $filterSQL";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<ul class="breadcrumb">
				<li>
					LAPORAN DATA RAWAT PER PASIEN
				</li>
</ul>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="500" border="0"  class="table-list">
    <tr>
      <td width="130"><strong>Nama Pasien </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="351">
	  <select name="cmbPasien">
        <option value="KOSONG">....</option>
        <?php
	  $dataSql = "SELECT * FROM pasien ORDER BY nomor_rm";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['nomor_rm'] == $dataPasien) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[nomor_rm]' $cek>[ $dataRow[nomor_rm] ]  $dataRow[nm_pasien]</option>";
	  }
	  ?>
      </select>
      <input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>

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
				$filterSQL
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
