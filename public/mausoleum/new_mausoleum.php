<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

<style>
.products-list {
	padding-right: 10px;
    height: 200px;
    overflow: auto;
}
</style>




<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <section class="content-header">
      <h1>
        Mausoleum List
      <a class="btn btn-primary pull-right btn-flat" data-toggle="modal" data-target="#modal_add_crypt">Add Mausoleum</a>
      </h1>
    </section>
    <section class="content">
    <div class="modal fade" id="modal_add_crypt">
          <div class="modal-dialog">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Add New Bone Crypt</h3>
              </div>
              <div class="modal-body">
			        <form class="generic_form_trigger" url="bone_crypt">
                <input type="hidden" name="action" value="add_bone_crypt">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Building Name</label>
                  <input type="text" required name="crypt_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
          </div>
      </div>



      <div class="row">
      <?php foreach($mausoleum as $m): ?>
        <div class="col-md-4">
        <a href="bone_crypt?action=details&id=<?php echo($m["crypt_id"]); ?>">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-red-active">
              <h3 class="widget-user-username"><?php echo($m["crypt_name"]); ?></h3>
              <h5 class="widget-user-desc">Bone Crypt</h5>
            </div>
            <div class="widget-user-image">
              <img  src="resources/crypt_building.png" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">3,200</h5>
                    <span class="description-text">SLOTS</span>
                  </div>
                </div>
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">13,000</h5>
                    <span class="description-text">VACANT</span>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">35</h5>
                    <span class="description-text">OCCUPIED</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </a>
        </div>
                <?php endforeach; ?>
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
  <?php require("public/coffin_crypt/coffin_crypt_js.php"); ?>

  <?php
	// render footer 2
	require("layouts/footer_end.php");
  ?>

<script>
  $(function () {
    $('.sample_datatable').DataTable()
   
  })
</script>

