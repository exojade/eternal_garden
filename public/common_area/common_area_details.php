<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

<style>
.products-list {
	padding-right: 10px;
    height: 200px;
    overflow: auto;
}

.table .btn{
  font-size:12px !important;
}
</style>




<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <section class="content-header">
      <h1>
      <?php echo($common_area["crypt_name"]); ?>
      <!-- <a class="btn btn-primary pull-right btn-flat" data-toggle="modal" data-target="#modal_add_client">Add Crypt</a> -->
      </h1>
    </section>
    <section class="content">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table class="table table-bordered table-striped sample_datatable">
                <thead>
                  <th>Deceased</th>
                  <th>Birth</th>
                  <th>Death</th>
                  <th>Age Died</th>
                  <th>Certificate</th>
                  <th>Previous Owner</th>
                  <th>Previous Location</th>
                </thead>
                <tbody>
                  <?php foreach($deceased_profile as $row):
                    ?>
                    <tr>
                      <td><?php echo($row["deceased_firstname"] . " " . $row["deceased_lastname"]); ?></td>
                      <td><?php echo($row["birthdate"]); ?></td>
                      <td><?php echo($row["date_of_death"]); ?></td>
                      <td><?php echo($row["age_died"]); ?></td>
                      <td><a target="_blank" href="<?php echo($row["death_certificate"]); ?>" class="btn btn-xs btn-primary btn-block">View</a></td>
                      <td><?php echo($Profile[$row["last_profile_id"]]["client_firstname"] . " " . $Profile[$row["last_profile_id"]]["client_lastname"]); ?></td>
                      <td><?php echo($Crypt_slot[$row["slot_id"]]["crypt_name"] . " Row: " . $Crypt_slot[$row["slot_id"]]["row_number"] . " Column: " . $Crypt_slot[$row["slot_id"]]["column_number"]); ?></td>
                    </tr>

                  <?php endforeach; ?>
                </tbody>
              </table>
       
            </div>
          </div>
    </section>
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
    $('.sample_datatable').DataTable({
      "ordering": false,
    });
   
  })
</script>

