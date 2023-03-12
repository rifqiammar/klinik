<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM rawat";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<div class="row-fluid">
	<div class="span12">
<ul class="breadcrumb">
				<li>
					Data Rawat Pasien
				</li>
			</ul>
            <a href="?page=Rawat-Baru">ADD RAWAT PASIEN</a>
	<table class="table table-striped table-bordered bootstrap-datatable datatable">
    <thead>
      <tr>
        <th width="29" align="center"><strong>No</strong></th>
        <th width="102"><strong>No. Rawat </strong></th>
        <th width="103"><strong>Tgl. Rawat </strong></th>
        <th width="133"><strong>Nomor RM  </strong></th>
        <th width="291"><strong>Nama Pasien </strong></th>
        <th width="291"><strong>Hasil Diagnosa </strong></th>
        <th colspan="2" align="center" ><strong>Tools</strong></th>
      </tr>
      </thead>
      <?php
	$mySql = "SELECT rawat.*, pasien.nm_pasien
				FROM rawat 
				LEFT JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				ORDER BY rawat.no_rawat DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['no_rawat'];
	?>
      <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['no_rawat']; ?></td>
        <td><?php echo IndonesiaTgl($myData['tgl_rawat']); ?></td>
        <td><?php echo $myData['nomor_rm']; ?></td>
        <td><?php echo $myData['nm_pasien']; ?></td>
        <td><?php echo $myData['hasil_diagnosa']; ?></td>
        <td width="45" align="center"><a href="rawat-pasien/rawat_nota.php?nomorRawat=<?php echo $Kode; ?>" target="_blank" class="halflings-icon print"></a></td>
        <td width="45" align="center"><a href="?page=Rawat-Hapus&Kode=<?php echo $Kode; ?>" target="_self" class="halflings-icon trash" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA RAWAT INI ... ?')"></a></td>
      </tr>
      <?php } ?>
    </table>
    </div></div>
    <b>Jumlah Data :</b><b>Halaman ke :</b>
      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Rawat-Tampil&hal=$list[$h]'>$h</a> ";
	}
	?>
