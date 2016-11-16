    <?php
    #-------------------------------------------------------------------------------------------------------------------#
    #                                                     Information                                                   #
    #-------------------------------------------------------------------------------------------------------------------#
    #                                               Created By    : Fajar Nurrohmat                                     #
    #                                               Email         : Fajarnur24@gmail.com                                #
    #                                               Name File     : profile_admin.php                               #
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

    <title>Edit Profile Admin</title>
    
    <?php

    # MEMBUAT NILAI DATA PADA FORM
    # SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)

    $dataKode   = buatKode("admin", "admin");
    $data_nama_lengkap= isset($_POST['nama_lengkap']) ?  $_POST['nama_lengkap'] : '';
    $data_no_telp= isset($_POST['no_telp']) ?  $_POST['no_telp'] : '';
    $data_email= isset($_POST['email']) ?  $_POST['email'] : '';
    
$mySql = "SELECT * FROM admin ";
$myQry = mysql_query($mySql);
$myData= mysql_fetch_array($myQry);
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
              Edit Data Profile Admin
              <small>
                Manage Your Data Profile Admin
              </small>
            </h3>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Edit Data <small>admin</small></h2>
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
    
                  $nama_lengkap= $_POST['nama_lengkap'];
                  $no_telp = $_POST['no_telp'];
                  $email = $_POST['email'];
                  
      #VALIDASI UNTUK FORM JIKA FORM KOSONG

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

      $pesanError= array();
      if (trim($nama_lengkap)=="") {
        $pesanError[] = "Data <b>Nama  admin</b> tidak boleh kosong !";    
      }
      if (trim($no_telp)=="") {
        $pesanError[] = "Data <b>No Telp admin</b> tidak boleh kosong !";    
      }
      if (trim($email)=="") {
        $pesanError[] = "Data <b>email  admin</b> tidak boleh kosong !";    
      }
      if (empty($nama_foto)){
        $queryjeng = mysql_query("UPDATE admin SET nama_lengkap='$nama_lengkap', no_telp='$no_telp', email='$email' ") or die(mysql_error());
      header('location: ./dashboard');
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
             $lokasi = '../assets/admin/paneladmin/profile-admin/';
             
             //$jeneng = $id_pegawai.'.jpg';

             $file = md5(rand(1000,1000000000))."-".$nama_foto;
             $newfilename = $file . $bagian_extensine;
             $jeneng=str_replace(' ','-',$file);
             $url = $lokasi . $jeneng;
             $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80); 
             
             $query = mysql_query("UPDATE admin SET nama_lengkap='$nama_lengkap', no_telp='$no_telp', email='$email', foto='$jeneng' ") or die(mysql_error());
                

             }
             if ($query){
              unlink("../assets/admin/paneladmin/profile-admin/$myData[foto]");
             header('location: ./dashboard');
              }
  else { $error = "Uploaded image should be jpg or gif or png"; } 

      }
    
    }
    ?>
    <form id="formadmin" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
    <div class="alert alert-info" role="alert" id="removeWarning">
      <span class="glyphicon " aria-hidden="true"></span>
      <span class="sr-only"></span>
      Data Pribadi
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Image <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="col-lg-8">
          <div class="fileupload fileupload-new" data-provides="fileupload">
            <?php if (!empty($myData['foto'])) { ?>
              <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/admin/paneladmin/profile-admin/<?php echo $myData['foto']; ?>" alt=""></div>

              <?php } else{ ?>
              <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/fileupload/images/nopict.jpg" alt=""></div>
              <?php } ?>
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
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_lengkap">Nama Lengkap <span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="nama_bak" value="<?php echo $myData['nama_lengkap'] ?>" name="nama_lengkap" required="required" class="form-control col-md-7 col-xs-12">
    </div>
    </div>
    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="email" value="<?php echo $myData['email'] ?>" name="email" required="required" class="form-control col-md-7 col-xs-12">
    </div>
    </div>
    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_telp">No Telpon<span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="no_telp" value="<?php echo $myData['no_telp'] ?>" name="no_telp" required="required" class="form-control col-md-7 col-xs-12">
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
     var formadmin = $("#formadmin").serialize();
     var validator = $("#formadmin").bootstrapValidator({
      framework: 'bootstrap',
      feedbackIcons: {
        valid: "fa fa-smile-o",
        invalid: "fa fa-frown-o", 
        validating: "glyphicon glyphicon-refresh"
      }, 
      excluded: [':disabled'],
      fields : {
       nama_lengkap : {
         validators: {
          notEmpty: {
           message: 'Nama admin Harus Diisi'
         },
       }
     },
     email : {
       validators: {
        notEmpty: {
         message: 'nama email rekening admin Harus Diisi'
       },
     }
    },
    no_telp : {
         validators: {
          notEmpty: {
           message: 'No Rekening admin Harus Diisi'
         },
       }
     },

      }
    });

    </script>

    <?php

    BagianFooterPanelAdmin();

    NgisoraneJsDataTabel();
    ?>
