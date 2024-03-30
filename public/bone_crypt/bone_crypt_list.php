<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

<style>
.products-list {
	padding-right: 10px;
    height: 200px;
    overflow: auto;
}
</style>

<?php
$Details = [];

$details = query("SELECT SUM(CASE WHEN active_status = 'OCCUPIED' THEN 1 ELSE 0 END) occupied,
SUM(CASE WHEN active_status = 'VACANT' THEN 1 ELSE 0 END) vacant,
COUNT(*) total, crypt_name, s.crypt_id
FROM  crypt_slot s
LEFT JOIN crypt_list l
ON s.crypt_id = l.crypt_id
WHERE l.crypt_type = 'BONE'
GROUP BY s.crypt_id
");
foreach($details as $d):
  $Details[$d["crypt_id"]] = $d;
endforeach;
?>



<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header">
      <h1>
        Bone Crypt List
      <a class="btn btn-primary pull-right btn-flat" data-toggle="modal" data-target="#modal_add_crypt">Add Crypt Building</a>
      <a href="maps?action=map_editor&type=BONE" class="btn btn-success pull-right btn-flat" >Open Map</a>
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
                  <label for="exampleInputEmail1">Crypt Building Name</label>
                  <input type="text" required name="crypt_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Rows</label>
                      <input type="number" required name="crypt_rows" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Columns</label>
                      <input type="number" required name="crypt_columns" class="form-control" id="exampleInputEmail1" placeholder="---">
                    </div>
                  </div>
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
      <?php foreach($bone_crypt as $bone): ?>
        <div class="col-md-4">
        <a href="bone_crypt?action=details&id=<?php echo($bone["crypt_id"]); ?>">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-red-active">
              <h3 class="widget-user-username"><?php echo($bone["crypt_name"]); ?></h3>
              <h5 class="widget-user-desc">Bone Crypt</h5>
            </div>
            <div class="widget-user-image">
              <img  src="resources/crypt_building.png" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo($Details[$bone["crypt_id"]]["total"]); ?></h5>
                    <span class="description-text">SLOTS</span>
                  </div>
                </div>
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo($Details[$bone["crypt_id"]]["vacant"]); ?></h5>
                    <span class="description-text">VACANT</span>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo($Details[$bone["crypt_id"]]["occupied"]); ?></h5>
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

