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
        Transaction
      </h1>
    </section>
    <section class="content">

    <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Burial Space</label>
                  <select id="burial_space_id" class="form-control select2" style="width: 100%;">
                    <option selected value="">Select Burial Space</option>
                    <option value="COFFIN">COFFIN [ALL]</option>
                    <option value="BONE">BONE [ALL]</option>
                    <option value="MAUSOLEUM">MAUSOLEUM [ALL]</option>
                    <option value="LAWN">LAWN [ALL]</option>
                    <?php foreach($burial_space as $row): ?>
                      <option value="<?php echo($row["crypt_id"]); ?>"><?php echo($row["crypt_name"] . " [" . $row["crypt_type"] . "]"); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-3">
              <div class="form-group">
                <label>Client</label>
                <select id="client_id" class="form-control select2" style="width: 100%;">
                  <option selected value="" >Select Client...</option>
                  <?php foreach($client as $row): ?>
                    <option value="<?php echo($row["profile_id"]); ?>"><?php echo($row["client_firstname"] . " " . $row["client_lastname"]); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>Deceased</label>
                <select id="deceased_id" class="form-control select2" style="width: 100%;">
                <option selected value="" >Select Deceased...</option>
                <?php foreach($deceased as $row): ?>
                    <option value="<?php echo($row["deceased_id"]); ?>"><?php echo($row["deceased_firstname"] . " " . $row["deceased_lastname"]); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>Transaction Type</label>
                <select id="transaction_type" class="form-control select2" style="width: 100%;">
                <option selected value="" >Select Type...</option>
                  <option value="LAWN PURCHASE">LAWN PURCHASE</option>
                  <option value="BURIAL">BURIAL</option>
                  <option value="CANCELLED">CANCELLED</option>
                  <option value="POSTPONED">POSTPONED</option>
                  <option value="TRANSFER COMMON">TRANSFER COMMON</option>
                </select>
              </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>Filter:</label>
                <button type="button" onclick="filter();" class="btn btn-primary btn-block">Filter</button>
              </div>
              </div>
            </div>
      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body">
              <table class="table table-bordered reports-datatable">
                <thead>
                  <th>Client</th>
                  <th>Deceased</th>
                  <th>Location</th>
                  <th>Date</th>
                  <th>Time</th>
                </thead>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
  var datatable = 
            $('.reports-datatable').DataTable({
                "pageLength": 10,
                language: {
                    searchPlaceholder: "Enter Filter"
                },
                searching: false,
                "bLengthChange": true,
                "ordering": false,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'reports',
                     'type': "POST",
                     "data": function (data){
                        data.action = "reports-datatable";
                     }
                },
                'columns': [
                    { data: 'client', "orderable": false },
                    { data: 'deceased', "orderable": false },
                    { data: 'location', "orderable": false },
                    { data: 'date', "orderable": false },
                    { data: 'time', "orderable": false },
                ],
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(), data;
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    // // Total over all pages

                    console.log(received = api
                        .column(2)
                        .data());


                    received = api
                        .column(2)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        console.log(received);

                    $('#currentTotal').html('P ' + received.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                }
            });

            function filter() {
              var client_id = $('#client_id').val();
              var deceased_id = $('#deceased_id').val();
              var transaction_type = $('#transaction_type').val();
              var burial_space = $('#burial_space_id').val();
              
              datatable.ajax.url('reports?action=reports-datatable&burial_space='+burial_space+'&client='+client_id+'&deceased_id='+deceased_id+'&transaction_type='+transaction_type).load();
          }


  $(document).on("click", ".open-schedule", function () {
    
     var schedule_id = $(this).data('id');
    
     $.ajax({
        type : 'post',
        url : 'schedule',
        data: {
            schedule_id: schedule_id, action: "modal_schedule"
        },
        success : function(data){
          $('#modal_schedule .fetched_data').html(data);
            // swal.close();
            $('#modal_schedule').modal('show');
            // $(".select2").select2();//Show fetched data from database
        }
      });
});

$('.select2').select2()

  </script>


