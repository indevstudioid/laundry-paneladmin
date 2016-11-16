<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : Kabupaten.php                                       #
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

<title>Data Kabupaten</title>

<?php 
headfixdatatabel();
?>
<script type="text/javascript">
  var htmlobjek;
  $(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=provinsi>
  $("#id_prov").change(function(){
    var id_prov = $("#id_prov").val();
    $.ajax({
      url: "../inc/jikuk_kabupaten.php",
      data: "id_prov="+id_prov,
      cache: false,
      success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kabupaten>
            $("#id_kab").html(msg);
          }
        });
  });
});
</script>

<?php
script_kabupaten();

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
          Data Kabupaten
          <small>
            Manage Your Data Kabupaten
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Master Data <small>Kabupaten</small></h2>
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
              Berikut ini merupakan seluruh data Kabupaten yang ada di Indonesia
            </p>

            <a href="kabupaten.tambah.php"><button type="button" class="btn btn-info"><i class="fa fa-plus-square" ></i> Tambah Data</button></a><p></p>

            <table id="tabelkabupaten"  cellpadding="0" cellspacing="0" border="0" class="display" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" width="100%">
              <thead>
                <tr>
                  <th>provinsi</th>
                  <th>kabupaten</th>
                  <th>Action</th>
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
            
            <div class="alert alert-danger" role="alert" id="removeWarning">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              Anda yakin ingin menghapus data Kabupaten <span id="namakabupaten"></span>?
            </div>
            <form class="form-horizontal" id="formkabupaten">
              
              <input type="hidden" class="form-control" id="id_kab" name="id_kab">
              <input type="hidden" class="form-control" id="type" name="type">
              <div class="form-group">
                <label for="nama_kab" class="col-sm-2 control-label">Kabupaten</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama_kab" name="nama_kab" ></textarea>
                </div>
              </div>
            </form>
            <br>
          </div>
          <div class="modal-footer">
            <button type="button" onClick="buttondelete()" class="btn btn-default" data-dismiss="modal">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function showModals( id_kab )
      {

        clearModals();
        
        // Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
        if( id_kab )
        {
          $.ajax({
            type: "POST",
            url: "Kabupaten.hapus.php",
            dataType: 'json',
            data: {id_kab:id_kab,type:"get"},
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
        $("#namaKabupaten").html(data.nama_kab);
        $("#myModalLabel").html(data.nama_kab);
        $("#id").val(data.id);
        $("#type").val("edit");
        $("#id_kab").val(data.id_kab);
        $("#id_prov").val(data.id_prov);
        $("#nama_kab").val(data.nama_kab);
        $("#myModals").modal("show");
      }
      
      //Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
      function buttondelete()
      {
        var formData = $("#formkabupaten").serialize();
        
        $.ajax({
          type: "POST",
          url: "Kabupaten.hapus.php",
          dataType: 'json',
          data: formData,
          success: function(data) {
            dTable.ajax.reload(); // Untuk Reload Tables secara otomatis
          }
        });
      }
      
      
      //Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
      
      
      function deletekabupaten( id_kab )
      {

        $.ajax({
          type: "POST",
          url: "Kabupaten.hapus.php",
          dataType: 'json',
          data: {id_kab:id_kab,type:"get"},
          success: function(data) {
            $("#namakabupaten").html(data.nama_kab);
            $("#myModals").show();
            $("#removeWarning").show();
            $("#myModalLabel").html("Hapus Kabupaten");
            $("#id_kab").val(data.id_kab);  
            $("#type").val("delete");
            $("#nama_kab").val(data.nama_kab).attr("disabled","true");
            $("#myModals").modal("show");
            
          }
        });
      }
    </script>
    <?php

    BagianFooterPanelAdmin();

    NgisoraneJsDataTabel();
    ?>




