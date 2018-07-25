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
                "bStateSave": false,
                "bLengthChange": false,
                "responsive": true,
            });
            // Initalize Select Dropdown after DataTables is created
            $table1.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });
        });
    </script>
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/datatables/datatables.css">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        Consultant Event List<br>
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
        <div class="row">
            <div class="col-md-2" style="margin-left: 20%">
                <label for="">Select Consultant</label>
            </div>
            <div class="col-md-4">
                <select name="consultant_user_id" id="consultant_user_id" class="select2"
                        data-allow-clear="true" data-placeholder="Select A Consultant...">
                    <option></option>
                    <?php if ($consultants) { ?>
                        <?php foreach ($consultants as $row) { ?>
                            <option value="<?= $row->consultant_user_id ?>"><?= $row->name ?></option>
                        <?php }
                    } ?>
                </select>
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <div style="float: left"><h3>Consultant Events</h3></div>
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
                       style="margin-top: 5%; margin-left: 10%; font-size: 90%">Please Select A Consultant From The
                        Drop-down Menu Above</p>
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
    <script src="<?php echo base_url() ?>asset/admin/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $('#month_select_id').datepicker({
            minViewMode: 'months',
            format: 'yyyy-mm'
        });
        $('#consultant_user_id').on("change", function () {
            var consultant = $(this).val();
            var today = new Date();
            var get_year = today.getFullYear();
            var get_month = today.getMonth() + 1;
            //alert(consultant+' '+get_year+' '+get_month);
            fetch_data(consultant, get_year, get_month);
            //$.ajax({
            //    type: 'POST',
            //    url: '<?php //echo site_url('get_consultant_wise_events'); ?>//',
            //    data: {
            //        consultant_user_id: consultant,
            //        year_id: get_year,
            //        month_id: get_month
            //    },
            //    success: function (data) {
            //        $('#table_data').html(data);
            //    }
            //});
        });
        function get_events(val) {
            // alert(val);
            var consultant_temp = document.getElementById('consultant_user_id');
            var consultant_id = consultant_temp.options[consultant_temp.selectedIndex].value;
            // alert(cg_id);
            if (consultant_id == '') {
                alert('Kindly Select A Consultant First!');
            }
            else {
                var temp_data = $('#month_select_id').val();
                var split_data = temp_data.split('-');
                fetch_data(consultant_id, split_data[0], split_data[1]);
            }
            // var temp_data = $('#s_month').val();
            // var split_data = temp_data.split('-');
            //alert(split_data[0]);
            //fetch_data(cg_id, split_data[0], split_data[1]);
        }
        function fetch_data(consultant_id, year_id, month_id) {
            //alert(consultant_id+' '+year_id+' '+month_id);
            var get_year_id = year_id;
            var get_month_id = month_id;
            //alert('ok');
            //console.log(get_year_id +' '+get_month_id);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("get_consultant_wise_events");?>',
                data: {
                    consultant_user_id: consultant_id,
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
            $('#table_body tr').remove();
            // console.log(id);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("schedule/get_selected_consultant_schedule");?>',
                data: {
                    'consultant_id': id
                },
                success: function (data) {
                    // alert(data);
                    var i;
                    var data1 = $.parseJSON(data);
                     //console.log("test length"+data1['result'].length);
                    if (data1['result'].length == '0') {
                        urow = '<tr>'
                            + '<td style="text-align: center; color: red" colspan="9"><strong>No Schedules Found!</strong></i></td>'
                            + '</tr>';
                        $('#table_body').append(urow);
                    }
                    else {
                        for (i = 0; i < data1['result'].length; i++) {
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
                            console.log("test "+ new_time[i]);
                            urow[i] = '<tr>'
                            if (new_time[i] == 0) {
                                urow[i] += '<td style="text-align: left">' + data1['result'][i]['patient_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['name'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + st_time[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" style="background-color: #0c455d; color: white" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 1) {
                                urow[i] += '<td style="text-align: left">' + data1['result'][i]['patient_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['name'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + st_time[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" style="background-color: #0c455d; color: white" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 2) {
                                urow[i] += '<td style="text-align: left">' + data1['result'][i]['patient_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['name'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + st_time[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" style="background-color: #0c455d; color: white" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 3) {
                                urow[i] += '<td style="text-align: left">' + data1['result'][i]['patient_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['name'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + st_time[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" style="background-color: #0c455d; color: white" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 4) {
                                // console.log('this'+ i);
                                urow[i] += '<td style="text-align: left">' + data1['result'][i]['patient_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['name'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + st_time[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" style="background-color: #0c455d; color: white" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 5) {
                                urow[i] += '<td style="text-align: left">' + data1['result'][i]['patient_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['name'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + st_time[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" style="background-color: #0c455d; color: white" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }
                            if (new_time[i] == 6) {
                                urow[i] += '<td style="text-align: left">' + data1['result'][i]['patient_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['level_name'] + '</td>'
                                    + '<td style="text-align: left">' + data1['result'][i]['name'] + '</td>'
                                    + '<td style="text-align: left"><span title="' + s_time[i] + '">' + st_time[i] + '</span></td>'
                                    + '<td style="text-align: left">' + s_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_e_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockin_time[i] + '</td>'
                                    + '<td style="text-align: left">' + f_clockout_time[i] + '</td>'
                                    + '<td style="text-align: right">' + '<button class="btn btn-primary" style="background-color: #0c455d; color: white" onclick="setModal(\'' + data1['result'][i]['patient_name'] + '\',\'' + data1['result'][i]['name'] + '\', \'' + data1['result'][i]['schedule_date'] + '\', \'' + data1['result'][i]['start_time'] + '\', \'' + data1['result'][i]['end_time'] + '\', \'' + data1['result'][i]['schedule_maker_id'] + '\', \'' + data1['result'][i]['clock_in_time'] + '\', \'' + data1['result'][i]['clock_out_time'] + '\')"><span class="glyphicon glyphicon-time" title="Clock In/Clock Out"></span></button>' + '</td>'
                            }

                            urow[i] += '</tr>';
                            $('#table_body').append(urow[i]);
                            // console.log(i);
                        }
                    }
                }
            });
        }
        function check_time_input(get_time) {
            var get_time = get_time;
            get_time = get_time.split(':');
            console.log(get_time);
            if((get_time[0] != '') && (get_time[1] != '') && (get_time[2] != ''))
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        function setModal(p_id, c_id, s_date, start, end, schedule_maker, clockin, clockout) {
            var schedule_start = start;
            var schedule_end = end;
            var clock_start = clockin;
            var p_name = p_id;
            var c_name = c_id;
            var s_date = s_date;
            var start = start;
            var end = end;
            var schedule_maker = schedule_maker;
            var clockin = clockin;
            var clockout = clockout;
            var clocking_time;
            var clockout_time;
            var clock_in = moment.unix(clockin / 1000).format('HH:mm:ss');
            var starting_time = moment.unix(start / 1000).format('HH:mm:ss');
            var ending_date = moment.unix(end / 1000).format('YYYY-MM-DD');
            var ending_time = moment.unix(end / 1000).format('HH:mm:ss');
          //  console.log(ending_time);
            document.getElementById('c_name').value = c_name;
            document.getElementById('p_name').value = p_name;
            document.getElementById('c_patient_id').value = p_id;
            document.getElementById('c_consultant_id').value = c_id;
            document.getElementById('c_schedule_date').value = s_date;
            document.getElementById('c_ending_date').value = ending_date;
            document.getElementById('c_s_time').value = starting_time;
            document.getElementById('c_e_time').value = ending_time;
            document.getElementById('schedule_maker_id').value = schedule_maker;
            document.getElementById('schedule_maker_start_time').value = schedule_start;
            document.getElementById('schedule_maker_end_time').value = schedule_end;
            document.getElementById('clocking_start').value = clock_start;
            document.getElementById('clocking_test').value = clock_in;
            if (clockin == 'null') {
                //  console.log('yes');
                document.getElementById('c_start_time').value = '';
                document.getElementById('c_start_time').disabled = false;
            }
            else {
                clocking_time = moment.unix(clockin / 1000).format('HH:mm:ss');
                document.getElementById('c_start_time').value = clocking_time;
                document.getElementById('c_start_time').disabled = true;
                document.getElementById('clocking_test').value = clocking_time;
            }
            if(clockout == 'null')
            {
                document.getElementById('c_end_time').disabled = false;
            }
            else
            {
                clockout_time = moment.unix(clockout / 1000).format('HH:mm:ss');
                document.getElementById('c_end_time').value = clockout_time;
                document.getElementById('c_end_time').disabled = true;
            }
            //  console.log(clocking_time);
            // document.getElementById('c_start_time').value = s_date;
            //  document.getElementById('c_end_time').value = s_date;
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
            //  console.log(clockout);
            var s_date = $('#c_schedule_date').val();
            var e_date = $('#c_ending_date').val();
            var starting_date = get_date_millisecond(s_date, clockin);
            console.log(clockin);
            var ending_date = get_date_millisecond(e_date, clockout);
            if (clockin == '') {
                console.log('yes its blank');
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
            console.log(clockin);
            var ending_date = get_date_millisecond(e_date, clockout);
            if (clockin == '') {
                console.log('yes its blank');
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
           //   console.log(clockin);
            var new_clockin = clockin.split(':');
            var clockout = $('#c_end_time').val();
            var schedule_start = $('#schedule_maker_start_time').val();
            var schedule_end = $('#schedule_maker_end_time').val();
            //  console.log('Start' + schedule_start);
           //   console.log('End' + schedule_end);
            var today = new Date();
            var cur_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            //return false;
            var starting_date;
            var ending_date;
            var s_date = $('#c_schedule_date').val();
            var e_date = $('#c_ending_date').val();
            //console.log(new_clockin);
           // return false;
            if(clockin == '')
            {
                var y = document.getElementById('end_time_err');
                y.style.color = "red";
                y.innerHTML = "";
                var x = document.getElementById('start_time_err');
                x.style.color = "red";
                x.innerHTML = "<strong>You Have To Clock In First</strong><br>";
                //  alert('You Have To Clock In First!');
                return false;
            }

            else if(check_time_input(clockin) == 1)
            {

               // console.log(get_date_millisecond_new(cur_date, clockin) +' '+(schedule_start - 1800000));
                //return false;
                if(get_date_millisecond_new(cur_date, clockin) > (schedule_start - 1800000))
                {
                    starting_date = get_date_millisecond_new(s_date, clockin);
                }
                else{
                    var x = document.getElementById('start_time_err');
                    x.style.color = "red";
                    x.innerHTML = "<strong>You Can Not Clock In Now!</strong><br>";
                    return false;
                }
               // return false;
            }
            else
            {
                var x = document.getElementById('start_time_err');
                x.style.color = "red";
                x.innerHTML = "<strong>Please Insert Hour/Minute/Second Correctly!</strong><br>";
                return false;
            }
           // console.log(check_time_input(clockout));
            if(clockout != '')
            {
                if(check_time_input(clockout) == 1)
                {
                   // console.log((get_date_millisecond_new(cur_date, clockout)) +' '+(parseInt(schedule_start) + 86400000));
                   // return false;
                    if((get_date_millisecond_new(cur_date, clockout) > schedule_start) && (get_date_millisecond_new(cur_date, clockout) < (parseInt(schedule_start) + 86400000)))
                    {
                        ending_date = get_date_millisecond_new(cur_date, clockout);
                    }
                    else{
                        var x = document.getElementById('end_time_err');
                        x.style.color = "red";
                        x.innerHTML = "<strong>You Can Not Clock Out Now!</strong><br>";
                        return false;
                    }
                }
                else
                {
                    var y = document.getElementById('end_time_err');
                    y.style.color = "red";
                    y.innerHTML = "<strong>Please Insert Hour/Minute/Second Correctly!</strong><br>";
                    return false;
                }
            }
            else
            {
                return true;
            }
        }
    </script>
</div>