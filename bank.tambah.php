    <?php
    #-------------------------------------------------------------------------------------------------------------------#
    #                                                     Information                                                   #
    #-------------------------------------------------------------------------------------------------------------------#
    #                                               Created By    : Fajar Nurrohmat                                     #
    #                                               Email         : Fajarnur24@gmail.com                                #
    #                                               Name File     : bank.tambah.php                               #
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

    <title>Tambah bank</title>
    
    <?php

    # MEMBUAT NILAI DATA PADA FORM
    # SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)

    $dataKode   = buatKode("bank", "BANK");
    $data_nama_bank= isset($_POST['nama_bank']) ?  $_POST['nama_bank'] : '';
    $data_no_rekening= isset($_POST['no_rekening']) ?  $_POST['no_rekening'] : '';
    $data_pemilik= isset($_POST['pemilik']) ?  $_POST['pemilik'] : '';


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
              Tambah Data bank
              <small>
                Manage Your Data bank
              </small>
            </h3>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Tambah Data <small>bank</small></h2>
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
    
                  $nama_bank= $_POST['nama_bank'];
                  $no_rekening = $_POST['no_rekening'];
                  $pemilik = $_POST['pemilik'];

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
      if (trim($nama_bank)=="") {
        $pesanError[] = "Data <b>Nama  bank</b> tidak boleh kosong !";    
      }
      if (trim($no_rekening)=="") {
        $pesanError[] = "Data <b>No Rekening bank</b> tidak boleh kosong !";    
      }
      if (trim($pemilik)=="") {
        $pesanError[] = "Data <b>Pemilik Rekening bank</b> tidak boleh kosong !";    
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
             $lokasi = '../assets/images/bank/';
             
             //$jeneng = $id_pegawai.'.jpg';

             $file = md5(rand(1000,1000000000))."-".$nama_foto;
             $newfilename = $file . $bagian_extensine;
             $jeneng=str_replace(' ','-',$file);
             $url = $lokasi . $jeneng;
             $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80); 
             $kodeBaru= buatKode("bank", "BANK");
             $query = mysql_query("INSERT INTO bank SET kd_bank='$kodeBaru', nama_bank='$nama_bank', no_rekening='$no_rekening', pemilik='$pemilik', foto='$jeneng' ") or die(mysql_error());
                

             }
             if ($query){
             header('location: ./bank');
              }
  else { $error = "Uploaded image should be jpg or gif or png"; } 

      }
    
    }
    ?>
    <form id="formbank" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
      <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_bank">Kode bank <span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="kd_bank" name="kd_bank" value="<?php echo $dataKode; ?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    
    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_bank">Nama bank <span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="nama_bak" value="<?php echo $data_nama_bank; ?>" name="nama_bank" required="required" class="form-control col-md-7 col-xs-12">
    </div>
    </div>
    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pemilik">Nama Pemilik Rekening<span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="pemilik" value="<?php echo $data_pemilik; ?>" name="pemilik" required="required" class="form-control col-md-7 col-xs-12">
    </div>
    </div>
    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_rekening">No Rekening<span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="no_rekening" value="<?php echo $data_no_rekening; ?>" name="no_rekening" required="required" class="form-control col-md-7 col-xs-12">
    </div>
    </div>
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
     var formbank = $("#formbank").serialize();
     var validator = $("#formbank").bootstrapValidator({
      framework: 'bootstrap',
      feedbackIcons: {
        valid: "fa fa-smile-o",
        invalid: "fa fa-frown-o", 
        validating: "glyphicon glyphicon-refresh"
      }, 
      excluded: [':disabled'],
      fields : {
       nama_bank : {
         validators: {
          notEmpty: {
           message: 'Nama bank Harus Diisi'
         },
       }
     },
     pemilik : {
       validators: {
        notEmpty: {
         message: 'nama pemilik rekening bank Harus Diisi'
       },
     }
    },
    no_rekening : {
         validators: {
          notEmpty: {
           message: 'No Rekening bank Harus Diisi'
         },
       }
     },
    file : {
      validators : {
        notEmpty: {
         message: 'Belum Memilih Gambar'
       },
       file : {
        extention : 'jpeg,jpg,png',
        type : 'image/jpeg,image/png',
              //maxSize : 2097152, //2048*1024
              message : 'file tidak benar'
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
