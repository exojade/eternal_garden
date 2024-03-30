uploadCapture<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">

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
        Upload Capture
        <a class="btn btn-primary pull-right btn-flat" data-toggle="modal" data-target="#modalUpload">Upload</a>
      </h1>
    </section>
    <section class="content">


    <div class="modal fade" id="modalUpload">
          <div class="modal-dialog">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Add New Bone Crypt</h3>
              </div>
              <div class="modal-body">
			        <form class="generic_form_trigger" url="uploadCapture">
                <input type="hidden" name="action" value="upload">
              <div class="box-body">

              <div class="form-group">
                  <label for="exampleInputFile">File</label>
                  <input name="uploadCSV" type="file" accept=".csv" id="exampleInputFile">
                  <p class="help-block">Upload</p>
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



    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
      Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire
      soul, like these sweet mornings of spring which I enjoy with my whole heart.
    </div>

    </section>


    
  </div>
  
  <?php 
    require("layouts/footer.php");
  ?>

<script src="AdminLTE/bower_components/moment/moment.js"></script>
<script src="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
<script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script src="AdminLTE/dist/js/adminlte.min.js"></script>
	<script src="AdminLTE/dist/js/demo.js"></script>
  <script src="AdminLTE/bower_components/Chart.js/Chart.js"></script>
  <?php
	require("layouts/footer_end.php");
  ?>
  <script>
    $('.select2').select2()
  </script>


