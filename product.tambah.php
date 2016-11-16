    <?php
    #-------------------------------------------------------------------------------------------------------------------#
    #                                                     Information                                                   #
    #-------------------------------------------------------------------------------------------------------------------#
    #                                               Created By    : Fajar Nurrohmat                                     #
    #                                               Email         : Fajarnur24@gmail.com                                #
    #                                               Name File     : product.tambah.php                               #
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

    <title>Tambah product</title>

    <?php

    # MEMBUAT NILAI DATA PADA FORM
    # SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)

    $dataKode   = buatKode("product", "PD");
    $data_nm_product= isset($_POST['nm_product']) ?  $_POST['nm_product'] : '';
    $data_description= isset($_POST['description']) ?  $_POST['description'] : '';
    $data_harga= isset($_POST['harga']) ?  $_POST['harga'] : '';
    $data_discount= isset($_POST['discount']) ?  $_POST['discount'] : '';



    $data_kd_categories= isset($_POST['kd_categories']) ?  $_POST['kd_categories'] : '';


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
              Tambah Data product
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
                <h2>Tambah Data <small>product</small></h2>
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
                  $stock=str_replace(".", "", $stock);
                  $kd_ukuran=$_POST['kd_ukuran'];
                  $jumlahukuran=count($kd_ukuran);
                  
                  

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
      if (empty($nama_foto)){
        $pesanError[] = "Anda Belum Memilih Gambar Utama Product !";    
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

         }
         else { $pesanError[] = "File Yang Bisa Di Upload Berupa Image (.jpg .jpeg .png) !"; }

//GAMBAR1                
         if (!empty($nama_foto1) && ($_FILES["file1"]["type"] == "image/gif") || ($_FILES["file1"]["type"] == "image/jpeg") || ($_FILES["file1"]["type"] == "image/png") || ($_FILES["file1"]["type"] == "image/pjpeg")) {

           $lokasi1 = '../gallery/product/';
           $file1 = md5(rand(1000,1000000000))."-".md5($nama_foto1);
           $newfilename1 = $file1 . $bagian_extensine1;
           $jeneng1=str_replace(' ','-',$file1);

           $url1 = $lokasi1 . $newfilename1;
           $filename1 = compress_image($_FILES["file1"]["tmp_name"], $url1, 80);     
         }
         if (!empty($nama_foto2) && ($_FILES["file2"]["type"] == "image/gif") || ($_FILES["file2"]["type"] == "image/jpeg") || ($_FILES["file2"]["type"] == "image/png") || ($_FILES["file2"]["type"] == "image/pjpeg")) {

           $lokasi2 = '../gallery/product/';
           $file2 = md5(rand(1000,1000000000))."-".md5($nama_foto2);
           $newfilename2 = $file2 . $bagian_extensine2;
           $jeneng2=str_replace(' ','-',$file2);

           $url2 = $lokasi2 . $newfilename2;
           $filename2 = compress_image($_FILES["file2"]["tmp_name"], $url2, 80); 
         }
//GAMBAR 3
         if (!empty($nama_foto3) && ($_FILES["file3"]["type"] == "image/gif") || ($_FILES["file3"]["type"] == "image/jpeg") || ($_FILES["file3"]["type"] == "image/png") || ($_FILES["file3"]["type"] == "image/pjpeg")){

           $lokasi3 = '../gallery/product/';
           $file3 = md5(rand(1000,1000000000))."-".md5($nama_foto3);
           $newfilename3 = $file3 . $bagian_extensine3;
           $jeneng3=str_replace(' ','-',$file3);

           $url3 = $lokasi3 . $newfilename3;
           $filename3 = compress_image($_FILES["file3"]["tmp_name"], $url3, 80); 


         }
         $kodeBaru= buatKode("product", "PD");
         $jj=$discount / 100 * $harga;
         $harga_discount=$harga-$jj;
         $tgl  =date('Y-m-d');

         $query = mysql_query("INSERT INTO product SET kd_product='$kodeBaru', kd_categories='$kd_categories', nm_product='$nm_product', description='$description', harga_modal='$harga_modal', harga='$harga', discount='$discount', tgl='$tgl', berat='$berat', review='$review', gambarutama='$newfilename', gambar1='$newfilename1', gambar2='$newfilename2', gambar3='$newfilename3', harga_discount='$harga_discount' ") or die(mysql_error());
         
         $ty=0;
         foreach($kd_ukuran as $k) { 
          $querytambahproductdetail =  mysql_query("INSERT INTO detail_product (id_detail_product, kd_product, kd_ukuran, stock) 
            VALUES ( '' , '$kodeBaru', '$k',  '$stock[$ty]' )") or die(mysql_error());
          $ty++;
          header('location: ./product');

        }


          // header('location: ./product');



      }
    }

    ?>
    <form id="formproduct" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
      <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_product">Kode product <span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="kd_product" name="kd_product" value="<?php echo $dataKode; ?>" readonly="readonly" class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <div class="">
            <div class="">
              <label>Gambar Utama</label>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/fileupload/images/nopict.jpg" alt=""></div>
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
                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/fileupload/images/nopict.jpg" alt=""></div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 150px;"></div>
                <div>
                  <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" accept="image/*" name="file1" id="file1" placeholder="file2"></span>
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
              <label>Gambar 2</label>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/fileupload/images/nopict.jpg" alt=""></div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 150px;"></div>
                <div>
                  <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" accept="image/*" name="file2" id="file2" placeholder="file2"></span>
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
              <label>Gambar 3</label>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="../assets/fileupload/images/nopict.jpg" alt=""></div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 150px;"></div>
                <div>
                  <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" accept="image/*" name="file3" id="file3" placeholder="file3"></span>
                  <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">Remove</a>
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
      <input type="text" id="nm_product" name="nm_product" required="required" class="form-control col-md-7 col-xs-12">
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga_modal">Harga Modal<span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon">Rp.</span>
        <input id="harga_modal" onkeyup="convertToRupiah(this);" type="text" pattern="[0-9.]+" name="harga_modal" class="form-control">
        <span class="input-group-addon">,-</span>
      </div>
    </div>
  </div>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga Jual<span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="input-group">
        <span class="input-group-addon">Rp.</span>
        <input id="harga" onkeyup="convertToRupiah(this);" type="text" pattern="[0-9.]+" name="harga" class="form-control">
        <span class="input-group-addon">,-</span>
      </div>
    </div>
  </div>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Discount <span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="input-group">

      <input id="discount" onkeyup="convertToRupiah(this);" type="text" pattern="[0-9.]+" name="discount" class="form-control">
      <span class="input-group-addon">%</span>
    </div>
  </div>
</div>
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="berat">Berat <span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <div class="input-group">

    <input id="berat" onkeyup="convertToRupiah(this);" type="text" pattern="[0-9.]+" name="berat" class="form-control">
    <span class="input-group-addon">Gram</span>
  </div>
</div>
</div>
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discription">Description <span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <textarea rows="9" id="description" required="required" name="description" class="form-control col-md-7 col-xs-12"></textarea>
</div>
</div>  
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Stock <span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <?php
  $categories = $_GET['kd_categories'];
  $size = mysql_query("SELECT * FROM ukuran WHERE kd_categories='$categories' ORDER BY nama_ukuran");
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
          <input type="hidden" name="kd_ukuran[]" readonly="readonly" value="<?php echo $k['kd_ukuran'] ; ?>"  class="form-control"/><?php echo $k['nama_ukuran'] ; ?>
        </td>
        <td>
          <input type="text" name="stock[]" onkeyup="convertToRupiah(this);" type="text" pattern="[0-9.]+" value="" placeholder='' class="form-control"/>
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
  <textarea id="review" required="required" name="review" rows="9" class="form-control col-md-7 col-xs-12"></textarea>
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
