    <?php
    #-------------------------------------------------------------------------------------------------------------------#
    #                                                     Information                                                   #
    #-------------------------------------------------------------------------------------------------------------------#
    #                                               Created By    : Fajar Nurrohmat                                     #
    #                                               Email         : Fajarnur24@gmail.com                                #
    #                                               Name File     : product.edit.php                               #
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

    <title>Edit product</title>

    <?php

    # MEMBUAT NILAI DATA PADA FORM
    # SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)


    $data_nm_product= isset($_POST['nm_product']) ?  $_POST['nm_product'] : '';
    $data_description= isset($_POST['description']) ?  $_POST['description'] : '';
    $data_harga= isset($_POST['harga']) ?  $_POST['harga'] : '';
    $data_discount= isset($_POST['discount']) ?  $_POST['discount'] : '';
    $data_kd_categories= isset($_POST['kd_categories']) ?  $_POST['kd_categories'] : '';



    $kd_product=$_GET['id'];
    $kd_categories=$_GET['kd_categories'];

    $mySql = "SELECT * FROM product , detail_product WHERE detail_product.kd_product=product.kd_product AND detail_product.kd_product='$_GET[id]' ";
    $myQry = mysql_query($mySql);
    $myData= mysql_fetch_array($myQry);

    $harga_modal=$myData['harga_modal'];
    $harga_modal= number_format($harga_modal,0,',','.');

    $harga=$myData['harga'];
    $harga= number_format($harga,0,',','.');

    $berat=$myData['berat'];
    $berat= number_format($berat,0,',','.');

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
              Edit Data product
              <small>
                Manage Your Data product
              </small>
            </h3>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Edit Data <small>product</small></h2>
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
                  function convertToAngka($rupiah)
                  {
                    $int = ereg_replace("[^0-9]", "", $rupiah); 
                    return $int;
                  }


                  $nm_product= $_POST['nm_product'];
                  $description= $_POST['description'];
                  $kd_categories=$_GET['kd_categories'];
                  $description= $_POST['description'];
                  $review  = $_POST['review'];
                  $stock=$_POST['stock']; 
                  $kd_ukuran=$_POST['kd_ukuran'];
                  $jumlahukuran=count($kd_ukuran);
                  $kd_product=$_POST['kd_product'];
                  
                  

                  $harga  = $_POST['harga'];
                  $harga  = htmlspecialchars(stripslashes(trim($_POST['harga'])));
                  $harga  = preg_replace("/[^0-9]/", "", $harga);

                  $harga_modal  = $_POST['harga_modal'];
                  $harga_modal  = htmlspecialchars(stripslashes(trim($_POST['harga_modal'])));
                  $harga_modal  = preg_replace("/[^0-9]/", "", $harga_modal);

                  $berat  = $_POST['berat'];
                  $berat  = htmlspecialchars(stripslashes(trim($_POST['berat'])));
                  $berat  = preg_replace("/[^0-9]/", "", $berat);

                  $discount= $_POST['discount'];

                  $jj=$discount / 100 * $harga;
                  $harga_discount=$harga-$jj;
                  $tgl  =date('Y-m-d');

                  $queryproduct="SELECT *FROM product, categories WHERE product.kd_categories=categories.kd_categories AND kd_categories='$kd_categories'";
                  $exeproduct=mysql_query($queryproduct);
                  $dataproduct=mysql_fetch_array($exeproduct); 
                  $kat=$dataproduct['nama_file'];

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

    //gambar utama
                  $nama_foto = $_FILES["file"]["name"];
      $file_sik_dipilih = substr($nama_foto, 0, strripos($nama_foto, '.')); // strip extention
      $bagian_extensine = substr($nama_foto, strripos($nama_foto, '.')); // strip name
      $ukurane = $_FILES["file"]["size"];

//gambar 1
      $nama_foto1 = $_FILES["file1"]["name"];
      $file_sik_dipilih1 = substr($nama_foto1, 0, strripos($nama_foto1, '.')); // strip extention
      $bagian_extensine1 = substr($nama_foto1, strripos($nama_foto1, '.')); // strip name
      $ukurane1 = $_FILES["file1"]["size"];
//gambar 2
      $nama_foto2 = $_FILES["file2"]["name"];
      $file_sik_dipilih2 = substr($nama_foto2, 0, strripos($nama_foto2, '.')); // strip extention
      $bagian_extensine2 = substr($nama_foto2, strripos($nama_foto2, '.')); // strip name
      $ukurane2 = $_FILES["file2"]["size"];

//gambar 3
      $nama_foto3 = $_FILES["file3"]["name"];
      $file_sik_dipilih3 = substr($nama_foto3, 0, strripos($nama_foto3, '.')); // strip extention
      $bagian_extensine3 = substr($nama_foto3, strripos($nama_foto3, '.')); // strip name
      $ukurane3 = $_FILES["file3"]["size"];

      $pesanError= array();
      if (trim($nm_product)=="") {
        $pesanError[] = "Data <b>Nama Title product</b> tidak boleh kosong !";    
      }
      if (trim($kd_categories)=="") {
        $pesanError[] = "Data <b>Description product</b> tidak boleh kosong !";    
      }
      
      if (trim($harga)=="") {
        $pesanError[] = "Data <b>Harga product</b> tidak boleh kosong !";    
      }
      if (trim($harga_modal)=="") {
        $pesanError[] = "Data <b>Harga Modal product</b> tidak boleh kosong !";    
      }
      if (trim($berat)=="") {
        $pesanError[] = "Data <b>Description product</b> tidak boleh kosong !";    
      }
      if (trim($description)=="") {
        $pesanError[] = "Data <b>Description product</b> tidak boleh kosong !";    
      }
      if (trim($review)=="") {
        $pesanError[] = "Data <b>Description product</b> tidak boleh kosong !";    
      }

      if (empty($nama_foto)){

        if (!empty($nama_foto1) && ($_FILES["file1"]["type"] == "image/gif") || ($_FILES["file1"]["type"] == "image/jpeg") || ($_FILES["file1"]["type"] == "image/png") || ($_FILES["file1"]["type"] == "image/pjpeg")) {

         $lokasi1 = '../gallery/product/';
         $file1 = md5(rand(1000,1000000000))."-".md5($nama_foto1);
         $newfilename1 = $file1 . $bagian_extensine1;
         $jeneng1=str_replace(' ','-',$file1);

         $url1 = $lokasi1 . $newfilename1;
         $filename1 = compress_image($_FILES["file1"]["tmp_name"], $url1, 80);     
         unlink("../gallery/product/$myData[gambar1]");
         $query = mysql_query("UPDATE product SET gambar1='$newfilename1' WHERE kd_product='$kd_product' ") or die(mysql_error());
       }
       if (!empty($nama_foto2) && ($_FILES["file2"]["type"] == "image/gif") || ($_FILES["file2"]["type"] == "image/jpeg") || ($_FILES["file2"]["type"] == "image/png") || ($_FILES["file2"]["type"] == "image/pjpeg")) {

         $lokasi2 = '../gallery/product/';
         $file2 = md5(rand(1000,1000000000))."-".md5($nama_foto2);
         $newfilename2 = $file2 . $bagian_extensine2;
         $jeneng2=str_replace(' ','-',$file2);

         $url2 = $lokasi2 . $newfilename2;
         $filename2 = compress_image($_FILES["file2"]["tmp_name"], $url2, 80); 
         unlink("../gallery/product/$myData[gambar2]");
         $query = mysql_query("UPDATE product SET gambar2='$newfilename2' WHERE kd_product='$kd_product' ") or die(mysql_error());
       }
          //GAMBAR 3
       if (!empty($nama_foto3) && ($_FILES["file3"]["type"] == "image/gif") || ($_FILES["file3"]["type"] == "image/jpeg") || ($_FILES["file3"]["type"] == "image/png") || ($_FILES["file3"]["type"] == "image/pjpeg")){

         $lokasi3 = '../gallery/product/';
         $file3 = md5(rand(1000,1000000000))."-".md5($nama_foto3);
         $newfilename3 = $file3 . $bagian_extensine3;
         $jeneng3=str_replace(' ','-',$file3);

         $url3 = $lokasi3 . $newfilename3;
         $filename3 = compress_image($_FILES["file3"]["tmp_name"], $url3, 80); 
         unlink("../gallery/product/$myData[gambar3]");
         $query = mysql_query("UPDATE product SET gambar3='$newfilename3' WHERE kd_product='$kd_product' ") or die(mysql_error());

       }

       $query = mysql_query("UPDATE product SET kd_categories='$kd_categories', nm_product='$nm_product',  description='$description', harga_modal='$harga_modal', harga='$harga', discount='$discount', tgl='$tgl', berat='$berat', review='$review', harga_discount='$harga_discount' WHERE kd_product='$kd_product' ") or die(mysql_error());


       foreach($stock as $ukur => $stock_value) { 
        $queryeditproductdetail =  mysql_query("UPDATE detail_product SET  stock='$stock_value' WHERE kd_product='$kd_product' AND kd_ukuran='$ukur' LIMIT 1 ") or die(mysql_error());            
      }
      header('location: ./product');

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




//GAMBAR UTAMA     
       if(($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/pjpeg")){
         $lokasi = '../gallery/product/';
         $file = md5(rand(1000,1000000000))."-".md5($nama_foto);
         $newfilename = $file . $bagian_extensine;
         $jeneng=str_replace(' ','-',$file);
         $url = $lokasi . $newfilename;
         $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80); 

             if (!empty($nama_foto1) && ($_FILES["file1"]["type"] == "image/gif") || ($_FILES["file1"]["type"] == "image/jpeg") || ($_FILES["file1"]["type"] == "image/png") || ($_FILES["file1"]["type"] == "image/pjpeg")) {

               $lokasi1 = '../gallery/product/';
               $file1 = md5(rand(1000,1000000000))."-".md5($nama_foto1);
               $newfilename1 = $file1 . $bagian_extensine1;
               $jeneng1=str_replace(' ','-',$file1);

               $url1 = $lokasi1 . $newfilename1;
               $filename1 = compress_image($_FILES["file1"]["tmp_name"], $url1, 80);     
               unlink("../gallery/product/$myData[gambar1]");
               $query = mysql_query("UPDATE product SET gambar1='$newfilename1' WHERE kd_product='$kd_product' ") or die(mysql_error());
             }
             if (!empty($nama_foto2) && ($_FILES["file2"]["type"] == "image/gif") || ($_FILES["file2"]["type"] == "image/jpeg") || ($_FILES["file2"]["type"] == "image/png") || ($_FILES["file2"]["type"] == "image/pjpeg")) {

               $lokasi2 = '../gallery/product/';
               $file2 = md5(rand(1000,1000000000))."-".md5($nama_foto2);
               $newfilename2 = $file2 . $bagian_extensine2;
               $jeneng2=str_replace(' ','-',$file2);

               $url2 = $lokasi2 . $newfilename2;
               $filename2 = compress_image($_FILES["file2"]["tmp_name"], $url2, 80); 
               unlink("../gallery/product/$myData[gambar2]");
               $query = mysql_query("UPDATE product SET gambar2='$newfilename2' WHERE kd_product='$kd_product' ") or die(mysql_error());
             }
              //GAMBAR 3
             if (!empty($nama_foto3) && ($_FILES["file3"]["type"] == "image/gif") || ($_FILES["file3"]["type"] == "image/jpeg") || ($_FILES["file3"]["type"] == "image/png") || ($_FILES["file3"]["type"] == "image/pjpeg")){

               $lokasi3 = '../gallery/product/';
               $file3 = md5(rand(1000,1000000000))."-".md5($nama_foto3);
               $newfilename3 = $file3 . $bagian_extensine3;
               $jeneng3=str_replace(' ','-',$file3);

               $url3 = $lokasi3 . $newfilename3;
               $filename3 = compress_image($_FILES["file3"]["tmp_name"], $url3, 80); 
               unlink("../gallery/product/$myData[gambar3]");
               $query = mysql_query("UPDATE product SET gambar3='$newfilename3' WHERE kd_product='$kd_product' ") or die(mysql_error());

             }

         //}
         //else { $pesanError[] = "File Yang Bisa Di Upload Berupa Image (.jpg .jpeg .png) !"; }
         $queryubah = mysql_query("UPDATE product SET kd_categories='$kd_categories', gambarutama='$newfilename', nm_product='$nm_product', description='$description', harga_modal='$harga_modal', harga='$harga', discount='$discount', tgl='$tgl', berat='$berat', review='$review', harga_discount='$harga_discount' WHERE kd_product='$kd_product' ") or die(mysql_error());




//GAMBAR1  
       }
       if ($queryubah){
        unlink("../gallery/product/$myData[gambarutama]");
        header('location: ./product');
        foreach($stock as $ukur => $stock_value) { 
          $queryeditproductdetail =  mysql_query("UPDATE detail_product SET  stock='$stock_value' WHERE kd_product='$kd_product' AND kd_ukuran='$ukur' LIMIT 1 ") or die(mysql_error());            
        }
      }
      else { $error = "Uploaded image should be jpg or gif or png"; } 

    }





  }

  ?>
  <form id="formproduct" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_product">Kode product <span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="kd_product" name="kd_product" value="<?php echo $myData['kd_product']; ?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="">
          <div class="">
            <label>Gambar Utama</label>
            <div class="fileupload fileupload-new" data-provides="fileupload">
              <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../gallery/product/<?php echo $myData['gambarutama']; ?>" alt=""></div>
              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 150px;"></div>
              <div>
                <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" accept="image/*" name="file" id="file" placeholder="file"></span>
                
                <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">Remove</a>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="">
          <div class="">
            <label>Gambar 1</label>
            <div class="fileupload fileupload-new" data-provides="fileupload">
              <?php if (!empty($myData['gambar1'])) { ?>
              <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../gallery/product/<?php echo $myData['gambar1']; ?>" alt=""></div>

              <?php } else{ ?>
              <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/fileupload/images/nopict.jpg" alt=""></div>
              <?php } ?>
              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 150px;"></div>
              <div>
                <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span>
                <span class="fileupload-exists">Change</span><input type="file" value="asdasd" accept="image/*" name="file1" id="file1" placeholder="file2"></span>
                <?php if (!empty($myData['gambar1'])) { ?>
                <a data-toggle="modal"class="btn btn-danger btn-xs " data-target="#hapusimage1">Remove</a>
                <?php } else{ ?>
                <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">Remove</a>
                <?php } ?>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="">
          <div class="">
            <label>Gambar 2</label>
            <div class="fileupload fileupload-new" data-provides="fileupload">
              <?php if (!empty($myData['gambar2'])) { ?>
              <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../gallery/product/<?php echo $myData['gambar2']; ?>" alt=""></div>
              <?php } else{ ?>
              <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/fileupload/images/nopict.jpg" alt=""></div>
              <?php } ?>
              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 150px;"></div>
              <div>
                <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" accept="image/*" name="file2" id="file2" placeholder="file2"></span>
                <?php if (!empty($myData['gambar2'])) { ?>
                <a data-toggle="modal"class="btn btn-danger btn-xs " data-target="#hapusimage2">Remove</a>
                <?php } else{ ?>
                <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">Remove</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="">
          <div class="">
            <label>Gambar 3</label>
            <div class="fileupload fileupload-new" data-provides="fileupload">
             <?php if (!empty($myData['gambar3'])) { ?>
             <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../gallery/product/<?php echo $myData['gambar3']; ?>" alt=""></div>
             <?php } else{ ?>
             <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/fileupload/images/nopict.jpg" alt=""></div>
             <?php } ?>
             <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 150px;"></div>
             <div>
              <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" accept="image/*" name="file3" id="file3" placeholder="file3"></span>
              <?php if (!empty($myData['gambar3'])) { ?>
                <a data-toggle="modal"class="btn btn-danger btn-xs " data-target="#hapusimage3">Remove</a>
                <?php } else{ ?>
                <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">Remove</a>
                <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm__product">Nama Product <span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="nm_product" name="nm_product" value="<?php echo $myData['nm_product']; ?>" required="required" class="form-control col-md-7 col-xs-12">
</div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga_modal">Harga Modal<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="input-group">
      <span class="input-group-addon">Rp.</span>
      <input id="harga_modal" onkeyup="convertToRupiah(this);" type="text" pattern="[0-9.]+" name="harga_modal" value="<?php echo $harga_modal; ?>" class="form-control">

    </div>
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga Jual<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="input-group">
      <span class="input-group-addon">Rp.</span>
      <input id="harga" onkeyup="convertToRupiah(this);" type="text" pattern="[0-9.]+" name="harga" value="<?php echo $harga; ?>" class="form-control">

    </div>
  </div>
</div>
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Discount <span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <div class="input-group">
    <span class="input-group-addon">%</span>
    <input id="discount" onkeyup="convertToRupiah(this);" type="text" pattern="[0-9.]+" value="<?php echo $myData['discount']; ?>" name="discount" class="form-control">

  </div>
</div>
</div>
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="berat">Berat <span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <div class="input-group">
    <span class="input-group-addon">Gram</span>
    <input id="berat" onkeyup="convertToRupiah(this);" type="text" pattern="[0-9.]+" value="<?php echo $berat; ?>" name="berat" class="form-control">
    
  </div>
</div>
</div>
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discription">Description <span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <textarea id="description" rows="9" required="required" name="description"  class="form-control col-md-7 col-xs-12"><?php echo $myData['description']; ?></textarea>
</div>
</div>  
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Stock <span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <?php
  $categories = $_GET['kd_categories'];
  $size = mysql_query("SELECT * FROM detail_product, ukuran WHERE detail_product.kd_ukuran=ukuran.kd_ukuran AND kd_product='$kd_product'");
  ?>
  <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <tr >
        <th class="text-center"> Size </th>
        <th class="text-center"> Stock </th>
      </tr>
    </thead>
    <tbody>
      <?php


      while($k = mysql_fetch_array($size)){ ?>
      <tr>
        <td>
          <input type="hidden" name="kd_ukuran[]" readonly="readonly" value="<?php echo $k['kd_ukuran'][0] ; ?>"  class="form-control"/><?php echo $k['nama_ukuran'] ; ?>
        </td>
        <td>
          <input type="text" name="stock[<?php echo $k['kd_ukuran'];?>]" value="<?php echo $k['stock']; ?>" placeholder='' class="form-control"/>
        </td>
      </tr>
      <?php

    }
    ?>

  </tbody>
</table>
</div>
</div>
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="review">Review <span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <textarea id="review" rows="9" required="required" name="review" class="form-control col-md-7 col-xs-12"><?php echo $myData['review']; ?></textarea>
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

<div class="modal" id="hapusimage1" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">Hapus Gambar</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Anda yakin ingin menghapus gambar ini ?
      </div>
      <form class="form-horizontal" id="formslider" role="form" method="post" enctype="multipart/form-data" action="gambarproduct.hapus" >
        <input type="hidden" name="sik" value="gambar1">
        <input type="hidden" name="kd_product" value="<?php echo $myData['kd_product']; ?>">
        <input type="hidden" name="gambar1" value="<?php echo $myData['gambar1']; ?>">
        <input type="hidden" name="kd_categories" value="<?php echo $myData['kd_categories']; ?>">
        <img id="image-gallery-image" class="img-responsive img-rounded" src="../gallery/product/<?php echo $myData['gambar1']?>">
      </div>
      <div class="modal-footer">                                            
        <button type="submit" class="btn btn-default"></i> Yes</button></a>
        <button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
      </div>
    </form>
  </div>
</div>
</div>
<div class="modal" id="hapusimage2" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">Hapus Gambar</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Anda yakin ingin menghapus gambar ini ?
      </div>
      <form class="form-horizontal" id="formslider" role="form" method="post" enctype="multipart/form-data" action="gambarproduct.hapus" >
        <input type="hidden" name="sik" value="gambar2">
        <input type="hidden" name="kd_product" value="<?php echo $myData['kd_product']; ?>">
        <input type="hidden" name="gambar2" value="<?php echo $myData['gambar2']; ?>">
        <input type="hidden" name="kd_categories" value="<?php echo $myData['kd_categories']; ?>">
        <img id="image-gallery-image" class="img-responsive img-rounded" src="../gallery/product/<?php echo $myData['gambar2']?>">
      </div>
      <div class="modal-footer">                                            
        <button type="submit" class="btn btn-default"></i> Yes</button></a>
        <button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
      </div>
    </form>
  </div>
</div>
</div>
<div class="modal" id="hapusimage3" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">Hapus Gambar</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Anda yakin ingin menghapus gambar ini ?
      </div>
      <form class="form-horizontal" id="formslider" role="form" method="post" enctype="multipart/form-data" action="gambarproduct.hapus" >
        <input type="hidden" name="sik" value="gambar3">
        <input type="hidden" name="kd_product" value="<?php echo $myData['kd_product']; ?>">
        <input type="hidden" name="gambar3" value="<?php echo $myData['gambar3']; ?>">
        <input type="hidden" name="kd_categories" value="<?php echo $myData['kd_categories']; ?>">
        <img id="image-gallery-image" class="img-responsive img-rounded" src="../gallery/product/<?php echo $myData['gambar3']?>">
      </div>
      <div class="modal-footer">                                            
        <button type="submit" class="btn btn-default"></i> Yes</button></a>
        <button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
      </div>
    </form>
  </div>
</div>
</div>
<script type="text/javascript">
  function convertToRupiah(objek) {
    separator = ".";
    a = objek.value;
    b = a.replace(/[^\d]/g,"");
    c = "";
    panjang = b.length; 
    j = 0; 
    for (i = panjang; i > 0; i--) {
      j = j + 1;
      if (((j % 3) == 1) && (j != 1)) {
        c = b.substr(i-1,1) + separator + c;
      } else {
        c = b.substr(i-1,1) + c;
      }
    }
    objek.value = c;

  }            
</script>
<script type="text/javascript">
 var formproduct = $("#formproduct").serialize();
 var validator = $("#formproduct").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "fa fa-smile-o",
    invalid: "fa fa-frown-o", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
   nm_product : {
     validators: {
      notEmpty: {
       message: 'Nama  product Harus Diisi'
     },
   }
 },
 harga: {
  validators: {
    notEmpty: {
      message: 'Harga Product Harus Diisi'
    },
    regexp: {
      regexp: /^[0-9\.]+$/,
      message: 'Karakter Yang Boleh Digunakan Angka'
    }
  }
},
harga_modal: {
  validators: {
    notEmpty: {
      message: 'Harga Modal Harus Diisi'
    },
    regexp: {
      regexp: /^[0-9\.]+$/,
      message: 'Karakter Yang Boleh Digunakan Angka'
    }
  }
},
berat: {
  validators: {
    notEmpty: {
      message: 'Berat Harus Diisi'
    },
    regexp: {
      regexp: /^[0-9\.]+$/,
      message: 'Karakter Yang Boleh Digunakan Angka'
    }
  }
},
review : {
 validators: {
  notEmpty: {
   message: 'review  product Harus Diisi'
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
