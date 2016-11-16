<?php
include_once "../inc/config.php";
$kota = $_GET['kota'];
$kec = mysql_query("SELECT id_kec,nama_kec FROM Kecamatan WHERE id_kab='$kota' order by nama_kec");
echo "<option>-- Pilih Kecamatan --</option>";
while($k = mysql_fetch_array($kec)){
    echo "<option value=\"".$k['id_kec']."\">".$k['nama_kec']."</option>\n";
}
?>