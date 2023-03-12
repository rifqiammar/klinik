<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pasien";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		// Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
		$txtKataKunci	= $_POST['txtKataKunci'];
		$mySql = "SELECT * FROM pasien WHERE nomor_rm='$txtKataKunci' OR nm_pasien LIKE '%$txtKataKunci%' 
				  ORDER BY nomor_rm ASC LIMIT $hal, $row";
	}
}
else {
	$mySql = "SELECT * FROM pasien ORDER BY nomor_rm ASC LIMIT $hal, $row";
} 

// Membaca variabel form
$dataKataKunci	= isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';
?>

<ul class="breadcrumb">
				<li>
					LAPORAN DATA PASIEN
				</li>
				
</ul>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table  class="table-list" width="500" border="0" cellspacing="1" cellpadding="4">
    <tr>
      <td width="139"><strong>Nomor RM / Nama </strong></td>
      <td width="1"><strong>:</strong></td>
      <td width="332"><b>
        <input name="txtKataKunci" type="text" value="<?php echo $dataKataKunci; ?>" size="40" maxlength="100" />
        <input name="btnCari" type="submit" value="Cari" />
      </b></td>
    </tr>
  </table>
</form>
<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
  <tr>
    <th><strong>No</strong></th>
    <th><strong>No. RM </strong></th>
    <th><strong>Nama Pasien </strong></th>
    <th><strong>No. Identitas </strong></th>
    <th><strong>Kelamin</strong></th>
    <th><strong>G Darah </strong></th>
    <th><strong>Tempat, Tgl Lahir </strong></th>
    <th><strong>Tools</strong></th>
  </tr>
</thead>
  <?php
	// Query SQL ada di bagian atas, kolom tombol Cari (btnCari)
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td><?php echo $myData['no_identitas']; ?></td>
    <td><?php echo $myData['jns_kelamin']; ?></td>
    <td><?php echo $myData['gol_darah']; ?></td>
    <td><?php echo $myData['tempat_lahir']; ?>, 
    <?php echo IndonesiaTgl($myData['tanggal_lahir']); ?></td>
    <td><a href="cetak/pasien_cetak.php?NomorRM=<?php echo $myData['nomor_rm']; ?>" target="_blank" class="halflings-icon print"></a></td>
  </tr>
  <?php } ?>
  
</table>
