<ul class="breadcrumb">
				<li>
					LAPORAN DATA TINDAKAN
				</li>
</ul>
<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
  <tr>
    <th><strong>No</strong></th>
    <th><strong>Nama Tindakan </strong></th>
    <th><strong>Harga (Rp.) </strong></th>
  </tr>
</thead>
  <?php
	  // Menampilkan daftar tindakan
	$mySql = "SELECT * FROM tindakan ORDER BY kd_tindakan ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
  ?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['nm_tindakan']; ?></td>
    <td align="right"><?php echo format_angka($myData['harga']); ?></td>
  </tr>
  <?php } ?>
</table>
