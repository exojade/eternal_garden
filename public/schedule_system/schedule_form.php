<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

<style>
.products-list {
	padding-right: 10px;
    height: 200px;
    overflow: auto;
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
        Schedule
      </h1>
    </section>
    <section class="content">

    <div class="row">
              <div class="col-md-3">
              <div class="form-group">
                <label>From Date:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="from_date" id="from" type="date" class="form-control">
                </div>
                <!-- /.input group -->
              </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>To Date:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input id="to" name="to_date" type="date" class="form-control">
                </div>
                <!-- /.input group -->
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
              <table class="table table-bordered schedule-datatable">
                <thead>
                  <th>Action</th>
                  <th>Client</th>
                  <th></th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Remarks</th>
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




<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Point Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="generic_form_trigger" data-url="schedule">
      <input type="hidden" name="action" value="markDone">
      <div class="modal-body" id="modalBody">
        <!-- Point information will be displayed here -->
      </div>
      <div class="modal-footer">
                <button type="submit" class="btn btn-success" >MARK AS DONE</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_schedule" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="modalLabel">Client Information</h5>
        </button>
      </div>
      <form class="generic_form_trigger" data-url="schedule">
      <input type="hidden" name="action" value="markDone">
      <div class="modal-body" id="modalBody">
        <div class="fetched_data"></div>
        <!-- Point information will be displayed here -->
      </div>
      <div class="modal-footer">
                <button type="submit" class="btn btn-success" >MARK AS DONE</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
      </form>
    </div>
  </div>
</div>







    <div id="calendarModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header bg-primary">
                  <h4 id="modalTitle" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
            </div>
            <div id="modalBody" class="modal-body">
            <form class="generic_form_trigger" data-url="schedule">
            <input type="hidden" name="action" value="markDone">
            <input type="hidden" id="schedule_id" name="schedule_id" value="">


            <div class="form-group">
              <label>Name</label>
							<input id="name" type="text" readonly class="form-control" value="">
						</div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Birth Date</label>
                  <input id="birhdate" type="text" readonly class="form-control" value="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date of Death</label>
                  <input id="date_death" type="text" readonly class="form-control" value="">
                </div>
              </div>
            </div>


            <div class="form-group">
              <label>Crypt</label>
							<input id="crypt_name" type="text" readonly class="form-control" value="">
						</div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Row</label>
                  <input id="row_number" type="text" readonly class="form-control" value="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Column</label>
                  <input id="column_number" type="text" readonly class="form-control" value="">
                </div>
              </div>
            </div>




            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" >MARK AS DONE</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
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

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

      // alert(d);  
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      eventClick: function(event, element, view) {
            //element.popover('hide');
            // $('#modalTitle').html(event.title);
            // $('#modalBody').html(event.description);
            // $('#eventUrl').attr('href', event.url);
            // $('#calendarModal #name').val(event.title);
            // $('#calendarModal #birhdate').val(event.dob);
            // $('#calendarModal #date_death').val(event.death_date);
            // $('#calendarModal #crypt_name').val(event.crypt_name);
            // $('#calendarModal #row_number').val(event.row_number);
            // $('#calendarModal #column_number').val(event.column_number);
            // $('#calendarModal #schedule_id').val(event.schedule_id);

            $.ajax({
                    type : 'post',
                    url : 'schedule',
                    data: {
                        schedule_id: event.schedule_id, action: "modalSchedule"
                    },
                    success : function(data){
                        $('#myModal #modalBody').html(data);
                        // swal.close();
                        $('#myModal').modal('show');
                        // $('#calendarModal').modal();
                        // $(".select2").select2();//Show fetched data from database
                    }
                });


           
        },

      //Random default events
      events    : [
        <?php $schedule = query("select *,bs.burial_date as burial_date,
                                bs.burial_time as burial_time,
                                concat(client_firstname, ' ', client_middlename, ' ', client_lastname, ' ', client_suffix) as client_name
                                from burial_schedule bs
                                  left join profile_list p
                                  on p.profile_id = bs.profile_id
                                  left join crypt_slot s
                                  on p.slot_number = s.slot_id
                                  left join crypt_list c
                                  on s.crypt_id = c.crypt_id
                                  where remarks = 'PENDING'");

            // dump($schedule);
        foreach($schedule as $s):
        $date = explode('-',$s["burial_date"]);
        $day = (int)$date[2];
        $month = (int)$date[1];
        $year = (int)$date[0];
        $s["burial_time"] = date("H:i", strtotime($s["burial_time"]));
        $time = explode(':',$s["burial_time"]);
        // dump($time);
        $hour = (int)$time[0];
        $minute = (int)$time[1];
        ?>
          {
            title          : '<?php echo($s["client_name"]); ?>',
            start          : new Date(<?php echo($year); ?>, <?php echo($month-1); ?>, <?php echo($day); ?>, <?php echo($hour); ?>, <?php echo($minute); ?>),
            end            : new Date(<?php echo($year); ?>, <?php echo($month-1); ?>, <?php echo($day); ?>, <?php echo($hour+1); ?>, <?php echo($minute); ?>),
            // url            : 'index',
            backgroundColor: '#f56954', //red
            borderColor    : '#f56954', //red
            schedule_id    : '<?php echo($s["schedule_id"]); ?>', //red
           
          },
        <?php endforeach; ?>

      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>

<script>
  var datatable = 
            $('.schedule-datatable').DataTable({
                "pageLength": 100,
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
                    'url':'schedule',
                     'type': "POST",
                     "data": function (data){
                        data.action = "schedule-datatable";
                     }
                },
                'columns': [
                    { data: 'action', "orderable": false },
                    { data: 'client', "orderable": false },
                    { data: 'location', "orderable": false },
                    { data: 'burial_date', "orderable": false },
                    { data: 'burial_time', "orderable": false },
                    { data: 'remarks', "orderable": false },
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
              var from = $('#from').val();
              var to = $('#to').val();
              console.log(from);
              console.log(to);
              datatable.ajax.url('schedule?action=schedule-datatable&from='+from+'&to='+to).load();
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
     
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
  </script>


