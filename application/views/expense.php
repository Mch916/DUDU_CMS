<div class="container-fluid" style="margin-top:3%;">
    <?php if($expense_added = $this->session->flashdata('expense_added')): ?>
    <?php echo '<p class="alert alert-success" id="expense_added_div">'.$expense_added.'</p>'; ?>
    <?php endif; ?>
    <h4>Expense List</h4>
    <div class="col-md-8 well">
        <h5>Custom Search</h5>
        <hr>
        <div class="row">
            <div class="col-md-6 form-group">
                <label>From date:</label>
                <input type="text" name="fromDate" class="form-control form_datetime" id="fromDate" readonly>
            </div>
            <div class="col-md-6 form-group">
                <label>To date:</label>
                <input type="text" name="toDate" class="form-control form_datetime" id="toDate" readonly>
            </div>
        </div>
        <button id="searchBtn" class="btn btn-success">Search</button>
        <button id="addExpenseBtn" class="btn btn-primary pull-right">Add Expense</button>
    </div>
    <table class="table table-hover table-responsive" style="font-size:1em;" id="expenseTable">

    </table>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Expense</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(site_url("expenses/add_expense"), array("class" => "form-horizontal", "id" => "addExpenseForm")) ?>
                        <div class="form-group">
                            <label class="col-md-4">Expense Date</label>
                            <div class="col-md-8">
                                <input required type="text" class="form-control form_datetime" name="expenseDate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4">Expense Item</label>
                            <div class="col-md-8">
                                <input required type="text" class="form-control" name="expenseItem">
                            </div>
                        </div>
                        <div class="form-group">
                                  <label class="col-md-4">Staff</label>
                                  <div class="col-md-8">
                                      <select name="staff" class="form-control" id="staff" required>
                                        <option value="" disabled selected>Select your option</option>
                                        <?php foreach ($staff as $a): ?>
                                            <option value="<?php echo $a['staffID']; ?>"><?php echo $a['staffName']; ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                  </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4">Total Amount</label>
                            <div class="col-md-8">
                                <input required type="text" class="form-control" name="expenseAmt">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="addExpenseClose" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit Expense</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(site_url("expenses/edit_expense"), array("class" => "form-horizontal", "id" => "editExpenseForm")) ?>
                        <input type="hidden" name="expense_id" value="" id="editExpenseID">
                        <div class="form-group">
                            <label class="col-md-4">Expense Date</label>
                            <div class="col-md-8">
                                <input required type="text" class="form-control form_datetime" name="expenseDateEdit" id="expenseDateEdit">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4">Expense Item</label>
                            <div class="col-md-8">
                                <input required type="text" class="form-control" name="expenseItemEdit" id="expenseItemEdit">
                            </div>
                        </div>
                        <div class="form-group">
                                  <label class="col-md-4">Staff</label>
                                  <div class="col-md-8">
                                      <select name="staffEdit" class="form-control" id="staff" required id="staffEdit">
                                        <?php foreach ($staff as $a): ?>
                                            <option value="<?php echo $a['staffID']; ?>"><?php echo $a['staffName']; ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                  </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4">Total Amount</label>
                            <div class="col-md-8">
                                <input required type="text" class="form-control" name="expenseAmtEdit" id="expenseAmtEdit">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="addExpenseClose" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Change</button>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $.fn.initDateToDisplay = function() {
        var today = new Date();
        var curDay = today.getDate(), curMonth = today.getMonth() + 1, curYear = today.getFullYear();
        $('#fromDate').val(curYear + "-" + curMonth + "-" + "01");
        $('#toDate').val(curYear + "-" + curMonth + "-" + curDay);
        $('#searchBtn').click();
    }

    $('#searchBtn').click(function() {
            $.ajax({
                url: '<?php echo site_url('expenses/get_expenses'); ?>',
                data: {
                    from: $('#fromDate').val() ,
                    to: $('#toDate').val()
                },
                dataType: 'json',
                success: function(data) {
                    $.fn.dispayTable(data);
                },
                error: function(){
                    console.log('fail to ajax');
                }

            });
    });

    $.fn.dispayTable = function (data) {
        var expenseData = data;
        var thead = document.createElement('thead'), tbody = document.createElement('tbody');
        $('#expenseTable').empty();
        var theadContent = "<tr class='info'><th>Date</th><th>Expense Item</th><th>Staff</th><th>Expense Amount</th><th>Edit</th></tr>";
        thead.innerHTML = theadContent;
        $('#expenseTable').append(thead);
        var tbodyContent = "";
        for (var i = 0; i < expenseData.length; i++) {
            tbodyContent += "<tr><td>" + expenseData[i].expense_date + "</td><td>" +
            expenseData[i].expense_item + "</td><td>" + expenseData[i].staffName + "</td><td>" +
            expenseData[i].expense_amt + "</td><td><button class='btn btn-sm btn-default' onclick='open_edit(" +
            expenseData[i].id +")'>Edit</button></td></tr>" ;
        }
        tbody.innerHTML = tbodyContent;
        $('#expenseTable').append(tbody);
    }

    $('.form_datetime').datetimepicker({
        format: 'yyyy-mm-dd',
        minView: 2,
        autoclose: true
    });

    $('#addExpenseBtn').click(function () {
        $('#addModal').modal();
    });

    setTimeout(function() {
      $("#expense_added_div").fadeOut();
    }, 1000);

    $.fn.initDateToDisplay();
});

function open_edit(expense_id) {
    $.ajax({
        url: '<?php echo site_url('expenses/get_expense'); ?>',
        data: {
            expenseID: expense_id ,
        },
        dataType: 'json',
        success: function(data) {
            $('#expenseDateEdit').val(data['expense_date']);
            $('#expenseItemEdit').val(data['expense_item']);
            $('#expenseAmtEdit').val(data['expense_amt']);
            $('#staffEdit').val(data['staff_id']);
            $('#editExpenseID').val(data['id']);
        },
        error: function(){
            console.log('fail to ajax');
        }

    });
    $('#editModal').modal();
}
</script>
<link href="<?php echo base_url() ?>scripts/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="<?php echo base_url() ?>scripts/datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
