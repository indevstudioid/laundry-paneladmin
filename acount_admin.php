    <?php
    #-------------------------------------------------------------------------------------------------------------------#
    #                                                     Information                                                   #
    #-------------------------------------------------------------------------------------------------------------------#
    #                                               Created By    : Fajar Nurrohmat                                     #
    #                                               password_ulangi         : Fajarnur24@gmail.com                                #
    #                                               Name File     : acount_admin.php                               #
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

    <title>Edit acount Admin</title>
    
    <?php

    # MEMBUAT NILAI DATA PADA FORM
    # SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)

    $dataKode   = buatKode("admin", "admin");
    $data_password_lama= isset($_POST['password_lama']) ?  $_POST['password_lama'] : '';
    $data_password_baru= isset($_POST['password_baru']) ?  $_POST['password_baru'] : '';
    $data_password_ulangi= isset($_POST['password_ulangi']) ?  $_POST['password_ulangi'] : '';
    
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
              Edit Data acount Admin
              <small>
                Manage Your Data acount Admin
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
              $passwordasli=$_POST['password_baru'];
              $password_baruasli=$_POST['password_baru'];
              $password_baru=md5($_POST['password_baru'],"g4r4m");
                  
                  $password_lama = $_POST['password_lama'];
                  $username = $_POST['username'];
                  
                  $password_ulangiasli = $_POST['password_ulangi'];
                  $password_ulangi=md5($_POST['password_baru'],"g4r4m");
      #VALIDASI UNTUK FORM JIKA FORM KOSONG

                  

      $pesanError= array();
      if (trim($username)=="") {
        $pesanError[] = "Data <b>Username</b> tidak boleh kosong !";    
      }
      if (trim($password_lama)=="") {
        $pesanError[] = "Data <b>Password Lama</b> tidak boleh kosong !";    
      }
      if (trim($password_baruasli)=="") {
        $pesanError[] = "Data <b>Password Baru</b> tidak boleh kosong !";    
      }
      if (trim($password_ulangi)=="") {
        $pesanError[] = "Data <b>Konfirmasi Password Baru</b> tidak boleh kosong !";    
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
          $r=mysql_fetch_array(mysql_query("SELECT * FROM admin"));
              if ($password_lama==$r['password_asli']){
                // Pastikan bahwa password baru yang dimasukkan sebanyak dua kali sudah cocok
                if ($_POST[password_baruasli]==$_POST[password_ulangiasli]){
                  mysql_query("UPDATE admin SET username='$username',  password = '$password_baru', password_asli='$password_baruasli' ");
                  echo "<script>alert('Update Account Berhasil'); window.location = './logout'</script>";
                }
                else{
                echo "<script>alert('Password baru yang anda masukkan tidak sama'); window.location = './acount_admin'</script>";
                }
              }
              else{
              echo "<script>alert('Password Lama anda salah'); window.location = './acount_admin'</script>";
              }
              }
    
    }
    ?>
    <form id="formadmin" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
    <div class="alert alert-info" role="alert" id="removeWarning">
      <span class="glyphicon " aria-hidden="true"></span>
      <span class="sr-only"></span>
      Data Acount
    </div>
    <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="username" name="username" required value="<?php echo $myData['username'] ?>"  class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password Lama<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="password" id="password_lama" name="password_lama" required   class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password Baru<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="password" id="password_baru" name="password_baru" required   class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password1">Konfirmasi Password Baru <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="password" id="password_ulangi" name="password_ulangi"  required class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <input type="hidden" id="pass" name="pass" value="<?php echo $myData['password_asli'] ?>"  required class="form-control col-md-7 col-xs-12">

    
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
       username: {
        message: 'Data username Tidak Benar',
        validators: {
          notEmpty: {
            message: 'username Harus Diisi'
          },
          stringLength: {
            min: 1,
            max: 30,
            message: 'Nama username Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
          },
          different: {
            field: 'password_baru',
            message:'Harus Beda dengan Password'
          },          
        }
      },
password_lama: {
        message: 'Data Password Tidak Benar',
        validators: {
          identical:{
            field:'pass',
            message: 'Password Lama Tidak Sama'
          },
          notEmpty: {
            message: 'Password Harus Diisi'
          },
          stringLength: {
            min: 1,
            max: 30,
            message: 'Nama password Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
          },
          different: {
            field: 'username',
            message:'Password Harus Beda dengan username'
          },          
        }
      },
      password_baru: {
        message: 'Data Password Tidak Benar',
        validators: {
          identical:{
            field:'password_ulangi',
            message: 'Konfirmasi Password Harus Sama Dengan Password'
          },
          notEmpty: {
            message: 'Password Harus Diisi'
          },
          stringLength: {
            min: 1,
            max: 30,
            message: 'Nama password Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
          },
          different: {
            field: 'username',
            message:'Password Harus Beda dengan username'
          },
        }
      },
      password_ulangi: {
        message: 'Data Password Tidak Benar',
        validators: {
          identical:{
            field:'password_baru',
            message: 'Konfirmasi Password Harus Sama Dengan Password'
          },
          notEmpty: {
            message: 'Password Harus Diisi'
          },
          stringLength: {
            min: 1,
            max: 30,
            message: 'Nama password Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
          },
          different: {
            field: 'username',
            message:'Password Harus Beda dengan username'
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
