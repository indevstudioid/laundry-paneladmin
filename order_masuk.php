<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : order_masuk.php                                        #
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

<title>Data Pemesanan</title>

<?php 
DataHeadTabel();

validator();

BagianSideBarPanelAdmin();

BagianTopNavi();

?>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>
          Data pemesanan
          <small>
            Manage Your Data pemesanan
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Master Data <small>pemesanan</small></h2>
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
              Berikut ini merupakan data pemesanan yang ada di roverland cloth
            </p>
            <p></p>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th><center>No</center> </th>
              <th><center>No Pemesanan</center> </th>
              <th><center>Nama</center> </th>
              <th><center>Tanggal Pesan</center> </th>
              
              <th><center>Batas Pembayaran</center> </th>
              
              <th><center>Total Pembayaran</center> </th>
              <th><center>Status</center> </th>
              
              <th width="9%"><center>Option</center> </th>
                </tr>
              </thead>
              <div class="col-lg-12">
                <?php 
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Query                                                   
#-------------------------------------------------------------------------------------------------------------------#                          

                $no=0;
                $querypemesanan="SELECT *
FROM
customer
INNER JOIN pemesanan ON pemesanan.kd_customer = customer.kd_customer
";
                $exepemesanan=mysql_query($querypemesanan);
                while ($datapemesanan=mysql_fetch_array($exepemesanan)) { 
                  $no++;
                  $tgl_pemesanan=$datapemesanan['tgl_pemesanan'];
              $batas_tgl_bayar=kelolatanggal("$tgl_pemesanan","+2 day");

#-------------------------------------------------------------------------------------------------------------------#?>


<?php#-------------------------------------------------------------------------------------------------------------------#
#                                                     Hapus Data pemesanan                                                  
#-------------------------------------------------------------------------------------------------------------------#
?> 

<div class="modal" id="hapuspemesanan<?php echo $datapemesanan['id_pemesanan']; ?>" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">Hapus Data pemesanan</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Anda yakin ingin menghapus data pemesanan <?php echo "$datapemesanan[id_pemesanan]";?> ?
      </div>
      <form class="form-horizontal" id="formpemesanan">
       <form role="form" method="post" enctype="multipart/form-data" >
        <div class="form-group">
          <label>Kode Pemesanan </label>
          <input class="form-control" name="nama_pemesanan" value="<?php echo "$datapemesanan[id_pemesanan]"; ?>" disable readonly required  />
        </div>
        <div class="form-group">
          <label>Kode Customer</label>
          <input class="form-control" name="nama_pemesanan" value="<?php echo "$datapemesanan[kd_customer]"; ?>" disable readonly required  />
        </div>
        <div class="form-group">
          <label>Nama Customer</label>
          <input class="form-control" name="nama_pemesanan" value="<?php echo "$datapemesanan[nm_customer]"; ?>" disable readonly required  />
        </div>
        <div class="form-group">
          <label>Tanggal Pemesanan</label>
          <input class="form-control" name="nama_pemesanan" value="<?php echo IndonesiaTgl($tgl_pemesanan);?>" disable readonly required  />
        </div>
        <div class="form-group">
          <label>Total Pembayaran</label>
          <input class="form-control" name="nama_pemesanan" value="<?php echo 'Rp. '. number_format($datapemesanan['grandtotal'],0,',','.');?>,-" disable readonly required  />
        </div>
        
      </div>
      <div class="modal-footer">                                            
        <a href="actionorder?act=hapus&&id=<?php echo $datapemesanan['id_pemesanan'];?>"> <button type="button" class="btn btn-default"></i> Yes</button></a>
        <button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
      </div>
    </form>
  </div>
</div>
</div>
<?php#-------------------------------------------------------------------------------------------------------------------# ?>
<?php if($datapemesanan['status_pemesanan']=="Pesan") {
  $warna="warning";
}
if($datapemesanan['status_pemesanan']=="Lunas") {
  $warna="succes";
}
if($datapemesanan['status_pemesanan']=="Batal") {
  $warna="danger";
}?>
<tr class="<?php echo $warna; ?>">
  <td><?php echo $no?></td>
  <td><?php echo $datapemesanan['id_pemesanan']?></td>
  <td><?php echo $datapemesanan['nm_customer']?></td>
  <td><?php echo IndonesiaTgl($tgl_pemesanan);?></td>
  <td class="<?php echo $warna; ?>"><?php echo IndonesiaTgl($batas_tgl_bayar);?></td>
  <td><?php echo 'Rp. '. number_format($datapemesanan['grandtotal'],0,',','.');?>,-</td>
  <td class="<?php echo $warna; ?>"><?php echo $datapemesanan['status_pemesanan']?></td>
  <td><CENTER> 
    <a href="pemesanan.lihat?id=<?php echo $datapemesanan['id_pemesanan'];?>"><button class="btn btn-success btn-xs" > <i class="fa fa-search"></i></button></a>
    <button data-toggle="modal" data-target="#hapuspemesanan<?php echo $datapemesanan['id_pemesanan']; ?>" href="#hapuspemesanan<?php echo $datapemesanan['id_pemesanan']; ?>" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button>
  </CENTER>
</td>
</tr>


<?php } ?>

</tbody>
</table>
<?php
JsDataTabel();
?>