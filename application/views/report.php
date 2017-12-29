<div class="container-fluid" style="margin-top:3%; font-size:12px;">
    <h4>Booking Report</h4>
    <div class="col-md-10 well">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>From date:</label>
                <input type="text" name="fromDate" class="form-control form_datetime" id="fromDate" readonly style="height: 25px;">
            </div>
            <div class="col-md-6 form-group">
                <label>To date:</label>
                <input type="text" name="toDate" class="form-control form_datetime" id="toDate" readonly style="height: 25px;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                <label>Payment Status:</label>
                <select name="payment" class="form-control" id="paymentSelect" style="height:25px;">
                  <option value="all" selected>All</option>
                  <option value="Deposit">Deposit</option>
                  <option value="Full">Full</option>
                  <option value="NA">NA</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label>Confirm Status:</label>
                <select name="confirm" class="form-control" id="confirmSelect" style="height:25px;">
                  <option value="all" selected>All</option>
                  <option value="1">Confirmed</option>
                  <option value="0">Not Confirm</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label>Deposit Acc:</label>
                <select name="depositAcc" class="form-control" id="depositSelect" style="height:25px;">
                  <option value="all" selected>All</option>
                  <?php foreach ($staff as $a): ?>
                  <option value="<?php echo $a['staffID']; ?>"><?php echo $a['staffName']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label>Final Payment Acc:</label>
                <select name="finalAcc" class="form-control" id="finalSelect" style="height:25px;">
                  <option value="all" selected>All</option>
                  <?php foreach ($staff as $a): ?>
                  <option value="<?php echo $a['staffID']; ?>"><?php echo $a['staffName']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button id="searchBtn" class="btn btn-success" style="font-size:12px;">Search</button>
        <span id="loadingMsg">Hello</span>
    </div>
    <div class="report_content_wrap" id="report">

        <table id="example1" class="display" cellspacing="0" width="100%" style="font-size:12px;">
            <thead>
                <tr>
                    <th>Contact Person</th>
                    <th>start</th>
                    <th>end</th>
                    <th>people</th>
                    <th>drinks</th>
                    <th>Confirm?</th>
                    <th>payment_status</th>
                    <th>deposit_acc</th>
                    <th>final_acc</th>
                    <th>remarks</th>
                    <th>deposit</th>
                    <th>total_amt</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="2" style="text-align:right">Final payment total:</th>
                    <th></th>
                    <th colspan="7" style="text-align:right">Total:</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>Contact Person</th>
                    <th>start</th>
                    <th>end</th>
                    <th>people</th>
                    <th>drinks</th>
                    <th>Confirm?</th>
                    <th>payment_status</th>
                    <th>deposit_acc</th>
                    <th>final_acc</th>
                    <th>remarks</th>
                    <th>deposit</th>
                    <th>total_amt</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
<script>
$(document).ready( function() {
    var example_table =
    $('#example1').DataTable( {
        "scrollX": true,
        "paging":   true,
        "ordering": true,
        "info":     false,
        "stateSave": false,
        "order": [[1,'asc']],
        "ajax": {
            'type': 'POST',
            'url': '<?php echo site_url("report/load_report_data") ?>',
            'data': function (d) {
                d.from = $('#fromDate').val();
                d.to = $('#toDate').val();
                d.payment = $('#paymentSelect').val();
                d.confirm = $('#confirmSelect').val();
                d.depositacc = $('#depositSelect').val();
                d.finalacc = $('#finalSelect').val();
            }
        },
        "columns": [
            { "data": "title" },
            { "data": "start" },
            { "data": "end" },
            { "data": "people" },
            { "data": "drinks" },
            { "data": "isConfirm" },
            { "data": "payment_status" },
            { "data": "deposit_acc" },
            { "data": "final_acc" },
            { "data": "remarks" },
            { "data": "deposit" },
            { "data": "total_amt" }
        ],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', footer: true }
        ],
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            var grossTotal = api.column(11).data().reduce( function (a, b)
                                {
                                    return parseInt(a) + parseInt(b);
                                }, 0 );
            var depositTotal = api.column(10).data().reduce( function (a, b)
                                {
                                    return parseInt(a) + parseInt(b);
                                }, 0 );

            $(api.column(10).footer()).html('$' + depositTotal);
            $(api.column(11).footer()).html('$' + grossTotal);
            $(api.column(2).footer()).html('$' + (grossTotal - depositTotal));
        }
    } );

    $('.form_datetime').datetimepicker({
        format: 'yyyy-mm-dd',
        minView: 2,
        autoclose: true
    });

    $('#searchBtn').click(function() {

        example_table.destroy();
        // $('#example1').remove();
        // $('#loadingMsg').text('Loading...Please wait...');
        // $('#report').append(table);
        example_table = $('#example1').DataTable( {
            "scrollX": true,
            "paging":   true,
            "ordering": true,
            "info":     false,
            "stateSave": false,
            "order": [[1,'asc']],
            "ajax": {
                'type': 'POST',
                'url': '<?php echo site_url("report/load_report_data") ?>',
                'data': function (d) {
                    d.from = $('#fromDate').val();
                    d.to = $('#toDate').val();
                    d.payment = $('#paymentSelect').val();
                    d.confirm = $('#confirmSelect').val();
                    d.depositacc = $('#depositSelect').val();
                    d.finalacc = $('#finalSelect').val();
                }
            },
            "columns": [
                { "data": "title" },
                { "data": "start" },
                { "data": "end" },
                { "data": "people" },
                { "data": "drinks" },
                { "data": "isConfirm" },
                { "data": "payment_status" },
                { "data": "deposit_acc" },
                { "data": "final_acc" },
                { "data": "remarks" },
                { "data": "deposit" },
                { "data": "total_amt" }
            ],
            dom: 'Bfrtip',
            buttons: [
                { extend: 'excelHtml5', footer: true },
                { extend: 'csvHtml5', footer: true },
                { extend: 'pdfHtml5', footer: true }
            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();
                var grossTotal = api.column(11).data().reduce( function (a, b)
                                    {
                                        return parseInt(a) + parseInt(b);
                                    }, 0 );
                var depositTotal = api.column(10).data().reduce( function (a, b)
                                    {
                                        return parseInt(a) + parseInt(b);
                                    }, 0 );

                $(api.column(10).footer()).html('$' + depositTotal);
                $(api.column(11).footer()).html('$' + grossTotal);
                $(api.column(2).footer()).html('$' + (grossTotal - depositTotal));
            }
        });

        // $('#loadingMsg').text('');

    });

    $('#example1').ready(function() {
        $('#loadingMsg').text('');
    });

});

</script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
<link href="<?php echo base_url() ?>scripts/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="<?php echo base_url() ?>scripts/datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
