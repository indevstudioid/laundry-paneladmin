<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : customer.php                                        #
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

<title>Data customer</title>

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
          Data customer
          <small>
            Manage Your Data customer
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Master Data <small>customer</small></h2>
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
              Berikut ini merupakan data customer yang ada di roverland cloth
            </p>
            <a href="customer.tambah"> <button type="button" class="btn btn-info" data-toggle="modal" ><i class="fa fa-plus-square" ></i> Tambah</button></a><p></p>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th><center>No</center> </th>
                  <th><center>Kode customer</center> </th>
                  <th><center>Nama customer</center> </th>
                  <th><center>Jenis Kelamin</center> </th>
                  <th><center>Alamat</center> </th>
                  <th><center>No Hp</center> </th>
                  <th><center>Email</center> </th>
                  <th><center>Option</center> </th>
                </tr>
              </thead>
              <div class="col-lg-12">
                <?php 
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Query                                                   
#-------------------------------------------------------------------------------------------------------------------#                          

                $no=0;
                $querycustomer="SELECT *FROM customer";
                $execustomer=mysql_query($querycustomer);
                while ($datacustomer=mysql_fetch_array($execustomer)) { 
                  $no++;
#-------------------------------------------------------------------------------------------------------------------#?>


<?php#-------------------------------------------------------------------------------------------------------------------#
#                                                     Hapus Data customer                                                  
#-------------------------------------------------------------------------------------------------------------------#
?> 

<div class="modal" id="hapuscustomer<?php echo $datacustomer['kd_customer']; ?>" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">Hapus Data customer</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Anda yakin ingin menghapus data customer <?php echo "$datacustomer[nm_customer]";?> ?
      </div>
      <form class="form-horizontal" id="formcustomer">
       <form role="form" method="post" enctype="multipart/form-data" >
        <div class="form-group">
          <label>Nama customer</label>
          <input class="form-control" name="nama_customer" value="<?php echo "$datacustomer[nm_customer]"; ?>" disable readonly required  />
        </div>
      </div>
      <div class="modal-footer">                                            
        <a href="customer.hapus?id=<?php echo $datacustomer['kd_customer'];?>"> <button type="button" class="btn btn-default"></i> Yes</button></a>
        <button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
      </div>
    </form>
  </div>
</div>
</div>
<?php#-------------------------------------------------------------------------------------------------------------------# ?>
<tr>
  <td><?php echo $no?></td>
  <td><?php echo $datacustomer['kd_customer']?></td>
  <td><?php echo $datacustomer['nm_customer']?></td>
  <td><?php echo $datacustomer['gender']?></td>
  <td><?php echo $datacustomer['alamat']?></td>
  <td><?php echo $datacustomer['mobile']?></td>
  <td><?php echo $datacustomer['email']?></td>
  <td><CENTER> 
    <a href="customer.edit?id=<?php echo $datacustomer['kd_customer'];?>"><button class="btn btn-success btn-xs" > <i class="fa fa-pencil"></i></button></a>
    <button data-toggle="modal" data-target="#hapuscustomer<?php echo $datacustomer['kd_customer']; ?>" href="#hapuscustomer<?php echo $datacustomer['kd_customer']; ?>" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button>
  </CENTER>
</td>
</tr>


<?php } ?>

</tbody>
</table>
<?php
JsDataTabel();
?>