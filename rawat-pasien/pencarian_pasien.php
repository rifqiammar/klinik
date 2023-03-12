<?php
include_once "library/inc.seslogin.php";

// Membaca variabel form
$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
$dataCari	= isset($_POST['txtCari']) ? $_POST['txtCari'] : $KeyWord;

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		$filterSql = "WHERE nm_pasien LIKE '%$dataCari%'";
	}
}
else {
	if($KeyWord){
		$filterSql = "WHERE nm_pasien LIKE '%$dataCari%'";
	}
	else {
		$filterSql = "";
	}
} 

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pasien $filterSql";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<ul class="breadcrumb">
				<li>
					Cari Pasien
				</li>
			</ul>
            
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <strong>Cari Nama Pasien :</strong>
  <input name="txtCari" type="text" value="<?php echo $dataCari; ?>" size="40" maxlength="100" />
  <input name="btnCari" type="submit" value="Cari" />
</form>
<table class="table table-bordered table-striped table-condensed">
<thead>
  <tr>
    <th>No</th>
    <th ><strong>Nomor RM </strong></th>
    <th><strong>Nama Pasien </strong></th>
    <th ><strong>Kelamin</strong></th>
    <th ><strong>Gol. Darah </strong></th>
    <th ><strong>Alamat</strong></th>
    <th><strong>Tools</strong></th>
  </tr>
</thead>
<?php
$mySql = "SELECT * FROM pasien $filterSql ORDER BY nomor_rm ASC LIMIT $hal, $row";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$nomor = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td><?php echo $myData['jns_kelamin']; ?></td>
    <td><?php echo $myData['gol_darah']; ?></td>
    <td><?php echo $myData['alamat']; ?></td>
    <td><a href="?page=Rawat-Baru&NomorRM=<?php echo $myData['nomor_rm']; ?>" target="_self" alt="Rawat">Rawat</a></td>
  </tr>
<?php } ?>  
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong><?php echo $jml; ?> </td>
    <td colspan="4" align="right"><strong>Halaman ke : </strong>
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Pencarian-Pasien&hal=$list[$h]&KeyWord=$dataCari'>$h</a> ";
	}
	?></td>
  </tr>
</table>
