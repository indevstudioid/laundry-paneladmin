<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : artwork.php                                        #
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

<title>Data artwork</title>

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
          Data artwork
          <small>
            Manage Your Data artwork
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Master Data <small>artwork</small></h2>
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
              Berikut ini merupakan data artwork yang ada di roverland cloth
            </p>
            <a href="artwork.tambah"> <button type="button" class="btn btn-info" data-toggle="modal" ><i class="fa fa-plus-square" ></i> Tambah</button></a><p></p>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th><center>No</center> </th>
                  <th><center>Image</center> </th>
                  <th><center>Title</center> </th>
                  <th><center>Description</center> </th>
                  <th><center>Option</center> </th>
                </tr>
              </thead>
              <div class="col-lg-12">
                <?php 
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Query                                                   
#-------------------------------------------------------------------------------------------------------------------#                          

                $no=0;
                $queryartwork="SELECT *FROM artwork";
                $exeartwork=mysql_query($queryartwork);
                while ($dataartwork=mysql_fetch_array($exeartwork)) { 
                  $no++;
#-------------------------------------------------------------------------------------------------------------------#?>


<?php#-------------------------------------------------------------------------------------------------------------------#
#                                                     Hapus Data artwork                                                  
#-------------------------------------------------------------------------------------------------------------------#
?> 

<div class="modal fade" id="image-gallery<?php echo $dataartwork['kd_artwork']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="background: none">
    <div style="background: none">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="image-gallery-title"></h4>
        <img id="image-gallery-image" class="img-responsive img-rounded" src="../assets/user/images/artwork/<?php echo $dataartwork['foto']?>">
      </div>   
    </div>
  </div>
</div>



<div class="modal" id="hapusartwork<?php echo $dataartwork['kd_artwork']; ?>" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">Hapus Data artwork</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Anda yakin ingin menghapus data artwork ini ?
      </div>
      <form class="form-horizontal" id="formartwork">
       <form role="form" method="post" enctype="multipart/form-data" >
        <img id="image-gallery-image" class="img-responsive img-rounded" src="../assets/user/images/artwork/<?php echo $dataartwork['foto']?>">
      </div>
      <div class="modal-footer">                                            
        <a href="artwork.hapus?id=<?php echo $dataartwork['kd_artwork'];?>&file=<?php echo $dataartwork['foto'];?>"> <button type="button" class="btn btn-default"></i> Yes</button></a>
        <button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
      </div>
    </form>
  </div>
</div>
</div>
<?php#-------------------------------------------------------------------------------------------------------------------# ?>

<tr>
  <td><?php echo $no?></td>
  <td><center><a  href="#" data-image-id="" data-toggle="modal" data-title="This is my title" data-caption="Some lovely red flowers" data-image="../assets/user/images/artwork/<?php echo $dataartwork['foto']?>" data-target="#image-gallery<?php echo $dataartwork['kd_artwork']; ?>">
                <img class="img-responsive img-circle" width="100px" height="100x" src="../assets/user/images/artwork/<?php echo $dataartwork['foto']?>" alt="Short alt text">
            </a></center></td>
  <td><?php echo $dataartwork['title']?></td>
  <td><?php echo $dataartwork['deskribsi']?></td>
  <td><CENTER> 
    <a href="artwork.edit?id=<?php echo $dataartwork['kd_artwork'];?>"><button class="btn btn-success btn-xs" > <i class="fa fa-pencil"></i></button></a>
    <button data-toggle="modal" data-target="#hapusartwork<?php echo $dataartwork['kd_artwork']; ?>" href="#hapusartwork<?php echo $dataartwork['kd_artwork']; ?>" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button>
  </CENTER>
</td>
</tr>



<?php } ?>

</tbody>
</table>

<?php
JsDataTabel();

?>