<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : kabupaten.hapus.php                                 #
#                                               Release Date  :                                                     #
#                                               Created       : 20/04/16 02.23                                      #
#                                               Last Modified : 22/04/16 01.08                                      #
#                                                                                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                                SIK BERKAITAN KARO LOGIN                                           #
#-------------------------------------------------------------------------------------------------------------------#

# Include Dari System
require ('../system/jenglot.php');
require ('../inc/admin/script_serverside.php');

session_start();
hakAksesKakakz();

cekTingkatUser(array(1));
//mysql_query("DELETE from kecamatan WHERE id_kec='$_GET[id]'");
//header('location: ./kecamatan');

  //Connection Database
  include "../inc/config.php";
  
  switch ($_POST['type']) {
    
    //Tampilkan Data 
    case "get":
      
    $SQL = mysql_query("SELECT * FROM
      kabupaten
      INNER JOIN provinsi ON kabupaten.id_prov = provinsi.id_prov WHERE id_kab='".$_POST['id_kab']."'");
    $return = mysql_fetch_array($SQL,MYSQL_ASSOC);
    echo json_encode($return);
    break;
    
    
    case "delete":
      
      $SQL = mysql_query("DELETE from kabupaten WHERE id_kab='".$_POST['id_kab']."'");
      if($SQL){
        echo json_encode("OK");
      }     
      break;
  } 
  
?>