<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : data_pengiriman.php                                        #
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

<title>Data Pengiriman Barang</title>

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


  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>
          Data Pengiriman Barang
          <small>
            Manage Your Data Pengiriman Barang
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Master Data <small>Pengiriman Barang</small></h2>
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
              Berikut ini merupakan data Pengiriman Barang yang ada di roverland cloth
            </p>
            <p></p>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th><center>No</center> </th>
              <th><center>No Pemesanan</center> </th>
              
              <th><center>Tanggal Lunas</center> </th>
              <th><center>Nama Penerima</center> </th>
              
              <th><center>Alamat Penerima</center> </th>
              <th><center>No HP</center> </th>
              <th><center>Ongkos Kirim</center> </th>
              <th><center>Tanggal Pengiriman</center> </th>
              <th><center>Status Pengiriman Barang</center> </th>
             
              
              <th width="9%"><center>Option</center> </th>
                </tr>
              </thead>
              <div class="col-lg-12">
                <?php 
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Query                                                   
#-------------------------------------------------------------------------------------------------------------------#                          

                $no=0;
                $querypengiriman="SELECT *

FROM
pengiriman, pemesanan, provinsi, kabupaten, kecamatan, kelurahan WHERE pengiriman.id_pemesanan=pemesanan.id_pemesanan AND pengiriman.id_prov=provinsi.id_prov AND pengiriman.id_kab=kabupaten.id_kab AND pengiriman.id_kec=kecamatan.id_kec AND pengiriman.id_kel=kelurahan.id_kel 
AND pemesanan.status_pemesanan='Lunas'";
                $exepengiriman=mysql_query($querypengiriman);
                while ($datapengiriman=mysql_fetch_array($exepengiriman)) { 
                  $no++;
                  $tgl_pemesanan=$datapengiriman['tgl_pemesanan'];
              $batas_tgl_bayar=kelolatanggal("$tgl_pemesanan","+2 day");

#-------------------------------------------------------------------------------------------------------------------#?>
<?php#-------------------------------------------------------------------------------------------------------------------#
#                                                     Edit Data konfirmasi                                                  
#-------------------------------------------------------------------------------------------------------------------#
?> 

<div class="modal" id="editpengiriman<?php echo $datapengiriman['id_pemesanan']; ?>" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">Edit Data Pengiriman</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-info" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Edit  data Pengiriman Kode Pemesanan :<?php echo "$datapengiriman[id_pemesanan]";?> ?
        <br> Anda Tidak Bisa Mengubah Tujuan Pengiriman Atau Alamat Penerima
        <br> Anda Harus Mengisi Tanggal Pengiriman dan Merubah Status Pengiriman
      </div>
      
      <form role="form" method="post" action="pengiriman.edit?id=<?php echo $datapengiriman['id_pemesanan'];?>" enctype="multipart/form-data" >
        <div class="form-group">
          <label>Kode Pemesanan</label>
          <input class="form-control" name="id_pemesanan" value="<?php echo "$datapengiriman[id_pemesanan]"; ?>" readonly  required  />
        </div>

        <div class="form-group">
          <label>Nama Penerima</label>
          <input class="form-control" name="nm_penerima" value="<?php echo "$datapengiriman[nm_penerima]"; ?>" readonly required  />
        </div>

        <div class="form-group">
          <label>Tuuan Pengiriman (Alamat Penerima)</label>
         <textarea readonly class="form-control" rows="3"><?php echo '('.$datapengiriman['alamat_penerima'].') Kelurahan '.$datapengiriman['nama_kel'].', Kecamatan '.$datapengiriman['nama_kec'].', Kabupaten '.$datapengiriman['nama_kab'].', Provinsi '.$datapengiriman['nama_prov']?></textarea>
        </div>
        <div class="form-group">
          <label>Ongkos Kirim</label>
          <input class="form-control" name="unik_trasnfer" id="unik_transfer" value="<?php echo 'Rp. '. number_format($datapengiriman['biayakirim'],0,',','.');?>,-" readonly required  />
        </div>
        
       <div class="form-group">
              <label>Tanggal Pengiriman</label>
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
        <label>Status Pengiriman</label>
        <select class="form-control" name="status_pengiriman" required id="status_pengiriman">

          <?php
                    //MENGAMBIL NAMA kabupaten YANG DI DATABASE

          if ($datapengiriman['status_pengiriman']=='Belum Dikirim' ) {
           $cekbelum ="selected";
         }
         elseif ($datapengiriman['status_pengiriman']=='Sudah Dikirim' ) {
           $ceksudah ="selected";
         }
        
         ?>

         
         <option value="Belum Dikirim" name="status_pengiriman"<?php echo $cekbelum; ?>>Belum Dikirim</option>
         <option value="Sudah Dikirim" name="status_pengiriman" <?php echo $ceksudah; ?>>Sudah Dikirim</option>

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

<div class="modal" id="hapuspengiriman<?php echo $datapengiriman['id_pemesanan']; ?>" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">Hapus Data Pengiriman </h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Anda yakin ingin menghapus data pengiriman kode pemesanan <?php echo "$datapengiriman[id_pemesanan]";?> ?
      </div>
      <form class="form-horizontal" id="formkonfirmasi">
       <form role="form" method="post" enctype="multipart/form-data" >
        <div class="form-group">
          <label>Kode Pemesanan</label>
          <input class="form-control" name="id_pemesanan" value="<?php echo "$datapengiriman[id_pemesanan]"; ?>" readonly  required  />
        </div>

        <div class="form-group">
          <label>Nama Penerima</label>
          <input class="form-control" name="nm_penerima" value="<?php echo "$datapengiriman[nm_penerima]"; ?>" readonly required  />
        </div>

        <div class="form-group">
          <label>Tuuan Pengiriman (Alamat Penerima)</label>
         <textarea readonly class="form-control" rows="3"><?php echo '('.$datapengiriman['alamat_penerima'].') Kelurahan '.$datapengiriman['nama_kel'].', Kecamatan '.$datapengiriman['nama_kec'].', Kabupaten '.$datapengiriman['nama_kab'].', Provinsi '.$datapengiriman['nama_prov']?></textarea>
        </div>
        <div class="form-group">
          <label>Ongkos Kirim</label>
          <input class="form-control" name="unik_trasnfer" id="unik_transfer" value="<?php echo 'Rp. '. number_format($datapengiriman['biayakirim'],0,',','.');?>,-" readonly required  />
        </div>
        <?php 

        $tgl_pengiriman=IndonesiaTgl($datapengiriman['tgl_pengiriman']); 
        $belumdik="Barang Belum Dikirim";

        ?>

       
   </div>
    <div class="modal-footer">                                            
      <a href="konfirmasi_pembayaran.hapus?id=<?php echo $datapengiriman['id_pemesanan'];?>"> <button type="button" class="btn btn-default"></i> Yes</button></a>
      <button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
    </div>
  </form>
</div>
</div>
</div>
<?php#-------------------------------------------------------------------------------------------------------------------# ?>
<?php if($datapengiriman['status_pengiriman']=="Belum Dikirim" || $datapengiriman['status_pengiriman']=="Belum" || $datapengiriman['status_pengiriman']=="") {
  $warna="danger";
}
if($datapengiriman['status_pengiriman']=="Sudah Dikirim") {
  $warna="success";
}
?>
<tr class="<?php echo $warna; ?>">
  <td><?php echo $no?></td>
  <td><?php echo $datapengiriman['id_pemesanan']?></td>
  

  <td><center>  <?php echo IndonesiaTgl($tgl_pemesanan);?>  </center></td>
  <td><center><?php echo $datapengiriman['nm_penerima']?></center></td>
  <td><?php echo '('.$datapengiriman['alamat_penerima'].') Kelurahan '.$datapengiriman['nama_kel'].', Kecamatan '.$datapengiriman['nama_kec'].', Kabupaten '.$datapengiriman['nama_kab'].', Provinsi '.$datapengiriman['nama_prov']?></td>
  <td><?php echo $datapengiriman['mobile_penerima']?></td>
  <td><?php echo 'Rp. '. number_format($datapengiriman['biayakirim'],0,',','.');?>,-</td>
  <td>
  <?php if($datapengiriman['tgl_pengiriman']>0 ){
  echo IndonesiaTgl($datapengiriman['tgl_pengiriman']);
}else{?><center>Belum Dikirim</center><?php } ?>
  </center></td>
  <td><center><?php if($datapengiriman['status_pengiriman']=='' || $datapengiriman['status_pengiriman']=='Belum'){ echo 'Belum Dikirim'; }else{ echo $datapengiriman['status_pengiriman'];}?></center></td>
  
  <td><CENTER> 
    <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#editpengiriman<?php echo $datapengiriman['id_pemesanan']; ?>" > <i class="fa fa-pencil"></i></button></a>
    <button data-toggle="modal" data-target="#hapuspengiriman<?php echo $datapengiriman['id_pemesanan']; ?>" href="#hapuspengiriman<?php echo $datapengiriman['id_pemesanan']; ?>" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button>
  </CENTER>
</td>
</tr>


<?php } ?>

</tbody>
</table>











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
