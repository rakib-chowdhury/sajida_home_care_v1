<div class="main-content">

    <?php
    if (isset($top_header)) {

        echo $top_header;
    }
    ?>

    <hr/>
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/datatables/datatables.css">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        Caregiver Info<br>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <?php if ($this->session->flashdata('success_msg')) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong><?= $this->session->flashdata('success_msg'); ?></strong>
                </div>
            </div>
        </div>
    <?php }if($this->session->flashdata('error_msg')){ ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong><?= $this->session->flashdata('error_msg'); ?></strong>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="profile-env">
            <div class="col-md-3">

                <div class="panel panel-gradient" data-collapsed="0">
                    <div class="panel-body">
                        <div>
                            <a href="#" class="profile-picture">
                                <img style="height: 120px;width: 120px" src="<?= site_url('uploads/caregiver_image/no_image.jpg') ?>"
                                     class="center-block img-circle"/>
                            </a>

                        </div>

                        <div>
                            <hr>
                            <ul class="profile-info-sections list-unstyled">
                                <li>
                                    <div class="profile-name">
                                        <strong>
                                            <a href="#"><?= $consultant_info[0]->name ?></a>
                                        </strong><br>
                                        <span><a
                                                href="#"><?php if(isset($total_rating)){echo '('.sprintf("%.2f", $total_rating).')';}else{echo 'No Rating';} ?>
                                                <span><a href="#">
                                                        <?php if(isset($total_rating)){ ?>
                                                        <?php if($total_rating >= 5){ ?>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                        <?php }if($total_rating > 0 && $total_rating < 1.5){ ?>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        <?php }if($total_rating >= 1.5 && $total_rating < 2){ ?>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star-half"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                                <span class="fa fa-star-o"></span>
                                                        <?php }if($total_rating >= 2 && $total_rating < 2.5){ ?>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        <?php }if($total_rating >= 2.5 && $total_rating < 3){ ?>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-half"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        <?php }if($total_rating >= 3 && $total_rating < 3.5){ ?>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        <?php }if($total_rating >= 3.5 && $total_rating < 4){ ?>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star-half"></span>
                                                                <span class="fa fa-star-o"></span>
                                                            <?php }if($total_rating >= 4 && $total_rating < 4.5){ ?>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star-half"></span>
                                                        <?php }if($total_rating >= 4.5 && $total_rating < 5){ ?>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star-half"></span>
                                                        <?php }}?>
                                                    </a></span><br></a></span>
                                        <span><a
                                                href="#"><?= $consultant_info[0]->consultant_user_id; ?></a></span><br>
                                    </div>
                                </li>
                            </ul>
                            <hr>
                            <ul class="profile-info-sections list-unstyled ">
                                <li>
                                    <div class="profile-stat">
                                        <h3><?= $appointments ?></h3>
                                        <span><a href="#">Appointments</a></span>
                                    </div>
                                </li>

                                <li>
                                    <div class="profile-stat">
                                        <h3><?php $s = $total_hours/1000;
                                                    $hours = floor($s/3600);
                                                    $minutes = floor(($s/60)-($hours*60));
                                                    $seconds = round($s-($hours*3600)-($minutes*60));
                                                    echo $hours.':'.$minutes.':'.$seconds;
                                            ?></h3>
                                        <span><a href="#">Care Hours</a></span>
                                    </div>
                                </li>
                            </ul>

                        </div>
                        <hr>
                        <ul class="user-details list-unstyled">
                            <li>
                                <a href="#">
                                    <i class="entypo-location"></i>
                                    <?= $consultant_info[0]->address ?>
                                </a>
                            </li>
                            <br>
                            <li>
                                <a href="#">
                                    <i class="entypo-mobile"></i>
                                    <?= $consultant_info[0]->phone_number ?>
                                </a>
                            </li>
                            <br>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-9">

                <div class="panel panel-gradient" data-collapsed="0">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- tabs for the profile links -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#biography">Bio</a></li>
                                    <li><a data-toggle="tab" href="#care_history">Care History</a></li>
                                    <li><a data-toggle="tab" href="#schedules">Upcoming Schedule</a></li>
                                    <li><a data-toggle="tab" href="#analytics">Analytics</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div id="biography" class="tab-pane fade in active">
                                <div class="panel-group joined" id="accordion-test-2">
                                    <h4 class=""><a data-toggle="collapse" data-parent="#accordion-test-2"
                                                    href="#collapseOne-2">
                                            Basic Info
                                        </a></h4>
                                    <div class="panel panel-default">
                                        <div id="collapseOne-2" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="col-md-10">
                                                    <span for="patient_name" class="col-sm-3">Name</span>
                                                    <p class="col-sm-3"><?= $consultant_info[0]->name ?></p>
                                                </div>
                                                <input type="hidden" name="g_caregiver_name" id="g_caregiver_name" value="<?= $consultant_info[0]->consultant_name ?>">
                                                <div class="col-md-10">
                                                    <span for="patient_id" class="col-sm-3">ID</span>
                                                    <p class="col-sm-3"><?= $consultant_info[0]->consultant_user_id ?></p>
                                                </div>
                                                <input type="hidden" id="get_caregiver" name="get_caregiver"
                                                       value="<?= $consultant_info[0]->consultant_user_id ?>">
                                                <div class="col-md-10">
                                                    <span for="phone_number" class="col-sm-3">Phone</span>
                                                    <p class="col-sm-3"><?= $consultant_info[0]->phone_number ?></p>
                                                </div>
                                                <div class="col-md-10">
                                                    <span for="patient_email" class="col-sm-3">Email</span>
                                                    <p class="col-sm-3"><?php if($consultant_info[0]->email){echo $consultant_info[0]->email;}else{echo 'N/A';} ?></p>
                                                </div>
                                                <div class="col-md-10">
                                                    <span for="patient_address" class="col-sm-3">Address</span>
                                                    <p class="col-sm-3"><?php if($consultant_info[0]->address){echo $consultant_info[0]->address;}else{echo 'N/A';} ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class=""><a data-toggle="collapse" data-parent="#accordion-test-2"
                                                    href="#collapseOne-5">
                                            Financial Information
                                        </a></h4>
                                    <div class="panel panel-default">
                                        <div id="collapseOne-5" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="panel panel-gray panel-shadow">
                                                    <!-- to apply shadow add class "panel-shadow" -->

                                                    <!-- panel body -->
                                                    <div class="panel-body">
                                                        <?php if ($financial_info) { ?>
                                                                <?php if($financial_info['payment_type'] == 'Cash'){ ?>
                                                                <div class="col-sm-6">
                                                                    <div class="tile-stats tile-primary">
                                                                        <div class="icon"><i
                                                                                    class="entypo-suitcase"></i></div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                        class="fa fa-money"></i> Type: Cash Payment
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                        class="fa fa-gg"></i>Fixed Rate: <?= $financial_info['fixed_salary_rate'] ?>
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                    </div>

                                                                </div>
                                                            <?php }else if($financial_info['payment_type'] == 'Bank'){?>
                                                                <div class="col-sm-6">
                                                                    <div class="tile-stats tile-primary">
                                                                        <div class="icon"><i
                                                                                    class="entypo-suitcase"></i></div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                        class="fa fa-money"></i> Type: Bank Payment
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                        class="fa fa-bank"></i>Bank Name: <?= $financial_info['bank_name'] ?>
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                        class="fa fa-gg-circle"></i>A/C No: <?= $financial_info['bank_account_number'] ?>
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                        class="fa fa-gg"></i>Fixed Rate: <?= $financial_info['fixed_salary_rate'] ?>
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                    </div>

                                                                </div>
                                                            <?php }else if($financial_info['payment_type'] == 'Mobile'){ ?>
                                                                <div class="col-sm-6">
                                                                    <div class="tile-stats tile-primary">
                                                                        <div class="icon"><i
                                                                                    class="entypo-suitcase"></i></div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                        class="fa fa-money"></i> Type: Mobile Payment
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                        class="fa fa-mobile-phone"></i>Method Name: <?= $financial_info['payment_method_name'] ?>
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                        class="fa fa-gg-circle"></i>A/C No: <?= $financial_info['mobile_payment_number'] ?>
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                        class="fa fa-gg"></i>Fixed Rate: <?= $financial_info['fixed_salary_rate'] ?>
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                    </div>

                                                                </div>
                                                            <?php } ?>

                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="care_history" class="tab-pane fade">
                                <div style="float: left"><h3>Care History</h3></div>
                                <div style="float: right">
                                    <div class="input-group">
                                        <input type="text" required class="form-control" id="s_month"
                                               name="s_month" readonly onchange="fetch_data()"
                                               placeholder="Select A Month"
                                        >

                                        <div class="input-group-addon">
                                            <a href="#"><i class="entypo-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="filter_table">

                                </div>
                            </div>
                            <div id="schedules" class="tab-pane fade">
                                <h3>Upcoming Schedules</h3>
                                <table class="table table-bordered responsive" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th style="background-color: #303641;color: white">Patient Name</th>
                                        <th style="background-color: #303641;color: white">Starting Date</th>
                                        <th style="background-color: #303641;color: white">Start Time</th>
                                        <th style="background-color: #303641;color: white">Ending Date</th>
                                        <th style="background-color: #303641;color: white">End Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (sizeof($get_schedule) == null) { ?>
                                        <tr>
                                            <td colspan="5" style="text-align: center">No Data Available</td>
                                        </tr>
                                    <?php } else { ?>
                                        <?php foreach ($get_schedule as $key => $row) { ?>
                                            <tr>
                                                <td><a href="<?= site_url('patient/view_profile') . '/' . $row['patient_id'] ?>">
                                                        <?= $row['patient_name'] ?>
                                                    </a></td>
                                                <td><?= $row['starting_date'] ?></td>
                                                <td><?= $row['starting_time'] ?></td>
                                                <td><?= $row['ending_date'] ?></td>
                                                <td><?= $row['ending_time'] ?></td>
                                            </tr>
                                        <?php }
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="analytics" class="tab-pane fade" style="width: 640px; height: 640px" >
                                <div id="chart_div">
                                    <div style="float: left"><h3>Analytics</h3></div>
                                    <div style="float: right">
                                        <div class="input-group">
                                            <input type="text" required class="form-control" id="c_month"
                                                   name="c_month" readonly onchange="fetch_chart_data()"
                                                   placeholder="Select Year & Month"
                                            >

                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div id="chart3"></div>
                                        <div class="icheck-skins">
                                            <a href="#" style="background-color: #707f9b; margin-left: 40%"></a><span>Duty Hours</span>
                                            <a href="#" style="background-color: #455064"></a><span>Over Time</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        $('#s_month').datepicker({
            minViewMode: 'months',
            format: 'yyyy-mm'
        });
        $('#c_month').datepicker({
            minViewMode: 'months',
            format: 'yyyy-mm'
        });

        function fetch_data() {
            var get_month = $('#s_month').val();
            var get_caregiver = $('#get_caregiver').val();
            var caregiver_name = $('#g_caregiver_name').val();
            // console.log(get_caregiver);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("caregiver/fetch_history");?>',
                data: {
                    'month_name': get_month,
                    'caregiver_id': get_caregiver,
                    'caregiver_name': caregiver_name
                },
                success: function (data) {
                    $("#filter_table").html(data);
                }
            });
        }
        function fetch_chart_data() {
            $("#chart3").empty();
            var get_month = $('#c_month').val();
            var get_caregiver = $('#get_caregiver').val();
            // console.log(get_month);

            var bar_chart = Morris.Bar( {
                element : 'chart3',
                data: [{schedule_date: 0, dutyhours: 0, overtime: 0},
                    {schedule_date: 0, dutyhours: 0, overtime: 0},
                    {schedule_date: 0, dutyhours: 0, overtime: 0},
                    {schedule_date: 0, dutyhours: 0, overtime: 0}],
                xkey: 'schedule_date',
                ykeys: ['dutyhours', 'overtime'],
                labels: ['Duty Hours', 'Overtime'],
                barColors: ['#707f9b', '#455064'],
                redraw: true,
                hideHover: false,
                resize: true
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("caregiver/get_chart_data");?>',
                data: {
                    'month_name': get_month ,
                    'caregiver_id': get_caregiver
                },
                success: function (data) {
//                    $("#filter_table").html(data);
                    data1 = $.parseJSON(data);
                    // console.log(data.length);
                    bar_chart.setData(data1);
                }
            });
        }

        $(document).ready(function () {
            var today = new Date();
            var get_year = today.getFullYear();
            var get_caregiver = $('#get_caregiver').val();
            var get_month = today.getMonth() + 1;
            var caregiver_name = $('#g_caregiver_name').val();
            //  console.log(get_month);
            var mm = get_year + '-' + get_month;
            var curr_year_month = moment().format('YYYY-MM');
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("caregiver/fetch_history");?>',
                data: {
                    'month_name': curr_year_month,
                    'caregiver_id': get_caregiver,
                    'caregiver_name': caregiver_name
                },
                success: function (data) {
                    $("#filter_table").html(data);
                }
            });
            //// chart //////////
                // Bar Charts
            var bar_chart = Morris.Bar( {
                element : 'chart3',
                data: [{schedule_date: 0, dutyhours: 0, overtime: 0},
                    {schedule_date: 0, dutyhours: 0, overtime: 0},
                    {schedule_date: 0, dutyhours: 0, overtime: 0},
                    {schedule_date: 0, dutyhours: 0, overtime: 0}],
                xkey: 'schedule_date',
                ykeys: ['dutyhours', 'overtime'],
                labels: ['Duty Hours', 'Overtime'],
                barColors: ['#707f9b', '#455064'],
                redraw: true,
                hideHover: false,
                resize: true
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("caregiver/get_chart_data");?>',
                data: {
                    'month_name': mm,
                    'caregiver_id': get_caregiver
                },
                success: function (data) {
//                    $("#filter_table").html(data);
                    data1 = $.parseJSON(data);
                   // console.log(data1);
                    bar_chart.setData(data1);
                }
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                var target = $(e.target).attr("href"); // activated tab

                switch (target) {
                    case "#analytics":
                        bar_chart.redraw();
                        $(window).trigger('resize');
                        break;
                }
            });
        });
        function data(offset) {
            var ret = [];
            for (var x = 0; x <= 360; x += 10) {
                var v = (offset + x) % 360;
                ret.push({
                    x: x,
                    y: Math.sin(Math.PI * v / 180).toFixed(4),
                    z: Math.cos(Math.PI * v / 180).toFixed(4),
                });
            }
            return ret;
        }
        function show_chart_div() {
            $('#chart_div').show();
        }
    </script>
</div>