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
    <?php }
    if ($this->session->flashdata('error_msg')) { ?>
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
        <div class="col-sm-3">
            <div class="tile-stats tile-red" style="">
                <div class="icon img-responsive" style="margin-bottom: 2%"><i class="entypo-users" style="font-size: 820%"></i></div>
                <div class="num"><?= $active_caregivers ?></div>
                <h3 style="font-size: 15px; font-weight: bold">Caregivers</h3>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="tile-stats tile-green" style="">
                <div class="icon" style="margin-bottom: 2%">
                    <i class="entypo-clock" style="font-size: 820%"></i>
                </div>
                <div class="num"><?= $care_hours ?></div>
                <h3 style="font-size: 15px; font-weight: bold">Total Care Hours</h3>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="tile-stats tile-aqua" style="">
                <div class="icon" style="margin-bottom: 2%">
                    <i class="entypo-user" style="font-size: 820%"></i>
                </div>
                <div class="num"><?= $active_clients ?></div>
                <h3 style="font-size: 15px; font-weight: bold">Clients</h3>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="tile-stats tile-blue" style="">
                <div class="icon" style="margin-bottom: 2%">
                    <i class="entypo-mobile" style="font-size: 820%"></i>
                </div>
                <div class="num"><?= $total_devices ?></div>
                <h3 style="font-size: 15px; font-weight: bold">Devices Delivered</h3>
            </div>
        </div>
    </div>
    <br/>
        <div class="col-sm-12">
            <div class="panel panel-primary panel-table">
                <div class="panel-heading">
                    <div class="panel-body">
                        <div style="float: left; margin-bottom: 3%"><h3>Schedules</h3></div>
                        <div style="float: right; margin-bottom: 3%">
                            <div class="input-group">
                                <input type="text" required class="form-control datepicker" id="s_month"
                                       name="s_month" readonly onchange="fetch_data()"
                                       value="<?= date('m/d/Y') ?>"
                                >
                                <div class="input-group-addon">
                                    <a href="#"><i class="entypo-calendar"></i></a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div id="filter_table" class="table-responsive">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div id="clockingModal" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form action="<?= base_url() ?>Home/clocking_add_post"
                  method="post" onsubmit="return check_values()">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="c_name" class="control-label">Caregiver
                                        Name</label>
                                    <div class="input-group" style="width: 65%">
                                        <input type="text" class="form-control"
                                               id="c_name"
                                               name="c_name" readonly
                                               data-validate="required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="c_name" class="control-label">Patient
                                        Name</label>
                                    <div class="input-group" style="width: 65%">
                                        <input type="text" class="form-control"
                                               id="p_name"
                                               name="p_name" readonly
                                               data-validate="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="c_schedule_date" class="control-label">Starting
                                        Date</label>
                                    <div class="input-group" style="width: 65%">
                                        <input type="text" class="form-control"
                                               id="c_schedule_date"
                                               name="c_schedule_date" readonly
                                               data-validate="required">
                                        <div class="input-group-addon">
                                            <a href="#"><i class="entypo-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="c_ending_date" class="control-label">Ending Date</label>
                                    <div class="input-group" style="width: 65%">
                                        <input type="text" class="form-control"
                                               id="c_ending_date"
                                               name="c_ending_date" readonly
                                               data-validate="required">
                                        <div class="input-group-addon">
                                            <a href="#"><i class="entypo-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="c_patient_id" name="c_patient_id">
                        <input type="hidden" id="c_caregiver_id" name="c_caregiver_id">
                        <input type="hidden" id="schedule_maker_id" name="schedule_maker_id">
                        <input type="hidden" id="schedule_maker_start_time" name="schedule_maker_start_time">
                        <input type="hidden" id="schedule_maker_end_time" name="schedule_maker_end_time">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="c_s_time" style="margin-right: 5%"
                                           class="timepicontrol-label">Starting Time<span
                                                style="color: red">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="c_s_time"
                                                   name="c_s_time" readonly
                                                   data-validate="required">
                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-clock"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="c_s_time" style="margin-right: 6%"
                                           class="timepicontrol-label">Ending
                                        Time<span
                                                style="color: red">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                   id="c_e_time"
                                                   name="c_e_time" readonly
                                                   data-validate="required">
                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-clock"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="c_start_time" style="margin-right: 5%"
                                           class="timepicontrol-label">Clock In Time<span
                                                style="color: red">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" id="c_start_time"
                                                   name="c_start_time" readonly
                                                   class="form-control timepicker"
                                                   data-template="dropdown"
                                                   data-show-seconds="true"
                                                   data-default-time=00:00:00;
                                                   data-show-meridian="false"
                                                   data-minute-step="5"
                                                   data-second-step="5"/>
                                        </div>
                                        <span id="start_time_err" name="start_time_err"></span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="clocking_test" name="clocking_test" value="0">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="c_end_time" style="margin-right: 6%"
                                           class="timepicontrol-label">Clock Out
                                        Time<span style="color: red">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" id="c_end_time"
                                                   name="c_end_time" readonly
                                                   class="form-control timepicker"
                                                   data-template="dropdown"
                                                   data-show-seconds="true"
                                                   data-default-time=00:00:00;
                                                   data-show-meridian="false"
                                                   data-minute-step="5"
                                                   data-second-step="5"/>
                                        </div>
                                        <span id="end_time_err" name="end_time_err"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="myBtn" class="btn btn-success">Yes</button>
                        <button type="button" class="btn btn-danger"
                                data-dismiss="modal">No
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <?php if (isset($footer)) {
        echo $footer;
    }
    ?>
<!--    <script src="--><?php //echo base_url() ?><!--asset/admin/js/datatables/datatables.js"></script>-->
    <script src="<?php echo base_url() ?>asset/admin/js/downloaded/datatables.min.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/select2/select2.min.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/bootstrap-timepicker.min.js"></script>

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

        function setModal(p_id, c_id, s_date, start, end, schedule_maker, clockin, clockout) {
            var p_name = p_id;
            var c_name = c_id;
            var s_date = s_date;
            var start = start;
            var end = end;
            var schedule_maker = schedule_maker;
            var clockout = clockout;
            var clocking_time;
            var clockout_time;
            var clock_in = moment.unix(clockin / 1000).format('HH:mm:ss');
            var starting_time = moment.unix(start / 1000).format('HH:mm:ss');
            var ending_date = moment.unix(end / 1000).format('YYYY-MM-DD');
            var ending_time = moment.unix(end / 1000).format('HH:mm:ss');
            document.getElementById('c_name').value = c_name;
            document.getElementById('p_name').value = p_name;
            document.getElementById('c_patient_id').value = p_id;
            document.getElementById('c_caregiver_id').value = c_id;
            document.getElementById('c_schedule_date').value = s_date;
            document.getElementById('c_ending_date').value = ending_date;
            document.getElementById('c_s_time').value = starting_time;
            document.getElementById('schedule_maker_start_time').value = start;
            document.getElementById('schedule_maker_end_time').value = end;
            document.getElementById('c_e_time').value = ending_time;
            document.getElementById('schedule_maker_id').value = schedule_maker;
            if (clockin == '') {
                //  console.log('yes');
                document.getElementById('c_start_time').value = '';
                document.getElementById('c_start_time').disabled = false;
            }
            else {
                clocking_time = moment.unix(clockin / 1000).format('HH:mm:ss');
                document.getElementById('c_start_time').value = clocking_time;
                document.getElementById('clocking_test').value = 1;
                document.getElementById('c_start_time').disabled = true;
            }
            if (clockout == '') {
                document.getElementById('c_end_time').value = '';
                document.getElementById('c_end_time').disabled = false;
            }
            else {
                clockout_time = moment.unix(clockout / 1000).format('HH:mm:ss');
                document.getElementById('c_end_time').value = clockout_time;
                document.getElementById('c_end_time').disabled = true;
            }
            $('#clockingModal').modal('show');
        }
        setInterval(function(){fetch_data()},600000);
    </script>
</div>