<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM penjualan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<ul class="breadcrumb">
				<li>
					LAPORAN PENJUALAN OBAT
				</li>
</ul>
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
            text: 'DATA PENJUALAN OBAT'
         },
         xAxis: {
            categories: ['merek']
         },
         yAxis: {
            title: {
               text: 'Jumlah terjual'
            }
         },
              series:             
            [
            <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Penjualan
	$qryObat = "SELECT * FROM obat 
				ORDER BY kd_obat ";
	$sqlObat = mysql_query($qryObat, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = $hal; 
	while ($tampilObat = mysql_fetch_array($sqlObat)) {
		
		
		# Membaca Kode Penjualan/ Nomor transaksi
		$kdObat = $tampilObat['kd_obat'];
		
		# Menghitung Total Penjualan (belanja) setiap nomor transaksi
		$my2Sql = "SELECT SUM(jumlah) AS total_barang   
				   FROM penjualan_item WHERE kd_obat='$kdObat'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$my2Data = mysql_fetch_array($my2Qry);	
	?>
                  {
                      name: '<?php echo $tampilObat['nm_obat']; ?>',
                      data: [<?php echo $my2Data['total_barang'];  ?>]
                  },
                  <?php } ?>
            ]
      });
   });	
</script>
<div id='container'></div>		
<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
  <tr>
    <th><strong>No</strong></th>
    <th><strong>Tanggal</strong></th>
    <th><strong>No. Penjualan </strong></th>
    <th><strong>Pelanggan </strong></th>
    <th><strong>Keterangan </strong></th>
    <th><strong>Tools</strong></th>
  </tr>
  </thead>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi Penjualan
	$mySql = "SELECT * FROM penjualan ORDER BY no_penjualan DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = $hal;
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		# Membaca Kode Penjualan/ Nomor transaksi
		$noNota = $myData['no_penjualan'];
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></td>
    <td><?php echo $myData['no_penjualan']; ?></td>
    <td><?php echo $myData['pelanggan']; ?></td>
    <td><?php echo $myData['keterangan']; ?></td>
    <td align="center"><a href="cetak/penjualan_cetak.php?noNota=<?php echo $noNota; ?>" target="_blank" class="halflings-icon print"></a></td>
  </tr>
  <?php } ?>
  
</table>
