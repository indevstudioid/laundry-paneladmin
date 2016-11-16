<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : kelurahan.hapus.php                                  #
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

  //Connection Database
  include "../inc/config.php";
  
  switch ($_POST['type']) {
    
    //Tampilkan Data 
    case "get":
      
    $SQL = mysql_query("SELECT * FROM provinsi, kabupaten, kecamatan, kelurahan 
      WHERE provinsi.id_prov=kabupaten.id_prov AND kabupaten.id_kab=kecamatan.id_kab AND kecamatan.id_kec=kelurahan.id_kec AND
      id_kel='".$_POST['id_kel']."'");
    $return = mysql_fetch_array($SQL,MYSQL_ASSOC);
    echo json_encode($return);
    break;  
    
    case "delete":
      
      $SQL = mysql_query("DELETE from kelurahan WHERE id_kel='".$_POST['id_kel']."'");
      if($SQL){
        echo json_encode("OK");
      }     
      break;
  } 
  
?>