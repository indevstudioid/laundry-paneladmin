<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : ukuran.tambah.php                               #
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

<title>Tambah Ukuran</title>
<?php

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)

$dataKode   = buatKode("ukuran", "SZ");
$data_nama_ukuran = isset($_POST['nama_ukuran']) ?  $_POST['nama_ukuran'] : '';

headfixdatatabel();
?>

<?php

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
          Tambah Data Ukuran
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
            <h2>Tambah Data <small>Ukuran</small></h2>
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
# baca variabel 
//    menangkap $post nip dan mengamankan inputan dengan fungsi
//    trim, htmlspecialchars dan stripslashes
  $nama_ukuran  = htmlspecialchars(stripslashes(trim($_POST['nama_ukuran'])));
  $nama_ukuran  = strtoupper($nama_ukuran);
  $nama_ukuran  = preg_replace("[^a-zA-Z0-9]", "", $nama_ukuran);
  $kd_categories=$_POST['kd_categories'];

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
    $kodeBaru= buatKode("ukuran", "SZ");
    #SIMPAN DATA KE DALAM DATABASE jika tidak menemukan error 
    $querytambahukuran = mysql_query("INSERT INTO ukuran SET kd_ukuran='$kodeBaru', kd_categories='$kd_categories', nama_ukuran='$nama_ukuran' ") or die(mysql_error());

  if ($querytambahukuran){
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
            <input type="text" id="nama_ukuran" name="nama_ukuran" value="<?php echo $dataKode; ?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
          </div>
        </div>
        <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_categories">categories <span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="kd_categories" name="kd_categories" required>
                  <option value="">-Pilih categories-</option>
                  <?php
                    //MENGAMBIL NAMA categories YANG DI DATABASE
                  $categories =mysql_query("SELECT * FROM categories ORDER BY nama_categories");
                  while ($datacategories=mysql_fetch_array($categories)) {
                   echo "<option value=\"$datacategories[kd_categories]\">$datacategories[nama_categories]</option>\n";
                 }
                 ?>
               </select>
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
  	kd_categories : {
     validators: {
      notEmpty: {
       message: 'Categories Harus Diisi'
     },
 },
 nama_ukuran : {
     validators: {
      notEmpty: {
       message: 'Nama Ukuran Harus Diisi'
     },
      remote: {
      type: 'POST',
      url: '../remote/remote_ukuran.php',
      message: 'Data Ukuran Sudah Tersedia/Ada'
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
