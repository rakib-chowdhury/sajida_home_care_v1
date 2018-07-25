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
                "responsive": true
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
                    </div>
                    <br>
                </div>
                <div class="panel-body">
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
                    <table class="table table-bordered datatable" id="table-1" width="100%">
                        <thead>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Level</th>
                            <th style="width: 15%">Address</th>
                            <th>Phone Number</th>
                            <th>Referred By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (sizeof($get_patient_info) != null) { ?>
                            <?php foreach ($get_patient_info as $key => $row) { ?>
                                <tr>
                                    <td><a href="<?= site_url('patient/view_profile') . '/' . $row['patient_id'] ?>">
                                            <?php if(isset($row['picture'])) { ?>
                                    <img src="<?php $img = filemtime($row['picture']);
                                    echo site_url($row['picture']."?".$img);
                                    ?>"
                                         class="img-circle" alt="" height="60" width="60">
                                    <?php }else {?>
                                    <img src="<?= site_url('uploads/patient_image/') . 'no_image.jpg' ?>"
                                         class="img-circle" alt="" height="60" width="60">
                                    <?php  }?>
                                            <span><br><?= $row['patient_id'] ?></span>
                                        </a></td>
                                    <td><a href="<?= site_url('patient/view_profile') . '/' . $row['patient_id'] ?>" >
                                            <?= $row['patient_name'] ?>
                                        </a></td>
                                    <td><?php if($row['level_name'] == "Level 1"){ ?>
                                    <div class="label label-default"><strong><?= $row['level_name'] ?></strong></div>
                                    <?php }else if($row['level_name'] == "Level 2"){ ?>
                                    <div class="label label-secondary"><strong><?= $row['level_name'] ?></strong></div>
                                    <?php }else{ ?>
                                    <div class="label label-danger"><strong><?= $row['level_name'] ?></strong></div>
                                    <?php } ?>
                                    </td>
                                    <td><?= $row['address'] ?></td>
                                    <td><?= $row['phone_number'] ?></td>
                                    <td><?php if($row['referral_name']){echo $row['referral_name'];}
                                        else{echo 'N/A';}
                                        ?></td>
                                    <td>
                                        <a href="<?= site_url('patient/edit_patient') . '/' . $row['patient_id'] ?>">
                                            <span data-toggle="tooltip" data-placement="top" title="Edit"
                                                  class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a data-toggle="modal" data-target="#statusModal_<?= $row['patient_id'] ?>"> <?php if ($row['status'] == 1) { ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Change Status"
                                                      class="glyphicon glyphicon-thumbs-up"></span>
                                            <?php } ?>
                                            <?php if ($row['status'] == 0) { ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Change Status"
                                                      class="glyphicon glyphicon-thumbs-down"></span>
                                            <?php } ?>
                                        </a>
                                        <a data-toggle="modal" data-target="#passwordModal_<?= $row['patient_id'] ?>">
                                            <span data-toggle="tooltip" data-placement="top" title="Reset Password"
                                                  class="glyphicon glyphicon-lock"></span>
                                        </a>
                                    </td>
                                    <div class="modal fade" id="passwordModal_<?= $row['patient_id'] ?>"
                                         data-backdrop="static">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form role="form"
                                                      action="<?= site_url('patient/reset_password') ?>"
                                                      class="form-horizontal form-groups-bordered" method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Reset Password For
                                                            <strong><?= $row['patient_name'] ?></strong></h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div style="text-align: center; font-size: 20px;color: red">
                                                            <strong>Are You Sure?</strong>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input type="hidden" id="password_id" name="password_id"
                                                               value="<?= $row['patient_id'] ?>">
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
                                    <div class="modal fade" id="statusModal_<?= $row['patient_id'] ?>"
                                         data-backdrop="static">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form role="form"
                                                      action="<?= site_url('patient/change_status') ?>"
                                                      class="form-horizontal form-groups-bordered" method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Change Status For
                                                            <strong><?= $row['patient_name'] ?></strong></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div style="text-align: center; font-size: 20px; color: black">
                                                            <?php if($row['status'] == 0){ ?>
                                                            Are you sure you want to activate this user?
                                                            <?php }else{ ?>
                                                            Are you sure you want to Deactivate this user?
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input type="hidden" id="status_id" name="status_id"
                                                               value="<?= $row['patient_id'] ?>">
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

    <!-- Footer -->
    <?php if (isset($footer)) {
        echo $footer;
    }
    ?>
    <script src="<?php echo base_url() ?>asset/admin/js/datatables/datatables.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/select2/select2.min.js"></script>
    <script type="text/javascript">

    </script>
</div>