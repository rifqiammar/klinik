<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pasien";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<ul class="breadcrumb">
				<li>
					Data Pasien
				</li>
			</ul>
<a href="?page=Pasien-Add" target="_self">ADD DATA</a>
	<table class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
      <tr>
        <th width="25" align="center"><strong>No</strong></th>
        <th width="70"><strong>No RM</strong></th>
        <th width="200"><strong>Nama Pasien </strong></th>
        <th width="95"><strong>Kelamin</strong></th>
        <th width="280"><strong>Alamat</strong></th>
        <th colspan="2" align="center"><strong>Tools</strong></th>
      </tr>
    </thead>
      <?php
	$mySql = "SELECT * FROM pasien ORDER BY nomor_rm ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['nomor_rm'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['nomor_rm']; ?></td>
        <td><?php echo $myData['nm_pasien']; ?></td>
        <td><?php echo $myData['jns_kelamin']; ?></td>
        <td><?php echo $myData['alamat']; ?></td>
        <td width="40" align="center"><a href="?page=Pasien-Edit&Kode=<?php echo $Kode; ?>" target="_self" class="halflings-icon edit" alt="Edit Data"></a></td>
        <td width="48" align="center"><a href="?page=Pasien-Delete&Kode=<?php echo $Kode; ?>" target="_self" class="halflings-icon trash" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PASIEN INI ... ?')"></a></td>
      </tr>
      <?php } ?>
    </table>
  <strong>Jumlah Data :</strong> <?php echo $jml; ?>
    <strong>Halaman ke :</strong> 
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Pasien-Data&hal=$list[$h]'>$h</a> ";
	}
	?>
