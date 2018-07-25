<?php $i = 0; ?>

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
                        User Info<br>
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
                            <th style="width: 5%">#</th>
                            <th style="width: 10%">ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>DOB</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th style="width: 15%">Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if (sizeof($users) != null) { ?>
                            <?php foreach ($users as $key => $row) {
                                $i++; ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $row['admin_user_id'] ?></td>
                                    <td><?= $row['admin_name'] ?></td>
                                    <td><?= $row['user_type_name'] ?></td>
                                    <td><?= $row['DOB'] ?></td>
                                    <td><?= $row['phone_number'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['address'] ?></td>
                                    <td>
                                        <a href="<?= site_url('admin_users/edit_users') . '/' . $row['admin_user_id'] ?>">
                                            <span data-toggle="tooltip" data-placement="top" title="Edit"
                                                  class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a data-toggle="modal" data-target="#statusModal_<?= $i ?>"> <?php if ($row['status'] == 1) { ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Change Status"
                                                      class="glyphicon glyphicon-thumbs-up"></span>
                                            <?php } ?>
                                            <?php if ($row['status'] == 0) { ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Change Status"
                                                      class="glyphicon glyphicon-thumbs-down"></span>
                                            <?php } ?>
                                        </a>
                                        <a data-toggle="modal" data-target="#emergencyModal_<?= $i ?>"> <?php if ($row['phone_number'] != null && $row['is_emergency'] == 0) { ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Make Emergency Contact"
                                                      class="glyphicon glyphicon-earphone"></span>
                                            <?php } ?>
                                            <?php if ($row['is_emergency'] == 1) { ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Currently Active"
                                                      class="glyphicon glyphicon-ok"></span>
                                            <?php } ?>
                                            <?php if ($row['phone_number'] == null) { ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Change Status"
                                                      class="glyphicon glyphicon-remove"></span>
                                            <?php } ?>

                                        </a>
                                    </td>
                                    <div class="modal fade" id="statusModal_<?php echo $i ?>"
                                         data-backdrop="static">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form role="form"
                                                      action="<?= site_url('admin_user/change_status') ?>"
                                                      class="form-horizontal form-groups-bordered" method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Change Status For
                                                            <strong><?= $row['admin_name'] ?></strong></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div style="text-align: center; font-size: 20px;color: black">
                                                            <?php if ($row['status'] == 0) { ?>
                                                                Are you sure you want to activate this user?
                                                            <?php } else { ?>
                                                                Are you sure you want to Deactivate this user?
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input type="hidden" id="admin_id" name="admin_id"
                                                               value="<?= $row['admin_user_id'] ?>">
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
                                    <div class="modal fade" id="emergencyModal_<?php echo $i ?>"
                                         data-backdrop="static">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form role="form"
                                                      action="<?= site_url('admin_user/emergency_contact') ?>"
                                                      class="form-horizontal form-groups-bordered" method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Emergency Contact</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div style="text-align: center; font-size: 20px;color: black">
                                                                Are you sure you want to make <strong><?= $row['admin_name'] ?></strong> as emergency contact?
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input type="hidden" id="admin_id" name="admin_id"
                                                               value="<?= $row['admin_user_id'] ?>">
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

</div>