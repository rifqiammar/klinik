<ul class="breadcrumb">
				<li>
					LAPORAN DATA DOKTER
				</li>
				
			</ul>
<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
  <tr>
    <th><strong>No</strong></th>
    <th><strong>Kode</strong></th>
    <th><strong>Nama Dokter </strong></th>
    <th><strong>Spesialis</strong></th>
    <th><strong>Tempat, Tgl Lahir </strong></th>
    <th><strong>Alamat</strong></th>
    <th><strong>Tools</strong></th>
  </tr>
</thead>
<?php
$mySql = "SELECT * FROM dokter ORDER BY kd_dokter ASC";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
$nomor = 0; 
while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_dokter']; ?></td>
    <td><?php echo $myData['nm_dokter']; ?></td>
    <td><?php echo $myData['spesialisasi']; ?></td>
    <td><?php echo $myData['tempat_lahir']; ?>, 
		<?php echo IndonesiaTgl($myData['tanggal_lahir']); ?></td>
    <td><?php echo $myData['alamat']; ?></td>
    <td align="center"><a href="cetak/dokter_cetak.php?Kode=<?php echo $myData['kd_dokter']; ?>" target="_blank" class="halflings-icon print"></a></td>
  </tr>
  <?php } ?>
</table>
