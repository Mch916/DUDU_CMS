<div class="container-fluid" style="margin-top:3%; font-size:12px;">
    <h4>Working Report</h4>
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

        <table id="example1" class="display" cellspacing="0" width="100%" style="font-size:12px;">
            <thead>
                <tr>
                    <th>Start</th>
                    <th>End</th>
                    <th>Staff</th>
                    <th>Remarks</th>
                    <th>Salary Cost</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th colspan="2" style="text-align:right">Total cost:</th>
                    <th></th>
                </tr>
                <tr>
                    <th>Start</th>
                    <th>End</th>
                    <th>Staff</th>
                    <th>Remarks</th>
                    <th>Salary Cost</th>
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
        "order": [[0,'asc']],
        "ajax": {
            'type': 'POST',
            'url': '<?php echo site_url("report/load_working_report_data") ?>',
            'data': function (d) {
                d.from = $('#fromDate').val();
                d.to = $('#toDate').val();
                d.staff = $('#staffSelect').val();
            }
        },
        "columns": [
            { "data": "start" },
            { "data": "end" },
            { "data": "staff" },
            { "data": "workRemark" },
            { "data": "pay" }
        ],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'excelHtml5', footer: true },
            { extend: 'csvHtml5', footer: true }
        ],
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            var salaryTotal = api.column(4).data().reduce( function (a, b)
                                {
                                    return parseInt(a) + parseInt(b);
                                }, 0 );

            $(api.column(4).footer()).html('$' + salaryTotal);
        }
    } );

    $('.form_datetime').datetimepicker({
        format: 'yyyy-mm-dd',
        minView: 2,
        autoclose: true
    });

    $('#searchBtn').click(function() {

        example_table.destroy();

        example_table = $('#example1').DataTable( {
            "scrollX": true,
            "paging":   true,
            "ordering": true,
            "info":     false,
            "stateSave": false,
            "order": [[0,'asc']],
            "ajax": {
                'type': 'POST',
                'url': '<?php echo site_url("report/load_working_report_data") ?>',
                'data': function (d) {
                    d.from = $('#fromDate').val();
                    d.to = $('#toDate').val();
                    d.staff = $('#staffSelect').val();
                }
            },
            "columns": [
                { "data": "start" },
                { "data": "end" },
                { "data": "staff" },
                { "data": "workRemark" },
                { "data": "pay" }
            ],
            dom: 'Bfrtip',
            buttons: [
                { extend: 'excelHtml5', footer: true },
                { extend: 'csvHtml5', footer: true }
            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();
                var salaryTotal = api.column(4).data().reduce( function (a, b)
                                    {
                                        return parseInt(a) + parseInt(b);
                                    }, 0 );

                $(api.column(4).footer()).html('$' + salaryTotal);
            }
        });

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
