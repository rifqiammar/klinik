<ul class="breadcrumb">
				<li>
					LAPORAN DATA PETUGAS
				</li>
				
</ul>
<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
  <tr>
    <th><b>No</b></th>
    <th><strong>Kode</strong></th>
    <th><b>Nama Petugas </b></th>
    <th><b>No Telepon </b></th>
    <th><b>Username</b></th>
    <th><b>Level</b></th>
  </tr>
</thead>
  <?php
	$mySql 	= "SELECT * FROM petugas ORDER BY kd_petugas";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td><?php echo $myData['kd_petugas']; ?></td>
    <td> <?php echo $myData['nm_petugas']; ?> </td>
    <td> <?php echo $myData['no_telepon']; ?> </td>
    <td> <?php echo $myData['username']; ?> </td>
    <td> <?php echo $myData['level']; ?> </td>
  </tr>
  <?php } ?>
</table>
