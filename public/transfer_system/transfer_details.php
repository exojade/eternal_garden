<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

<style>
.products-list {
    padding-right: 10px;
    height: 100%;
    overflow: auto;
}
.products-list .product-info {
    margin-left: 2px !important;
    font-size:180% !important;
}

.product-list-in-box>.item {

    border-bottom: 3px solid #000 !important;
}
</style>

<script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
	<script src="AdminLTE/dist/js/adminlte.min.js"></script>
	<script src="AdminLTE/dist/js/demo.js"></script>
  <script src="AdminLTE/bower_components/Chart.js/Chart.js"></script>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header">
      <h1>
        For Transfer
      </h1>
    </section>
    <section class="content">


    <div class="modal fade" id="transfer">
          <div class="modal-dialog">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Transfer To</h3>
              </div>
              <div class="modal-body">

              <div class="row">
                <div class="col-md-6">
                  <button class="btn btn-block btn-primary">BONE CRYPT</button>

                </div>
                <div class="col-md-6">
                  <button class="btn btn-block btn-success">LAWN LOT</button>
                </div>
              </div>

              



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
      </div>

    <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            <div class="modal-body">

<div class="form-group">
<label>Deceased Name</label>
<input type="text" readonly="" class="form-control" value="MACARIO SAKAY">
</div>
<div class="row">
<div class="col-md-6">
  <div class="form-group">
    <label>Date of Birth</label>
    <input type="text" readonly="" class="form-control" value="January 01, 1950">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Date of Death</label>
    <input type="text" readonly="" class="form-control" value="May 20, 2023">
  </div>
</div>
</div>


<div class="form-group">
<label>Crypt Name</label>
<input type="text" readonly="" class="form-control" value="MT ZEMIRAIM">
</div>
<div class="row">
<div class="col-md-6">
  <div class="form-group">
    <label>Row</label>
    <input type="text" readonly="" class="form-control" value="2">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Column</label>
    <input type="text" readonly="" class="form-control" value="4">
  </div>
</div>
</div>
<a data-toggle="modal" data-target="#transfer" class="btn btn-block btn-primary">Transfer</a>

</div>
            <!-- /.box-body -->
          </div>
    
      
    </section>

  </div>
  
  <?php 
    require("layouts/footer.php");
  ?>

<script src="AdminLTE/bower_components/moment/moment.js"></script>
<script src="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
  
  <?php
	require("layouts/footer_end.php");
  ?>

<script>
  $(function () {
    $('#example2').DataTable()
   
  })
</script>


