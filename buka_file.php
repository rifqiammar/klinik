<?php
# KONTROL MENU PROGRAM
if($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['page']){				
		case '' :
			if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php";	break;
			
		case 'Halaman-Utama' :
			if(!file_exists ("main.php")) die ("Sorry Empty Page!"); 
			include "main.php";	break;
			
		case 'Login' :
			if(!file_exists ("login.php")) die ("Sorry Empty Page!"); 
			include "login.php"; break;
			
		case 'Login-Validasi' :
			if(!file_exists ("login_validasi.php")) die ("Sorry Empty Page!"); 
			include "login_validasi.php"; break;
			
		case 'Logout' :
			if(!file_exists ("login_out.php")) die ("Sorry Empty Page!"); 
			include "login_out.php"; break;		

		# TINDAKAN / PAKET TINDAKAN
		case 'Tindakan-Data' :
			if(!file_exists ("tindakan_data.php")) die ("Sorry Empty Page!"); 
			include "tindakan_data.php"; break;		
		case 'Tindakan-Add' :
			if(!file_exists ("tindakan_add.php")) die ("Sorry Empty Page!"); 
			include "tindakan_add.php";	break;		
		case 'Tindakan-Delete' :
			if(!file_exists ("tindakan_delete.php")) die ("Sorry Empty Page!"); 
			include "tindakan_delete.php"; break;		
		case 'Tindakan-Edit' :
			if(!file_exists ("tindakan_edit.php")) die ("Sorry Empty Page!"); 
			include "tindakan_edit.php"; break;	


		# DOKTER
		case 'Dokter-Data' :
			if(!file_exists ("dokter_data.php")) die ("Sorry Empty Page!"); 
			include "dokter_data.php";	 break;		
		case 'Dokter-Add' :
			if(!file_exists ("dokter_add.php")) die ("Sorry Empty Page!"); 
			include "dokter_add.php";	 break;		
		case 'Dokter-Delete' :
			if(!file_exists ("dokter_delete.php")) die ("Sorry Empty Page!"); 
			include "dokter_delete.php"; break;		
		case 'Dokter-Edit' :				
			if(!file_exists ("dokter_edit.php")) die ("Sorry Empty Page!"); 
			include "dokter_edit.php"; break;	


		# PETUGAS KLINIK
		case 'Petugas-Data' :
			if(!file_exists ("petugas_data.php")) die ("Sorry Empty Page!"); 
			include "petugas_data.php";	 break;		
		case 'Petugas-Add' :
			if(!file_exists ("petugas_add.php")) die ("Sorry Empty Page!"); 
			include "petugas_add.php";	 break;		
		case 'Petugas-Delete' :
			if(!file_exists ("petugas_delete.php")) die ("Sorry Empty Page!"); 
			include "petugas_delete.php"; break;		
		case 'Petugas-Edit' :
			if(!file_exists ("petugas_edit.php")) die ("Sorry Empty Page!"); 
			include "petugas_edit.php"; break;	


		# PASIEN
		case 'Pasien-Data' :
			if(!file_exists ("pasien_data.php")) die ("Sorry Empty Page!"); 
			include "pasien_data.php"; break;		
		case 'Pasien-Add' :
			if(!file_exists ("pasien_add.php")) die ("Sorry Empty Page!"); 
			include "pasien_add.php"; break;
		case 'Pasien-Delete' :
			if(!file_exists ("pasien_delete.php")) die ("Sorry Empty Page!"); 
			include "pasien_delete.php"; break;
		case 'Pasien-Edit' :
			if(!file_exists ("pasien_edit.php")) die ("Sorry Empty Page!"); 
			include "pasien_edit.php"; break;

			
		# OBAT
		case 'Obat-Data' :
			if(!file_exists ("obat_data.php")) die ("Sorry Empty Page!"); 
			include "obat_data.php"; break;		
		case 'Obat-Add' :
			if(!file_exists ("obat_add.php")) die ("Sorry Empty Page!"); 
			include "obat_add.php"; break;		
		case 'Obat-Delete' :
			if(!file_exists ("obat_delete.php")) die ("Sorry Empty Page!"); 
			include "obat_delete.php"; break;		
		case 'Obat-Edit' :
			if(!file_exists ("obat_edit.php")) die ("Sorry Empty Page!"); 
			include "obat_edit.php"; break;
			
		case 'Pencarian-Obat' :
			if(!file_exists ("pencarian_obat.php")) die ("Sorry Empty Page!"); 
			include "pencarian_obat.php"; break;		
		
		# PENDAFTARAN
        case 'Pendaftaran' :
			if(!file_exists ("pendaftaran/pendaftaran_baru.php")) die ("Sorry Empty Page!"); 
			include "pendaftaran/pendaftaran_baru.php"; break;	
		case 'Pendaftaran-Tampil' : 
			if(!file_exists ("pendaftaran/pendaftaran_data.php")) die ("Empty Main Page!"); 
			include "pendaftaran/pendaftaran_data.php";	break;	
		case 'Pendaftaran-Ubah' :
			if(!file_exists ("pendaftaran/pendaftaran_ubah.php")) die ("Empty Main Page!"); 
			include "pendaftaran/pendaftaran_ubah.php";	break;
		case 'Pendaftaran-Hapus' :
			if(!file_exists ("pendaftaran/pendaftaran_hapus.php")) die ("Empty Main Page!"); 
			include "pendaftaran/pendaftaran_hapus.php";	break;
		case 'Pendaftaran-Tampil' : 
			if(!file_exists ("pendaftaran/pendaftaran_data.php")) die ("Empty Main Page!"); 
			include "pendaftaran/pendaftaran_data.php";	break;
		case 'Pencarian-Pasien' : 
			if(!file_exists ("pendaftaran/pencarian_pasien.php")) die ("Empty Main Page!"); 
			include "pendaftaran/pencarian_pasien.php";	break;
		
		
		# RAWAT PASIEN
		case 'Rawat-Baru' :
			if(!file_exists ("rawat-pasien/rawat_baru.php")) die ("Empty Main Page!"); 
			include "rawat-pasien/rawat_baru.php";	break;
		case 'Rawat-Tampil' :
			if(!file_exists ("rawat-pasien/rawat_tampil.php")) die ("Empty Main Page!"); 
			include "rawat-pasien/rawat_tampil.php";	break;
		case 'Rawat-Hapus' :
			if(!file_exists ("rawat-pasien/rawat_hapus.php")) die ("Empty Main Page!"); 
			include "rawat-pasien/rawat_hapus.php";	break;
		case 'Pencarian-Pasien1' : 
			if(!file_exists ("rawat-pasien/pencarian_pasien.php")) die ("Empty Main Page!"); 
			include "rawat-pasien/pencarian_pasien.php";	break;
			
		# PENJUALAN OBAT
		case 'Penjualan-Baru' :
			if(!file_exists ("penjualan/penjualan_baru.php")) die ("Empty Main Page!"); 
			include "penjualan/penjualan_baru.php";	break;
		case 'Pencarian-Obat' : 
			if(!file_exists ("penjualan/pencarian_obat.php")) die ("Empty Main Page!"); 
			include "penjualan/pencarian_obat.php";	break;
		case 'Penjualan-Tampil' : 
			if(!file_exists ("penjualan/penjualan_tampil.php")) die ("Empty Main Page!"); 
			include "penjualan/penjualan_tampil.php";	break;
		case 'Penjualan-Hapus' : 
			if(!file_exists ("penjualan/penjualan_hapus.php")) die ("Empty Main Page!"); 
			include "penjualan/penjualan_hapus.php";	break;
			
		# REPORT INFORMASI / LAPORAN DATA
		case 'Laporan' :
				if(!file_exists ("menu_laporan.php")) die ("Sorry Empty Page!"); 
				include "menu_laporan.php"; break;

			# LAPORAN MASTER DATA
			case 'Laporan-Tindakan' :
				if(!file_exists ("laporan_tindakan.php")) die ("Sorry Empty Page!"); 
				include "laporan_tindakan.php"; break;
				
			case 'Laporan-Petugas' :
				if(!file_exists ("laporan_petugas.php")) die ("Sorry Empty Page!"); 
				include "laporan_petugas.php"; break;
	
			case 'Laporan-Dokter' :
				if(!file_exists ("laporan_dokter.php")) die ("Sorry Empty Page!"); 
				include "laporan_dokter.php"; break;
				
			case 'Laporan-Pasien' :
				if(!file_exists ("laporan_pasien.php")) die ("Sorry Empty Page!"); 
				include "laporan_pasien.php"; break;

			case 'Laporan-Obat' :	
				if(!file_exists ("laporan_obat.php")) die ("Sorry Empty Page!"); 
				include "laporan_obat.php"; break;
			
			# LAPORAN PENDAFTARAN
			case 'Laporan-Pendaftaran' :
				if(!file_exists ("laporan_pendaftaran.php")) die ("Sorry Empty Page!"); 
				include "laporan_pendaftaran.php"; break;
				
			case 'Laporan-Pendaftaran-Periode' :
				if(!file_exists ("laporan_pendaftaran_periode.php")) die ("Sorry Empty Page!"); 
				include "laporan_pendaftaran_periode.php"; break;
					
			# LAPORAN RAWAT PASIEN
			case 'Laporan-Rawat' :
				if(!file_exists ("laporan_rawat.php")) die ("Sorry Empty Page!"); 
				include "laporan_rawat.php"; break;
				
			case 'Laporan-Rawat-Periode' :
				if(!file_exists ("laporan_rawat_periode.php")) die ("Sorry Empty Page!"); 
				include "laporan_rawat_periode.php"; break;
				
			case 'Laporan-Rawat-Pasien' :
				if(!file_exists ("laporan_rawat_pasien.php")) die ("Sorry Empty Page!"); 
				include "laporan_rawat_pasien.php"; break;
				
			# LAPORAN PENJUALAN OBAT
			case 'Laporan-Penjualan' :
				if(!file_exists ("laporan_penjualan.php")) die ("Sorry Empty Page!"); 
				include "laporan_penjualan.php"; break;
				
			case 'Laporan-Penjualan-Periode' :
				if(!file_exists ("laporan_penjualan_periode.php")) die ("Sorry Empty Page!"); 
				include "laporan_penjualan_periode.php"; break;

		default:
			if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php";						
		break;
	}
}
else {
	// Jika tidak mendapatkan variabel URL : ?page
	if(!file_exists ("main.php")) die ("Empty Main Page!"); 
	include "main.php";	
}
?>