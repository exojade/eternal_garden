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
        Client Profile
      </h1>
    </section>
    <section class="content">

    <?php foreach($profile as $p):?>
      <div class="modal fade" id="modalProfile_<?php echo($p["profile_id"]); ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Profile Information</h3>
              </div>
              <div class="modal-body">

              <div class="form-group">
              <label>Deceased Name</label>
							<input type="text" readonly class="form-control" value="<?php echo($p["deceased_name"]); ?>">
						</div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date of Birth</label>
                  <input type="text" readonly class="form-control" value="<?php  echo(date('F d, Y', strtotime($p["deceased_dob"]))); ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date of Death</label>
                  <input type="text" readonly class="form-control" value="<?php echo(date('F d, Y', strtotime($p["deceased_date_death"]))); ?>">
                </div>
              </div>
            </div>


            <div class="form-group">
              <label>Crypt Name</label>
							<input type="text" readonly class="form-control" value="<?php echo($p["crypt_name"]); ?>">
						</div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Row</label>
                  <input type="text" readonly class="form-control" value="<?php  echo($p["row_number"]); ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Column</label>
                  <input type="text" readonly class="form-control" value="<?php echo($p["column_number"]); ?>">
                </div>
              </div>
            </div>
            <a href="profile?action=details&id=<?php echo($p["slot_id"]); ?>" class="btn btn-block btn-primary">Open Crypt Details</a>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
          </div>
      </div>

    <?php endforeach; ?>




    <div class="box">
            <div class="box-body">
              <table class="table table-bordered table-striped sample_datatable">
                <thead>
                <tr>
                  <th>Action</th>
                  <th>Client</th>
                  <th>Address</th>
                  <th>Crypt</th>
                  <th>Slot</th>
                  <th>Lease Date</th>
                  <th>Lease Expiry</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($profile as $p): ?>
                <tr>
                  <td><a href="profile?action=client_details&slot=<?php echo($p["slot_id"]); ?>" class="btn btn-primary">View</a></td>
                  <td><?php echo($p["client_name"]); ?></td>
                  <td><?php echo($p["client_address"].", " . $p["barangay"].",".$p["city_municipality"].",".$p["province"]); ?></td>
                  <td><?php echo($p["crypt_name"]); ?></td>
                  <td><?php echo($p["slot_number"]); ?></td>
                  <td><?php echo($p["lease_date"]); ?></td>
                  <td><?php echo($p["date_expired"]); ?></td>
                  <td><?php echo($p["active_status"]); ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
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

