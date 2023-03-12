<th colspan="3"><ul class="breadcrumb">
				<li>
					Penjualan Obat
				</li>
				
			</ul></th>
			
			<?php
include_once "library/inc.seslogin.php";

# HAPUS DAFTAR OBAT DI TMP
if(isset($_GET['Aksi'])){
	if(trim($_GET['Aksi'])=="Delete"){
		# Hapus Tmp jika datanya sudah dipindah
		$mySql = "DELETE FROM tmp_penjualan WHERE id='".$_GET['id']."' AND kd_petugas='".$_SESSION['SES_LOGIN']."'";
		mysql_query($mySql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
	}
	if(trim($_GET['Aksi'])=="Sucsses"){
		echo "<b>DATA BERHASIL DISIMPAN</b> <br><br>";
	}
}
// =========================================================================


# TOMBOL TAMBAH (INPUT OBAT) DIKLIK
if(isset($_POST['btnTambah'])){
	$pesanError = array();
	if (trim($_POST['txtKodeObat'])=="") {
		$pesanError[] = "Data <b>Kode Obat belum diisi</b>, ketik Kode dari Keyboard atau dari <b>Barcode Reader</b> !";		
	}
	if (trim($_POST['txtJumlah'])=="" or ! is_numeric(trim($_POST['txtJumlah']))) {
		$pesanError[] = "Data <b>Jumlah Obat (Qty) belum diisi</b>, silahkan <b>isi dengan angka</b> !";		
	}
	
	# Baca variabel
	$txtKodeObat	= $_POST['txtKodeObat'];
	$txtKodeObat	= str_replace("'","&acute;", $txtKodeObat);
	$txtJumlah	= $_POST['txtJumlah'];

	# Skrip validasi Stok Obat
	# Jika stok < (kurang) dari Jumlah yang dibeli, maka buat Pesan Error
	$cekSql	= "SELECT stok FROM obat WHERE kd_obat='$txtKodeObat'";
	$cekQry = mysql_query($cekSql, $koneksidb) or die ("Gagal Query".mysql_error());
	$cekRow = mysql_fetch_array($cekQry);
	if ($cekRow['stok'] < $txtJumlah) {
		$pesanError[] = "Stok Obat untuk Kode <b>$txtKodeObat</b> adalah <b> $cekRow[stok]</b>, tidak dapat dijual!";
	}
			
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
			echo "<div class='alert alert-error'>";
		echo "<button type='button' class='close' data-dismiss='alert'>
											<i class='halflings-icon remove'></i></button>

										<strong>
											";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN KE DATABASE (tmp_penjualan)	
		// Periksa, apakah Kode obat atau Kode Barcode yang diinput ada di dalam tabel obat
$mySql ="SELECT * FROM obat WHERE kd_obat='$txtKodeObat'";
$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
$myRow = mysql_fetch_array($myQry);
if (mysql_num_rows($myQry) >= 1) {
	// Membaca kode obat/ obat
	$kodeObat	= $myRow['kd_obat'];
	
	// Jika Kode ditemukan, masukkan data ke Keranjang (TMP)
	$tmpSql 	= "INSERT INTO tmp_penjualan (kd_obat, jumlah,  kd_petugas) 
				VALUES ('$kodeObat', '$txtJumlah',  '".$_SESSION['SES_LOGIN']."')";
	mysql_query($tmpSql, $koneksidb) or die ("Gagal Query tmp : ".mysql_error());
}
}

}
// ============================================================================

# ========================================================================================================
# JIKA TOMBOL SIMPAN TRANSAKSI DIKLIK
if(isset($_POST['btnSimpan'])){
	$pesanError = array();
	if (trim($_POST['txtTanggal'])=="") {
		$pesanError[] = "Data <b>Tanggal Transaksi</b> belum diisi, pilih pada kalender !";		
	}
	if (trim($_POST['txtUangBayar'])==""  or ! is_numeric(trim($_POST['txtUangBayar']))) {
		$pesanError[] = "Data <b> Uang Bayar</b> belum diisi, isi dengan uang (Rp) !";		
	}
	if (trim($_POST['txtUangBayar']) < trim($_POST['txtTotBayar'])) {
		$pesanError[] = "Data <b> Uang Bayar Belum Cukup</b>.  
						 Total belanja adalah <b> Rp. ".format_angka($_POST['txtTotBayar'])."</b>";		
	}
	
	# Periksa apakah sudah ada obat yang dimasukkan
	$tmpSql ="SELECT COUNT(*) As qty FROM tmp_penjualan WHERE kd_petugas='".$_SESSION['SES_LOGIN']."'";
	$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$tmpData = mysql_fetch_array($tmpQry);
	if ($tmpData['qty'] < 1) {
		$pesanError[] = "<b>DAFTAR OBAT MASIH KOSONG</b>, belum ada obat yang dimasukan, <b>minimal 1 obat</b>.";
	}
	
	# Baca variabel from
	$txtTanggal 	= $_POST['txtTanggal'];
	$txtPelanggan	= $_POST['txtPelanggan'];
	$txtKeterangan	= $_POST['txtKeterangan'];
	$txtUangBayar	= $_POST['txtUangBayar'];
			
			
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='alert alert-error'>";
		echo "<button type='button' class='close' data-dismiss='alert'>
											<i class='halflings-icon remove'></i></button>

										<strong>
											";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE
		# Jika jumlah error pesanError tidak ada, maka penyimpanan dilakukan. Data dari tmp dipindah ke tabel penjualan dan penjualan_item
		$noTransaksi = buatKode("penjualan", "JL");
		$mySql	= "INSERT INTO penjualan SET 
						no_penjualan='$noTransaksi', 
						tgl_penjualan='".InggrisTgl($_POST['txtTanggal'])."', 
						pelanggan='$txtPelanggan', 
						keterangan='$txtKeterangan', 
						uang_bayar='$txtUangBayar',
						kd_petugas='".$_SESSION['SES_LOGIN']."'";
		mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		
		# SIMPAN DATA TMP KE PENJUALAN_ITEM
		# Ambil semua data obat yang dipilih, berdasarkan kasir yg login
		$tmpSql ="SELECT obat.*, tmp.jumlah FROM obat, tmp_penjualan As tmp
					WHERE obat.kd_obat = tmp.kd_obat AND tmp.kd_petugas='".$_SESSION['SES_LOGIN']."'";
		$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
		while ($tmpData = mysql_fetch_array($tmpQry)) {
			// Baca data dari tabel obat dan jumlah yang dibeli dari TMP
			$dataKode 	= $tmpData['kd_obat'];
			$dataHargaM	= $tmpData['harga_modal'];
			$dataHargaJ	= $tmpData['harga_jual'];
			$dataJumlah	= $tmpData['jumlah'];
			
			// MEMINDAH DATA, Masukkan semua data di atas dari tabel TMP ke tabel ITEM
			$itemSql = "INSERT INTO penjualan_item SET 
									no_penjualan='$noTransaksi', 
									kd_obat='$dataKode', 
									harga_modal='$dataHargaM', 
									harga_jual='$dataHargaJ', 
									jumlah='$dataJumlah'";
			mysql_query($itemSql, $koneksidb) or die ("Gagal Query ".mysql_error());
			
			// Skrip Update stok
			$stokSql = "UPDATE obat SET stok = stok - $dataJumlah WHERE kd_obat='$dataKode'";
			mysql_query($stokSql, $koneksidb) or die ("Gagal Query Edit Stok".mysql_error());
		}
		
		# Kosongkan Tmp jika datanya sudah dipindah
		$hapusSql = "DELETE FROM tmp_penjualan WHERE kd_petugas='".$_SESSION['SES_LOGIN']."'";
		mysql_query($hapusSql, $koneksidb) or die ("Gagal kosongkan tmp".mysql_error());
		
		// Jalankan skrip Nota
		echo "<script>";
		echo "window.open('penjualan/penjualan_nota.php?noNota=$noTransaksi','popuppage','width=920,toolbar=0,resizable=0,scrollbars=yes,height=720,top=10,left=300')";
		echo "</script>";
		
		// Refresh form
		echo "<meta http-equiv='refresh' content='0; url=?page=Penjualan-Baru'>";

	}	
}

# TAMPILKAN DATA KE FORM
$noTransaksi 	= buatKode("penjualan", "JL");
$dataTanggal 	= isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('d-m-Y');
$dataPelanggan	= isset($_POST['txtPelanggan']) ? $_POST['txtPelanggan'] : 'Pasien';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
$dataUangBayar	= isset($_POST['txtUangBayar']) ? $_POST['txtUangBayar'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="849" cellpadding="3" cellspacing="1"  class="table-list">
    <tr>
      <td width="26%"><strong>No. Penjualan </strong></td>
      <td width="2%"><strong>:</strong></td>
      <td width="72%"><input type="text" name="txtNomor" value="<?php echo $noTransaksi; ?>" size="23" maxlength="23" readonly="readonly"/></td>
    </tr>
    <tr>
      <td><strong>Tgl. Penjualan </strong></td>
      <td><strong>:</strong></td>
      <td><input name="txtTanggal" type="text" class="tcal" value="<?php echo $dataTanggal; ?>" size="23" maxlength="23" /></td>
    </tr>
    <tr>
      <td><strong>Pelanggan</strong></td>
      <td><strong>:</strong></td>
      <td><input type="text" name="txtPelanggan" value="<?php echo $dataPelanggan; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>Keterangan</strong></td>
      <td><strong>:</strong></td>
      <td><input type="text" name="txtKeterangan" value="<?php echo $dataKeterangan; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td><strong>Kode Obat </strong></td>
      <td><strong>:</strong></td>
      <td><b>
        <input type="text" name="txtKodeObat" size="40" maxlength="20" />
        <a href="" onclick="window.open('penjualan/?page=Pencarian-Obat','popuppage','width=920,toolbar=0,resizable=0,scrollbars=no,height=600,top=100,left=300');"> Pencarian Obat</a></b></td>
    </tr>
    <tr>
      <td><b>Jumlah </b></td>
      <td><b>:</b></td>
      <td><b>
        <input type="text" class="angkaC" name="txtJumlah" size="10" maxlength="4" value="1" 
				 onblur="if (value == '') {value = '1'}" 
				 onfocus="if (value == '1') {value =''}"/>
        <input name="btnTambah" type="submit" style="cursor:pointer;" value=" Tambah " />
      </b></td>
    </tr>
  </table>
  <br>
  <table class="table table-condensed" >
  <thead>
    <tr>
      <th colspan="7"><div align="left">DAFTAR OBAT </div></th>
    </tr>
    </thead>
    <tr>
      <th width="29" ><strong>No</strong></th>
      <th width="85" ><strong>Kode</strong></th>
      <th width="432"><strong>Nama Obat </strong></th>
      <th width="85" align="right"><strong>Harga (Rp) </strong></th>
      <th width="48" align="right" ><strong>Jumlah</strong></th>
      <th width="100" align="right" ><strong>Sub Total(Rp) </strong></th>
      <th width="22" align="center" >&nbsp;</th>
    </tr>
<?php
// Qury menampilkan data dalam Grid TMP_Penjualan 
$tmpSql ="SELECT obat.*, tmp.id, tmp.jumlah FROM obat, tmp_penjualan As tmp
		WHERE obat.kd_obat=tmp.kd_obat AND tmp.kd_petugas='".$_SESSION['SES_LOGIN']."'
		ORDER BY obat.kd_obat ";
$tmpQry = mysql_query($tmpSql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
$nomor=0;  $hargaDiskon = 0;   $totalBayar	= 0;  $jumlahobat	= 0;
while($tmpData = mysql_fetch_array($tmpQry)) {
	$nomor++;
	$subSotal 	= $tmpData['jumlah'] * $tmpData['harga_jual'];
	$totalBayar	= $totalBayar + $subSotal;
	$jumlahobat	= $jumlahobat + $tmpData['jumlah'];
?>
    <tr>
      <td><?php echo $nomor; ?></td>
      <td><?php echo $tmpData['kd_obat']; ?></b></td>
      <td><?php echo $tmpData['nm_obat']; ?></td>
      <td align="right"><?php echo format_angka($tmpData['harga_jual']); ?></td>
      <td align="right"><?php echo $tmpData['jumlah']; ?></td>
      <td align="right"><?php echo format_angka($subSotal); ?></td>
      <td><a href="?page=Penjualan-Baru&Aksi=Delete&id=<?php echo $tmpData['id']; ?>" target="_self">Delete</a></td>
    </tr>
<?php } ?>
    <tr>
      <td colspan="4" align="right" bgcolor="#F5F5F5"><div align="right"><strong>GRAND TOTAL   (Rp.) : </strong></div></td>
      <td align="right" bgcolor="#F5F5F5"><strong><?php echo $jumlahobat; ?></strong></td>
      <td align="right" bgcolor="#F5F5F5"><strong><?php echo format_angka($totalBayar); ?></strong></td>
      <td bgcolor="#F5F5F5">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="right" bgcolor="#F5F5F5"><div align="right"><strong>UANG BAYAR (Rp.) : </strong></div></td>
      <td bgcolor="#F5F5F5"><input name="txtTotBayar" type="hidden" value="<?php echo $totalBayar; ?>" /></td>
      <td bgcolor="#F5F5F5"><input type="text" name="txtUangBayar" value="<?php echo $dataUangBayar; ?>" size="16" maxlength="16"/></td>
      <td bgcolor="#F5F5F5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" align="right"><div align="right">
        <input name="btnSimpan" type="submit" style="cursor:pointer;" value=" SIMPAN TRANSAKSI " />
      </div></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
