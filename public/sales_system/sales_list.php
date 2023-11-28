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

  <div class="modal fade" id="modal_details">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Transaction Details</h4>
              </div>
              <div class="modal-body">
                  <div class="fetched_data"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

  <section class="content-header">
      <h1>
        Sales Report
      </h1>
    </section>
    <section class="content">

    <div class="row">
      <form class="generic_form_trigger" data-url="sales">
        <input type="hidden" name="action" value="print_pdf">
              <div class="col-md-3">
              <div class="form-group">
                <label>Client</label>
                <select id="client_id" class="form-control select2" name="profile" style="width: 100%;">
                  <option selected value="" >Select Client...</option>
                  <?php foreach($client as $row): ?>
                    <option value="<?php echo($row["profile_id"]); ?>"><?php echo($row["client_firstname"] . " " . $row["client_lastname"]); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group">
                <label>From</label>
                <input type="date" name="from" id="from" class="form-control">
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group">
                <label>To</label>
                <input type="date" name="to" id="to" class="form-control">
              </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>Filter:</label>
                <button type="button" onclick="filter();" class="btn btn-primary btn-block">Filter</button>
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group">
                <label>Print:</label>
                <button type="submit" onclick="filter();" class="btn btn-success btn-block">Print</button>
              </div>
              </div>
              </form>
            </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body">
              <h2 class="pull-right" id="currentTotal">0.00</h2>
              <table class="table table-bordered sales-datatable">
                <thead>
                  <th>Tranasction</th>
                  <th>Client</th>
                  <th>Location</th>
                  <th>Total</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Type</th>
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
            $('.sales-datatable').DataTable({
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
                    'url':'sales',
                     'type': "POST",
                     "data": function (data){
                        data.action = "sales-datatable";
                     }
                },
                'columns': [
                    { data: 'action', "orderable": false },
                    { data: 'client', "orderable": false },
                    { data: 'location', "orderable": false },
                    {
            data: 'total_fee',
            "orderable": false,
            render: function (data, type, row) {
                if (type === 'display' || type === 'filter') {
                    // Format the data as currency when displaying or filtering
                    return parseFloat(data).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
                return data; // For sorting and other purposes, return the original data
            }
        },
                    { data: 'date', "orderable": false },
                    { data: 'time', "orderable": false },
                    { data: 'transaction_type', "orderable": false },
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
                        .column(3)
                        .data());


                    received = api
                        .column(3)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        console.log(received);

                    $('#currentTotal').html('P ' + received.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                }
            });

            $('.sales-datatable td:nth-child(4').addClass('text-right');

            function filter() {
              var client_id = $('#client_id').val();
              var from = $('#from').val();
              var to = $('#to').val();
              datatable.ajax.url('sales?action=sales-datatable&client='+client_id+'&from='+from+'&to='+to).load();
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

$(document).on("click", ".open_transaction_modal", function () {
     var transaction_id = $(this).data('id');
     $.ajax({
        type : 'post',
        url : 'profile',
        data: {
            transaction_id: transaction_id, action: "modal_details"
        },
        success : function(data){
            $('#modal_details .fetched_data').html(data);
            // swal.close();
            $('#modal_details').modal('show');
            // $(".select2").select2();//Show fetched data from database
        }
      });
     
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});

  </script>


