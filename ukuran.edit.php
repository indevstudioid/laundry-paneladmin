<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : ukuran.edit.php                                  #
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

<title>Edit Data Ukuran</title>

<?php 

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$kd_ukuran  = isset($_GET['id']) ?  $_GET['id'] : $_POST['kd_ukuran'];
$mySql = "SELECT * FROM ukuran WHERE kd_ukuran='$kd_ukuran'";
$myQry = mysql_query($mySql);
$myData= mysql_fetch_array($myQry);

  // Masukkan data ke variabel, untuk dibaca di form input
$kd_ukuran   = $myData['kd_ukuran'];
$data_nama_ukuran = isset($_POST['nama_ukuran']) ?  $_POST['nama_ukuran'] : $myData['nama_ukuran'];

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
          Edit Data Ukuran
          <small>
            Manage Your Data Ukuran
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Data <small>Ukuran</small></h2>
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
<?php 
# TOMBOL SIMPAN DIKLIK
if (isset($_POST['buttonsubmit'])) {

  #baca variabel 
//    menangkap $post nip dan mengamankan inputan dengan fungsi
//    trim, htmlspecialchars dan stripslashes
  $nama_ukuran  = htmlspecialchars(stripslashes(trim($_POST['nama_ukuran'])));
  $nama_ukuran  = strtoupper($nama_ukuran);
  $nama_ukuran  = preg_replace("[^a-zA-Z0-9]", "", $nama_ukuran);

 

  #VALIDASI UNTUK FORM JIKA FORM KOSONG

  $pesanError= array();
  if (trim($nama_ukuran)=="") {
    $pesanError[] = "Data <b>Nama Ukuran</b> tidak boleh kosong !";    
  }
  
  #JIKA ADA PESAN ERROR DARI VALIDASI FORM 
  if (count($pesanError)>=1) {
    echo "
    <div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    $noPesan= 0;
    foreach ($pesanError as $indeks => $pesan_tampil) {
      $noPesan++;
      echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
    }
    echo "</div><br />";
  }
  else{
    $kd_ukuran = $_POST['kd_ukuran'];
    #SIMPAN DATA KE DALAM DATABASE jika tidak menemukan error 
  $queryeditukuran = mysql_query("UPDATE ukuran SET nama_ukuran='$nama_ukuran'  WHERE kd_ukuran='$_GET[id]'") or die(mysql_error());

  if ($queryeditukuran){
    header('location: ./ukuran');
  }
 }
}
?>
           <form id="formukuran" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_ukuran">Kode ukuran <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nama_ukuran" name="nama_ukuran" value="<?php echo $kd_ukuran; ?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
          </div>
        </div>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_ukuran">Nama ukuran <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nama_ukuran" value="<?php echo $data_nama_ukuran; ?>" name="nama_ukuran" required="required" class="form-control col-md-7 col-xs-12">
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
 var formukuran = $("#formukuran").serialize();
 var validator = $("#formukuran").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "fa fa-smile-o",
    invalid: "fa fa-frown-o", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
 nama_ukuran : {
     validators: {
      notEmpty: {
       message: 'Nama Ukuran Harus Diisi'
     },
    regexp: {
      regexp: /^[a-zA-Z0-9 ]+$/,
      message: 'Karakter Yang Boleh Digunakan Huruf dan Angka'
    }
   }
 }
}
});

</script>

<?php

BagianFooterPanelAdmin();

NgisoraneJsDataTabel();
?>
