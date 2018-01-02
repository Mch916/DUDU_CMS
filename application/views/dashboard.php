<div class="container-fluid" style="margin-top:;">
    <h2 class="page-header"><?php echo $title ?></h2>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="dashboard-box">
                    <div class="box-title">
                        Month's Booking Income
                    </div>
                    <div class="box-value">
                        <div class="box-value-inner">
                            <div class="value">
                                <?php echo 'HK$ '.$month_income['total_amt']; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="dashboard-box">
                    <div class="box-title">
                        Month's Expense
                    </div>
                    <div class="box-value">
                        <div class="box-value-inner">
                            <div class="value">
                                <?php echo 'HK$ '.$month_expense['expense_amt']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row next-box">
            <div class="col-md-6">
                <div class="dashboard-box">
                    <div class="box-title">
                        Final Payment to be received today
                    </div>
                    <div class="box-value">
                        <?php foreach($Todayfinal as $final): ?>
                            <div class="final-box">
                                <?php echo $final['customerName'].'   HK$'.$final['finalPayment'] ;?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="" style="height:50vh;">

        </div>
    </div>
</div>

<style>
    .dashboard-box {
        background-color: #427ab2;
        color: #fff;
        border-radius: 3px;
        padding: 1%;
    }

    .box-title {
        font-size: 2rem;
    }

    .box-value {
        height: 150px;
    }

    .box-value-inner {
        display: table;
        width: 100%;
        height: 100%;
    }

    .value {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
        font-size: 4rem;
    }

    .final-box {
        background-color: #fff;
        border-radius: 3px;
        color: #000;
        font-size: 1.5rem;
        margin: 2%;
        text-align: center;
        padding: 5px 0;
    }

    .next-box {
        margin-top: 30px;
    }

    @media only screen and (max-width: 500px) {

        .next-box {
            margin-top: 0;
        }

    }
</style>
