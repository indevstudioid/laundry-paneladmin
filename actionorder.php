<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : order_masuk.php                                        #
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
//include_once "../library/inc.library.php";

// Keterangan : Skrip ini untuk menjalankan Aksi dari file program pemesanan_lihat.php dan pemesanan_tampil.php
$status_pemesanan=$_POST['status_pemesanan'];
$id_pemesanan =$_POST['id_pemesanan'];


$sqlstok=mysql_query("SELECT * FROM product, pemesanan WHERE product.kd_product=pemesanan.kd_product AND pemesanan.id_pemesanan='$id_pemesanan'");
$datastok=mysql_fetch_array($sqlstok);
$dibeli=$datastok['dibeli'];
# Membaca Kode dari URL
if(empty($_GET['act'])){
	echo "<b>Data yang diubah tidak ada</b>";
	header('location: pemesanan.lihat.php?id=$id_pemesanan');
}
else {
	# MEMBACA KODE
	
	
	# JIKA KLIK TOMBOL LUNAS, maka status Pemesanan jadi Lunas
	if($_GET['act']=='update' && $_POST['status_pemesanan']=="Lunas") {
		require ('../inc/tanggal.php');
		$editSql = "UPDATE pemesanan SET status_pemesanan='Lunas',  tgl_lunas='$tgl_sekarang' WHERE id_pemesanan='$id_pemesanan'";
		$editQry = mysql_query($editSql) or die ("Eror Query Edit".mysql_error());

		$editpengirimansql = "UPDATE pengiriman SET status_pengiriman='Siap Dikirim'  WHERE id_pemesanan='$id_pemesanan'";
		$jalankanpengiriman = mysql_query($editpengirimansql) or die ("Eror Query Edit".mysql_error());

			  // Update untuk menambahkan produk yang dibeli (best seller = produk yang paling laris)
     	$mySql= mysql_query("UPDATE product, pemesanan_detail SET product.dibeli=product.dibeli+pemesanan_detail.qty WHERE product.kd_product=pemesanan_detail.kd_product AND pemesanan_detail.id_pemesanan='$id_pemesanan'")or die ("Gagal query update ".mysql_error());
			
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=pemesanan.lihat.php?id=$id_pemesanan'>";
		}
	elseif($_GET['act']=='update' && $_POST['status_pemesanan']=="Pesan") {
		$editSqlPesan = "UPDATE pemesanan SET status_pemesanan='Pesan' , tgl_lunas='0' WHERE id_pemesanan='$id_pemesanan'";
		$editQryPesan = mysql_query($editSqlPesan) or die ("Eror Query Edit".mysql_error());

		$editpengirimansql1 = "UPDATE pengiriman SET status_pengiriman='Belum'  WHERE id_pemesanan='$id_pemesanan'";
		$jalankanpengiriman1 = mysql_query($editpengirimansql1) or die ("Eror Query Edit".mysql_error());


			  // Update untuk menambahkan produk yang dibeli (best seller = produk yang paling laris)
     	//$mySqlPesan= mysql_query("UPDATE product, pemesanan_detail SET product.dibeli=product.dibeli+pemesanan_detail.qty WHERE product.kd_product=pemesanan_detail.kd_product AND pemesanan_detail.id_pemesanan='$id_pemesanan'")or die ("Gagal query update ".mysql_error());
			
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=pemesanan.lihat.php?id=$id_pemesanan'>";
	}
	elseif($_GET['act']=='update' && $_POST['status_pemesanan']=="Batal") {

		$editSqlBatal = "UPDATE pemesanan SET status_pemesanan='Batal', tgl_lunas='0' WHERE id_pemesanan='$id_pemesanan'";
		$editQryBatal = mysql_query($editSqlBatal) or die ("Eror Query Edit".mysql_error());

		$editpengirimansql12 = "UPDATE pengiriman SET status_pengiriman='Belum'   WHERE id_pemesanan='$id_pemesanan'";
		$jalankanpengiriman12 = mysql_query($editpengirimansql12) or die ("Eror Query Edit".mysql_error());



		if ($dibeli=='0') {
			echo "<meta http-equiv='refresh' content='0; url=pemesanan.lihat.php?id=$id_pemesanan'>";
		}
		if ($dibeli!=='0') {
			$mySqlBatal= mysql_query("UPDATE product, pemesanan_detail SET product.dibeli=product.dibeli-pemesanan_detail.qty WHERE product.kd_product=pemesanan_detail.kd_product AND pemesanan_detail.id_pemesanan='$id_pemesanan'")or die ("Gagal query update ".mysql_error());
				
			$itemSql = "SELECT * FROM pemesanan_detail WHERE id_pemesanan='$id_pemesanan'";
			$itemQry = mysql_query($itemSql) or die ("Gagal query ambil data".mysql_error());
			while ($itemRow = mysql_fetch_array($itemQry)) {		
				$jumlahBrg 	= $itemRow['qty'];
				$kodeBrg	= $itemRow['id_detail_product'];

				# Update stok
				$mySqlstokbatal = "UPDATE detail_product SET stock=stock + $jumlahBrg WHERE id_detail_product='$kodeBrg'";
				mysql_query($mySqlstokbatal) or die ("Gagal query update stok".mysql_error());
			}
				echo "<meta http-equiv='refresh' content='0; url=pemesanan.lihat.php?id=$id_pemesanan'>";


		}
			  // Update untuk menambahkan produk yang dibeli (best seller = produk yang paling laris)
     	
			
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=pemesanan.lihat.php?id=$id_pemesanan'>";
	}
	elseif($_GET['act']=='hapus')  {

		if ($dibeli=='0') {
			mysql_query("DELETE FROM pemesanan WHERE id_pemesanan='$_GET[id]'"); 
			echo "<meta http-equiv='refresh' content='0; url=order_masuk'>";
		}
		if ($dibeli!=='0') {
			$mySqlBatal= mysql_query("UPDATE product, pemesanan_detail SET product.dibeli=product.dibeli-pemesanan_detail.qty WHERE product.kd_product=pemesanan_detail.kd_product AND pemesanan_detail.id_pemesanan='$_GET[id]'")or die ("Gagal query update ".mysql_error());
				
			$itemSql = "SELECT * FROM pemesanan_detail WHERE id_pemesanan='$_GET[id]'";
			$itemQry = mysql_query($itemSql) or die ("Gagal query ambil data".mysql_error());
			while ($itemRow = mysql_fetch_array($itemQry)) {		
				$jumlahBrg 	= $itemRow['qty'];
				$kodeBrg	= $itemRow['id_detail_product'];

				# Update stok
				$mySqlstokbatal = "UPDATE detail_product SET stock=stock + $jumlahBrg WHERE id_detail_product='$kodeBrg'";
				mysql_query($mySqlstokbatal) or die ("Gagal query update stok".mysql_error());
			}
				mysql_query("DELETE FROM pemesanan WHERE id_pemesanan='$_GET[id]'"); 
				echo "<meta http-equiv='refresh' content='0; url=order_masuk'>";


		}
			
    }  	
}
			
			



?>