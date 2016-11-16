<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : product.php                                        #
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

<title>Data product</title>

<?php 
DataHeadTabel();

validator();

BagianSideBarPanelAdmin();

BagianTopNavi();

?>

<div class="right_col" role="main">
 <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Tambah Product <small></small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="row">
<div class="alert alert-info" role="alert" id="removeWarning">
      <span class="glyphicon " aria-hidden="true"></span>
      <span class="sr-only"></span>
      Silahkan Pilih Kategori Product yang Akan Ditambahkan :)
    </div>
                    
<?php 
$querycategories="SELECT *FROM categories";
                $execategories=mysql_query($querycategories);
                while ($datacategories=mysql_fetch_array($execategories)) { ?>
                    <div class="col-md-4">
                      <div class="thumbnail">
                        <div class="image view view-first">
                          <img style="width: 100%; display: block;" src="../assets/admin/paneladmin/images/<?php echo $datacategories['foto']?>" alt="image">
                          <div class="mask">
                            <p><?php echo $datacategories['nama_categories']?></p>
                            <div class="tools tools-bottom">
                              
                              <a href="product.tambah?kd_categories=<?php echo $datacategories['kd_categories'];?> "><button class="btn btn-round btn-success"> <i class="fa fa-plus"></i></button></a>
                              
                            </div>
                          </div>
                        </div>
                        <div class="caption">

                          <center><p><?php echo $datacategories['description']?></p></center>
                        </div>
                      </div>
                    </div>

                 <?php }   ?>
                  </div>

                </div>
              </div>
            </div>
          </div>
 </div>

<?php
JsDataTabel();

?>