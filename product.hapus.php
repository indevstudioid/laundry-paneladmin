<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : product.hapus.php                                 #
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
$kd_product=$_REQUEST['kd_product'];
$gambarutama=$_REQUEST['gambarutama'];
$gambar1=$_REQUEST['gambar1'];
$gambar2=$_REQUEST['gambar2'];
$gambar3=$_REQUEST['gambar3'];



mysql_query("DELETE from product WHERE kd_product='$kd_product'");
unlink("../gallery/product/$gambarutama");
unlink("../gallery/product/$gambar1");
unlink("../gallery/product/$gambar2");
unlink("../gallery/product/$gambar3");
header('location: ./product');
?>