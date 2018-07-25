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
                "bStateSave": true
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
                        Patient Info<br>
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true"><?= $this->session->flashdata('msg'); ?>&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="profile-env">
            <div class="col-md-3">

                <div class="panel panel-gradient" data-collapsed="0">
                    <div class="panel-body">
                        <div>
                            <a href="#" class="profile-picture">
                                <?php if($patient_info[0]->picture != null){ ?>
                                <img style="height: 120px;width: 120px"
                                     src="<?php $img = filemtime($patient_info[0]->picture);
                                     echo site_url($patient_info[0]->picture."?".$img);
                                     ?>"
                                     class="center-block img-circle"/>
                                <?php }else{ ?>
                                    <img style="height: 120px;width: 120px"
                                         src="<?= base_url()?>uploads/patient_image/no_image.jpg"
                                         class="center-block img-circle"/>
                                <?php } ?>
                            </a>

                        </div>

                        <div>
                            <hr>
                            <ul class="profile-info-sections list-unstyled">
                                <li>
                                    <div class="profile-name">
                                        <strong>
                                            <a href="#"><?= $patient_info[0]->patient_name ?></a>
                                        </strong><br>
                                        <span><a
                                                href="#"><?= $patient_info[0]->patient_id; ?></a></span><br>
                                        <span><a
                                                href="#"><?= $patient_info[0]->level_name; ?></a></span><br>
                                        <span><a
                                                href="#"><?= 'Joined On ' . $j_date = date("F, Y", strtotime($patient_info[0]->joining_date)); ?></a></span>
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
                                    <?= $patient_info[0]->address ?>
                                </a>
                            </li>
                            <br>
                            <li>
                                <a href="#">
                                    <i class="entypo-mobile"></i>
                                    <?= $patient_info[0]->phone_number ?>
                                </a>
                            </li>
                            <br>
                            <li>
                                <a href="#">
                                    <i class="entypo-users"></i>
                                    <?= $e_contact[0]->family_contact_name.'('.$e_contact[0]->phone_number.')' ?>
                                </a>
                            </li>
                            <br>
                            <li>
                                <a href="#">
                                    <i class="entypo-calendar"></i>
                                    <?= $b_day = date('d F, Y', strtotime($patient_info[0]->DOB)); ?>
                                </a>
                            </li>
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
                                    <li><a data-toggle="tab" href="#history">Medical History</a></li>
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
                                                    <p class="col-sm-3"><?= $patient_info[0]->patient_name ?></p>
                                                </div>
                                                <input type="hidden" name="p_name" id="p_name" value="<?= $patient_info[0]->patient_name ?>">
                                                <div class="col-md-10">
                                                    <span for="patient_id" class="col-sm-3">ID</span>
                                                    <p class="col-sm-3"><?= $patient_info[0]->patient_id ?></p>
                                                </div>
                                                <input type="hidden" id="get_patient" name="get_patient"
                                                       value="<?= $patient_info[0]->patient_id ?>">
                                                <div class="col-md-10">
                                                    <span for="patient_nid" class="col-sm-3">National ID</span>
                                                    <p class="col-sm-3"><?php if($patient_info[0]->NID_number){echo $patient_info[0]->NID_number;}else{echo 'N/A';} ?></p>
                                                </div>
                                                <div class="col-md-10">
                                                    <span for="patient_dob" class="col-sm-3">Date of Birth</span>
                                                    <p class="col-sm-4"><?= $j_date = date("l, F j, Y", strtotime($patient_info[0]->DOB)); ?></p>
                                                </div>
                                                <div class="col-md-10">
                                                    <span for="patient_gender" class="col-sm-3">Gender</span>
                                                    <p class="col-sm-3"><?php if ($patient_info[0]->gender == 1) {
                                                            echo 'Male';
                                                        } else {
                                                            echo 'Female';
                                                        } ?></p>
                                                </div>
                                                <div class="col-md-10">
                                                    <span for="phone_number" class="col-sm-3">Phone</span>
                                                    <p class="col-sm-3"><?= $patient_info[0]->phone_number ?></p>
                                                </div>
                                                <div class="col-md-10">
                                                    <span for="patient_email" class="col-sm-3">Email</span>
                                                    <p class="col-sm-3"><?php if($patient_info[0]->email){echo $patient_info[0]->email;}else{echo 'N/A';} ?></p>
                                                </div>
                                                <div class="col-md-10">
                                                    <span for="patient_address" class="col-sm-3">Address</span>
                                                    <p class="col-sm-3"><?= $patient_info[0]->address ?></p>
                                                </div>
                                                <div class="col-md-10">
                                                        <span for="patient_joining_date"
                                                              class="col-sm-3">Joining Date</span>
                                                    <p class="col-sm-4"><?= $j_date = date("l, F j, Y", strtotime($patient_info[0]->joining_date)); ?></p>
                                                </div>
                                                <div class="col-md-10">
                                                    <span for="area" class="col-sm-3">Area</span>
                                                    <p class="col-sm-3"><?= $patient_info[0]->name ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class=""><a data-toggle="collapse" data-parent="#accordion-test-2"
                                                    href="#collapseOne-3">
                                            Preferable Caregiver List
                                        </a></h4>
                                    <div class="panel panel-default">
                                        <div id="collapseOne-3" class="panel-collapse collapse">
                                            <div class="panel-body">


                                                <?php if (sizeof($p_caregiver) == null) { ?>
                                                    <div class="panel panel-default panel-shadow">
                                                        <!-- to apply shadow add class "panel-shadow" -->

                                                        <!-- panel body -->
                                                        <div class="panel-body">
                                                            <div class="col-md-12">
                                                                No content found!!.
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php } else { ?>
                                                    <?php foreach ($p_caregiver as $key => $row) { ?>
                                                        <div class="panel panel-gray panel-shadow">
                                                            <!-- to apply shadow add class "panel-shadow" -->

                                                            <!-- panel body -->
                                                            <div class="panel-body">

                                                                <div class="col-md-3">
                                                                    <img
                                                                        src="<?= base_url().$row->picture ?>"
                                                                        class="img-responsive55 img-circle"
                                                                        height="50px" width="50px"/>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <h5><?= $row->caregiver_name ?></h5>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <h5><?= $row->address ?></h5>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    <?php }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class=""><a data-toggle="collapse" data-parent="#accordion-test-2"
                                                    href="#collapseOne-4">
                                            Family Information
                                        </a></h4>
                                    <div class="panel panel-default">
                                        <div id="collapseOne-4" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="panel panel-gray panel-shadow">
                                                    <!-- to apply shadow add class "panel-shadow" -->

                                                    <!-- panel body -->
                                                    <div class="panel-body">
                                                        <?php if (sizeof($f_contacts) == null) { ?>
                                                        <?php } else { ?>
                                                            <?php foreach ($f_contacts as $key => $row) { ?>
                                                                <div class="col-sm-6">

                                                                    <div class="tile-stats tile-primary">
                                                                        <div class="icon"><i
                                                                                class="entypo-suitcase"></i></div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                    class="fa fa-user"></i> <?= $row->family_contact_name ?>
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                    class="fa fa-users"></i> <?= $row->relationship ?>
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                    class="fa fa-location-arrow"></i> <?php if($row->address){echo $row->address;}else{echo 'N/A';} ?>
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                    class="fa fa-phone"></i> <?= $row->phone_number ?>
                                                                            </h4>
                                                                        </div>
                                                                        <br>
                                                                        <div>
                                                                            <h4 style="color: white"><i
                                                                                    class="entypo-mail"></i> <?php if($row->email){echo $row->email;}else{echo 'N/A';} ?>
                                                                            </h4>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            <?php }
                                                        } ?>
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
                                        <th style="background-color: #303641;color: white">Caregiver Name</th>
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
                            <div id="analytics" class="tab-pane fade" style="width: 640px; height: 640px">
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
                                            <a href="#" style="background-color: #455064"></a><span>Consulting Hours</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="history" class="tab-pane fade">
                                <div class="row">
                                    <div style="float: left" class="col-md-8">
                                        <h3>Add Medical History</h3>
                                    </div>
                                    <div style="margin-left: 16%;margin-bottom: 2%" class="col-md-2">
                                        <a data-toggle="modal" data-target="#historyModal"  style="margin-top: 30%"
                                           class="btn btn-primary btn-sm btn-icon icon-left">
                                            <i class="entypo-plus-circled"></i>
                                            History
                                        </a>
                                    </div>
                                </div>
                                <div class="modal fade" id="historyModal"
                                     tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form role="form"
                                                  action="<?= site_url('patient/history_add_post')?>" onsubmit="return check_history()"
                                                  class="form-horizontal form-groups-bordered" method="post">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add Medical History For <strong><?= $patient_info[0]->patient_name ?></strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6" style="margin-left: 5%">
                                                            <div class="form-group">
                                                                <label for="disease"
                                                                       class="control-label">Disease
                                                                    Name</label>

                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="disease" placeholder="Disease Name"
                                                                           name="disease" data-validate="required"
                                                                           data-message-required="This is required">
                                                                </div>
                                                                <span id="e_disease_err" name="e_disease_err"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="caregiver_name"
                                                                       class="control-label">Time
                                                                    Period</label>

                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                           id="time_period" placeholder="Time Period"
                                                                           name="time_period"
                                                                           data-validate="required" data-message-required="This is required"
                                                                    >
                                                                </div>
                                                                <span id="e_time_err" name="e_time_err"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6" style="margin-left: 5%">
                                                            <div class="form-group">
                                                                <label for="activities"
                                                                       class="control-label">Activities
                                                                </label>

                                                                <div class="input-group">
                                                                    <textarea class="form-control autogrow" name="activities" id="activities" placeholder="Type here..."></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="caregiver_name"
                                                                       class="control-label">Medication
                                                                </label>

                                                                <div class="input-group">
                                                                    <textarea class="form-control autogrow" name="medication" id="medication" placeholder="Type here..."></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <input type="hidden" id="history_patient_id" name="history_patient_id" value="<?= $patient_info[0]->patient_id ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Yes
                                                    </button>
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">No
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered datatable" id="table-1" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th>Disease Name</th>
                                        <th>Time Period</th>
                                        <th>Activities</th>
                                        <th>Medication</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php if (sizeof($medical_history) != null) { ?>
                                        <?php foreach ($medical_history as $key => $row) { ?>
                                            <tr>
                                                <td><?= $row->disease ?></td>
                                                <td><?= $row->time_period ?></td>
                                                <td><?= $row->activities ?></td>
                                                <td><?= $row->medication ?></td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#editModal_<?= $row->patient_medical_history_id ?>"
                                                       class="btn btn-info btn-sm btn-icon icon-left">
                                                        <i class="entypo-pencil"></i>
                                                        Edit
                                                    </a>
                                                    <a data-toggle="modal" data-target="#deleteModal_<?= $row->patient_medical_history_id ?>"
                                                       class="btn btn-danger btn-sm btn-icon icon-left">
                                                        <i class="entypo-trash"></i>
                                                        Delete
                                                    </a>
                                                </td>

                                                <div id="deleteModal_<?= $row->patient_medical_history_id ?>"
                                                     class="modal fade"
                                                     role="dialog" tabindex="-1">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <form action="<?= base_url() ?>patient/delete_history"
                                                              method="post">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" style="text-align: center">Delete Medical History</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h3 style="color: red; text-align: center">Are You Sure?</h3>
                                                                    <input type="hidden" id="history_id" name="history_id" value="<?= $row->patient_medical_history_id ?>">
                                                                    <input type="hidden" id="h_patient_id" name="h_patient_id" value="<?= $row->patient_id ?>">
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
                                                <div class="modal fade" id="editModal_<?= $row->patient_medical_history_id ?>"
                                                     data-backdrop="static">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="<?= site_url('patient/history_edit_post')?>" onsubmit="return check_history_edit()"
                                                                  class="form-horizontal form-groups-bordered validate" method="post">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Medical History For <strong><?= $row->patient_name ?></strong></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="disease"
                                                                                       class="control-label">Disease
                                                                                    Name</label>

                                                                                <div class="input-group">
                                                                                    <input type="text" class="form-control" id="e_disease" placeholder="Disease Name"
                                                                                           name="e_disease" value="<?= $row->disease ?>" data-validate="required"
                                                                                           data-message-required="This is required">
                                                                                </div>
                                                                                <span id="e_disease_err" name="e_disease_err"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="caregiver_name"
                                                                                       class="control-label">Time
                                                                                    Period</label>

                                                                                <div class="input-group">
                                                                                    <input type="text" class="form-control"
                                                                                           id="e_time_period" placeholder="Time Period"
                                                                                           name="e_time_period" value="<?= $row->time_period ?>"
                                                                                           data-validate="required" data-message-required="This is required"
                                                                                    >
                                                                                </div>
                                                                                <span id="e_time_err" name="e_time_err"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="activities"
                                                                                       class="control-label">Activities
                                                                                </label>

                                                                                <div class="input-group">
                                                                                    <textarea class="form-control autogrow" name="e_activities" id="e_activities" placeholder="Type here..."><?= $row->activities ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="caregiver_name"
                                                                                       class="control-label">Medication
                                                                                </label>

                                                                                <div class="input-group">
                                                                                    <textarea class="form-control autogrow" name="e_medication" id="e_medication" placeholder="Type here..."><?= $row->medication ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <input type="hidden" id="history_edit_id" name="history_edit_id" value="<?= $row->patient_medical_history_id ?>">
                                                                    <input type="hidden" id="history_patient_edit_id" name="history_patient_edit_id" value="<?= $row->patient_id ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success">Yes
                                                                    </button>
                                                                    <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">No
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
            var get_patient = $('#get_patient').val();
            var patient_name = $('#p_name').val();
            // console.log(get_month);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("patient/fetch_history");?>',
                data: {
                    'month_name': get_month,
                    'patient_id': get_patient,
                    'patient_name': patient_name
                },
                success: function (data) {
                    $("#filter_table").html(data);
                }
            });
        }
        function fetch_chart_data() {
            $("#chart3").empty();
            var get_month = $('#c_month').val();
            var get_patient = $('#get_patient').val();
            // console.log(get_month);

            var bar_chart = Morris.Bar({
                element: 'chart3',
                data: [{schedule_date: 0, duty_hours: 0, consulting_hours: 0},
                    {schedule_date: 0, duty_hours: 0, consulting_hours: 0},
                    {schedule_date: 0, duty_hours: 0, consulting_hours: 0},
                    {schedule_date: 0, duty_hours: 0, consulting_hours: 0}],
                xkey: 'schedule_date',
                ykeys: ['duty_hours', 'consulting_hours'],
                labels: ['Duty Hours', 'Consulting Hours'],
                barColors: ['#707f9b', '#455064'],
                redraw: true,
                hideHover: false
            });
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("patient/get_chart_data");?>',
                data: {
                    'month_name': get_month,
                    'patient_id': get_patient
                },
                success: function (data) {
//                    $("#filter_table").html(data);
                    data1 = $.parseJSON(data);
                    //  console.log(data1);
                    bar_chart.setData(data1);
                }
            });
        }
        function show_history_modal() {
            //console.log('yes history');
           // $('#historyModal').show();
            $('#historyModal').modal('show');
        }

        $(document).ready(function () {
           // create_history();
            var today = new Date();
            var get_year = today.getFullYear();
            var get_patient = $('#get_patient').val();
            var get_month = today.getMonth() + 1;
            var curr_year_month = moment().format('YYYY-MM');
            //console.log(test);
            var patient_name = $('#p_name').val();
            var mm = get_year + '-' + get_month;
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("patient/fetch_history");?>',
                data: {
                    'month_name': curr_year_month,
                    'patient_id': get_patient,
                    'patient_name': patient_name
                },
                success: function (data) {
                    $("#filter_table").html(data);
                }
            });
            //// chart //////////
            // Bar Charts
            var bar_chart = Morris.Bar({
                element: 'chart3',
                data: [{schedule_date: 0, duty_hours: 0, consulting_hours: 0},
                    {schedule_date: 0, duty_hours: 0, consulting_hours: 0},
                    {schedule_date: 0, duty_hours: 0, consulting_hours: 0},
                    {schedule_date: 0, duty_hours: 0, consulting_hours: 0}],
                xkey: 'schedule_date',
                ykeys: ['duty_hours', 'consulting_hours'],
                labels: ['Duty Hours', 'Consulting Hours'],
                barColors: ['#707f9b', '#455064'],
                redraw: true,
                hideHover: false
            });
            //alert(mm);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("patient/get_chart_data");?>',
                data: {
                    'month_name': mm,
                    'patient_id': get_patient
                },
                success: function (data) {
//                    $("#filter_table").html(data);
                        data1 = $.parseJSON(data);
                        //  console.log(data1);
                        bar_chart.setData(data1);
                }
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href") // activated tab

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

        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        function check_history() {
            var disease_name = $('#disease').val();
            var time_period = $('#time_period').val();
            var activities = $('#activities').val();
            var medication = $('#medication').val();
           // console.log(disease_name +' '+time_period+' '+activities+' '+medication);
            if(disease_name == "")
            {
                var x = document.getElementById('disease_err');
                x.style.color = "red";
                x.innerHTML = "Please Type Disease Name!";
                return false;
            }
            if(time_period == "")
            {
                document.getElementById('disease_err').innerHTML = "";
                var y = document.getElementById('time_err');
                y.style.color = "red";
                y.innerHTML = "Please Specify Time Period!";
                return false;
            }
            else
            {
                return true;
            }
        }
        function check_history_edit() {
            var disease_name = $('#e_disease').val();
            console.log(disease_name);
          //  return false;
            var time_period = $('#e_time_period').val();
            var activities = $('#e_activities').val();
            var medication = $('#e_medication').val();
           // console.log(disease_name +' '+time_period+' '+activities+' '+medication);
            if(disease_name == "")
            {
                var x = document.getElementById('e_disease_err');
                x.style.color = "red";
                x.innerHTML = "Please Type Disease Name!";
                return false;
            }
            if(time_period == "")
            {
                document.getElementById('e_disease_err').innerHTML = "";
                var y = document.getElementById('e_time_err');
                y.style.color = "red";
                y.innerHTML = "Please Specify Time Period!";
                return false;
            }
            else
            {
                return true;
            }
        }
        
        function delete_row(id) {
            console.log(id);
            $('#' + id).remove();
        }
    </script>
</div>