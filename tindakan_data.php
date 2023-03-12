<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM tindakan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<ul class="breadcrumb">
				<li>
					Data Tindakan
				</li>
				
			</ul>
            <a href="?page=Tindakan-Add" target="_self">ADD DATA</a>

	<table class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
      <tr>
        <th width="4%"><strong>No</strong></th>
        <th width="67%"><strong>Nama Tindakan </strong></th>
        <th width="15%" align="right"><strong>Harga (Rp.) </strong></th>
        <th colspan="2" align="center" ><strong>Tools</strong></th>
        </tr>
     </thead>
      <?php
	  // Menampilkan daftar tindakan
	$mySql = "SELECT * FROM tindakan ORDER BY kd_tindakan ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_tindakan'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['nm_tindakan']; ?></td>
        <td align="right"><?php echo format_angka($myData['harga']); ?></td>
        <td width="7%" align="center"><a href="?page=Tindakan-Edit&Kode=<?php echo $Kode; ?>" target="_self" class="halflings-icon edit"></a></td>
        <td width="7%" align="center"><a href="?page=Tindakan-Delete&Kode=<?php echo $Kode; ?>" target="_self"  class="halflings-icon trash" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA TINDAKAN KLINIK INI ... ?')"></a></td>
      </tr>
	<?php } ?>
     </table>
     </div></div>
 <strong>Jumlah Data :</strong> <?php echo $jml; ?> 
   <strong>Halaman ke :</strong> 
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Tindakan-Data&hal=$list[$h]'>$h</a> ";
	}
	?>

