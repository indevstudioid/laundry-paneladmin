<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : kecamatan.edit.php                                  #
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
# Sudah Login Dan Menyimpan Session 



DataMetaTabel();  ?>

<title>Data kecamatan</title>

<?php 

# TOMBOL SIMPAN DIKLIK
if (isset($_POST['buttonsubmit'])) {

  #baca variabel 
  $nama_kec  = $_POST['nama_kec'];
  $nama_kec  = str_replace("'","&acute;",$nama_kec);
  $nama_kec  = ucwords(strtolower($nama_kec));

  $id_kab  = $_POST['id_kab'];
  $id_kab  = str_replace("'","&acute;",$id_kab);

  $kota  = $_POST['kota'];
  $kota  = str_replace("'","&acute;",$kota);

  $prov  = $_POST['prov'];
  $prov  = str_replace("'","&acute;",$prov);

  #VALIDASI UNTUK FORM JIKA FORM KOSONG

  $pesanError= array();
  if (trim($prov)=="") {
    $pesanError[] = "Data <b>provinsi</b> tidak boleh kosong !";    
  }
  if (trim($kota)=="") {
    $pesanError[]="Data <b>Kabupaten</b> Masih kosong !!";
  }
   if (trim($nama_kec)=="") {
    $pesanError[]="Data <b>kecamatan</b> Masih kosong !!";
  }

  #JIKA ADA PESAN ERROR DARI VALIDASI FORM 
  if (count($pesanError)>=1) {
    echo "<div class='mssgBox'>";
    echo "<img src ='../images/attention.png'><br><hr>";
    $noPesan= 0;
    foreach ($pesanError as $indeks => $pesan_tampil) {
      $noPesan++;
      echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
    }
    echo "</div><br />";
  }
  else{

    #UPDATE DATA KE DALAM DATABASE jika tidak menemukan error 
   $query = mysql_query("UPDATE kecamatan SET id_kab='$kota', nama_kec='$nama_kec' WHERE id_kec='$_GET[id]'") or die(mysql_error());

   if ($query){
    header('location: ./kecamatan');
  }
}
}
# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM
  kecamatan
  INNER JOIN kabupaten ON kabupaten.id_kab = kecamatan.id_kab
  INNER JOIN provinsi ON kabupaten.id_prov = provinsi.id_prov WHERE id_kec='$_GET[id]'");
$rowks  = mysql_fetch_array($edit);



headfixdatatabel();
?>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=prov>
  $("#prov").change(function(){
    var prov = $("#prov").val();
    $.ajax({
        url: "../inc/jikuk_kabupaten.php",
        data: "prov="+prov,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
  $("#kota").change(function(){
    var kota = $("#kota").val();
    $.ajax({
        url: "../inc/jikuk_kecamatan.php",
        data: "kota="+kota,
        cache: false,
        success: function(msg){
            $("#id_kec").html(msg);
        }
    });
  });
});

</script>

<?php
script_kecamatan();

validator();

BagianSideBarPanelAdmin();

BagianTopNavi();

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">

        <h3>
          Data Kecamatan
          <small>
            Manage Your Data Kecamatan
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Data <small>Kecamatan</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              Isi Data Dengan Benar
            </p>

            <form id="formkecamatan" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

             <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prov">Provinsi <span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="prov" name="prov" value="" required>
                  <option value="">-Pilih Provinsi-</option>
                  <?php
                    //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
                  $provinsi =mysql_query("SELECT * FROM provinsi ORDER BY nama_prov");
                  while ($dataprovinsi=mysql_fetch_array($provinsi)) {
                   if ($dataprovinsi['id_prov']==$rowks['id_prov']) {
                     $cek ="selected";
                   }
                   else{
                    $cek= "";
                  }
                  echo "<option value=\"$dataprovinsi[id_prov]\" $cek>$dataprovinsi[nama_prov]</option>\n";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kota">Kabupaten <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="kota" name="kota" value="" required>
              <option value="">-Pilih Kabupaten-</option>
              <?php
                    //MENGAMBIL NAMA kabupaten YANG DI DATABASE
              $kabupaten =mysql_query("SELECT * FROM kabupaten WHERE id_prov=$rowks[id_prov] ORDER BY nama_kab");
              while ($datakabupaten=mysql_fetch_array($kabupaten)) {
               if ($datakabupaten['id_kab']==$rowks['id_kab']) {
                 $cek ="selected";
               }
               else{
                $cek= "";
              }
              echo "<option value=\"$datakabupaten[id_kab]\" $cek>$datakabupaten[nama_kab]</option>\n";
            }
            ?>
          </select>
        </div>
      </div>

      <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_kec">Kecamatan <span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="nama_kec" name="nama_kec" value="<?php echo $rowks['nama_kec'];?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>

    <div style="text-align:center" class="form-actions no-margin-bottom">
     <button type="submit" id="buttonsubmit" name="buttonsubmit" class="btn btn-success">Submit</button>
   </div>
 </form>
</div>
</div>
</div>
</div>
</div>


<script type="text/javascript">


 var formkecamatan = $("#formkecamatan").serialize();
 var validator = $("#formkecamatan").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    id_prov : {
     validators: {
      notEmpty: {
       message: 'Harus Pilih Provinsi'
     }
   }
 }, 
 id_kab : {
   validators: {
    notEmpty: {
     message: 'Harus Pilih Kabupaten'
   }
 }
}, 
nama_kec: {
  message: 'Nama Kecamatan Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Nama Kecamatan Harus Diisi'
    },
    stringLength: {
      min: 1,
      max: 30,
      message: 'Nama Kecamatan Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
    },
    regexp: {
       regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Yang Boleh Digunakan (Angka, Huruf, Titik, Underscore'
    },

  }
}

}
});

</script>


<?php

BagianFooterPanelAdmin();

NgisoraneJsDataTabel();
?>
