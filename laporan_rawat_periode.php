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
	$filterPeriode = "WHERE ( tgl_rawat BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}
else {
	// Membaca data tanggal dari URL, saat menu Pages diklik
	$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
	$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
	
	// Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
	$filterPeriode = "WHERE ( tgl_rawat BETWEEN '".InggrisTgl($tglAwal)."' AND '".InggrisTgl($tglAkhir)."')";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM rawat $filterPeriode";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<ul class="breadcrumb">
				<li>
					LAPORAN DATA RAWAT PASIEN PER PERIODE
				</li>
</ul>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="790" border="0"  class="table-list">
    <tr>
      <td width="90"><strong>Periode </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="681"><input name="txtTglAwal" type="text" class="tcal" value="<?php echo $tglAwal; ?>" />
        s/d
      <input name="txtTglAkhir" type="text" class="tcal" value="<?php echo $tglAkhir; ?>" />
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
	# Perintah untuk menampilkan data Rawat dengan filter Periode
	$mySql = "SELECT rawat.*, pasien.nm_pasien FROM rawat 
				LEFT JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				$filterPeriode
				ORDER BY rawat.no_rawat ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;		
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['no_rawat']; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_rawat']); ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td align="right"><?php echo format_angka($myData['uang_bayar']); ?></td>
    <td><?php echo $myData['hasil_diagnosa']; ?></td>
    <td align="center"><a href="cetak/rawat_cetak.php?noRawat=<?php echo $myData['no_rawat']; ?>" target="_blank">Cetak</a></td>
  </tr>
  <?php } ?>
  
</table>
