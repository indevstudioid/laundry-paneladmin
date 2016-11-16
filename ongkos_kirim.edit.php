<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : ongkos_kirim.edit.php                                  #
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

<title>Data Onkgos Kirim</title>

<?php 

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM provinsi, kabupaten, kecamatan, ongkos_kirim WHERE provinsi.id_prov=kabupaten.id_prov AND kabupaten.id_kab=kecamatan.id_kab AND kecamatan.id_kec=ongkos_kirim.id_kec AND ongkos_kirim.id_kec  AND id_ongkos='$_GET[id]'");
$rowks  = mysql_fetch_array($edit);
$reg=$rowks['reg'];
$reg= number_format($reg,0,',','.');
$oke=$rowks['oke'];
$oke= number_format($oke,0,',','.');

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
          Edit Data Ongkos Kirim
          <small>
            Manage Your Data Ongkos Kirim
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Data <small>Ongkos Kirim</small></h2>
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

function convertToAngka($rupiah)
{
  $int = ereg_replace("[^0-9]", "", $rupiah); 
  return $int;
}
  #baca variabel 
//    menangkap $post nip dan mengamankan inputan dengan fungsi
//    trim, htmlspecialchars dan stripslashes
  $id_kec  = $_POST['id_kec'];
  $id_kec=preg_replace("/[^0-9]/", "", $id_kec);

  $kota  = $_POST['kota'];
  $kota  = preg_replace("/[^a-zA-Z0-9]/", "", $kota);

  $prov  = $_POST['prov'];
  $prov  =preg_replace("/[^a-zA-Z0-9]/", "", $prov);

  $reg  = htmlspecialchars(stripslashes(trim($_POST['reg'])));
  $reg  = preg_replace("/[^0-9]/", "", $reg);

  $estimasi_reg  = htmlspecialchars(stripslashes(trim($_POST['estimasi_reg'])));
  $estimasi_reg  = preg_replace("/[^0-9-]/", "", $estimasi_reg);

  $oke  = htmlspecialchars(stripslashes(trim($_POST['oke'])));
  $oke  = preg_replace("/[^0-9]/", "", $oke);

  $estimasi_oke  = htmlspecialchars(stripslashes(trim($_POST['estimasi_oke'])));
  $estimasi_oke  = preg_replace("/[^0-9-]/", "", $estimasi_oke);


  $origin  = 'YOGYAKARTA';

  #VALIDASI UNTUK FORM JIKA FORM KOSONG

  $pesanError= array();
  if (trim($prov)=="") {
    $pesanError[] = "Data <b>provinsi</b> tidak boleh kosong !";    
  }
  if (trim($kota)=="") {
    $pesanError[]="Data <b>Kabupaten</b> Masih kosong !!";
  }
  if (trim($id_kec)=="") {
    $pesanError[]="Data <b>Kecamatan</b> Masih kosong !!";
  }
   if (trim($reg)=="") {
    $pesanError[]="Data <b>Data Reguler </b> Masih kosong !!";
  }
    if (trim($estimasi_reg)=="") {
    $pesanError[] = "Data <b>Estimasi Reguler</b> tidak boleh kosong !";    
  }
  if (trim($oke)=="") {
    $pesanError[]="Data <b>Oke</b> Masih kosong !!";
  }
  if (trim($estimasi_oke)=="") {
    $pesanError[]="Data <b>Estimasi Oke</b> Masih kosong !!";
  }
   if (trim($origin)=="") {
    $pesanError[]="Data <b>Origin</b> Masih kosong !!";
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

    #SIMPAN DATA KE DALAM DATABASE jika tidak menemukan error 
    $queryeditongkoskirim = mysql_query("UPDATE ongkos_kirim SET id_kec='$id_kec', reg='$reg' , estimasi_reg='$estimasi_reg' , oke='$oke' , estimasi_oke='$estimasi_oke', origin='$origin' WHERE id_ongkos='$_GET[id]'") or die(mysql_error());

  if ($queryeditongkoskirim){
    header('location: ./ongkos_kirim');
  }
 }
}
?>
            <form id="formongkoskirim" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

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
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_kec">Kecamatan <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_kec" name="id_kec" value="" required>
              <option value="">-Pilih Kecamatan-</option>
              <?php
                    //MENGAMBIL NAMA kecamatan YANG DI DATABASE
              $kecamatan =mysql_query("SELECT * FROM kecamatan WHERE id_kab=$rowks[id_kab] ORDER BY nama_kec");
              while ($datakecamatan=mysql_fetch_array($kecamatan)) {
               if ($datakecamatan['id_kec']==$rowks['id_kec']) {
                 $cek ="selected";
               }
               else{
                $cek= "";
              }
              echo "<option value=\"$datakecamatan[id_kec]\" $cek>$datakecamatan[nama_kec]</option>\n";
            }
            ?>
          </select>
        </div>
      </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reg">Harga Paket Reguler <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="input-group">
              <span class="input-group-addon">Rp.</span>
              <input id="reg" onkeyup="convertToRupiah(this);" type="text" value="<?php echo $reg;?>" pattern="[0-9.]+" name="reg" class="form-control">
          </div>
          </div>
        </div>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estimasi_reg">Estimasi Paket Reguler <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="input-group">
           <span class="input-group-addon">Hari</span>
            <input type="text" id="estimasi_reg" name="estimasi_reg" value="<?php echo $rowks['estimasi_reg'];?>"  required="required" class="form-control col-md-7 col-xs-12">
          </div>
          <span class="help-block">Example : 7-8</span>
          </div>
        </div>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="oke">Harga Paket Oke <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="input-group">
              <span class="input-group-addon">Rp.</span>
              <input id="oke" onkeyup="convertToRupiah(this);" type="text" value="<?php echo $oke;?>" pattern="[0-9.]+" name="oke" class="form-control">
          </div>
          </div>
        </div>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estimasi_oke">Estimasi Paket Oke <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="input-group">
           <span class="input-group-addon">Hari</span>
            <input type="text" id="estimasi_oke" name="estimasi_oke" value="<?php echo $rowks['estimasi_oke'];?>" required="required" class="form-control col-md-7 col-xs-12">
            
            </div>
            <span class="help-block">Example : 7-8</span>
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
<script type="text/javascript" src="jquery.maskMoney.min.js"></script>
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
<script src="selectongkoskirim.js"></script>
<script type="text/javascript">

 var formongkoskirim = $("#formongkoskirim").serialize();
 var validator = $("#formongkoskirim").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "fa fa-smile-o",
    invalid: "fa fa-frown-o", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    prov : {
     validators: {
      notEmpty: {
       message: 'Harus Pilih Provinsi'
     }
   }
 },    
 kota : {
     validators: {
      notEmpty: {
       message: 'Harus Pilih Kabupaten'
     }
   }
 }, 
 id_kec : {
     validators: {
      notEmpty: {
       message: 'Harus Pilih Kecamatan'
     }
   }
 }, 
reg: {
  validators: {
    notEmpty: {
      message: 'Harga Paket Reguler Harus Diisi'
    },
        regexp: {
      regexp: /^[0-9\.]+$/,
      message: 'Karakter Yang Boleh Digunakan Angka'
    }
  }
},
estimasi_reg: {
  validators: {
    notEmpty: {
      message: 'Estimasi Paket Reguler Harus Diisi'
    },
        regexp: {
      regexp: /^[0-9\-]+$/,
      message: 'Karakter Yang Boleh Digunakan Angka'
    }
  }
},
oke: {
  validators: {
    notEmpty: {
      message: 'Harga Paket Oke Harus Diisi'
    },
        regexp: {
      regexp: /^[0-9\.]+$/,
      message: 'Karakter Yang Boleh Digunakan Angka'
    }
  }
},
estimasi_oke: {
  validators: {
    notEmpty: {
      message: 'Estimasi Paket Oke Harus Diisi'
    },
        regexp: {
      regexp: /^[0-9\-]+$/,
      message: 'Karakter Yang Boleh Digunakan Angka'
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
