<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : testimony.php                                        #
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

<title>Data Testimony</title>
<?php
if (isset($_POST['buttonsubmit'])) {

  #baca variabel 
	$kd_testimony  = $_POST['kd_testimony'];
	$tampilkan = $_POST['tampilkan'];

	if (trim($kd_testimony)=="") {
		$pesanError[]="Data <b>testimony</b> Masih kosong !!";
	}
	
	if (trim($tampilkan)=="") {
		$pesanError[]="Data <b>tampilkan</b> Masih kosong !!";
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
			$edit = mysql_query("UPDATE testimony SET tampilkan='$tampilkan' WHERE kd_testimony='$kd_testimony'") or die(mysql_error());

			if ($edit){

		//header('location: ./testimony');
			}
		}
	}

	?>
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
						Data Testimony
						<small>
							Manage Your Data Testimony
						</small>
					</h3>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Master Data <small>Testimony</small></h2>
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
								Berikut ini merupakan data Testimony yang ada di roverland cloth
							</p>
							<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th><center>No</center> </th>
										<th><center>Nama</center> </th>
										<th><center>Isi</center> </th>
										<th><center>Tampilkan</center> </th>
										<th><center>Option</center> </th>
									</tr>
								</thead>
								<div class="col-lg-12">
									<?php 
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Query                                                   
#-------------------------------------------------------------------------------------------------------------------#                          

									$no=0;
									$querytestimony="SELECT *FROM testimony, customer WHERE customer.kd_customer=testimony.kd_customer";
									$exetestimony=mysql_query($querytestimony);
									while ($datatestimony=mysql_fetch_array($exetestimony)) { 
										$no++;
#-------------------------------------------------------------------------------------------------------------------#?>


<?php#-------------------------------------------------------------------------------------------------------------------#
#                                                     Hapus Data testimony                                                  
#-------------------------------------------------------------------------------------------------------------------#
?> 

<div class="modal" id="hapustestimony<?php echo $datatestimony['kd_testimony']; ?>" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="H2">Hapus Data Testimony</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger" role="alert" id="removeWarning">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>
					Anda yakin ingin menghapus data Testimony <?php echo "$datatestimony[nama_testimony]";?> ?
				</div>
				<div class="form-group">
					<label>Kode Testimony</label>
					<input class="form-control" type="text" value="<?php echo $datatestimony['kd_testimony'];?>" readonly>
				</div>
				<div class="form-group">
					<label>Nama</label>
					<input class="form-control" type="text" value="<?php echo $datatestimony['nm_customer'];?>" readonly>
				</div>
				<div class="form-group">
					<label>Isi</label>
					<textarea class="form-control" type="text" value="<?php echo $datatestimony['isi'];?>" readonly><?php echo $datatestimony['isi'];?></textarea>
				</div>
			</div>
			<div class="modal-footer">                                            
				<a href="testimony.hapus?id=<?php echo $datatestimony['kd_testimony'];?>"> <button type="button" class="btn btn-default"></i> Yes</button></a>
				<button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
			</div>

		</div>
	</div>
</div>
<?php#-------------------------------------------------------------------------------------------------------------------# ?>

<?php#-------------------------------------------------------------------------------------------------------------------#
#                                                     Edit Data testimony                                                  
#-------------------------------------------------------------------------------------------------------------------#
?> 

<div class="modal" id="edit<?php echo $datatestimony['kd_testimony']; ?>" tabindex="-1"    role="dialog" aria-labelledby="myModalLabel" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="H2">Edit Data Testimony</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger" role="alert" id="removeWarning">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Pesan:</span>
					Anda Hanyabisa mengedit tampilkan testimony, apakah mau diaktifkan atau tidak  ?
				</div>
				
				<form  method="POST"  enctype="multipart/form-data" >
					
					
					<div class="form-group">
						<label>Kode Testimony</label>
						<input class="form-control" type="text" name="kd_testimony" value="<?php echo $datatestimony['kd_testimony'];?>" readonly>
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input class="form-control" type="text" value="<?php echo $datatestimony['nm_customer'];?>" readonly>
					</div>
					<div class="form-group">
						<label>Isi</label>
						<textarea class="form-control" type="text" value="<?php echo $datatestimony['isi'];?>" readonly><?php echo $datatestimony['isi'];?></textarea>
					</div>
					<div class="form-group">

						<label>Tampilkan </label>
						
							<?php if ($datatestimony['tampilkan']==="Y"){ ?>
							<div class="radio">
								<label>
									<input type="radio"  checked name="tampilkan" value="Y"> Yes
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio"  name="tampilkan" value="N"> No
								</label>
							</div>
							<?php } else{ ?>
							<div class="radio">
								<label>
									<input type="radio"  name="tampilkan" value="Y"> Yes
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio"  checked name="tampilkan" value="N"> No
								</label>
							</div>
							<?php  }?>
						
					</div>

					<div class="modal-footer">                                            
						<button type="submit" id="buttonsubmit" name="buttonsubmit" class="btn btn-default"></i> Yes</button>
						<button type="button" data-toggle="modal" data-dismiss="modal" class="btn btn-default"></i> No</button>
					</div>
				</form>

			</div>
		</div>
	</div>
	<?php#-------------------------------------------------------------------------------------------------------------------# ?>




	<tr>
		<td><?php echo $no?></td>
		<td><?php echo $datatestimony['nm_customer']?></td>
		<td><?php echo $datatestimony['isi']?></td>
		<td><?php echo $datatestimony['tampilkan']?></td>
		<td><CENTER> 
			<button data-toggle="modal" data-target="#edit<?php echo $datatestimony['kd_testimony']; ?>"  class="btn btn-success btn-xs" ><i class="fa fa-pencil"></i></button>
			<button data-toggle="modal" data-target="#hapustestimony<?php echo $datatestimony['kd_testimony']; ?>" href="#hapustestimony<?php echo $datatestimony['kd_testimony']; ?>" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i></button>
		</CENTER>
	</td>
</tr>


<?php } ?>

</tbody>
</table>
<?php
JsDataTabel();
?>