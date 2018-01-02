<div class="container-fluid" style="margin-top:3%; font-size:12px;">
    <h4>Expense Report</h4>
    <div class="col-md-10 well">
        <div class="row">
            <div class="col-md-4 form-group">
                <label>From date:</label>
                <input type="text" name="fromDate" class="form-control form_datetime" id="fromDate" readonly style="height: 25px;">
            </div>
            <div class="col-md-4 form-group">
                <label>To date:</label>
                <input type="text" name="toDate" class="form-control form_datetime" id="toDate" readonly style="height: 25px;">
            </div>
            <div class="col-md-4 form-group">
                <label>Staff:</label>
                <select name="staff" class="form-control" id="staffSelect" style="height:25px;">
                  <option value="all" selected>All</option>
                  <?php foreach ($staff as $a): ?>
                  <option value="<?php echo $a['staffID']; ?>"><?php echo $a['staffName']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
        </div>

        <button id="searchBtn" class="btn btn-success" style="font-size:12px;">Search</button>
    </div>
    <div class="report_content_wrap" id="report">

        <table id="example" class="display" cellspacing="0" width="100%" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>Expense Date</th>
                        <th>Staff</th>
                        <th>Expense Item</th>
                        <th>Expense Amount</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th style="text-align:right">Total:</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Expense Date</th>
                        <th>Staff</th>
                        <th>Expense Item</th>
                        <th>Expense Amount</th>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.form_datetime').datetimepicker({
        format: 'yyyy-mm-dd',
        minView: 2,
        autoclose: true
    });

    var table = $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "stateSave": false,
        "paging": false,
        "ajax": {
            "dataType": "json",
            'type': 'POST',
            'url': '<?php echo site_url("report/load_expense_report_data"); ?>',
            'data': function (d) {
                d.from = $('#fromDate').val();
                d.to = $('#toDate').val();
                d.staff = $('#staffSelect').val();
            }
        },
        "columns": [
            { "data": "expense_date" },
            { "data": "staff" },
            { "data": "expense_item" },
            { "data": "expense_amt" }
        ],
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            var Total = api.column(3).data().reduce( function (a, b)
                                {
                                    return parseInt(a) + parseInt(b);
                                }, 0 );

            $(api.column(3).footer()).html('$' + Total);
        },
        dom: 'Bfrtip',
        buttons: [
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', footer: true }
        ]
    } );

    $('#searchBtn').click(function() {
        table.draw();
    });
} );
</script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
<link href="<?php echo base_url() ?>scripts/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="<?php echo base_url() ?>scripts/datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
