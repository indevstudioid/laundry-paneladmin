<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : konfirmasi_pembayaran.tambah.php                                 #
#                                               Release Date  :                                                     #
#                                               Created       : 20/04/16 02.23                                      #
#                                               Last Modified : 22/04/16 01.08                                      #
#                                                                                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                                SIK BERKAITAN KARO LOGIN                                           #
#-------------------------------------------------------------------------------------------------------------------#

# Include Dari System
require ('../system/jenglot.php');

session_start();
hakAksesKakakz();

cekTingkatUser(array(1));

if (isset($_POST['buttonsubmit'])) {
 	$id_pemesanan=$_POST['id_pemesanan'];
 	$unik_keyo=$_POST['unik_key'];
 	$unik_key  = preg_replace("/[^0-9]/", "", $unik_keyo);

 	$kd_bank=$_POST['kd_bank'];
 	$status_konfirmasi=$_POST['status_konfirmasi'];

	$total_transfero=$_POST['total_transfer'];
	$total_transfer  = preg_replace("/[^0-9]/", "", $total_transfero);
	
	 $tgl_transfer0=$_POST['date'];
	
	 $tgl_transfer_ubah=ubahformatTgl($tgl_transfer0);

	if (empty($unik_key)) {
		?> <script language="JavaScript">alert('Anda Belum Mengisi Data Transfer Unik');</script><?php
		header('location: ./konfirmasi_pembayaran');
	}
	if (empty($kd_bank)) {
		?> <script language="JavaScript">alert('Anda Belum Memilih Bank');</script><?php
		header('location: ./konfirmasi_pembayaran');
	}
	if (empty($total_transfer)) {
		?> <script language="JavaScript">alert('Anda Belum Mengisi Data Total transfer yang Sudah Anda Bayar');</script><?php
		header('location: ./konfirmasi_pembayaran');
	}
	if (empty($tgl_transfer0)) {
		?> <script language="JavaScript">alert('Anda Belum Mengisi Data Tanggal Ketika Anda Transfer');</script><?php
		header('location: ./konfirmasi_pembayaran');
	}

	$querytambahkonfirmasi = mysql_query("INSERT INTO konfirmasi SET id_pemesanan='$id_pemesanan', status_konfirmasi='$status_konfirmasi', unik_transfer='$unik_key', total_transfer='$total_transfer', kd_bank='$kd_bank', tgl_transfer='$tgl_transfer_ubah' ") or die(mysql_error());
	header('location: ./konfirmasi_pembayaran');
}


?>