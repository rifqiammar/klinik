<?php
include_once "library/inc.seslogin.php";

# Deklarasi variabel
$filterPeriode = ""; 
$tglAwal	= ""; 
$tglAkhir	= "";

# Membaca tanggal dari form, jika belum di-POST formnya, maka diisi dengan tanggal sekarang
$tglAwal 	= isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('m-Y');
$tglAkhir 	= isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-Y');

// Jika tombol filter tanggal (Tampilkan) diklik
if (isset($_POST['btnTampil'])) {
	// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
	$filterPeriode = "WHERE ( tgl_janji BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}
else {
	// Membaca data tanggal dari URL, saat menu Pages diklik
	$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
	$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
	
	// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
	$filterPeriode = "WHERE ( tgl_janji BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pendaftaran $filterPeriode";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<ul class="breadcrumb">
				<li>
					LAPORAN DATA PENDAFTARAN PER PERIODE JANJI
				</li>
</ul>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="779" border="0"  class="table-list">
    
    <tr>
      <td width="90"><strong>Periode </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="670">
	  <input name="txtTglAwal" type="text" class="tcal" value="<?php echo $tglAwal; ?>" /> s/d
      <input name="txtTglAkhir" type="text" class="tcal" value="<?php echo $tglAkhir; ?>" />
      <input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>

<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
  <tr>
    <th><strong>No</strong></th>
    <th><strong>No. Daftar </strong></th>
    <th><strong>Tgl. Daftar </strong></th>
    <th><strong>Nomor RM </strong></th>
    <th><strong>Nama Pasien </strong></th>
    <th><strong>Tgl. Janji </strong></th>
    <th><strong>Jam. Janji </strong></th>
    <th><strong>Tindakan</strong></th>
    <th><strong>Antri</strong></th>
  </tr>
</thead>
  <?php
	$mySql = "SELECT pendaftaran.*, pasien.nm_pasien, tindakan.nm_tindakan 
				FROM pendaftaran 
				LEFT JOIN pasien ON pendaftaran.nomor_rm = pasien.nomor_rm
				LEFT JOIN tindakan ON pendaftaran.kd_tindakan = tindakan.kd_tindakan
				$filterPeriode
				ORDER BY pendaftaran.no_daftar ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;		
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
