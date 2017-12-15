<div class="container-fluid" style="margin-top:3%;">
  <?php if($added = $this->session->flashdata('work_added')): ?>
  <?php echo '<p class="alert alert-success" id="booking_added_div">'.$added.'</p>'; ?>
  <?php endif; ?>
<div class="row">
<div class="col-md-12">
<button class="btn btn-primary" id="addBookingBtn" style="margin-bottom:5px;">Add Work</button>
<div id="calendar">
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Add Work Time</h4>
  </div>
  <div class="modal-body">
  <?php echo form_open(site_url("works/add_works"), array("class" => "form-horizontal", "id" => "addWorkForm")) ?>
  <div class="form-group">
            <label class="col-md-4">Staff Name</label>
            <div class="col-md-8">
                <select name="staff" class="form-control">
                  <?php foreach ($staff as $a): ?>
                  <option value="<?php echo $a['staffID']; ?>"><?php echo $a['staffName'].' '.$a['staffID']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Work Start-time*</label>
            <div class="col-md-8 input-append date form_datetime">
                <input required type="text" class="form-control" name="start" id="addBookingStart">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Work End-time*</label>
            <div class="col-md-8 input-append date form_datetime">
                <input required type="text" class="form-control" name="end" id="addBookingEnd">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Remarks</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="remarks">
            </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" id="addBookingClose" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Add</button>
    <?php echo form_close() ?>
  </div>
</div>
</div>
</div>
<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close editModalClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title bookingDetailBox">Work Detail</h4>
    <h4 class="modal-title bookingEditBox">Update Calendar Event</h4>
  </div>
  <div class="modal-body">
  <div class="bookingDetailBox">
    <div class="row">
      <div class="col-md-4">Staff</div><div id="workingStaff" class="col-md-8"></div>
    </div>
    <div class="row">
      <div class="col-md-4">Staff ID</div><div id="workingStaffID" class="col-md-8"></div>
    </div>
    <div class="row">
      <div class="col-md-4">Work Start-time:</div><div id="workingStart" class="col-md-8"></div>
    </div>
    <div class="row">
      <div class="col-md-4">Work End-time:</div><div id="workingEnd" class="col-md-8"></div>
    </div>
    <div class="row">
      <div class="col-md-4">Remarks:</div><div id="workingRemarks" class="col-md-8"></div>
    </div>
  </div>
  <?php echo form_open(site_url("works/edit_work"), array("class" => "form-horizontal bookingEditBox", "id" => "bookingEditBox")) ?>
  <div class="form-group">
            <label class="col-md-4">Staff Name</label>
            <div class="col-md-8">
                <select name="staff" class="form-control" id="editStaff">
                  <?php foreach ($staff as $a): ?>
                  <option value="<?php echo $a['staffID']; ?>"><?php echo $a['staffName'].' '.$a['staffID']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Work Start-time</label>
            <div class="col-md-8 input-append date form_datetime">
                <input required type="text" class="form-control" name="start" id="editWorkStart">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Work End-time</label>
            <div class="col-md-8 input-append date form_datetime">
                <input required type="text" class="form-control" name="end" id="editWorkEnd">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Remarks</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="remarks" id="editWorkRemarks">
            </div>
    </div>
    <div class="form-group">
                <label class="col-md-4 label-heading">Delete Booking</label>
                <div class="col-md-8">
                    <input type="checkbox" name="delete" value="1">
                </div>
    </div>
        <input type="hidden" name="eventid" id="event_id" value="0" />
  </div>
  <?php echo form_close() ?>
  <div class="modal-footer">
    <button type="button" class="btn btn-default editModalClose" data-dismiss="modal">Close</button>
    <button id="editBookingBtn" class="btn btn-primary">Edit</button>
    <button id="updateBookingBtn" type="submit" class="btn btn-primary" form="bookingEditBox">Update Event</button>
  </div>
</div>
</div>
</div>

</div>


</div>
</div>
</div>

<script>

    function detectmob() {
     if(window.innerWidth <= 500) {
       return true;
     } else {
       return false;
     }
    }

    if (detectmob()){
    top.location.href='<?php echo site_url("works/mobile") ?>';
    }

</script>


<script type="text/javascript">
$(document).ready(function() {
var date_last_clicked = null;
$('#calendar').fullCalendar({
  eventSources: [
     {
         events: function(start, end, timezone, callback) {
             $.ajax({

                   url: '<?php echo site_url("works/get_works") ?>',
                   dataType: 'json',
                   data: {
                   // our hypothetical feed requires UNIX timestamps
                   start: start.unix(),
                   end: end.unix()
                   },
                   success: function(msg) {
                       var events = msg.events;
                       callback(events);
                   }

             });
         },
         color: '#5531e2',
         textColor: '#ffffff'

     },

   ],
   eventDrop: function(event, delta, revertFunc) {
        $.ajax({
              url: '<?php echo site_url("works/update_by_drag") ?>',
              data: {
                  start: moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                  end: moment(event.end).format('YYYY-MM-DD HH:mm:ss'),
                  workID: event.id
              }

        });
    },
    eventResize: function(event, delta, revertFunc) {
        $.ajax({
              url: '<?php echo site_url("works/update_by_drag") ?>',
              data: {
                  start: moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                  end: moment(event.end).format('YYYY-MM-DD HH:mm:ss'),
                  workID: event.id
              }

        });
    },
  dayClick: function(date, jsEvent, view) {
      if(view['name'] == 'month') {
          $('#calendar').fullCalendar( 'changeView', 'agendaWeek', date.format());
      }
  },

  eventClick: function(event, jsEvent, view) {
      $('#workingStaff').html(event.title);
      $('#workingStart').html(moment(event.start).format('YYYY-MM-DD HH:mm'));
      $('#workingEnd').html(moment(event.end).format('YYYY-MM-DD HH:mm'));
      $('#workingStaffID').html(event.staffID);
      $('#workingRemarks').html(event.remarks);

      $('#editStaff').val(event.staffID);
      $('#editWorkStart').val(moment(event.start).format('YYYY-MM-DD HH:mm'));
      $('#editWorkEnd').val(moment(event.end).format('YYYY-MM-DD HH:mm'));
      $('#editWorkRemarks').val(event.remarks);

      $('#event_id').val(event.id);
      $('#editModal').modal();
  },
  defaultView: 'agendaWeek',
  header: {
              left: 'agendaDay,agendaWeek,month',
              center: 'title',
              right: 'today prev,next'
    },
  windowResize: function(view) {
    if ($(window).width() < 514){
      $('#calendar').fullCalendar( 'changeView', 'agendaDay' );
      $('#calendar').fullCalendar('option', 'height', 700);
    } else {
      $('#calendar').fullCalendar( 'changeView', 'agendaWeek' );
    }
  },
  eventRender: function(event, element) {
      element.find('.fc-time').append("<br/>");
  },
  views: {
        month: {
            timeFormat: 'h:mm A'
        },
        agenda: {
            timeFormat: 'h:mm A'
        }
  },
  displayEventEnd: {
    month:true
  },
  editable: true,
  fixedWeekCount: false,
  selectable: true,
  select: function (start, end, jsEvent, view) {
      console.log(end - start);
      console.log(view);
      if (!((end - start) == 86400000 && view['name'] == 'month')) {
          $('#addBookingStart').val(start.format('YYYY-MM-DD HH:mm'));
          $('#addBookingEnd').val(end.format('YYYY-MM-DD HH:mm'));
          $('#addModal').modal();
      }
  }

});

$('#addBookingBtn').click(function () {
    $('#addModal').modal();
});

$.fn.editModalDisplay = function () {
    $('.bookingDetailBox').show();
    $('.bookingEditBox').hide();
    $('#editBookingBtn').show();
    $('#updateBookingBtn').hide();
}

$.fn.editModalDisplay();

$('#editBookingBtn').click(function () {
    $('.bookingDetailBox').hide();
    $('.bookingEditBox').show();
    $('#editBookingBtn').hide();
    $('#updateBookingBtn').show();
});

$('.editModalClose').click(function () {
    $.fn.editModalDisplay();
});

setTimeout(function() {
  $("#booking_added_div").fadeOut();
}, 1000);

$('.form_datetime').datetimepicker({
    format: 'yyyy-mm-dd hh:ii',
    minuteStep: 15,
    autoclose: true
});

$('#addBookingClose').click(function() {
    $('#addWorkForm').trigger('reset');
});

});
</script>

<link rel="stylesheet" href="<?php echo base_url() ?>scripts/fullcalendar/fullcalendar.css" />
<link href="<?php echo base_url() ?>scripts/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="<?php echo base_url() ?>scripts/datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>scripts/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url() ?>scripts/fullcalendar/fullcalendar.js"></script>
<script src="<?php echo base_url() ?>scripts/fullcalendar/gcal.js"></script>
