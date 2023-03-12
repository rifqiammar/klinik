	
<?php
# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM obat";
$pageQry = mysql_query($pageSql, $koneksidb) or die("error paging:".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<ul class="breadcrumb">
				<li>
					LAPORAN DATA OBAT
				</li>
			</ul>
<div id='container'></div>
<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
  <tr>
    <th><strong>No</strong></th>
    <th><strong>Kode</strong></th>
    <th><strong>Nama Obat</strong></th>
    <th><strong>Harga (Rp) </strong></th>
    <th><strong>Stok</strong></th>
    <th><strong>Keterangan</strong></th>
  </tr>
</thead>
  <?php
	# SQL Menampilkan data semua obat
	$mySql 	= "SELECT * FROM obat ORDER BY kd_obat ASC LIMIT $hal, $row";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td> <?php echo $nomor; ?> </td>
    <td> <?php echo $myData['kd_obat']; ?> </td>
    <td> <?php echo $myData['nm_obat']; ?> </td>
    <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
    <td align="right"> <?php echo $myData['stok']; ?> </td>
    <td><?php echo $myData['keterangan']; ?></td>
  </tr>
  <?php } ?>
 
</table>
<script src="js/grafik/jquery.min.js" type="text/javascript"></script>
<script src="js/grafik/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container',
            type: 'column'
         },   
         title: {
            text: 'LAPORAN STOK DATA OBAT'
         },
         xAxis: {
            categories: ['merek']
         },
         yAxis: {
            title: {
               text: 'Stok'
            }
         },
              series:             
            [
            <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Penjualan
	$sqlObat = "SELECT * FROM obat 
				ORDER BY kd_obat ";
	$qryObat = mysql_query($sqlObat);
	while ($tampilObat = mysql_fetch_array($qryObat)) {
	?>
                  {
                      name: '<?php echo $tampilObat['nm_obat']; ?>',
                      data: [<?php echo $tampilObat['stok'];  ?>]
                  },
                  <?php } ?>
            ]
      });
   });	
</script>
	