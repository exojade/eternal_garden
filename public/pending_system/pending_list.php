<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
        Pending for Burial
      </h1>
    </section>
    <section class="content">
    <?php foreach($for_schedule as $fs):?>
      <div class="modal fade" id="modalSchedule<?php echo($fs["schedule_id"]); ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Add Schedule</h3>
              </div>
              <div class="modal-body">

              <form class="generic_form_trigger" data-url="pending_burial">
                <input type="hidden" name="action" value="add_schedule">
                <input type="hidden" name="schedule_id" value="<?php echo($fs["schedule_id"]) ?>">


                <div class="form-group">
                        <label>Burial Schedule Date *</label>
                        <div class="input-group">
                          <input min="<?php echo(date("Y-m-d")); ?>" max="<?php echo(date('Y-m-d', strtotime('+2 weeks'))); ?>" name="deceased_burial_date" id="deceased_burial_date" required type="date" class="form-control">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
    <label for="deceased_burial_time">Burial Time</label>
    <input required type="text" id="deceased_burial_time" name="deceased_burial_time" class="form-control deceased_burial_time">
</div>
                
                      <!-- <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <label>Burial Time</label>
                        <div class="input-group">
                          <input name="deceased_burial_time" id="deceased_burial_time" value="" type="text" class="form-control timepicker">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                    </div> -->

                  <button type="submit" class="btn btn-primary">Submit</button>

              </form>
            

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
                  <th>Client Registered</th>
                  <th>Crypt</th>
                  <th>Type</th>
                  <th>Slot / Niche #</th>
                  <th>Services</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($for_schedule as $fs): 
                  $crypt = query("select * from crypt_slot slot
                                  left join crypt_list crypt
                                  on crypt.crypt_id = slot.crypt_id
                                  where slot.slot_id = ?
                                  ", $fs["slot_number"]);
                  // $transaction 
                  $crypt = $crypt[0];

                  ?>
                <tr>
                  <td>
                    <a data-toggle="modal" data-target="#modalSchedule<?php echo($fs["schedule_id"]); ?>" class="btn btn-primary btn-flat">Add Schedule</a>
                  </td>
                  <td><?php echo($fs["client_name"]); ?></td>
                  <td><?php echo($crypt["crypt_name"]); ?></td>
                  <td><?php echo($crypt["crypt_type"]); ?></td>
                  <td><?php echo($crypt["slot_number"]); ?></td>
                  <td><?php 
                  // dump($for_schedule);
                  if($fs["services_availed"] != ""):
                    $services = unserialize($fs["services_availed"]);
                    foreach($services as $s):
                      // dump($s);
                      echo("** " . $s["service_name"] . "<br>");
                    endforeach;
                  endif;
               ?></td>
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
  <script src="AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

<script>

flatpickr(".deceased_burial_time", {
    enableTime: true,               // Enable time selection
    noCalendar: true,               // Disable calendar
    dateFormat: "h:i K",           // Date format (12-hour with AM/PM)
    minTime: "08:00",               // Minimum allowed time
    maxTime: "16:00",               // Maximum allowed time
    time_24hr: false,               // Use 12-hour time format
    minuteIncrement: 30,            // Set time interval if needed
    disableMobile: true,             // Disable mobile-friendly mode
    defaultDate: "08:00", 
});


// $('#deceased_burial_time').timepicker({
//     timeFormat: 'h:i A', // 12-hour format with AM/PM
//     minTime: '8:00am',    // Minimum allowed time
//     maxTime: '4:00pm',    // Maximum allowed time
//     step: 30,             // Set time interval if needed
//     scrollbar: true      // Enable scrollbar if needed
// });

    // Validate time selection on change
    // $('#deceased_burial_time').on('changeTime', function() {
    //   const selectedTime = $(this).val();
    //   const maxTime = '4:00pm';

    //   // Compare selected time with the maximum allowed time
    //   if (selectedTime > maxTime) {
    //     alert('Please select a time before 4:00 PM.');
    //     $(this).val(''); // Clear the invalid selection
    //   }
    // });
  </script>

