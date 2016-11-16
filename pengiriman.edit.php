<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : pengiriman.edit.php                                 #
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

if ($_GET['id']) {
 $status_pengiriman=$_POST['status_pengiriman'];
  $id_pemesanan=$_POST['id_pemesanan'];
	$tgl_pengiriman0=$_POST['date'];
  
  $tgl_pengiriman_ubah=ubahformatTgl($tgl_pengiriman0);

mysql_query("UPDATE pengiriman SET status_pengiriman='$status_pengiriman', tgl_pengiriman='$tgl_pengiriman_ubah' WHERE id_pemesanan='$_GET[id]'");
?> <script language="JavaScript">alert('Data Berhasil DiUpdate');</script><?php
header('location: ./data_pengiriman');
	
}


?>