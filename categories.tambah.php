<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : categories.tambah.php                               #
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

<title>Tambah Kategori</title>
<?php

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)

$dataKode   = buatKode("categories", "KT");
$data_nama_categories = isset($_POST['nama_categories']) ?  $_POST['nama_categories'] : '';

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
          Tambah Data Kategori
          <small>
            Manage Your Data Kategori
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tambah Data <small>Kategori</small></h2>
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
  $nama_categories  = htmlspecialchars(stripslashes(trim($_POST['nama_categories'])));
  $nama_categories  = ucwords(strtolower($nama_categories));
  $nama_categories  = preg_replace("[^a-zA-Z0-9]", "", $nama_categories);

  $nama_file  = strtolower($nama_categories);
  $nama_file  = str_replace(" ","_",$nama_file); // Membuang karakter spasi
  $description= $_POST['description'];
   function compress_image($source_url, $destination_url, $quality) 
                  { 
                    $info = getimagesize($source_url); 
                    if ($info['mime'] == 'image/jpeg') 
                      $image = imagecreatefromjpeg($source_url); 
                    elseif ($info['mime'] == 'image/gif') 
                      $image = imagecreatefromgif($source_url); 
                    elseif ($info['mime'] == 'image/png') 
                      $image = imagecreatefrompng($source_url); 
                    imagejpeg($image, $destination_url, $quality); 
                    return $destination_url; 
                  } 

      $nama_foto = $_FILES["file"]["name"];
      $file_sik_dipilih = substr($nama_foto, 0, strripos($nama_foto, '.')); // strip extention
      $bagian_extensine = substr($nama_foto, strripos($nama_foto, '.')); // strip name
      $ukurane = $_FILES["file"]["size"];


  #VALIDASI UNTUK FORM JIKA FORM KOSONG

  $pesanError= array();
  if (trim($nama_categories)=="") {
    $pesanError[] = "Data <b>Nama Kategori</b> tidak boleh kosong !";    
  }
  if (trim($nama_file)=="") {
    $pesanError[]="Data <b>Nama File</b> Masih kosong !!";
  }
  if (trim($description)=="") {
    $pesanError[]="Data <b>description</b> Masih kosong !!";
  }
  if (empty($file_sik_dipilih)){
        $pesanError[] = "Anda Belum Memilih Foto !";    
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
  	 if(($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/pjpeg")){
             $lokasi = '../assets/admin/paneladmin/images/';
             
             //$jeneng = $id_pegawai.'.jpg';

             $file = md5(rand(1000,1000000000))."-".$nama_foto;
             $newfilename = $file . $bagian_extensine;
             $jeneng=str_replace(' ','-',$file);
             $url = $lokasi . $jeneng;
             $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80); 
    $kodeBaru= buatKode("categories", "KT");
    #SIMPAN DATA KE DALAM DATABASE jika tidak menemukan error 
    $querytambahcategories = mysql_query("INSERT INTO categories SET kd_categories='$kodeBaru', description='$description', nama_categories='$nama_categories', nama_file='$nama_file', foto='$jeneng'") or die(mysql_error());
}
             if ($querytambahcategories){
             header('location: ./categories');
              }
  else { $error = "Uploaded image should be jpg or gif or png"; } 

      }
 
}
?>
            <form id="formcategories" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
            <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Image <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="col-lg-8">
          <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/fileupload/images/nopict.jpg" alt="" /></div>
            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
            <div>
              <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" accept="image/*" name="file" id="file" placeholder="file" /></span>
              <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">Remove</a>
            </div>
          </div>
        </div>
      </div>
    </div>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_categories">Kode Categories <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nama_categories" name="nama_categories" value="<?php echo $dataKode; ?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
          </div>
        </div>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_categories">Nama Categories <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nama_categories" value="<?php echo $data_nama_categories; ?>" name="nama_categories" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>
         <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description Categories<span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="description" value="<?php echo $data_description; ?>" name="description" required="required" class="form-control col-md-7 col-xs-12">
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
 var formcategories = $("#formcategories").serialize();
 var validator = $("#formcategories").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "fa fa-smile-o",
    invalid: "fa fa-frown-o", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
 nama_categories : {
     validators: {
      notEmpty: {
       message: 'Nama Kategori Harus Diisi'
     },
      remote: {
      type: 'POST',
      url: '../remote/remote_categories.php',
      message: 'Data Kategori Sudah Tersedia/Ada'
    },
    regexp: {
      regexp: /^[a-zA-Z0-9 ]+$/,
      message: 'Karakter Yang Boleh Digunakan Huruf dan Angka'
    }
   }
 },
 description : {
       validators: {
        notEmpty: {
         message: 'Description slider Harus Diisi'
       },
     }
    },
  file : {
  validators : {
    notEmpty: {
     message: 'Belum Memilih Gambar'
   },
   file: {
    extension: 'jpeg,jpg,png',
    type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'File harus berupa gambar'
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
