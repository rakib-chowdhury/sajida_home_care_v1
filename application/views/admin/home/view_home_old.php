<div class="main-content">

    <?php
    if (isset($top_header)) {

        echo $top_header;
    }
    ?>

    <hr/>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            var $table1 = jQuery('#table-1');

            // Initialize DataTable
            $table1.DataTable({
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "bStateSave": false
            });

            // Initalize Select Dropdown after DataTables is created
            $table1.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });
        });
    </script>
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/datatables/datatables.css">
    <div class="row">
        <div class="col-sm-3">
            <div class="tile-stats tile-red" style="">
                <div class="icon img-responsive" style="margin-bottom: 30%"><i class="glyphicon glyphicon-user" style="font-size: 820%"></i></div>
                <div class="num"><?= $active_caregivers ?></div>
                <h3 style="font-size: 12px; font-weight: bold">Total Caregivers</h3>
                <p>We have <?= $total_caregivers ?>  registered<br> caregivers</p>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="tile-stats tile-green" style="">
                <div class="icon" style="margin-bottom: 30%">
                    <i class="glyphicon glyphicon-time" style="font-size: 820%"></i>
                </div>
                <div class="num"><?= $care_hours ?></div>
                <h3 style="font-size: 12px; font-weight: bold">Total Care Hours</h3>
                <p>We have provided <?= $care_hours ?> <br>care hours</p>
                
            </div>
        </div>


        <div class="col-md-3 col-sm-6">
            <div class="tile-stats tile-aqua" style="">
                <div class="icon" style="margin-bottom: 30%">
                    <i class="glyphicon glyphicon-user" style="font-size: 820%"></i>
                </div>
                <div class="num"><?= $active_clients ?></div>
                <h3 style="font-size: 12px; font-weight: bold">Total Clients</h3>
                <p>We have <?= $total_clients ?> registered <br>clients</p>
            </div>
        </div>


        <div class="col-md-3 col-sm-6">
            <div class="tile-stats tile-blue" style="">
                <div class="icon" style="margin-bottom: 30%">
                    <i class="glyphicon glyphicon-phone" style="font-size: 820%"></i>
                </div>
                <div class="num"><?= $total_devices ?></div>
                <h3 style="font-size: 12px; font-weight: bold">Devices Delivered</h3>
                <p>We have delivered <?= $total_devices ?> <br>devices</p>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary panel-table">
                <div class="panel-heading">
                    <div class="panel-body">
                        <div style="float: left; margin-bottom: 3%"><h3>Schedules</h3></div>
                        <div style="float: right; margin-bottom: 3%">
                            <div class="input-group">
                                <input type="text" required class="form-control datepicker" id="s_month"
                                       name="s_month" readonly onchange="fetch_data()"
                                       placeholder="<?= date('m/d/Y') ?>"
                                >

                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-calendar"></i></a>
                                </div>
                            </div>
                        </div>
                        <div id="filter_table">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php if (isset($footer)) {
        echo $footer;
    }
    ?>
    <script src="<?php echo base_url() ?>asset/admin/js/datatables/datatables.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/select2/select2.min.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            // var d = new Date();
            $("#s_month").datepicker();

            var curr = new Date();
            curr = curr.getFullYear()+'-'+(curr.getMonth()+1)+'-'+curr.getDate();
           // console.log(curr);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("home/fetch_history");?>',
                data: {
                    'month_name': curr
                },
                success: function (data) {
                    $("#filter_table").html(data);
                }
            });
        });

        function fetch_data() {
            var get_month = $('#s_month').val();
            var get_date = get_month.split('/');
            get_date = get_date[2]+'-'+get_date[0]+'-'+get_date[1];
            console.log(get_date);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("home/fetch_history");?>',
                data: {
                    'month_name': get_date
                },
                success: function (data) {
                    $("#filter_table").html(data);
                }
            });
        }

    </script>
</div>