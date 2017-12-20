<div class="container-fluid" style="margin-top:3%;">
    <h4>Expense List</h4>
    <div class="col-md-8 well">
        <h5>Custom Search</h5>
        <hr>
        <div class="row">
            <div class="col-md-6 form-group">
                <label>From date:</label>
                <input type="text" name="fromDate" class="form-control" id="fromDate">
            </div>
            <div class="col-md-6 form-group">
                <label>To date:</label>
                <input type="text" name="toDate" class="form-control" id="toDate">
            </div>
        </div>
        <button id="searchBtn" class="btn btn-success">Search</button>
        <button id="addExpenseBtn" class="btn btn-primary pull-right">Add Expense</button>
    </div>
    <table class="table table-hover table-responsive" style="font-size:1em;" id="expenseTable">

    </table>
</div>

<script>
$(document).ready(function() {
    $('#searchBtn').click(function (){
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
            expenseData[i].expense_amt + "</td><td><a href=''>Edit</a></td></tr>" ;
        }
        tbody.innerHTML = tbodyContent;
        $('#expenseTable').append(tbody);
    }
});
</script>
