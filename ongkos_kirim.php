<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : ongkos_kirim.php                                    #
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

<title>Data Biaya Ongko Kirim</title>

<?php 
headfixdatatabel();

script_ongkos_kirim();

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
          Data Biaya Ongkos Kirim
          <small>
            Manage Your Data Biaya Ongkos Kirim
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Master Data <small>Biaya Ongkos Kirim</small></h2>
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
              Berikut ini merupakan seluruh data Biaya Ongkos Kirim yang ada di Indonesia
            </p>

            <a href="ongkos_kirim.tambah.php"><button type="button" class="btn btn-info"><i class="fa fa-plus-square" ></i> Tambah Data</button></a><p></p>

            <table id="tabelongkoskirim"  cellpadding="0" cellspacing="0" border="0" class="display" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" width="100%">
              <thead>
                <tr>
                  <th><center>Provinsi</center></th>
                  <th><center>Kabupaten</center></th>
                  <th><center>Kecamatan</center></th>
                  <th><center>Reguler</center></th>
                  <th><center>Estimasi Reg (Hari)</center></th>
                  <th><center>Oke</center></th>
                  <th><center>Estimasi Oke (Hari)</center></th>
                  <th><center>Origin</center></th>
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
        <h4 class="modal-title" id="H2">Hapus Data Ongkos Kirim</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" role="alert" id="removeWarning">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Anda yakin ingin menghapus data ongkos kirim di kecamatan :<?php echo "$row[nama_kec]";?> ?
      </div>
      <form class="form-horizontal" id="formongkoskirim">
       
              <input type="hidden" class="form-control" id="id_ongkos" name="id_ongkos">
              <input type="hidden" class="form-control" id="type" name="type">
        <div class="form-group">
          <label>Provinsi</label>
          <input class="form-control" id="nama_prov" name="nama_prov"  disable readonly required  />
        </div>
        <div class="form-group">
          <label>Kabupaten</label>
          <input class="form-control" id="nama_kab" name="nama_kab" value="<?php echo "$row[nama_kab]"; ?>" disable readonly required  />
        </div>
        <div class="form-group">
          <label>Kecamatan</label>
          <input class="form-control" id="nama_kec" name="nama_kec" value="<?php echo "$row[nama_kec]"; ?>" disable readonly required  />
        </div>
        <div class="form-group">
          <label>Harga Paket Reguler</label>
          <div class="input-group">
              <span class="input-group-addon">Rp.</span>
              <input id="reg" value=" <?php echo" $reg,-"; ?>" onkeyup="convertToRupiah(this);" type="text" pattern="[0-9.]+"  disable readonly name="reg" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label>Estimasi Paket Reguler</label>
          <div class="input-group">
           <span class="input-group-addon">Hari</span>
            <input type="text" id="estimasi_reg" name="estimasi_reg" value="<?php echo" $row[estimasi_reg] Hari"; ?>"  disable readonly class="form-control col-md-7 col-xs-12">
          </div>
        </div>
        <div class="form-group">
          <label>Harga Paket Oke</label>
          <div class="input-group">
              <span class="input-group-addon">Rp.</span>
              <input id="oke" onkeyup="convertToRupiah(this);" type="text" pattern="[0-9.]+" name="oke" value=" <?php echo" $oke,-"; ?>"  disable readonly class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label>Estimasi Paket Oke</label>
          <div class="input-group">
           <span class="input-group-addon">Hari</span>
            <input type="text" id="estimasi_oke" name="estimasi_oke" value="  <?php echo" $row[estimasi_oke] Hari"; ?>"  disable readonly class="form-control col-md-7 col-xs-12">
            
            </div>
        </div>
      </div>
</form>


      <div class="modal-footer">
            <button type="button" onClick="buttondelete()" class="btn btn-default" data-dismiss="modal">Yes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function showModals( id_ongkos )
      {

        clearModals();
        
        // Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
        if( id_ongkos )
        {
          $.ajax({
            type: "POST",
            url: "ongkos_kirim.hapus.php",
            dataType: 'json',
            data: {id_ongkos:id_ongkos,type:"get"},
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
        $("#id").val(data.id);
        $("#type").val("edit");
        $("#id_ongkos").val(data.id_ongkos);
        $("#id_prov").val(data.id_prov);
        $("#nama_kec").val(data.nama_kec);
        $("#myModals").modal("show");
      }
      
      //Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
      function buttondelete()
      {
        var formData = $("#formongkoskirim").serialize();
        
        $.ajax({
          type: "POST",
          url: "ongkos_kirim.hapus.php",
          dataType: 'json',
          data: formData,
          success: function(data) {
            dTable.ajax.reload(); // Untuk Reload Tables secara otomatis
          }
        });
      }
      
      
      //Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
      
      
      function deleteongkos_kirim( id_ongkos )
      {

        $.ajax({
          type: "POST",
          url: "ongkos_kirim.hapus.php",
          dataType: 'json',
          data: {id_ongkos:id_ongkos,type:"get"},
          success: function(data) {
            $("#namakecamatan").html(data.nama_kec);
            $("#myModals").show();
            $("#removeWarning").show();
            $("#myModalLabel").html("Hapus Kecamatan");
            $("#id_ongkos").val(data.id_ongkos);  
            $("#type").val("delete");
            $("#nama_prov").val(data.nama_prov).attr("disabled","true");
            $("#nama_kab").val(data.nama_kab).attr("disabled","true");
            $("#nama_kec").val(data.nama_kec).attr("disabled","true");
            $("#reg").val(data.reg).attr("disabled","true");
            $("#estimasi_reg").val(data.estimasi_reg).attr("disabled","true");
            $("#oke").val(data.oke).attr("disabled","true");
            $("#estimasi_oke").val(data.estimasi_oke).attr("disabled","true");
            $("#myModals").modal("show");
            
          }
        });
      }
    </script>
    <?php

    BagianFooterPanelAdmin();

    NgisoraneJsDataTabel();
    ?>

fmoda


