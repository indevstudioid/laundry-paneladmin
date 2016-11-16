<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : bank.php                                        #
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

<title>Data bank</title>

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
					Data bank
					<small>
						Manage Your Data bank
					</small>
				</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Master Data <small>bank</small></h2>
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
							Berikut ini merupakan data bank yang ada di roverland cloth
						</p>
						<a href="bank.tambah"> <button type="button" class="btn btn-info" data-toggle="modal" ><i class="fa fa-plus-square" ></i> Tambah</button></a><p></p>
						<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><center>No</center> </th>
									<th><center>Nama Bank</center> </th>
									<th><center>No Rekening</center> </th>
									<th><center>Nama Pemilik</center> </th>
									<th><center>Gamabar</center> </th>
									<th><center>Option</center> </th>
								</tr>
							</thead>
							<div class="col-lg-12">
								<?php 
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Query                                                   
#-------------------------------------------------------------------------------------------------------------------#                          

								$no=0;
								$querybank="SELECT *FROM bank";
								$exebank=mysql_query($querybank);
								while ($databank=mysql_fetch_array($exebank)) { 
									$no++;
#-------------------------------------------------------------------------------------------------------------------#?>


<?php#-------------------------------------------------------------------------------------------------------------------#
#                                                     Hapus Data bank                                                  
#-------------------------------------------------------------------------------------------------------------------#
?> 





<div class="modal" id="hapusbank<?php echo $databank['kd_bank']; ?>" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="H2">Hapus Data bank</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger" role="alert" id="removeWarning">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					Anda yakin ingin menghapus data bank ini ?
				</div>
				<form class="form-horizontal" id="formbank">
					<form role="form" method="post" enctype="multipart/form-data" >
						<div class="form-group">
							<label>Nama Bank</label>
							<input class="form-control" type="text" value="<?php echo $databank['nama_bank'];?>" readonly>
						</div>
						<div class="form-group">
						<label>Nama Pemilik</label>
							<input class="form-control" type="text" value="<?php echo $databank['pemilik'];?>" readonly>
						</div>
						<div class="form-group">
							<label>No Rekening Bank</label>
							<input class="form-control" type="text" value="<?php echo $databank['no_rekening'];?>" readonly>
						</div>
						<div class="form-group">
							<label>Gambar</label>
						<img id="image-gallery-image" class="img-responsive img-rounded" src="../assets/images/bank/<?php echo $databank['foto']?>">
						</div>

					</div>
					<div class="modal-footer">                                            
						<a href="bank.hapus?id=<?php echo $databank['kd_bank'];?>&file=<?php echo $databank['foto'];?>"> <button type="button" class="btn btn-default"></i> Yes</button></a>
						<button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php#-------------------------------------------------------------------------------------------------------------------# ?>

	<tr>
		<td><?php echo $no?></td>
		<td><?php echo $databank['nama_bank']?></td>
		<td><?php echo $databank['no_rekening']?></td>
		<td><?php echo $databank['pemilik']?></td>
		<td><center><a  href="#" data-image-id="" data-toggle="modal" data-title="This is my title" data-caption="Some lovely red flowers" data-image="../assets/images/bank/<?php echo $databank['foto']?>" data-target="#image-gallery<?php echo $databank['kd_bank']; ?>">
			<img class="img-responsive img-circle" width="100px" height="100x" src="../assets/images/bank/<?php echo $databank['foto']?>" alt="Short alt text">
		</a></center></td>
		<td><CENTER> 
			<a href="bank.edit?id=<?php echo $databank['kd_bank'];?>"><button class="btn btn-success btn-xs" > <i class="fa fa-pencil"></i></button></a>
			<button data-toggle="modal" data-target="#hapusbank<?php echo $databank['kd_bank']; ?>" href="#hapusbank<?php echo $databank['kd_bank']; ?>" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button>
		</CENTER>
	</td>
</tr>



<?php } ?>

</tbody>
</table>

<?php
JsDataTabel();

?>