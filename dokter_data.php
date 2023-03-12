
<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM dokter";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<ul class="breadcrumb">
				<li>
					Data Dokter
				</li>
			</ul>
<a href="?page=Dokter-Add" target="_self">ADD DATA</a>
	<table class="table table-bordered table-striped table-condensed">
    <thead>
      <tr>
        <th width="24" align="center"><strong>No</strong></th>
        <th width="189"><strong>Nama Dokter </strong></th>
        <th width="110"><strong>Spesialis</strong></th>
        <th width="115"><strong>No. Telepon </strong></th>
        <th width="215"><strong>Alamat </strong></th>
        <th colspan="2" align="center" ><strong>Tools</strong></th>
      </tr>
     </thead>
      <?php
	$mySql = "SELECT * FROM dokter ORDER BY kd_dokter ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_dokter'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['nm_dokter']; ?></td>
        <td><?php echo $myData['spesialisasi']; ?></td>
        <td><?php echo $myData['no_telepon']; ?></td>
        <td><?php echo $myData['alamat']; ?></td>
        <td width="45" align="center"><a href="?page=Dokter-Edit&Kode=<?php echo $Kode; ?>" target="_self" class="halflings-icon edit"></a></td>
        <td width="50" align="center"><a href="?page=Dokter-Delete&Kode=<?php echo $Kode; ?>" target="_self" class="halflings-icon trash" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA DOKTER INI ... ?')"></a></td>
      </tr>
      <?php } ?>
    </table>
  </div></div>
    <strong>Jumlah Data :</strong> <?php echo $jml; ?></td>
    <strong>Halaman ke :</strong>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Dokter-Data&hal=$list[$h]'>$h</a> ";
	}
	?>
