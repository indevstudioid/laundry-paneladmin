<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : provinsi.tambah.php                                #
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
# Sudah Login Dan Menyimpan Session 

DataMetaTabel();  ?>

<title>Tambah Provinsi</title>

<?php 
# TOMBOL SIMPAN DIKLIK
if (isset($_POST['buttonsubmit'])) {

  #baca variabel 
  $nama_prov  = $_POST['nama_prov'];
  $nama_prov  = str_replace("'","&acute;",$nama_prov);
  $nama_prov  = ucwords(strtolower($nama_prov));

  #VALIDASI UNTUK FORM JIKA FORM KOSONG

  $pesanError= array();
  if (trim($nama_prov)=="") {
    $pesanError[]="Data <b>Provinsi</b> Masih kosong !!";
  }

  //VALIDASI nama kota, tidak boleh ada nama kota yang sama
  $cekSql ="SELECT * FROM provinsi WHERE nama_prov='$nama_prov'";
  $cekQry = mysql_query($cekSql) or die("Error Query:".mysql_error());
  if (mysql_num_rows($cekQry)>=1) {
    $pesanError[]= "Maaf, provinsi <b>$nama_prov</b> Sudah Ada, ganti dengan nama lain";
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

    #SIMPAN DATA KE DALAM DATABASE jika tidak menemukan error 
    $querytambahprovinsi = mysql_query("INSERT INTO provinsi (id_prov, nama_prov) 
    VALUES ( '' , '$nama_prov' )") or die(mysql_error());

  if ($querytambahprovinsi){
    header('location: ./provinsi');
  }
 }
}
# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)

$dataprovinsi  = isset($_POST['nama_prov']) ? $_POST['nama_prov'] : '';



headfixdatatabel();

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
          Tambah Data provinsi
          <small>
            Manage Your Data provinsi
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tambah Data <small>provinsi</small></h2>
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

            <form id="formprovinsi" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

         <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_prov">provinsi <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nama_prov" name="nama_prov" value="<?php echo $dataprovinsi; ?>" required="required" class="form-control col-md-7 col-xs-12">
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


 var formprovinsi = $("#formprovinsi").serialize();
 var validator = $("#formprovinsi").bootstrapValidator({
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
nama_prov: {
  message: 'Nama provinsi Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Nama provinsi Harus Diisi'
    },
    stringLength: {
      min: 1,
      max: 30,
      message: 'Nama provinsi Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
    },
    regexp: {
      regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Yang Boleh Digunakan (Angka, Huruf, Titik, Underscore'
    },
    remote: {
      type: 'POST',
      url: '../remote/remote_provinsi.php',
      message: 'Nama provinsi Sudah Tersedia'
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
