<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : ongkos_kirim.hapus.php                              #
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
//mysql_query("DELETE from ongkos_kirim WHERE id_kec='$_GET[id]'");
//header('location: ./ongkos_kirim');

  //Connection Database
  include "../inc/config.php";
  if(empty($_GET[id])){

  switch ($_POST['type']) {
    
    //Tampilkan Data 
    case "get":
      
    $SQL = mysql_query("SELECT * FROM provinsi, kabupaten, kecamatan, ongkos_kirim WHERE provinsi.id_prov=kabupaten.id_prov AND kabupaten.id_kab=kecamatan.id_kab AND kecamatan.id_kec=ongkos_kirim.id_kec AND ongkos_kirim.id_kec  AND id_ongkos='".$_POST['id_ongkos']."'");
    $return = mysql_fetch_array($SQL,MYSQL_ASSOC);
    echo json_encode($return);
    break;
    
    
   case "delete":
      
      $SQL = mysql_query("DELETE from ongkos_kirim WHERE id_ongkos='".$_POST['id_ongkos']."'");
      if($SQL){
        echo json_encode("OK");
      }     
      break;
  } 
}
else {
mysql_query("DELETE from ongkos_kirim WHERE id_ongkos='$_GET[id]'");
header('location: ./ongkos_kirim');   
  
}
  
?>