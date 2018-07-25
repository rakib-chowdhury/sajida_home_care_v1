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
                        Caregiver Event List<br>
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
        <div class="row">
            <div class="col-md-2" style="margin-left: 20%">
                <label for="">Select Caregiver</label>
            </div>
            <div class="col-md-4">
                <select name="caregiver_id" id="caregiver_id" class="select2"
                        data-allow-clear="true" data-placeholder="Select A Caregiver...">
                    <option></option>
                    <?php if ($caregivers) { ?>
                        <?php foreach ($caregivers as $row) { ?>
                            <option value="<?= $row->caregiver_user_id ?>"><?= $row->caregiver_name ?></option>
                        <?php }
                    } ?>
                </select>
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <div style="float: left"><h3>Caregiver Events</h3></div>
            <div style="float: right">
                <div class="input-group">
                    <input type="text" required class="form-control" id="month_select_id"
                           name="month_select_id" readonly onchange="get_events(this.value)"
                           placeholder="Select A Month">
                    <div class="input-group-addon">
                        <a href="#"><i class="entypo-calendar"></i></a>
                    </div>
                </div>
            </div>
            <div id="table_data">
                <div class="col-md-10 centered">
                    <p class="text-center text-info label label-info"
                       style="margin-top: 5%; margin-left: 10%; font-size: 90%">Please Select A Caregiver From The
                        Drop-down Menu Above</p>
                </div>
            </div>
        </div>
        <div id="clockingModal" class="modal fade" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <!-- Modal content-->
                <form action="<?= base_url() ?>Schedule/clocking_add_post"
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
                                <input type="hidden" id="clocking_test" name="clocking_test">
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
    </div>
    <!-- Footer -->
    <?php if (isset($footer)) {
        echo $footer;
    }
    ?>
    <script src="<?php echo base_url() ?>asset/admin/js/datatables/datatables.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $('#month_select_id').datepicker({
            minViewMode: 'months',
            format: 'yyyy-mm'
        });
        $('#caregiver_id').on("change", function () {
            var caregiver = $(this).val();
            var today = new Date();
            var get_year = today.getFullYear();
            var get_month = today.getMonth() + 1;
            //alert(caregiver+' '+get_year+' '+get_month);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('get_caregiver_wise_events'); ?>',
                data: {
                    caregiver_id: caregiver,
                    year_id: get_year,
                    month_id: get_month
                },
                success: function (data) {
                    $('#table_data').html(data);
                }
            });
        });

        function get_schedule(id) {
            var id = id;
            var row_date = [];
            var start_time = [];
            var st_time = [];
            var star_time = [];
            var new_time = [];
            var f_time = [];
            var s_time = [];
            var end_time = [];
            var ending_time = [];
            var f_e_time = [];
            var clockin = [];
            var clockin_time = [];
            var f_clockin_time = [];
            var f_clockout_time = [];
            var clockout = [];
            var clockout_time = [];
            var schedule_date = [];
            $('#table_body tr').remove();
            $("#progress").show();
            // console.log(id);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("schedule/get_selected_schedule");?>',
                data: {
                    'caregiver_id': id
                },
                success: function (data) {
                    // alert(data);
                    $("#progress").hide();
                    var i;
                    var data1 = $.parseJSON(data);
                    // console.log(data1['result'].length);
                    if (data1['result'].length == 0) {
                        urow = '<tr>'
                            + '<td style="text-align: center; color: red" colspan="11"><strong>No Schedule Found!</strong></i></td>'
                            + '</tr>';
                        $('#table_body').append(urow);
                    }
                    else {
                        for (i = 0; i < data1['result'].length; i++) {
                            schedule_date[i] = data1['result'][i]['schedule_date'];
                            start_time[i] = data1['result'][i]['start_time'];
                            end_time[i] = data1['result'][i]['end_time'];
                            ending_time[i] = end_time[i] / 1000;
                            f_e_time[i] = moment.unix(ending_time[i]).format("h:mm A");
                            f_time[i] = start_time[i] / 1000;
                            start_time[i] = start_time[i] / 1000;
                            row_date[i] = moment.unix(f_time[i]).format("YYYY-MM-DD h:mm A");
                            s_time[i] = moment.unix(f_time[i]).format("h:mm A");
                            st_time[i] = moment.unix(f_time[i]).format("YYYY-MM-DD");
                            star_time[i] = new Date(st_time[i]);
                            new_time[i] = star_time[i].getDay();
                            var urow = [];
                            clockin[i] = data1['result'][i]['clock_in_time'];
                            clockout[i] = data1['result'][i]['clock_out_time'];
                            if (clockin[i] != null) {
                                clockin_time[i] = clockin[i] / 1000;
                                f_clockin_time[i] = moment.unix(clockin_time[i]).format("h:mm A");
                            } else {
                                f_clockin_time[i] = 'Not Clocked In';
                            }
                            if (clockout[i] != null) {
                                clockout_time[i] = clockout[i] / 1000;
                                f_clockout_time[i] = moment.unix(clockout_time[i]).format("h:mm A");
                            } else {
                                f_clockout_time[i] = 'Not Clocked out';
                            }

                            // clockin_time[i] =  moment.unix(clockin[i]).format("h:mm A");
                            clockout[i] = data1['result'][i]['clock_out_time'] / 1000;
                            clockout_time[i] = moment.unix(clockout[i]).format("h:mm A");

                            // console.log(f_clockout_time[i]);
                            urow[i] = '<tr>'
                            //  console.log(i);
                            if (new_time[i] == 0) {
                                urow[i] += '<td style="text-align: left"><a href="<?= site_url('patient/view_profile') . '/' ?>' + data1['result'][i]['patient_id'] + '" title="Go To Profile">' + data1['result'][i]['patient_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['address'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left"><a href="<?= site_url('caregiver/view_profile') . '/' ?>' + data1['result'][i]['caregiver_user_id'] + '" title="Go To Profile">' + data1['result'][i]['caregiver_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['caregiver_user_id'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + schedule_date[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['caregiver_name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 1) {
                                urow[i] += '<td style="text-align: left"><a href="<?= site_url('patient/view_profile') . '/' ?>' + data1['result'][i]['patient_id'] + '" title="Go To Profile">' + data1['result'][i]['patient_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['address'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left"><a href="<?= site_url('caregiver/view_profile') . '/' ?>' + data1['result'][i]['caregiver_user_id'] + '" title="Go To Profile">' + data1['result'][i]['caregiver_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['caregiver_user_id'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + schedule_date[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['caregiver_name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 2) {
                                urow[i] += '<td style="text-align: left"><a href="<?= site_url('patient/view_profile') . '/' ?>' + data1['result'][i]['patient_id'] + '" title="Go To Profile">' + data1['result'][i]['patient_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['address'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left"><a href="<?= site_url('caregiver/view_profile') . '/' ?>' + data1['result'][i]['caregiver_user_id'] + '" title="Go To Profile">' + data1['result'][i]['caregiver_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['caregiver_user_id'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + schedule_date[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['caregiver_name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 3) {
                                urow[i] += '<td style="text-align: left"><a href="<?= site_url('patient/view_profile') . '/' ?>' + data1['result'][i]['patient_id'] + '" title="Go To Profile">' + data1['result'][i]['patient_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['address'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left"><a href="<?= site_url('caregiver/view_profile') . '/' ?>' + data1['result'][i]['caregiver_user_id'] + '" title="Go To Profile">' + data1['result'][i]['caregiver_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['caregiver_user_id'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + schedule_date[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['caregiver_name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 4) {
                                // console.log('this'+ i);
                                urow[i] += '<td style="text-align: left"><a href="<?= site_url('patient/view_profile') . '/' ?>' + data1['result'][i]['patient_id'] + '" title="Go To Profile">' + data1['result'][i]['patient_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['address'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left"><a href="<?= site_url('caregiver/view_profile') . '/' ?>' + data1['result'][i]['caregiver_user_id'] + '" title="Go To Profile">' + data1['result'][i]['caregiver_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['caregiver_user_id'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + schedule_date[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['caregiver_name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 5) {
                                urow[i] += '<td style="text-align: left"><a href="<?= site_url('patient/view_profile') . '/' ?>' + data1['result'][i]['patient_id'] + '" title="Go To Profile">' + data1['result'][i]['patient_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['address'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left"><a href="<?= site_url('caregiver/view_profile') . '/' ?>' + data1['result'][i]['caregiver_user_id'] + '" title="Go To Profile">' + data1['result'][i]['caregiver_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['caregiver_user_id'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + schedule_date[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['caregiver_name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 6) {
                                urow[i] += '<td style="text-align: left"><a href="<?= site_url('patient/view_profile') . '/' ?>' + data1['result'][i]['patient_id'] + '" title="Go To Profile">' + data1['result'][i]['patient_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['address'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left"><a href="<?= site_url('caregiver/view_profile') . '/' ?>' + data1['result'][i]['caregiver_user_id'] + '" title="Go To Profile">' + data1['result'][i]['caregiver_name'] + '</a></td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['caregiver_user_id'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + schedule_date[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['caregiver_name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }

                            urow[i] += '</tr>';
                            $('#table_body').append(urow[i]);
                            // console.log(i);
                        }
                    }
                }
//                complete:function(data){
//                    // Hide image container
//                    $("#progress").hide();
//                }
            });
        }

        function check_time_input(get_time) {
            var get_time = get_time;
            get_time = get_time.split(':');
            if ((get_time[0] != '') && (get_time[1] != '') && (get_time[2] != '')) {
                return 1;
            }
            else {
                return 0;
            }
        }

        function setModal(p_id, c_id, s_date, start, end, schedule_maker, clockin, clockout) {
            // alert('no');
            var p_name = p_id;
            var c_name = c_id;
            var s_date = s_date;
            var start = start;
            var end = end;
            var schedule_maker = schedule_maker;
            // var clockin = clockin;
            var clockout = clockout;
            var clocking_time;
            var clockout_time;
            var clock_in = moment.unix(clockin / 1000).format('HH:mm:ss');
            var starting_time = moment.unix(start / 1000).format('HH:mm:ss');
            var ending_date = moment.unix(end / 1000).format('YYYY-MM-DD');
            var ending_time = moment.unix(end / 1000).format('HH:mm:ss');
            //console.log(clock_in);
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
            //document.getElementById('clocking_test').value = clock_in;
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
                // document.getElementById('clocking_test').value = clocking_time;
            }
            if (clockout == '') {
                document.getElementById('c_end_time').value = '';
                document.getElementById('c_end_time').disabled = false;
            }
            else {
                clockout_time = moment.unix(clockout / 1000).format('HH:mm:ss');
                document.getElementById('c_end_time').value = clockout_time;
                // document.getElementById('clocking_test').value = 2;
                document.getElementById('c_end_time').disabled = true;
            }
            $('#clockingModal').modal('show');
        }

        function get_date_millisecond(test_date, test_time) {
            var ms_date = test_date.split('-');
            var ms_day = ms_date[2];
            var ms_month = ms_date[1] - 1;
            var ms_year = ms_date[0];
            ms_date = new Date(ms_year + ' ' + ms_month + ' ' + ' ' + ms_day + ' ' + test_time);
            ms_date = ms_date.getTime();
            //console.log(ms_date);
            return ms_date;
        }

        function get_date_millisecond_new(test_date, test_time) {
            var ms_date = test_date.split('-');
            var ms_day = ms_date[2];
            var ms_month = ms_date[1];
            var ms_year = ms_date[0];
            ms_date = new Date(ms_year + ' ' + ms_month + ' ' + ' ' + ms_day + ' ' + test_time);
            ms_date = ms_date.getTime();
            //console.log(ms_date);
            return ms_date;
        }

        function check_clocking() {
            //alert('sfgsdjf');
            var clockin = $('#c_start_time').val();
            //  console.log(clockin);
            var clockout = $('#c_end_time').val();
            //  console.log(clockin);
            var s_date = $('#c_schedule_date').val();
            var e_date = $('#c_ending_date').val();
            var starting_date = get_date_millisecond(s_date, clockin);
            //console.log(clockin);
            var ending_date = get_date_millisecond(e_date, clockout);
            if (clockin == '') {
                //console.log('yes its blank');
                var x = document.getElementById('end_time_err');
                x.style.color = "red";
                x.innerHTML = "<strong>You Have To Clock In First</strong><br>";
                //  alert("You Have To Clock In First");
                //return false;
            }
            else if (ending_date < starting_date) {
                var x = document.getElementById('end_time_err');
                x.style.color = "red";
                x.innerHTML = "<strong>Ending Time Should Be Higher Than Starting Time</strong><br>";
            }
            else {
                document.getElementById('myBtn').disabled = false;
                var x = document.getElementById('end_time_err');
                x.style.color = "black";
                x.innerHTML = "";
            }
        }

        function check_clockout() {
            var clockin = $('#c_start_time').val();
            var clockout = $('#c_end_time').val();
            //  console.log(clockin);
            var s_date = $('#c_schedule_date').val();
            var e_date = $('#c_ending_date').val();
            var starting_date = get_date_millisecond(s_date, clockin);
            // console.log(clockin);
            var ending_date = get_date_millisecond(e_date, clockout);
            if (clockin == '') {
                // console.log('yes its blank');
                var x = document.getElementById('end_time_err');
                x.style.color = "red";
                x.innerHTML = "<strong>You Have To Clock In First</strong><br>";
                document.getElementById('myBtn').disabled = true;
            }
            if (ending_date < starting_date) {
                var x = document.getElementById('end_time_err');
                x.style.color = "red";
                x.innerHTML = "<strong>Ending Time Should Be Higher Than Starting Time</strong><br>";
                document.getElementById('myBtn').disabled = true;
            }
            else {
                document.getElementById('myBtn').disabled = false;
                var x = document.getElementById('end_time_err');
                x.style.color = "black";
                x.innerHTML = "";
            }
        }

        function check_values() {
            var clockin = $('#c_start_time').val();
            // console.log(clockin);
            var new_clockin = clockin.split(':');
            var clockout = $('#c_end_time').val();
            //  console.log(clockin);
            var prev_start_time = $('#schedule_maker_start_time').val();
            var prev_end_time = $('#schedule_maker_end_time').val();
            var test_prev = parseInt(prev_end_time) + 86400000;
            //  console.log(test_prev);
            // return false;
            var starting_date;
            var ending_date;
            var today = new Date();
            var cur_date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
            var s_date = $('#c_schedule_date').val();
            var e_date = $('#c_ending_date').val();
            if (clockin == '') {
                var y = document.getElementById('end_time_err');
                y.style.color = "red";
                y.innerHTML = "";
                var x = document.getElementById('start_time_err');
                x.style.color = "red";
                x.innerHTML = "<strong>You Have To Clock In First</strong><br>";
                //  alert('You Have To Clock In First!');
                return false;
            }
            if (clockin != '') {
                if (check_time_input(clockin) == 1) {
                    // console.log(get_date_millisecond_new(cur_date, clockin));
                    // return false;
                    //  return false;
                    // console.log(get_date_millisecond_new(cur_date, clockin));
                    // return false;
                    // console.log(get_date_millisecond_new(cur_date, clockin) + ' ' + (prev_start_time - 1800000));
                    // return false;
                    if (get_date_millisecond_new(cur_date, clockin) > (prev_start_time - 1800000)) {
                        starting_date = get_date_millisecond_new(cur_date, clockin);
                    }
                    else {
                        var x = document.getElementById('start_time_err');
                        x.style.color = "red";
                        x.innerHTML = "<strong>You Can Not Clock In Now!</strong><br>";
                        return false;
                    }
                }
                else {
                    var x = document.getElementById('start_time_err');
                    x.style.color = "red";
                    x.innerHTML = "<strong>Please Insert Hour/Minute/Second Correctly!</strong><br>";
                    return false;
                }
            }

            if (clockout != '') {
                if (check_time_input(clockout) == 1) {
                    // ending_date = get_date_millisecond(e_date, clockout);
                    // console.log((get_date_millisecond_new(cur_date, clockout)) + ' ' + (parseInt(prev_end_time) + 86400000));
                    // return false;
                    // if ((get_date_millisecond_new(cur_date, clockout) > prev_start_time) && (get_date_millisecond_new(cur_date, clockout) < (parseInt(prev_end_time) + 86400000))) {
                    //     ending_date = get_date_millisecond_new(cur_date, clockout);
                    // }
                    // else {
                    //     var x = document.getElementById('end_time_err');
                    //     x.style.color = "red";
                    //     x.innerHTML = "<strong>You Can Not Clock Out Now!</strong><br>";
                    //     return false;
                    // }
                    ending_date = get_date_millisecond_new(cur_date, clockout);
                } else {
                    var y = document.getElementById('end_time_err');
                    y.style.color = "red";
                    y.innerHTML = "<strong>Please Insert Hour/Minute/Second Correctly!</strong><br>";
                    return false;
                }
            }
            else {
                return true;
            }
        }

        function get_events(val) {
            // alert(val);
            var cg_temp = document.getElementById('caregiver_id');
            var cg_id = cg_temp.options[cg_temp.selectedIndex].value;
            // alert(cg_id);
            if (cg_id == '') {
                alert('Kindly Select A Caregiver First!');
            }
            else {
                var temp_data = $('#month_select_id').val();
                var split_data = temp_data.split('-');
                fetch_data(cg_id, split_data[0], split_data[1]);
            }
            // var temp_data = $('#s_month').val();
            // var split_data = temp_data.split('-');
            //alert(split_data[0]);
            //fetch_data(cg_id, split_data[0], split_data[1]);
        }

        function fetch_data(cg_id, year_id, month_id) {
            var get_year_id = year_id;
            var get_month_id = month_id;
            //alert('ok');
            //console.log(get_year_id +' '+get_month_id);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("get_caregiver_wise_events");?>',
                data: {
                    caregiver_id: cg_id,
                    year_id: get_year_id,
                    month_id: get_month_id
                },
                success: function (data) {
                    //alert(data);
                    // $("#filter_table").html(data);
                    $('#table_data').html(data);
                }
            });
            //alert(get_month);
        }
    </script>
</div>