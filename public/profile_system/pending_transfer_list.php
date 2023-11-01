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
        Deceased Profile pending for Transfer
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
                  <th>Age of Death</th>
                  <th>Client</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($deceased_profile as $p): ?>
                <tr>
                  <td><?php echo($p["deceased_firstname"] . " " . $p["deceased_middlename"] . " " . $p["deceased_lastname"] . " " . $p["deceased_suffix"]); ?></td>
                  <td><?php echo($p["birthdate"]); ?></td>
                  <td><?php echo($p["gender"]); ?></td>
                  <td><?php echo($p["date_of_death"]); ?></td>
                  <td><?php echo($p["age_died"]); ?></td>
                  <td><?php echo($p["client_firstname"] . " " . $p["client_middlename"] . " " . $p["client_lastname"] . " " . $p["client_suffix"]); ?></td>
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
      "columnDefs": [
        { "orderable": false, "targets": "_all" }
    ]

    })
   
  })
</script>

