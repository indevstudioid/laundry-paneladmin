<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : kelurahan.php                                      #
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

<title>Data kelurahan</title>

<?php 
headfixdatatabel();

script_kelurahan();

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
          Data kelurahan
          <small>
            Manage Your Data kelurahan
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Master Data <small>kelurahan</small></h2>
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
              Berikut ini merupakan seluruh data kelurahan yang ada di Indonesia
            </p>

            <a href="kelurahan.tambah.php"><button type="button" class="btn btn-info"><i class="fa fa-plus-square" ></i> Tambah Data</button></a><p></p>

            <table id="tabelkelurahan"  cellpadding="0" cellspacing="0" border="0" class="display" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" width="100%">
              <thead>
                <tr>                
                  <th><center>Provinsi</center></th>
                  <th><center>Kabupaten</center></th>
                  <th><center>Kecamatan</center></th>
                  <th><center>Kelurahan</center></th>
                  <th><center>Action</center></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Popup -->
    <div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="H2">Hapus Data Kelurahan</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Anda yakin ingin menghapus data Kelurahan :<?php echo "$row[nama_kel]";?> ?
      </div>
      <form class="form-horizontal" id="formkelurahan">
      <input type="hidden" class="form-control" id="id_kel" name="id_kel">
              <input type="hidden" class="form-control" id="type" name="type">
        <div class="form-group">
          <label>Provinsi</label>
          <input class="form-control" name="nama_prov" id="nama_prov" disable readonly required  />
        </div>
        <div class="form-group">
          <label>Kabupaten</label>
          <input class="form-control" name="nama_kab" id="nama_kab" disable readonly required  />
        </div>
        <div class="form-group">
          <label>Kecamatan</label>
          <input class="form-control" name="nama_kec" id="nama_kec" disable readonly required  />
        </div>
        <div class="form-group">
          <label>Kelurahan</label>
          <input class="form-control" name="nama_kel" id="nama_kel" disable readonly required  />
        </div>
        </form>
<div class="modal-footer">
            <button type="button" onClick="buttondelete()" class="btn btn-default" data-dismiss="modal">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
<script type="text/javascript">
      function showModals( id_kel )
      {

        clearModals();
        
        // Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
        if( id_kel )
        {
          $.ajax({
            type: "POST",
            url: "kelurahan.hapus.php",
            dataType: 'json',
            data: {id_kel:id_kel,type:"get"},
            success: function(res) {

              setModalData( res );
            }
          });
        }
        // Untuk Tambahkan Data
        else
        {
          $("#myModals").modal("show");
          $("#myModalLabel").html("New Data");
          $("#type").val("new"); 

        }
      }
      
      //Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
      function setModalData( data )
      {
        $("#namakelurahan").html(data.nama_kel);
        $("#myModalLabel").html(data.nama_kel);
        
        $("#type").val("edit");
        $("#id_kel").val(data.id_kel);
        $("#id_kec").val(data.id_kec);
        $("#nama_kel").val(data.nama_kel);
        $("#myModals").modal("show");
      }
      
      //Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
      function buttondelete()
      {
        var formData = $("#formkelurahan").serialize();
        
        $.ajax({
          type: "POST",
          url: "kelurahan.hapus.php",
          dataType: 'json',
          data: formData,
          success: function(data) {
            dTable.ajax.reload(); // Untuk Reload Tables secara otomatis
          }
        });
      }
      
      
      //Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
      
      
      function deletekelurahan( id_kel )
      {

        $.ajax({
          type: "POST",
          url: "kelurahan.hapus.php",
          dataType: 'json',
          data: {id_kel:id_kel,type:"get"},
          success: function(data) {
            $("#namakelurahan").html(data.nama_kel);
            $("#myModals").show();
            $("#removeWarning").show();
            $("#myModalLabel").html("Hapus kelurahan");
            $("#id_kel").val(data.id_kel);  
            $("#type").val("delete");
            $("#nama_prov").val(data.nama_prov).attr("disabled","true");
            $("#nama_kab").val(data.nama_kab).attr("disabled","true");
            $("#nama_kec").val(data.nama_kec).attr("disabled","true");
            $("#nama_kel").val(data.nama_kel).attr("disabled","true");
            $("#myModals").modal("show");
            
          }
        });
      }
    </script>
    <?php

    BagianFooterPanelAdmin();

    NgisoraneJsDataTabel();
    ?>




