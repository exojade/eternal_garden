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
        Deceased Profile
      </h1>
    </section>
    <section class="content">
    <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped sample_datatable">
                <thead>
                <tr>
                  <th>Deceased</th>
                  <th>BirthDate</th>
                  <th>Gender</th>
                  <th>Date of Death</th>
                  <th>Age Died</th>
                  <th>Location</th>
                  <th>Client</th>
                  <th>Death Certificate</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($deceased_profile as $p): ?>
                <tr>
                  <td><?php echo($p["deceased_firstname"] . " " . $p["deceased_middlename"] . " " . $p["deceased_lastname"] . " " . $p["deceased_suffix"]); ?></td>
                  <td><?php echo($p["birthdate"]); ?></td>
                  <td><?php echo($p["gender"]); ?></td>
                  <td><?php echo($p["date_of_death"]); ?></td>
                  
                  <?php
                  $location = "";
                  	if($p["crypt_type"] == "LAWN"):
                      $location = "LAWN : TYPE : ".$p["lawn_type"];
                    elseif($p["crypt_type"] == "COFFIN" || $p["crypt_type"] == "BONE"):
                      $location = $p["crypt_type"] ." : NAME : ".$p["crypt_name"] . " : ROW : " . $p["row_number"] . " : COLUMN : " . $p["column_number"];
                    elseif($p["crypt_type"] == "COMMON"):
                      $location = $p["crypt_type"] ." : NAME : ".$p["crypt_name"];
                    endif;
                  ?>
                  <td><?php echo($p["age_died"]); ?></td>
                  <td><?php echo($location); ?></td>
                  <td><?php echo($p["client_firstname"] . " " . $p["client_middlename"] . " " . $p["client_lastname"] . " " . $p["client_suffix"]); ?></td>
                  <td><a href="<?php echo($p["death_certificate"]); ?>" target="_blank" class="btn btn-xs btn-flat btn-block btn-primary">View</a></td>
                  
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
    $('.sample_datatable').DataTable({
      "ordering": false,
    });

  })
</script>

