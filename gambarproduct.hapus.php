<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : gambarproduct.hapus.php                                  #
#                                               Release Date  :                                                     #
#                                               Created       : 20/04/16 02.23                                      #
#                                               Last Modified : 22/04/16 01.08                                      #
#                                                                                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                                SIK BERKAITAN KARO LOGIN                                           #
#-------------------------------------------------------------------------------------------------------------------#

# Include Dari System
require ('../system/jenglot.php');

# Sudah Login Dan Menyimpan Session 

$sik=$_POST['sik'];



if ($sik=="gambar1") {

      $gambar1=$_POST['gambar1'];
      $kd_product=$_POST['kd_product'];
      $kd_categories=$_POST['kd_categories'];


      $mySql = "SELECT * FROM product WHERE kd_product='$kd_product' AND kd_categories='$kd_categories'";
      $myQry = mysql_query($mySql);
      $myData= mysql_fetch_array($myQry);

      $kosong="";
      unlink("../gallery/product/$myData[gambar1]");
      $queryjeng = mysql_query("UPDATE product SET gambar1='' WHERE kd_product='$kd_product' AND gambar1='$gambar1'") or die(mysql_error());

      header('location: ./product.edit?id='.$kd_product.'&kd_categories='.$kd_categories);
}

elseif ($sik=="gambar2") {
      $gambar2=$_POST['gambar2'];
      $kd_product=$_POST['kd_product'];
      $kd_categories=$_POST['kd_categories'];


      $mySql = "SELECT * FROM product WHERE kd_product='$kd_product' AND kd_categories='$kd_categories'";
      $myQry = mysql_query($mySql);
      $myData= mysql_fetch_array($myQry);

      $kosong="";
      unlink("../gallery/product/$myData[gambar2]");
      $queryjeng = mysql_query("UPDATE product SET gambar2='' WHERE kd_product='$kd_product' AND gambar2='$gambar2'") or die(mysql_error());

      header('location: ./product.edit?id='.$kd_product.'&kd_categories='.$kd_categories);

}

elseif ($sik=="gambar3") {
      $gambar3=$_POST['gambar3'];
      $kd_product=$_POST['kd_product'];
      $kd_categories=$_POST['kd_categories'];


      $mySql = "SELECT * FROM product WHERE kd_product='$kd_product' AND kd_categories='$kd_categories'";
      $myQry = mysql_query($mySql);
      $myData= mysql_fetch_array($myQry);

      $kosong="";
      unlink("../gallery/product/$myData[gambar3]");
      $queryjeng = mysql_query("UPDATE product SET gambar3='' WHERE kd_product='$kd_product' AND gambar3='$gambar3'") or die(mysql_error());

      header('location: ./product.edit?id='.$kd_product.'&kd_categories='.$kd_categories);

}

?>