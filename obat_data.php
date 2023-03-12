<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM obat";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<ul class="breadcrumb">
				<li>
					Data Obat
				</li>
			</ul>
<a href="?page=Obat-Add" target="_self">ADD DATA</a>
	<table class="table table-bordered table-striped table-condensed">
    <thead>
      <tr>
        <th width="23" align="center"><strong>No</strong></th>
        <th width="60"><strong>Kode</strong></th>
        <th width="242"><strong>Nama Obat</strong></th>
        <th width="48" align="center"><strong>Stok</strong></th>
        <th width="98" align="right"><strong>Harga (Rp)</strong></th>
        <th width="193"><strong>Keterangan</strong></th>
        <th colspan="2" align="center" ><strong>Tools</strong></th>
      </tr>
    </thead>
	<?php
	$mySql = "SELECT * FROM obat ORDER BY kd_obat ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_obat'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['kd_obat']; ?></td>
        <td><?php echo $myData['nm_obat']; ?></td>
        <td align="center"><?php echo $myData['stok']; ?></td>
        <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
        <td><?php echo $myData['keterangan']; ?></td>
        <td width="45" align="center"><a href="?page=Obat-Edit&amp;Kode=<?php echo $Kode; ?>" target="_self" class="halflings-icon edit" alt="Edit Data"></a></td>
        <td width="44" align="center"><a href="?page=Obat-Delete&amp;Kode=<?php echo $Kode; ?>" target="_self" class="halflings-icon trash" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA OBAT INI ... ?')"></a></td>
      </tr>
      <?php } ?>
    </table>
    </div></div>
 <strong>Jumlah Data :</strong> <?php echo $jml; ?>
    
	<strong>Halaman ke :</strong> 
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Obat-Data&hal=$list[$h]'>$h</a> ";
	}
	?>