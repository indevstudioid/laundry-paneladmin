<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : ukuran.php                                        #
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

<title>Data ukuran</title>

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
          Data ukuran
          <small>
            Manage Your Data ukuran
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Master Data <small>ukuran</small></h2>
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
              Berikut ini merupakan data ukuran yang ada di roverland cloth
            </p>
            <a href="ukuran.tambah"> <button type="button" class="btn btn-info" data-toggle="modal" ><i class="fa fa-plus-square" ></i> Tambah</button></a><p></p>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th><center>No</center> </th>
                  <th><center>Kategori</center> </th>
                  <th><center>Kode ukuran</center> </th>
                  <th><center>Nama ukuran</center> </th>
                  <th><center>Option</center> </th>
                </tr>
              </thead>
              <div class="col-lg-12">
                <?php 
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Query                                                   
#-------------------------------------------------------------------------------------------------------------------#                          

                $no=0;
                $queryukuran="SELECT *FROM ukuran, categories WHERE categories.kd_categories=ukuran.kd_categories ";
                $exeukuran=mysql_query($queryukuran);
                while ($dataukuran=mysql_fetch_array($exeukuran)) { 
                  $no++;
#-------------------------------------------------------------------------------------------------------------------#?>


<?php#-------------------------------------------------------------------------------------------------------------------#
#                                                     Hapus Data ukuran                                                  
#-------------------------------------------------------------------------------------------------------------------#
?> 

<div class="modal" id="hapusukuran<?php echo $dataukuran['kd_ukuran']; ?>" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">Hapus Data ukuran</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Anda yakin ingin menghapus data ukuran <?php echo "$dataukuran[nama_ukuran]";?> ?
      </div>
      <form class="form-horizontal" id="formukuran">
       <form role="form" method="post" enctype="multipart/form-data" >
        <div class="form-group">
          <label>Nama ukuran</label>
          <input class="form-control" name="nama_ukuran" value="<?php echo "$dataukuran[nama_ukuran]"; ?>" disable readonly required  />
        </div>
      </div>
      <div class="modal-footer">                                            
        <a href="ukuran.hapus?id=<?php echo $dataukuran['kd_ukuran'];?>"> <button type="button" class="btn btn-default"></i> Yes</button></a>
        <button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
      </div>
    </form>
  </div>
</div>
</div>
<?php#-------------------------------------------------------------------------------------------------------------------# ?>

<tr>
  <td><?php echo $no?></td>
  <td><?php echo $dataukuran['nama_categories']?></td>
  <td><?php echo $dataukuran['kd_ukuran']?></td>
  <td><?php echo $dataukuran['nama_ukuran']?></td>
  <td><CENTER> 
    <a href="ukuran.edit?id=<?php echo $dataukuran['kd_ukuran'];?>"><button class="btn btn-success btn-xs" > <i class="fa fa-pencil"></i></button></a>
    <button data-toggle="modal" data-target="#hapusukuran<?php echo $dataukuran['kd_ukuran']; ?>" href="#hapusukuran<?php echo $dataukuran['kd_ukuran']; ?>" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button>
  </CENTER>
</td>
</tr>


<?php } ?>

</tbody>
</table>
<?php
JsDataTabel();
?>