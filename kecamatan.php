<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : kecamatan.php                                      #
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

<title>Data kecamatan</title>

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
script_kecamatan();

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
          Data Kecamatan
          <small>
            Manage Your Data Kecamatan
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Master Data <small>Kecamatan</small></h2>
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
              Berikut ini merupakan seluruh data kecamatan yang ada di Indonesia
            </p>

            <a href="kecamatan.tambah.php"><button type="button" class="btn btn-info"><i class="fa fa-plus-square" ></i> Tambah Data</button></a><p></p>

            <table id="tabelkecamatan"  cellpadding="0" cellspacing="0" border="0" class="display" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" width="100%">
              <thead>
                <tr>
                  <th>provinsi</th>
                  <th>kabupaten</th>
                  <th>kecamatan</th>
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
              Anda yakin ingin menghapus data kecamatan <span id="namakecamatan"></span>?
            </div>
            <form class="form-horizontal" id="formkecamatan">
              
              <input type="hidden" class="form-control" id="id_kec" name="id_kec">
              <input type="hidden" class="form-control" id="type" name="type">
              <div class="form-group">
                <label for="nama_kec" class="col-sm-2 control-label">Kecamatan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama_kec" name="nama_kec" ></textarea>
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
      function showModals( id_kec )
      {

        clearModals();
        
        // Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
        if( id_kec )
        {
          $.ajax({
            type: "POST",
            url: "kecamatan.hapus.php",
            dataType: 'json',
            data: {id_kec:id_kec,type:"get"},
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
        $("#namakecamatan").html(data.nama_kec);
        $("#myModalLabel").html(data.nama_kec);
        $("#id_ongkos").val(data.id_ongkos);
        $("#type").val("edit");
        $("#id_kec").val(data.id_kec);
        $("#id_prov").val(data.id_prov);
        $("#nama_kec").val(data.nama_kec);
        $("#myModals").modal("show");
      }
      
      //Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
      function buttondelete()
      {
        var formData = $("#formkecamatan").serialize();
        
        $.ajax({
          type: "POST",
          url: "kecamatan.hapus.php",
          dataType: 'json',
          data: formData,
          success: function(data) {
            dTable.ajax.reload(); // Untuk Reload Tables secara otomatis
          }
        });
      }
      
      
      //Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
      
      
      function deletekecamatan( id_kec )
      {

        $.ajax({
          type: "POST",
          url: "kecamatan.hapus.php",
          dataType: 'json',
          data: {id_kec:id_kec,type:"get"},
          success: function(data) {
            $("#namakecamatan").html(data.nama_kec);
            $("#myModals").show();
            $("#removeWarning").show();
            $("#myModalLabel").html("Hapus Kecamatan");
            $("#id_kec").val(data.id_kec);  
            $("#type").val("delete");
            $("#nama_prov").val(data.nama_prov).attr("disabled","true");
            $("#nama_kab").val(data.nama_kab).attr("disabled","true");
            $("#nama_kec").val(data.nama_kec).attr("disabled","true");
            $("#myModals").modal("show");
            
          }
        });
      }
    </script>
    <?php

    BagianFooterPanelAdmin();

    NgisoraneJsDataTabel();
    ?>




