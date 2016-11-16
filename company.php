<?php
#-------------------------------------------------------------------------------------------------------------------#
#                                                     Information                                                   #
#-------------------------------------------------------------------------------------------------------------------#
#                                               Created By    : Fajar Nurrohmat                                     #
#                                               Email         : Fajarnur24@gmail.com                                #
#                                               Name File     : company.php                                #
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

<title>Data Company</title>

<?php 
$kd_halaman  = $_POST['kd_halaman'];
$content= $_POST['content'];
  $mySql = "SELECT * FROM halaman WHERE kd_halaman='COMPANY' ";
  $myQry = mysql_query($mySql);
  $myData= mysql_fetch_array($myQry);

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)

$datacompany  = isset($_POST['nama_prov']) ? $_POST['nama_prov'] : '';



headfixdatatabel();

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
           Data Company
          <small>
            Manage Your Data Company
          </small>
        </h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
  
<?php
    # TOMBOL SIMPAN DIKLIK
if (isset($_POST['buttonsubmit'])) {

  #baca variabel 
  $kd_halaman  = $_POST['kd_halaman'];
  $content= $_POST['content'];
  

  #VALIDASI UNTUK FORM JIKA FORM KOSONG

  $pesanError= array();
  if (trim($kd_halaman)=="") {
    $pesanError[]="Kode Data <b>Company</b> Masih kosong !!";
  }
  if (trim($content)=="") {
    $pesanError[]="Data Content<b>Company</b> Masih kosong !!";
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
    $edit = mysql_query("UPDATE halaman SET content='$content' WHERE kd_halaman='$kd_halaman'") or die(mysql_error());

    if ($edit){

      header('location: ./company');
    }
  }
}
?>
      <!-- TinyMCE 3.x -->

      <script type="text/javascript" src="../assets/tiny_mce/tiny_mce_src.js"></script>
      <script type="text/javascript">

            //http://cariprogram.blogspot.com
            //nuramijaya@gmail.com

            tinyMCE.init({

              mode : "textareas",

              // ===========================================
              // Set THEME to ADVANCED
              // ===========================================

              theme : "advanced",

              // ===========================================
              // INCLUDE the PLUGIN
              // ===========================================

              plugins : "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

              // ===========================================
              // Set LANGUAGE to EN (Otherwise, you have to use plugin's translation file)
              // ===========================================

              language : "en",

              theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
              theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
              theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",

              // ===========================================
              // Put PLUGIN'S BUTTON on the toolbar
              // ===========================================

              theme_advanced_buttons4 : "jbimages,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",

              theme_advanced_toolbar_location : "top",
              theme_advanced_toolbar_align : "left",
              theme_advanced_statusbar_location : "bottom",
              theme_advanced_resizing : true,

              // ===========================================
              // Set RELATIVE_URLS to FALSE (This is required for images to display properly)
              // ===========================================

              relative_urls : false

            });

</script>
<!-- /TinyMCE -->
<div class="col-lg-12">
  <div class="panel panel-default">
    <div class="panel-heading">


      <form id="formcompany" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
      <input type="hidden" name="kd_halaman" value="COMPANY">

        <div class="form-group">
        
          <label>Content</label>
          <textarea class="form-control" name="content"  rows="3"><?php echo $myData['content']; ?> </textarea>
        </div>
        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="buttonsubmit" name="buttonsubmit" class="btn btn-success">Submit</button>
       </div>
     </form>
   </div>
 </div>
 

</div>
</div>
</div>


<script type="text/javascript">


 var formcompany = $("#formcompany").serialize();
 var validator = $("#formcompany").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    content : {
     validators: {
      notEmpty: {
       message: 'Content Company Harus  Diisi'
     }
   }
 }, 
 

}
});




</script>


<?php

BagianFooterPanelAdmin();

NgisoraneJsDataTabel();
?>
