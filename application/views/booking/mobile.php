<div class="container-fluid" style="margin-top:3%; padding: 0; width:100%;">
  <?php if($booking_added = $this->session->flashdata('booking_added')): ?>
  <?php echo '<p class="alert alert-success" id="booking_added_div">'.$booking_added.'</p>'; ?>
  <?php endif; ?>
<div class="row">
<div class="col-md-12 col-xs-12">
<div class="row">
  <div class="col-xs-4">
  <button class="btn btn-primary" id="addBookingBtn" style="margin-bottom:5px;">Add Booking</button>
  </div>
  <div class="col-xs-8" style="line-height:90%; ">
  <input type="checkbox" id="holdDisplay" checked>
  <label for="holdDisplay">Show on-hold bookings&nbsp;</label><br>
  <input type="checkbox" id="workDisplay">
  <label for="workDisplay">Show work schedule&nbsp;</label>
  </div>
</div>

<div id="calendar">
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Add Booking</h4>
  </div>
  <div class="modal-body">
  <div class="pull-right">Marked with * are required fields</div><br>
  <?php echo form_open(site_url("bookings/add_event"), array("class" => "form-horizontal", "id" => "addBookingForm")) ?>
  <div class="form-group">
            <label class="col-md-4">Customer Name &amp; Phone*</label>
            <div class="col-md-8">
                <input required type="text" class="form-control" name="title">
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Booking Start-time*</label>
            <div class="col-md-8 input-append date form_datetime">
                <input required type="text" class="form-control" name="start" id="addBookingStart">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Booking End-time*</label>
            <div class="col-md-8 input-append date form_datetime">
                <input required type="text" class="form-control" name="end" id="addBookingEnd">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Number of People*</label>
            <div class="col-md-8">
                <input required type="text" class="form-control" name="noOfPpl">
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Drinks:</label>
            <div class="col-md-8">
              <label class="radio-inline"><input type="radio" name="drinks" value="1">Yes</label>
              <label class="radio-inline"><input type="radio" name="drinks" value="0">No</label>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Confirm* :</label>
            <div class="col-md-8">
              <label class="radio-inline"><input required type="radio" name="isConfirm" value="1" id="addConfirmYes">Yes</label>
              <label class="radio-inline"><input required type="radio" name="isConfirm" value="0" id="addConfirmNo" checked>No</label>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Total Amount HK$</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="total_amt">
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Deposit HK$</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="deposit">
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Payment Status:</label>
            <div class="col-md-8">
              <label class="radio-inline"><input type="radio" name="payment" value="Full" id="addFull">Full paid</label>
              <label class="radio-inline"><input type="radio" name="payment" value="Deposit" id="addDeposit">Deposit paid</label>
              <label class="radio-inline"><input type="radio" name="payment" checked value="NA" id="addNA">Not applicable</label>
            </div>
    </div>
    <div class="form-group" id="depositStaff">
              <label class="col-md-4">Deposit Account</label>
              <div class="col-md-8">
                  <select name="depositAcc" class="form-control" id="depositStaffSelect">
                    <option value="" disabled selected>Select your option</option>
                    <?php foreach ($staff as $a): ?>
                    <option value="<?php echo $a['staffID']; ?>"><?php echo $a['staffName']; ?></option>
                    <?php endforeach; ?>
                  </select>
              </div>
      </div>
      <div class="form-group" id="fullStaff">
                <label class="col-md-4">Final Payment Account</label>
                <div class="col-md-8">
                    <select name="finalAcc" class="form-control" id="fullStaffSelect">
                      <option value="" disabled selected>Select your option</option>
                      <?php foreach ($staff as $a): ?>
                      <option value="<?php echo $a['staffID']; ?>"><?php echo $a['staffName']; ?></option>
                      <?php endforeach; ?>
                    </select>
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
    <button type="submit" class="btn btn-primary">Add Event</button>
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
    <h4 class="modal-title bookingDetailBox">Booking Detail</h4>
    <h4 class="modal-title bookingEditBox">Update Calendar Event</h4>
  </div>
  <div class="modal-body">
  <div class="bookingDetailBox">
    <div class="row">
      <div class="col-md-4 col-xs-7">Customer Name &amp; Phone:</div><div id="bookingTitle" class="col-md-8 col-xs-5"></div>
    </div>
    <div class="row">
      <div class="col-md-4 col-xs-7">Start Date &amp; Time:</div><div id="bookingStart" class="col-md-8 col-xs-5"></div>
    </div>
    <div class="row">
      <div class="col-md-4 col-xs-7">End Date &amp; Time</div><div id="bookingEnd" class="col-md-8 col-xs-5"></div>
    </div>
    <div class="row">
      <div class="col-md-4 col-xs-7">Number Of People:</div><div id="bookingPeople" class="col-md-8 col-xs-5"></div>
    </div>
    <div class="row">
      <div class="col-md-4 col-xs-7">Drinks:</div><div id="bookingDrinks" class="col-md-8 col-xs-5"></div>
    </div>
    <div class="row">
      <div class="col-md-4 col-xs-7">Confirm:</div><div id="bookingIsConfirm" class="col-md-8 col-xs-5"></div>
    </div>
    <div class="row">
      <div class="col-md-4 col-xs-7">Total Amount:</div><div id="bookingTotal" class="col-md-8 col-xs-5"></div>
    </div>
    <div class="row">
      <div class="col-md-4 col-xs-7">Deposit Amount:</div><div id="bookingDeposit" class="col-md-8 col-xs-5"></div>
    </div>
    <div class="row">
      <div class="col-md-4 col-xs-7">Payment Status:</div><div id="bookingPayment" class="col-md-8 col-xs-5"></div>
    </div>
    <div class="row">
      <div class="col-md-4 col-xs-7">Deposit Acc:</div><div id="bookingDepositAcc" class="col-md-8 col-xs-5"></div>
    </div>
    <div class="row">
      <div class="col-md-4 col-xs-7">Final Payment Acc:</div><div id="bookingFinalAcc" class="col-md-8 col-xs-5"></div>
    </div>
    <div class="row">
      <div class="col-md-4 col-xs-7">Remarks:</div><div id="bookingRemarks" class="col-md-8 col-xs-5"></div>
    </div>
  </div>
  <?php echo form_open(site_url("bookings/edit_event"), array("class" => "form-horizontal bookingEditBox", "id" => "bookingEditBox")) ?>
  <div class="form-group">
            <label class="col-md-4">Customer Name &amp; Phone*</label>
            <div class="col-md-8">
                <input required type="text" class="form-control" id="EditTitle" name="title">
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Booking Start-time*</label>
            <div class="col-md-8 input-append date form_datetime">
                <input required type="text" class="form-control" name="start" id="EditStart">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Booking End-time*</label>
            <div class="col-md-8 input-append date form_datetime">
                <input required type="text" class="form-control" name="end" id="EditEnd">
                <span class="add-on"><i class="icon-calendar"></i></span>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Number of People*</label>
            <div class="col-md-8">
                <input required type="text" class="form-control" name="noOfPpl" id="EditPeople">
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Drinks:</label>
            <div class="col-md-8">
              <label class="radio-inline"><input type="radio" name="drinks" value="1" id="EditDrinks1">Yes</label>
              <label class="radio-inline"><input type="radio" name="drinks" value="0" id="EditDrinks0">No</label>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Confirm* :</label>
            <div class="col-md-8">
              <label class="radio-inline"><input required type="radio" name="isConfirm" value="1" id="EditConfirm1">Yes</label>
              <label class="radio-inline"><input required type="radio" name="isConfirm" value="0" id="EditConfirm0">No</label>
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Total Amount HK$</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="total_amt" id="EditTotal">
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Deposit HK$</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="deposit" id="EditDeposit">
            </div>
    </div>
    <div class="form-group">
            <label class="col-md-4">Payment Status:</label>
            <div class="col-md-8">
              <label class="radio-inline"><input type="radio" name="payment" value="Full" id="EditPaymentF">Full paid</label>
              <label class="radio-inline"><input type="radio" name="payment" value="Deposit" id="EditPaymentD">Deposit paid</label>
              <label class="radio-inline"><input type="radio" name="payment" value="NA" id="EditPaymentNA">Not applicable</label>
            </div>
    </div>
    <div class="form-group" id="depositStaffEdit">
              <label class="col-md-4">Deposit Account</label>
              <div class="col-md-8">
                  <select name="depositAcc" class="form-control" id="depositStaffSelectEdit">
                    <option value="" disabled selected>Select your option</option>
                    <?php foreach ($staff as $a): ?>
                    <option value="<?php echo $a['staffID']; ?>"><?php echo $a['staffName']; ?></option>
                    <?php endforeach; ?>
                  </select>
              </div>
      </div>
      <div class="form-group" id="fullStaffEdit">
                <label class="col-md-4">Final Payment Account</label>
                <div class="col-md-8">
                    <select name="finalAcc" class="form-control" id="fullStaffSelectEdit">
                      <option value="" disabled selected>Select your option</option>
                      <?php foreach ($staff as $a): ?>
                      <option value="<?php echo $a['staffID']; ?>"><?php echo $a['staffName']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
        </div>
    <div class="form-group">
            <label class="col-md-4">Remarks</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="remarks" id="EditRemarks">
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
<div class="modal" id="workInfoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Work Detail</h4>
  </div>
  <div class="modal-body">
  <div class="">
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
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


</div>
</div>
</div>


<script type="text/javascript">
$(document).ready(function() {

  $.fn.checkTypeToDisplay = function (type) {
      if($(type).is(':checked')){
        return true;
      }else {
        return false;
      }
  }

$('#calendar').fullCalendar({
  eventSources: [
     {
         events: function(start, end, timezone, callback) {
             $.ajax({

                   url: '<?php echo site_url("bookings/get_events") ?>',
                   dataType: 'json',
                   data: {
                   // our hypothetical feed requires UNIX timestamps
                   start: start.unix(),
                   end: end.unix()
                   },
                   success: function(msg) {
                       var events = msg.events;
                       if($.fn.checkTypeToDisplay('#holdDisplay')) {
                            callback(events);
                        }else {
                            events = $.map(events, function (e) { return null; });
                            callback(events);
                        }
                   }

             });
         },
         color: '#c7e231',
         textColor: '#b1b5b3',
         id: 'hold'
     },
     {
         events: function(start, end, timezone, callback) {
             $.ajax({

                   url: '<?php echo site_url("bookings/get_events/1") ?>',
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
         id: 'confirm'
     },
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
                       if($.fn.checkTypeToDisplay('#workDisplay')) {
                            callback(events);
                        }else {
                            events = $.map(events, function (e) { return null; });
                            callback(events);
                        }
                   }

             });
         },
         color: '#5531e2',
         textColor: '#ffffff',
         id: 'work'

     },
   ],
   eventDrop: function(event, delta, revertFunc) {
        $.ajax({
              url: '<?php echo site_url("bookings/update_by_drag") ?>',
              data: {
                  start: moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                  end: moment(event.end).format('YYYY-MM-DD HH:mm:ss'),
                  bookingID: event.id
              }

        });
    },
    eventResize: function(event, delta, revertFunc) {
        $.ajax({
              url: '<?php echo site_url("bookings/update_by_drag") ?>',
              data: {
                  start: moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                  end: moment(event.end).format('YYYY-MM-DD HH:mm:ss'),
                  bookingID: event.id
              }

        });
    },
  dayClick: function(date, jsEvent, view) {
      $('#calendar').fullCalendar( 'changeView', 'agendaDay', date.format());
  },

  eventClick: function(event, jsEvent, view) {
      if (event.source.id == 'work') {
            $('#workingStaff').html(event.title);
            $('#workingStart').html(moment(event.start).format('YYYY-MM-DD HH:mm'));
            $('#workingEnd').html(moment(event.end).format('YYYY-MM-DD HH:mm'));
            $('#workingStaffID').html(event.staffID);
            $('#workingRemarks').html(event.remarks);

            $('#workInfoModal').modal();
      }else {
            $('#bookingTitle').html(event.title);
            $('#bookingStart').html(moment(event.start).format('YYYY-MM-DD HH:mm'));
            $('#bookingEnd').html(moment(event.end).format('YYYY-MM-DD HH:mm'));
            $('#bookingPeople').html(event.people);
            if(event.drinks == 1){
              $('#bookingDrinks').html('Yes');
            }else {
              $('#bookingDrinks').html('No');
            }
            if(event.isConfirm == 1){
              $('#bookingIsConfirm').html('Confirmed');
            }else {
              $('#bookingIsConfirm').html('Hold');
            }
            $('#bookingTotal').html(event.total_amt);
            $('#bookingDeposit').html(event.deposit);
            $('#bookingPayment').html(event.payment_status);
            $('#bookingRemarks').html(event.remarks);
            var depositAccount = "";
            $('#bookingDepositAcc').html(depositAccount);
            <?php foreach ($staff as $s) : ?>
                if(event.deposit_acc == <?php echo $s['staffID']; ?>) {
                    depositAccount = '<?php echo $s['staffName']; ?>' ;
                    $('#bookingDepositAcc').html(depositAccount);
                }
            <?php endforeach; ?>
            var finalAccount = "";
            $('#bookingFinalAcc').html(finalAccount);
            <?php foreach ($staff as $s) : ?>
                if(event.final_acc == <?php echo $s['staffID']; ?>) {
                    finalAccount = '<?php echo $s['staffName']; ?>' ;
                    $('#bookingFinalAcc').html(finalAccount);
                }
            <?php endforeach; ?>

            $('#EditTitle').val(event.title);
            $('#EditStart').val(moment(event.start).format('YYYY-MM-DD HH:mm'));
            $('#EditEnd').val(moment(event.end).format('YYYY-MM-DD HH:mm'));
            $('#EditPeople').val(event.people);
            $('#EditTotal').val(event.total_amt);
            $('#EditDeposit').val(event.deposit);
            $('#EditRemarks').val(event.remarks);
            if(event.drinks == 1){
              $('#EditDrinks1').attr('checked','true');
            }else {
              $('#EditDrinks0').attr('checked','true');
            }
            if(event.isConfirm == 1){
              $('#EditConfirm1').attr('checked','true');
              $('#EditPaymentNA').prop("disabled",true);
            }else {
              $('#EditConfirm0').attr('checked','true');
              $('#EditPaymentF').prop("disabled",true);
              $('#EditPaymentD').prop("disabled",true);
            }
            if(event.payment_status == 'Full') {
              $('#EditPaymentF').attr('checked','true');
            }else if (event.payment_status == 'Deposit') {
              $('#EditPaymentD').attr('checked','true');
              $('#fullStaffEdit').hide();
            }else {
              $('#EditPaymentNA').attr('checked','true');
              $('#depositStaffEdit').hide();
              $('#fullStaffEdit').hide();
            }
            $('#depositStaffSelectEdit').val(event.deposit_acc);
            $('#fullStaffSelectEdit').val(event.final_acc);

            $('#event_id').val(event.id);
            $('#editModal').modal();
      }
  },
  defaultView: 'listMonth',
  header: {
              left: 'title',
              right: 'agendaThreeDay,listMonth,today,prev,next'
    },
  height: 650,
  eventRender: function(event, element) {
    element.find('.fc-time').append("<br/>");
    if (event.source.id == 'hold' || event.source.id == 'confirm') {
      element.find('.fc-list-item-title').append("<br>" +event.people + "ppl");
    }

  },
  views: {
        month: {
            timeFormat: 'h:mm A'
        },
        agenda: {
            timeFormat: 'h:mm A'
        },
        agendaThreeDay: {
            type: 'agenda',
             duration: { days: 3 },
             buttonText: '3 day',
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

$.fn.addFormSetting = function () {
  $('#addNA').prop("disabled",false);
  $('#addFull').prop("disabled",true);
  $('#addDeposit').prop("disabled",true);
  $('#depositStaff').hide();
  $('#fullStaff').hide();
}

$.fn.addFormSetting();

$('#addBookingClose').click(function() {
    $('#addBookingForm').trigger('reset');
    $.fn.addFormSetting();
});

$('#holdDisplay').change(function () {
    $('#calendar').fullCalendar( 'refetchEvents' );
});

$('#workDisplay').change(function () {
    $('#calendar').fullCalendar( 'refetchEvents' );
});

$('#addConfirmYes').change(function () {
    if ($('#addConfirmYes').is(':checked')) {
        $('#addNA').prop("disabled",true);
        $('#addFull').prop("disabled",false);
        $('#addDeposit').prop("disabled",false);
        $('#addNA').prop('checked', false);
    }
});

$('#addConfirmNo').change(function () {
    if ($('#addConfirmNo').is(':checked')) {
        $.fn.addFormSetting();
        $('#addNA').prop('checked', true);
        $('#depositStaffSelect').prop('selectedIndex',0);
        $('#fullStaffSelect').prop('selectedIndex',0);
    }
});

$('#addDeposit').change(function () {
  if ($('#addDeposit').is(':checked')) {
      $('#depositStaff').show();
      $('#fullStaff').hide();
  }else {
      $('#depositStaff').hide();
      $('#fullStaff').hide();
  }
});

$('#addFull').change(function () {
  if ($('#addFull').is(':checked')) {
    $('#depositStaff').show();
    $('#fullStaff').show();
  }else {
    $('#depositStaff').hide();
    $('#fullStaff').hide();
  }
});

$('#EditConfirm1').change(function () {
    if ($('#EditConfirm1').is(':checked')) {
        $('#EditPaymentNA').prop("disabled",true);
        $('#EditPaymentF').prop("disabled",false);
        $('#EditPaymentD').prop("disabled",false);
        $('#EditPaymentNA').prop('checked', false);
    }
});

$('#EditConfirm0').change(function () {
    if ($('#EditConfirm0').is(':checked')) {
        $('#EditPaymentNA').prop("disabled",false);
        $('#EditPaymentF').prop("disabled",true);
        $('#EditPaymentD').prop("disabled",true);
        $('#depositStaffEdit').hide();
        $('#fullStaffEdit').hide();
        $('#EditPaymentNA').prop('checked', true);
        $('#depositStaffSelectEdit').prop('selectedIndex',0);
        $('#fullStaffSelectEdit').prop('selectedIndex',0);
    }
});

$('#EditPaymentD').change(function () {
  if ($('#EditPaymentD').is(':checked')) {
      $('#depositStaffEdit').show();
      $('#fullStaffEdit').hide();
  }else {
      $('#depositStaffEdit').hide();
      $('#fullStaffEdit').hide();
  }
});

$('#EditPaymentF').change(function () {
  if ($('#EditPaymentF').is(':checked')) {
    $('#depositStaffEdit').show();
    $('#fullStaffEdit').show();
  }else {
    $('#depositStaffEdit').hide();
    $('#fullStaffEdit').hide();
  }
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
