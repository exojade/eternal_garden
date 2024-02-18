<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
        Notification Logs
      </h1>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-md-12">
        <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Notification Logs</h3>
        </div>
        <div class="box-body">
          <?php $notification = query("select logs.*, p.client_firstname, p.client_lastname from notification_logs logs
                                      left join profile_list p
                                      on p.profile_id = logs.profile_id
                                      order by timestamp desc
                                        "); ?>
          <table class="table table-bordered" id="datatable">
            <thead>
              <th>Date</th>
              <th>Time</th>
              <th>Type</th>
              <th>Profile</th>
              <th>Logs</th>
              <th width="25%">Message</th>
              <th>Button</th>
            </thead>
            <tbody>
              <?php foreach($notification as $row): ?>
                <tr>
                  <td><?php echo($row["date"]); ?></td>
                  <td><?php echo($row["time"]); ?></td>
                  <td><?php echo($row["type"]); ?></td>
                  <td><?php echo($row["client_firstname"] . " " . $row["client_lastname"]); ?></td>
                  <td><?php echo($row["logs"]); ?></td>
                  <td><?php echo(strlen($row["message"]) > 100 ? substr($row["message"], 0, 100) . "..." : $row["message"]); ?></td>
        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#messageModal_<?php echo $row['logs_id']; ?>">View Message</button></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <?php foreach($notification as $row): ?>
        <div class="modal fade" id="messageModal_<?php echo $row['logs_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel_<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel_<?php echo $row['id']; ?>">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $row["message"]; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
      <?php endforeach; ?>


     



      </div>
        </div>
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
    $('.select2').select2();


    $(function () {
    $('#datatable').DataTable()
   
  })
  </script>


