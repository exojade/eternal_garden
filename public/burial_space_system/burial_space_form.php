<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">






<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <section class="content-header">
      <h1>
        Burial Space
      </h1>
    </section>
    <section class="content">
    <div class="row">
      <a href="coffin_crypt?action=list">
      <div class="col-md-6">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-building"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">COFFIN CRYPT</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          </div>
      </div>
      </a>
      <a href="bone_crypt?action=list">
      <div class="col-md-6">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-bone"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">BONE CRYPT</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          </div>
      </div>
      </a>
      <a href="mausoleum?action=list">
      <div class="col-md-6">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-home"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">MAUSOLEUM</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          </div>
      </div>
      </a>
      <a href="maps?action=map_details&crypt_type=LAWN&filter=ALL#20/7.32051/125.66230">
      <div class="col-md-6">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-cross"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">LAWN</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
          </div>
      </div>
      </a>

    </div>
    
    
 
    </section>
    <!-- /.content -->
  </div>
  
  <?php 
    require("layouts/footer.php");
  ?>
  
  <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script> -->
  <script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
	<script src="AdminLTE/dist/js/adminlte.min.js"></script>
	<script src="AdminLTE/dist/js/demo.js"></script>
  <script src="AdminLTE/bower_components/Chart.js/Chart.js"></script>
  <script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
  <?php require("public/bone_crypt/bone_crypt_js.php"); ?>

  <?php
	// render footer 2
	require("layouts/footer_end.php");
  ?>

<script>
  $(function () {
    $('.sample_datatable').DataTable()
   
  })
</script>

