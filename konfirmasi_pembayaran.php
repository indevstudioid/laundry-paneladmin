<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : kofirmasi_pembayaran.php                                        #
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

if (isset($_POST['buttonsubmit'])) {
  $id_pemesanan=$_POST['id_pemesanan'];
  $status_konfirmasi=$_POST['status_konfirmasi'];
  $unik_key  = preg_replace("/[^0-9]/", "", $unik_keyo);

  $kd_bank=$_POST['kd_bank'];
  $status_konfirmasi=$_POST['status_konfirmasi'];


  
  $tgl_transfer0=$_POST['date'];
  
  $tgl_transfer_ubah=ubahformatTgl($tgl_transfer0);


  $querydurung=mysql_query("SELECT  * FROM pemesanan WHERE id_pemesanan='$id_pemesanan'");
  $datadurung=mysql_fetch_array($querydurung);

  $total_transfer=$datadurung['grandtotal'];
  $unik_transfer=$datadurung['unik_key'];



  $querytambahkonfirmasi = mysql_query("INSERT INTO konfirmasi SET id_pemesanan='$id_pemesanan', status_konfirmasi='$status_konfirmasi', unik_transfer='$unik_transfer', total_transfer='$total_transfer', kd_bank='$kd_bank', tgl_transfer='$tgl_transfer_ubah' ") or die(mysql_error());
  header('location: ./konfirmasi_pembayaran');
} ?>
<?php
DataMetaTabel();  ?>

<title>Data Konfirmasi Pembayaran</title>

<?php 
DataHeadTabel();

validator();
datepicker();

BagianSideBarPanelAdmin();

BagianTopNavi();

?>
<script type="text/javascript">
  var htmlobjek;
  $(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=id_pemesanan>
  $("#id_pemesanan").change(function(){
    var id_pemesanan = $("#id_pemesanan").val();
    $.ajax({
      url: "../inc/jikuk_konfirmasi.php",
      data: "id_pemesanan="+id_pemesanan,
      cache: false,
      success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kd_customer").html(msg);
          }
        });
  });
});


</script>

<div class="right_col" role="main">


  <style type="text/css">.datepicker{
    z-index: 1050 !important;
    position: absolute;
  }
</style>


<div class="page-title">
  <div class="title_left">
    <h3>
      Data Konfirmasi Pembayaran

    </h3>
  </div>
</div>
<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Master Data <small>Konfirmasi Pembayaran</small></h2>
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
          Berikut ini merupakan data Konfirmasi Pembayaran yang ada di roverland cloth
        </p>
        <button type="button" data-toggle="modal" data-target="#tambahkonfirmasi" class="btn btn-info" data-toggle="modal" ><i class="fa fa-plus-square" ></i> Tambah</button><p></p>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th><center>No</center> </th>
              <th><center>No Pemesanan</center> </th>
              <th><center>Nama</center> </th>
              <th><center>Tanggal Pesan</center> </th>
              <th><center>Tanggal Transfer</center> </th>
              <th><center>Batas Pembayaran</center> </th>
              <th><center>Unik Transfer</center> </th>
              <th><center>Total Transfer</center> </th>
              <th><center>Status Konfirmasi</center> </th>
              <th width="9%"><center>Option</center> </th>
            </tr>
          </thead>
          <div class="col-lg-12">
            <?php 
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Query                                                   
#-------------------------------------------------------------------------------------------------------------------#                          

            $no=0;

            $querykonfirmasi = mysql_query("SELECT * FROM konfirmasi INNER JOIN pemesanan ON konfirmasi.id_pemesanan = pemesanan.id_pemesanan INNER JOIN customer ON pemesanan.kd_customer = customer.kd_customer") or die ("Gagal query");
            while($datakonfirmasi= mysql_fetch_array($querykonfirmasi)){
              $tgl_pemesanan=$datakonfirmasi['tgl_pemesanan'];
              $batas_tgl_bayar=kelolatanggal("$tgl_pemesanan","+2 day");


              $no++;

#-------------------------------------------------------------------------------------------------------------------#?>
<?php#-------------------------------------------------------------------------------------------------------------------#
#                                                     Edit Data konfirmasi                                                  
#-------------------------------------------------------------------------------------------------------------------#
?> 

<div class="modal" id="editkonfirmasi<?php echo $datakonfirmasi['id_pemesanan']; ?>" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">edit Data konfirmasi</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-info" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Edit  data konfirmasi <?php echo "$datakonfirmasi[id_pemesanan]";?> ?
      </div>
      
      <form role="form" method="post" action="konfirmasi_pembayaran.edit?id=<?php echo $datakonfirmasi['id_pemesanan'];?>" enctype="multipart/form-data" >
        <div class="form-group">
          <label>Kode Pemesanan</label>
          <input class="form-control" name="id_pemesanan" value="<?php echo "$datakonfirmasi[id_pemesanan]"; ?>" readonly  required  />
        </div>

        <div class="form-group">
          <label>Kode Customer</label>
          <input class="form-control" name="kd_customer" value="<?php echo "$datakonfirmasi[kd_customer]"; ?>" readonly required  />
        </div>

        <div class="form-group">
          <label>Nama Customer</label>
          <input class="form-control" name="nm_customer" value="<?php echo "$datakonfirmasi[nm_customer]"; ?>" readonly required  />
        </div>
        <div class="form-group">
          <label>Unik Transfer</label>
          <input class="form-control" name="unik_trasnfer" id="unik_transfer" value="<?php echo "$datakonfirmasi[unik_transfer]"; ?>" readonly required  />
        </div>
        <div class="form-group">
          <label>Total Transfer</label>
          <div class="form-group input-group">
           <span class="input-group-addon">Rp. </span>
           <input class="form-control" name="total_trasnfer" id="total_transfer" value="<?php echo  number_format($datakonfirmasi['total_transfer'],0,',','.'); ?>" readonly  required  />
         </div>
       </div>
       <div class="form-group">

        <label>Tanggal Transfer</label>
        <div class="form-group input-group">
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          <input class="form-control" name="date" value="<?php echo IndonesiaTgl($datakonfirmasi['tgl_transfer']); ?>" readonly required  />
          <span class="input-group-addon">Hari/Bulan/Tahun(hh/bb/tttt) </span>
        </div>
      </div>
      <div class="form-group">
        <label>Status Konfirmasi</label>
        <select class="form-control" name="status_konfirmasi" required id="status_konfirmasi">

          <?php
                    //MENGAMBIL NAMA kabupaten YANG DI DATABASE

          if ($datakonfirmasi['status_konfirmasi']=='Sudah' ) {
           $ceksudah ="selected";
         }
         elseif ($datakonfirmasi['status_konfirmasi']=='Belum' ) {
           $cekbelum ="selected";
         }
         elseif($datakonfirmasi['status_konfirmasi']=='Salah' ) {
           $ceksalah ="selected";
         }

         ?>

         <option value="Belum" name="status_konfirmasi"<?php echo $cekbelum; ?>>Belum</option>
         <option value="Sudah" name="status_konfirmasi"<?php echo $ceksudah; ?>>Sudah</option>
         <option value="Salah" name="status_konfirmasi" <?php echo $ceksalah; ?>>Salah</option>

       </select>
     </div>
   </div>
   <div class="modal-footer">                                            
     <button type="submit" class="btn btn-default"></i> Yes</button>
     <button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
   </div>
 </form>
</div>
</div>
</div>

<?php#-------------------------------------------------------------------------------------------------------------------#
#                                                     Hapus Data konfirmasi                                                  
#-------------------------------------------------------------------------------------------------------------------#
?> 

<div class="modal" id="hapuskonfirmasi<?php echo $datakonfirmasi['id_pemesanan']; ?>" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">Hapus Data konfirmasi</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Anda yakin ingin menghapus data konfirmasi <?php echo "$datakonfirmasi[id_pemesanan]";?> ?
      </div>
      <form class="form-horizontal" id="formkonfirmasi">
       <form role="form" method="post" enctype="multipart/form-data" >
        <div class="form-group">
          <label>Kode Pemesanan</label>
          <input class="form-control" name="id_pemesanan" value="<?php echo "$datakonfirmasi[id_pemesanan]"; ?>" disable readonly required  />
        </div>

        <div class="form-group">
          <label>Kode Customer</label>
          <input class="form-control" name="kd_customer" value="<?php echo "$datakonfirmasi[kd_customer]"; ?>" disable readonly required  />
        </div>

        <div class="form-group">
          <label>Nama Customer</label>
          <input class="form-control" name="nm_customer" value="<?php echo "$datakonfirmasi[nm_customer]"; ?>" disable readonly required  />
        </div>
        <div class="form-group">
          <label>Unik Transfer</label>
          <input class="form-control" name="unik_trasnfer" value="<?php echo "$datakonfirmasi[unik_transfer]"; ?>" disable readonly required  />
        </div>
        <div class="form-group">
          <label>Total Transfer</label>
          <div class="form-group input-group">
           <span class="input-group-addon">Rp. </span>
           <input class="form-control" name="total_trasnfer" value="<?php echo  number_format($datakonfirmasi['total_transfer'],0,',','.'); ?>" readonly required  />
         </div>
       </div>
       <div class="form-group">

        <label>Tanggal Transfer</label>
        <div class="form-group input-group">
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          <input class="form-control" name="date" value="<?php echo IndonesiaTgl($datakonfirmasi['tgl_transfer']); ?>" readonly  required  />
          <span class="input-group-addon">Hari/Bulan/Tahun(hh/bb/tttt) </span>
        </div>
      </div>
      
    </div>
    <div class="modal-footer">                                            
      <a href="konfirmasi_pembayaran.hapus?id=<?php echo $datakonfirmasi['id_pemesanan'];?>"> <button type="button" class="btn btn-default"></i> Yes</button></a>
      <button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
    </div>
  </form>
</div>
</div>
</div>
<?php if($datakonfirmasi['status_konfirmasi']=="Sudah") {
  $warna="success";
}
if($datakonfirmasi['status_konfirmasi']=="Belum") {
  $warna="warning";
}
if($datakonfirmasi['status_konfirmasi']=="Salah") {
  $warna="danger";
}

?>

<tr class="<?php echo $warna; ?>">
  <td><?php echo $no?></td>
  <td><?php echo $datakonfirmasi['id_pemesanan']?></td>
  <td><?php echo $datakonfirmasi['nm_customer']?></td>
  <td align="center"><?php echo IndonesiaTgl($tgl_pemesanan);?></td>
  <td align="center"><?php echo IndonesiaTgl($datakonfirmasi['tgl_transfer']);?></td>
  <td class="<?php echo $warna; ?>" align="center"><?php echo IndonesiaTgl($batas_tgl_bayar);?></td>
  <td align="center"><?php echo $datakonfirmasi['unik_transfer']?></td>
  <td align="center" width="70%"><?php echo 'Rp. '. number_format($datakonfirmasi['total_transfer'],0,',','.');?> ,-</td>
  <td align="center" class="<?php echo $warna; ?>"><?php echo $datakonfirmasi['status_konfirmasi'];?></td>


  <td><CENTER> 
    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#editkonfirmasi<?php echo $datakonfirmasi['id_pemesanan']; ?>" > <i class="fa fa-pencil"></i></button></a>
    <button data-toggle="modal" data-target="#hapuskonfirmasi<?php echo $datakonfirmasi['id_pemesanan']; ?>" href="#hapuskonfirmasi<?php echo $datakonfirmasi['id_pemesanan']; ?>" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button>
  </CENTER>
</td>
</tr>


<?php } ?>

</tbody>
</table>


<?php#-------------------------------------------------------------------------------------------------------------------#
#                                                     Tambah Data konfirmasi                                                  
#-------------------------------------------------------------------------------------------------------------------#

?>

<div class="modal" id="tambahkonfirmasi" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <form role="form" id="formtambahkonfirmasi" enctype="multipart/form-data" method="POST" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="H2">Tambah Data konfirmasi</h4>
        </div>
        <div class="modal-body">
         <div class="alert alert-info" role="alert" id="removeWarning">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only"></span>
          Isi  data konfirmasi Dengan Benar<?php echo "$datakonfirmasi[id_pemesanan]";?> ?
        </div>



        <div class="form-group">
          <label>Kode Pemesanan</label>
          <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_pemesanan" name="id_pemesanan"  >
            <option value="">-Pilih Kode Pemesanan-</option>
            <?php


            $pemesanan =mysql_query("SELECT *
              FROM
              pemesanan
              INNER JOIN customer ON pemesanan.kd_customer = customer.kd_customer WHERE pemesanan.id_pemesanan Not In (SELECT
                konfirmasi.id_pemesanan
                FROM
                konfirmasi
                INNER JOIN pemesanan ON konfirmasi.id_pemesanan = pemesanan.id_pemesanan
                INNER JOIN customer ON pemesanan.kd_customer = customer.kd_customer
                )");
                while ($datapemesanan=mysql_fetch_array($pemesanan)) { ?>
                <option value="<?php echo $datapemesanan['id_pemesanan'];?>"><?php echo $datapemesanan['id_pemesanan'];?></option>
                <?php } ?>
              </select>
            </div>
            <div id="kd_customer"> </div>

            <div class="form-group">
              <label>Bank Tujuan</label>
              <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="kd_bank" name="kd_bank"  >
                <option value="">-Pilih Bank Tujuan-</option>
                <?php
                            //MENGAMBIL NAMA bank YANG DI DATABASE

                $bank =mysql_query("SELECT * FROM bank  ORDER BY nama_bank");
                while ($databank=mysql_fetch_array($bank)) {
                  if($kd_bank==$databank['kd_bank']){
                    $cek ="selected";
                  }
                  else{
                    $cek= "";
                  }
                  echo "<option $cek value=\"$databank[kd_bank]\">$databank[nama_bank]</option>\n";
                }

                ?>
              </select>
            </div>

            <div class="form-group">
              <label>Tanggal Transfer</label>
              <div class="form-group input-group">
               <div class="date">
                <div class="input-group input-append date" id="datePicker">
                  <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                  <input type="text" class="form-control" name="date" />
                  <span class="input-group-addon add-on"><span> DD/MM/YYYY</span></span>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Status Konfirmasi</label>
            <select class="form-control" name="status_konfirmasi" id="status_konfirmasi">
             <option value="" >Pilih Status Konfirmasi</option>
             <option value="Belum" >Belum</option>
             <option value="Sudah" >Sudah</option>
             <option value="Salah" >Salah</option>

           </select>
         </div>

       </div>

       <div class="modal-footer">                                            
        <button type="submit" id="buttonsubmit" name="buttonsubmit" class="btn btn-default"> Yes</button>
        <button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
      </div>


    </div>
  </div>
</form>
</div>




<script>
  $(document).ready(function() {
    $('#formtambahkonfirmasi').bootstrapValidator({
      framework: 'bootstrap',
      excluded: ':disabled',
      icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
        id_pemesanan: {
          validators: {
            notEmpty: {
              message: 'Kode Pemesanan Belum Dipilih'
            }
          }
        },
        kd_bank: {
          validators: {
            notEmpty: {
              message: 'Tujuan Bank Belum Dipilh'
            }
          }
        },
        status_konfirmasi: {
          validators: {
            notEmpty: {
              message: 'Status Konfirmasi Belum Dipilh'
            }
          }
        },
        date: {
          validators: {
            notEmpty: {
              message: 'Tanggal Transfer Tidak Boleh Kosong'
            },
            date: {
              format: 'DD/MM/YYYY',
              message: 'Tanggal Tidak Valid'
              
            }
          }
        }
      }
    });
});
</script>














</div>



</div>
</div>
</div>


<!-- /datepicker -->

</div>       
</div>
</div>
</div>
</div>
<script>
  $(document).ready(function() {
    $('#datePicker')
    .datepicker({
      format: 'dd/mm/yyyy'
    })
    .on('changeDate', function(e) {
            // Revalidate the date field
            $('#formtambahkonfirmasi').bootstrapValidator('revalidateField', 'date');
          });

    $('#formtambahkonfirmasi').bootstrapValidator({
      framework: 'bootstrap',
      icon: {
        valid: "fa fa-smile-o",
        invalid: "fa fa-frown-o", 
        validating: "glyphicon glyphicon-refresh"
      },
      fields: {


        kd_bank: {
          validators: {
            notEmpty: {
              message: 'Harus Pilih Bank Yang Dituju'
            }
          }
        },
        date: {
          validators: {
            notEmpty: {
              message: 'Tanggal Transfer Tidak Boleh Kosong'
            },
            date: {
              format: 'DD/MM/YYYY',
              message: 'Tanggal Tidak Valid'
              
            }
          }
        },

      }
    });
  });
</script>



<?php
JsDataTabel();
?>
