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
                "bStateSave": true,
                "responsive": true
            });

            // Initalize Select Dropdown after DataTables is created
            $table1.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });
        });
    </script>
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/datatables/datatables.css">
    <style>
        .clsDatePicker {
            /*z-index: 100000;*/
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title">
                        New Patient Schedule<br>
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
        <div class="col-md-3">
            <div class="panel panel-gradient" data-collapsed="0">
                <div class="panel-body">
                    <div>
                        <a href="#" class="profile-picture">
                            <?php if($patient_info->picture != null){ ?>
                            <img style="height: 100px;width: 100px"
                                 src="<?php $img = filemtime($patient_info->picture);
                                 echo site_url($patient_info->picture."?".$img);
                                 ?>"
                                 class="center-block img-circle"/>
                            <?php }else{ ?>
                            <img style="height: 100px;width: 100px"
                                 src="<?= base_url() ?>uploads/patient_image/no_image.jpg"
                                 class="center-block img-circle"/>
                            <?php } ?>
                        </a>

                    </div>

                    <div>
                        <hr>
                        <ul class="profile-info-sections list-unstyled">
                            <li>
                                <div class="profile-name">
                                    <span><strong><a href="#"><?= $patient_info->patient_name ?></a></strong></span><br>
                                    <span><a href="#"><?= $patient_info->patient_id ?></a></span><br>
                                    <span><a href="#"><?= $patient_info->level_name ?></a></span><br>
                                    <hr>
                                                <span><a
                                                        href="#"><?= 'Joined On ' . $j_date = date("F Y", strtotime($patient_info->joining_date)); ?></a></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="choose_date" class="control-label">Choose A
                            Date</label>

                        <div class="input-group">
                            <input type="text" class="form-control datepicker"
                                   id="s_date" name="s_date" readonly data-validate="required"
                            >
                            <div class="input-group-addon">
                                <a href="#"><i class="entypo-calendar"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table table-bordered table-responsive" id="">
                            <thead>
                            <tr>
                                <th style="background-color: #303641;color: white">Consultant Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!isset($consultant_list)) { ?>
                                <tr>
                                    <td colspan="6"
                                        style="text-align: center">No Consultants
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <?php foreach ($consultant_list as $row) { ?>
                                    <tr>
                                        <td colspan="6"
                                            style="text-align: center"><a href="" data-toggle="modal"
                                                                          id="add_modal_date"
                                                                          onclick="show_modal('<?php echo $row->name; ?>','<?php echo $row->consultant_user_id; ?>')"
                                            >
                                                <?= $row->name ?><i class="fa fa-arrow-right"></i></a>
                                        </td>
                                    </tr>
                                    <input type="hidden" id="for_schedule_date" name="for_schedule_date"
                                           value="<?= $row->consultant_user_id ?>">
                                    <input type="hidden" id="for_consultant" name="for_consultant"
                                           value="<?= $row->name ?>">
                                    <div id="addModal_<?= $row->consultant_user_id ?>" class="modal fade"
                                         role="dialog" tabindex="-1">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <form action="<?= site_url('schedule/con_schedule_add_post') ?>"
                                                  method="post" onsubmit="return check_timing()">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="patient_name" class="control-label">Patient
                                                                        Name</label>

                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                               id="patient_name"
                                                                               value="<?= $patient_info->patient_name ?>"
                                                                               name="patient_name" readonly
                                                                               data-validate="required"
                                                                        >
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="caregiver_name"
                                                                           class="control-label">Consultant
                                                                        Name</label>

                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control"
                                                                               id="consultant_name"
                                                                               name="consultant_name" readonly
                                                                               data-validate="required"
                                                                        >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="tmp_today" id="tmp_today"
                                                               value="<?= date('Y-m-d'); ?>">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="schedule_date" class="control-label">Starting
                                                                        Date</label>

                                                                    <div class="input-group" style="width: 65%">
                                                                        <input type="text" class="form-control"
                                                                               id="schedule_date"
                                                                               name="schedule_date" readonly
                                                                               data-validate="required"
                                                                        >

                                                                        <div class="input-group-addon">
                                                                            <a href="#"><i
                                                                                    class="entypo-calendar"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="start_time" style="margin-right: 5%"
                                                                           class="timepicontrol-label">Starting
                                                                        Time<span
                                                                            style="color: red">*</span></label>

                                                                    <div class="col-sm-8">
                                                                        <div class="input-group">
                                                                            <input type="text" id="start_time"

                                                                                   name="start_time" readonly
                                                                                   class="form-control timepicker"
                                                                                   data-default-time="10:00:00"
                                                                                   data-template="dropdown"
                                                                                   data-show-seconds="true"
                                                                                   data-show-meridian="false"
                                                                                   data-minute-step="5"
                                                                                   data-second-step="5"/>
                                                                            <!--                                                                                <input type="time" id="s_time" name="s_time">-->
                                                                            <div class="input-group-addon">
                                                                                <a href="#"><i
                                                                                        class="entypo-clock"></i></a>
                                                                            </div>
                                                                        </div>
                                                                        <span id="start_time_err"
                                                                              name="start_time_err"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="patient_id" name="patient_id"
                                                               value="<?= $patient_info->patient_id ?>">
                                                        <input type="hidden" id="consultant_id" name="consultant_id"
                                                        >
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ending_date" class="control-label">Ending
                                                                        Date</label>

                                                                    <div class="input-group" style="width: 65%">
                                                                        <input type="date" class="form-control"
                                                                               min="<?= date("Y/m/d"); ?>"
                                                                               id="ending_date" name="ending_date">
                                                                    </div>
                                                                    <span id="e_date_err" name="e_date_err"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="end_time" style="margin-right: 6%"
                                                                           class="timepicontrol-label">Ending
                                                                        Time<span
                                                                            style="color: red">*</span></label>

                                                                    <div class="col-sm-8">
                                                                        <div class="input-group">
                                                                            <input type="text" id="end_time"
                                                                                   name="end_time" readonly
                                                                                   class="form-control timepicker"
                                                                                   data-template="dropdown"
                                                                                   data-show-seconds="true"
                                                                                   data-default-time="14:00:00"
                                                                                   data-show-meridian="false"
                                                                                   data-minute-step="5"
                                                                                   data-second-step="5"/>
                                                                            <!--                                                                                <input type="time" id="s_time" name="s_time">-->
                                                                            <div class="input-group-addon">
                                                                                <a href="#"><i
                                                                                        class="entypo-clock"></i></a>
                                                                            </div>
                                                                        </div>
                                                                        <span id="end_time_err"
                                                                              name="end_time_err"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Yes</button>
                                                        <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">No
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-gradient" data-collapsed="0">
                <div class="panel-body">
                    <div class="form-group">
                        <h3>Schedules</h3>
                        <table class="table table-bordered table-responsive datatable" width="100%" id="table-1">
                            <thead>
                            <tr>
                                <th style="background-color: #303641;color: white">Consultant Name</th>
                                <th style="background-color: #303641;color: white">ID</th>
                                <th style="background-color: #303641;color: white">Date</th>
                                <th style="background-color: #303641;color: white">Starting Time</th>
                                <th style="background-color: #303641;color: white">Ending Time</th>
                                <th style="background-color: #303641;color: white">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!isset($schedules)) { ?>
                                <tr>
                                    <td colspan="6"
                                        style="text-align: center">No Schedules
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <?php foreach ($schedules as $row) { ?>
                                    <tr>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['consultant_user_id'] ?></td>
                                        <td><?= $row['schedule_date'] ?></td>
                                        <td><?php $st = $row['start_time'];
                                            $st = ($st / 1000);
                                            date_default_timezone_set('Asia/Dhaka');
                                            echo date('h:i A', $st); ?></td>
                                        <td><?php $et = $row['end_time'];
                                            $et = ($et / 1000);
                                            date_default_timezone_set('Asia/Dhaka');
                                            echo date('h:i A', $et); ?></td>


                                        <td><a href="" id="edit_modal"
                                               onclick="edit_modal_show(<?= $row['consultant_patient_schedule_id'] ?>)"
                                               data-toggle="modal"
                                               data-target="editModal_<?= $row['consultant_patient_schedule_id'] ?>">
                                                <span data-toggle="tooltip" data-placement="top" title="Edit"
                                                      class="glyphicon glyphicon-edit"></span>
                                            </a>&nbsp;
                                            <a data-toggle="modal"
                                               data-target="#deleteModal_<?= $row['consultant_patient_schedule_id'] ?>"
                                            <span data-toggle="tooltip" data-placement="top" title="Delete"
                                                  style="color: red" class="glyphicon glyphicon-trash"></span></a>
                                            <div id="editModal_<?= $row['consultant_patient_schedule_id'] ?>"
                                                 class="modal fade"
                                                 role="dialog" tabindex="-1">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <form action="<?= base_url() ?>Schedule/con_schedule_edit_post"
                                                          method="post" onsubmit="return edit_modal_time()">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="patient_name"
                                                                                   class="control-label">Patient
                                                                                Name</label>

                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control"
                                                                                       id="e_patient_name"
                                                                                       value="<?= $row['patient_name'] ?>"
                                                                                       name="e_patient_name" readonly
                                                                                       data-validate="required"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="caregiver_name"
                                                                                   class="control-label">Consultant
                                                                                Name</label>

                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control"
                                                                                       id="e_caregiver_name"
                                                                                       value="<?= $row['name'] ?>"
                                                                                       name="e_caregiver_name" readonly
                                                                                       data-validate="required"
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="starting_date"
                                                                                   class="control-label">Starting
                                                                                Date</label>

                                                                            <div class="input-group" style="width: 65%">
                                                                                <input type="date" class="form-control"
                                                                                       value="<?= $row['schedule_date'] ?>"
                                                                                       id="e_starting_date"
                                                                                       min="<?= $row['schedule_date'] ?>"
                                                                                       name="e_starting_date"
                                                                                       onchange="edit_modal_check()">
                                                                            </div>
                                                                            <span id="e_s_err" name="e_s_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="tmp" id="tmp"
                                                                           value="<?= $row['schedule_date'] ?>">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="start_time"
                                                                                   style="margin-right: 6%"
                                                                                   class="timepicontrol-label">Starting
                                                                                Time<span
                                                                                    style="color: red">*</span></label>

                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" id="e_start_time"
                                                                                           name="e_start_time" readonly
                                                                                           class="form-control timepicker"
                                                                                           data-template="dropdown"
                                                                                           data-show-seconds="true"
                                                                                           data-default-time="<?php $st = $row['start_time'];
                                                                                           $st = floor($st / 1000);
                                                                                           date_default_timezone_set('Asia/Dhaka');
                                                                                           echo date('h:i:s A', $st); ?>"
                                                                                           data-show-meridian="false"
                                                                                           data-minute-step="5"
                                                                                           data-second-step="5"/>
                                                                                    <!--                                                                                <input type="time" id="s_time" name="s_time">-->
                                                                                    <div class="input-group-addon">
                                                                                        <a href="#"><i
                                                                                                class="entypo-clock"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                                <span id="e_st_err"
                                                                                      name="e_st_err"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" id="schedule_maker_id"
                                                                       name="schedule_maker_id"
                                                                       value="<?= $row['schedule_maker_id'] ?>">
                                                                <input type="hidden" id="caregiver_patient_schedule"
                                                                       name="caregiver_patient_schedule"
                                                                       value="<?= $row['consultant_patient_schedule_id'] ?>">
                                                                <input type="hidden" name="e_patient_id"
                                                                       value="<?= $row['tbl_patient_user_patient_id'] ?>">
                                                                <input type="hidden" name="e_caregiver_id"
                                                                       value="<?= $row['consultant_user_id'] ?>">
                                                                <input type="hidden" name="s_start" id="s_start"
                                                                       value="<?= $row['start_time'] ?>">
                                                                <input type="hidden" name="s_end" id="s_end"
                                                                       value="<?= $row['end_time'] ?>">
                                                                <input type="hidden" name="s_id" id="s_id"
                                                                       value="<?= $row['consultant_patient_schedule_id'] ?>">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="ending_date"
                                                                                   class="control-label">Ending
                                                                                Date</label>

                                                                            <div class="input-group" style="width: 65%">
                                                                                <input type="date" class="form-control"
                                                                                       min="<?= $row['schedule_date']; ?>"
                                                                                       id="e_ending_date"
                                                                                       value="<?= $row['schedule_date'] ?>"
                                                                                       name="e_ending_date"
                                                                                >
                                                                            </div>
                                                                            <span id="e_e_err" name="e_e_err"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="end_time"
                                                                                   style="margin-right: 6%"
                                                                                   class="timepicontrol-label">Ending
                                                                                Time<span
                                                                                    style="color: red">*</span></label>

                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="text" id="e_end_time"
                                                                                           name="e_end_time" readonly
                                                                                           class="form-control timepicker"
                                                                                           data-template="dropdown"
                                                                                           data-show-seconds="true"
                                                                                           data-default-time="<?php $st = $row['end_time'];
                                                                                           $st = floor($st / 1000);
                                                                                           date_default_timezone_set('Asia/Dhaka');
                                                                                           echo date('h:i:s A', $st); ?>"
                                                                                           data-show-meridian="false"
                                                                                           data-minute-step="5"
                                                                                           data-second-step="5"/>
                                                                                    <!--                                                                                <input type="time" id="s_time" name="s_time">-->
                                                                                    <div class="input-group-addon">
                                                                                        <a href="#"><i
                                                                                                class="entypo-clock"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                                <span id="e_end_err"
                                                                                      name="e_end_err"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Submit
                                                                </button>
                                                                <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Cancel
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div id="deleteModal_<?= $row['consultant_patient_schedule_id'] ?>"
                                                 class="modal fade"
                                                 role="dialog" tabindex="-1">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <form action="<?= base_url() ?>Schedule/con_schedule_delete"
                                                          method="post" onsubmit="return edit_modal_time()">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" style="text-align: center">Delete Consultant Schedule</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h3 style="color: red; text-align: center">Are You Sure?</h3>
                                                                <input type="hidden" id="d_schedule_id" name="d_schedule_id" value="<?= $row['consultant_patient_schedule_id'] ?>">
                                                                <input type="hidden" id="d_schedule_maker" name="d_schedule_maker" value="<?= $row['schedule_maker_id'] ?>">
                                                                <input type="hidden" id="d_patient_id" name="d_patient_id" value="<?= $row['patient_id'] ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Yes
                                                                </button>
                                                                <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">No
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
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
    <script src="<?php echo base_url() ?>asset/admin/js/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript">
        function get_date_millisecond(test_date, test_time) {
            var ms_date = test_date.split('/');
            var ms_day = ms_date[1];
            var ms_month = ms_date[0];
            var ms_year = ms_date[2];
            ms_date = new Date(ms_year + ' ' + ms_month + ' ' + ' ' + ms_day + ' ' + test_time);
            ms_date = ms_date.getTime();
            return ms_date;
        }

        function get_edit_millisecond(test_date, test_time) {
            var ms_date = test_date.split('-');
            var ms_day = ms_date[2];
            var ms_month = ms_date[1];
            var ms_year = ms_date[0];
            ms_date = new Date(ms_year + ' ' + ms_month + ' ' + ' ' + ms_day + ' ' + test_time);
            ms_date = ms_date.getTime();
            return ms_date;
        }

        function show_modal(name, id) {
            //  var selected_date = $('#s_date').val();
           // alert(id);
            var selected_date = $('#for_schedule_date').val();
            var consultant_name = $('#for_consultant').val();
            var set_schedule_date = $('#s_date').val();
            // console.log(id);
            var set_min_date = set_schedule_date.split('/');
            set_min_date = set_min_date[2] + '-' + set_min_date[0] + '-' + set_min_date[1];
            var e = set_schedule_date.split('/');
            var e_day = e[1];
            var e_month = e[0] - 1;
            var e_year = e[2];
            var maxDate = new Date(e_year, e_month, e_day);
            maxDate = maxDate.getTime();
            maxDate = maxDate + 86400000;
            //   console.log(maxDate);
            var set_ending_date = $('#s_date').val();
            set_ending_date = set_ending_date.split('/');
            set_ending_date = set_ending_date[2]+'-'+set_ending_date[0]+'-'+set_ending_date[1];
            maxDate = moment.unix(maxDate / 1000).format("YYYY-MM-DD");
            $('#ending_date').attr('min', set_min_date);
            $('#ending_date').attr('max', maxDate);
            //  console.log(maxDate);
            document.getElementById('schedule_date').value = set_schedule_date;
            document.getElementById('consultant_name').value = name;
            document.getElementById('consultant_id').value = id;
            document.getElementById('ending_date').value = set_ending_date;
            $('#addModal_' + selected_date + '').modal('show');
        }

        $(document).ready(function () {
            // var d = new Date();
            var d = $('#tmp_today').val();
            d = d.split('-');
            var d_day = d[2];
            var d_month = d[1] - 1;
            var d_year = d[0];
            var d_date = new Date(d_year, d_month, d_day);
            var day_id = d_date.getDay();
            // console.log(day_id);
            $("#s_date").datepicker();
            $("#s_date").datepicker("setDate", new Date());
            var e = $('#s_date').val();
            e = e.split('/');
            var e_day = e[1];
            var e_month = e[0] - 1;
            var e_year = e[2];
            var maxDate = new Date(e_year, e_month, e_day);
            maxDate = maxDate.getTime();
            maxDate = maxDate + 86400000;
            maxDate = moment.unix(maxDate / 1000).format("YYYY-MM-DD");
            $('#ending_date').attr('max', maxDate);
            var patient_name = $('#patient').val();
            var patient = $('#patient_name_old').val();
        });

        function check_timing() {
            var check=0;
            var consultant_id = $('#consultant_id').val();
           // alert(consultant_id);
            var starting_date = $('#schedule_date').val();
            var starting_time = $('#start_time').val();
            var start_time = get_date_millisecond(starting_date, starting_time);
            var con_ending_date = $('#ending_date').val();
            var ending_date = con_ending_date.split('-');
            ending_date = ending_date[1] + '/' + ending_date[2] + '/' + ending_date[0];
            var ending_time = $('#end_time').val();
            var end_time = get_date_millisecond(ending_date, ending_time);
           console.log(start_time+' '+end_time);
          //  return false;
            //   var response = 0;
            if(end_time < start_time) {
                var x = document.getElementById('end_time_err');
                x.style.color = "red";
                x.innerHTML = "<strong>Ending Time Should Be Higher Than Starting Time!</strong><br>";
                return false;
            }
            else {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url("schedule/check_con_timing"); ?>',
                    data: {
                        'consultant': consultant_id,
                        'start_time': start_time,
                        'end_time': end_time
                    },
                    success: function (data) {
                       // alert("return: " + data);
                        if (data == 1) {
                           // alert("if condition: " + data);
                            check=0;
                            //alert("check value: " + check);
                            document.getElementById('end_time_err').innerHTML = "";
                            var x = document.getElementById('end_time_err');
                            x.style.color = "red";
                            x.innerHTML = "<strong>Consultant is not available. Please select another time.</strong><br>";
                        }
                        else {
                            check=1;
                        }
                    },
                    async: false
                });
                if (check == 0) {
                   // alert("if check: " + check);
                    return false;
                }
                else {
                   // alert("else check: " + check);
                    var x = document.getElementById('end_time_err');
                    x.style.color = "red";
                    x.innerHTML = "";
                    return true;
                }
            }

        }

        function edit_modal_show(id) {
          //  console.log('hghgh');
            var start = $('#tmp').val();
            var end = $('#s_end').val();
            var id = id;
            start = start.split('-');
            var start_day = start[2];
            var start_month = start[1] - 1;
            var start_year = start[0];
            var start_date = new Date(start_year, start_month, start_day);
            start_date = start_date.getTime();
            start_date = start_date + 864000000;
            start_date = moment.unix(start_date / 1000).format("YYYY-MM-DD");
            console.log(start_date);
            $('#e_starting_date').attr('max', start_date);
            $('#editModal_' + id + '').modal('show');

        }

        function edit_modal_check() {
            var d = $('#e_starting_date').val();
            d = d.split('-');
            var d_day = d[2];
            var d_month = d[1] - 1;
            var d_year = d[0];
            var d_date = new Date(d_year, d_month, d_day);
            var tmp_date = d_date.getTime();
            var ds_date = tmp_date + 950400000; // 1 day = 86400000 milliseconds
            ds_date = moment.unix(ds_date / 1000).format("YYYY-MM-DD");
            var tds = moment.unix(tmp_date / 1000).format("YYYY-MM-DD");
            // console.log(ds_date);
            $('#e_ending_date').attr('min', tds);
            $('#e_ending_date').attr('max', ds_date);
        }

        function edit_modal_time() {
            var schedule_date = $('#e_starting_date').val();
            var schedule_time = $('#e_start_time').val();
            var ending_date = $('#e_ending_date').val();
            var ending_time = $('#e_end_time').val();
           // console.log(schedule_date);
           // return false;
            var starting_time = get_edit_millisecond(schedule_date, schedule_time);
            var ending_time = get_edit_millisecond(ending_date, ending_time);
          //  console.log(ending_time);
          //  return false;
            if (ending_time < starting_time) {
                var x = document.getElementById('e_end_err');
                x.style.color = "red";
                x.innerHTML = "<strong>Ending Time Should Be Higher Than Starting Time</strong><br>";
                return false;
            }
            else {
                return true;
            }
        }
    </script>
</div>

<!--//data-target="#addModal_--><? //= $row->consultant_user_id ?><!--"-->