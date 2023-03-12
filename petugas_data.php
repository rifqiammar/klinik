<div class="row-fluid">
	<div class="span12">
<ul class="breadcrumb">
				<li>
					Data Petugas
				</li>
			</ul>
<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM petugas";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<a href="?page=Petugas-Add" target="_self">ADD DATA</a>
<table class="table table-bordered table-striped table-condensed">
 <thead>
      <tr>
        <th width="24"><b>No</b></th>
        <th width="231"><b>Nama Petugas </b></th>
        <th width="145"><b>No. Telepon </b></th>
        <th width="170"><b>Username</b></th>
        <th width="102"><b>Level</b></th>
        <th colspan="2" align="center"><b>Tools</b></th>
        </tr>
</thead>
      <?php
	$mySql 	= "SELECT * FROM petugas ORDER BY kd_petugas ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_petugas'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['nm_petugas']; ?></td>
        <td><?php echo $myData['no_telepon']; ?></td>
        <td><?php echo $myData['username']; ?></td>
        <td><?php echo $myData['level']; ?></td>
        <td width="41" align="center"><a href="?page=Petugas-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data" class="halflings-icon edit"></a></td>
        <td width="45" align="center"><a href="?page=Petugas-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" class="halflings-icon trash" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?')"></a></td>
      </tr>
      <?php } ?>
    </table>
  
    <b>Jumlah Data :</b> <?php echo $jml; ?>
    <b>Halaman ke :</b> 
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Petugas-Data&hal=$list[$h]'>$h</a> ";
	}
	?>