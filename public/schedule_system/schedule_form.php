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
        Dashboard
        <small>System Monitoring</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> HOMES</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-7">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

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
            $('#modalTitle').html(event.title);
            $('#modalBody').html(event.description);
            $('#eventUrl').attr('href', event.url);
            $('#calendarModal #name').val(event.title);
            $('#calendarModal #birhdate').val(event.dob);
            $('#calendarModal #date_death').val(event.death_date);
            $('#calendarModal #crypt_name').val(event.crypt_name);
            $('#calendarModal #row_number').val(event.row_number);
            $('#calendarModal #column_number').val(event.column_number);
            $('#calendarModal #schedule_id').val(event.schedule_id);


            $('#calendarModal').modal();
        },

      //Random default events
      events    : [
        <?php $schedule = query("select * from burial_schedule bs
                                  left join profile_list p
                                  on p.profile_id = bs.profile_id
                                  left join crypt_slot s
                                  on p.slot_number = s.slot_id
                                  left join crypt_list c
                                  on s.crypt_id = c.crypt_id
                                  where remarks = 'PENDING'");
        foreach($schedule as $s):
        $date = explode('-',$s["burial_date"]);
        $day = (int)$date[2];
        $month = (int)$date[1];
        $year = (int)$date[0];

        $time = explode(':',$s["burial_time"]);
        // dump($time);
        $hour = (int)$time[0];
        $minute = (int)$time[1];
        ?>
          {
            title          : '<?php echo($s["deceased_name"]); ?>',
            start          : new Date(<?php echo($year); ?>, <?php echo($month-1); ?>, <?php echo($day); ?>, <?php echo($hour); ?>, <?php echo($minute); ?>),
            end            : new Date(<?php echo($year); ?>, <?php echo($month-1); ?>, <?php echo($day); ?>, <?php echo($hour); ?>, <?php echo($minute); ?>),
            // url            : 'index',
            backgroundColor: '#f56954', //red
            borderColor    : '#f56954', //red
            crypt_name    : '<?php echo($s["crypt_name"]); ?>', //red
            schedule_id    : '<?php echo($s["schedule_id"]); ?>', //red
            row_number    : '<?php echo($s["row_number"]); ?>', //red
            column_number    : '<?php echo($s["column_number"]); ?>', //red
            dob    : '<?php echo(date('F d, Y', strtotime($s["deceased_dob"]))); ?>', //red
            death_date    : '<?php echo(date('F d, Y', strtotime($s["deceased_date_death"]))); ?>', //red
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
  $(function () {
    $('#example2').DataTable()
   
  })
</script>


