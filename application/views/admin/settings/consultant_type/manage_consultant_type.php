<div class="main-content">

    <?php
    if (isset($top_header)) {

        echo $top_header;
    }
    ?>

    <hr/>
    <script type="text/javascript">
        jQuery(document).ready(function () {
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
                        Consultant Info<br>
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
                            <th>Type Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if (sizeof($consultant_types) != null) { ?>
                            <?php foreach ($consultant_types as $key => $row) { ?>
                                <tr>
                                    <td><?= $row['type_name'] ?></td>
                                    <td>
                                        <a href="<?= site_url('edit_consultant_type') . '/' . $row['consultant_type_id'] ?>">
                                            <span data-toggle="tooltip" data-placement="top" title="Edit"
                                                  class="glyphicon glyphicon-edit"></span>
                                        </a> |
                                        <a data-toggle="modal" data-target="#statusModal_<?= $row['consultant_type_id'] ?>"> <?php if($row['status'] == 1){ ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Change Status"
                                                      class="glyphicon glyphicon-thumbs-up"></span><?php }?>
                                            <?php if($row['status'] == 0){ ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Change Status"
                                                      class="glyphicon glyphicon-thumbs-down"></span>
                                            <?php }?>
                                        </a>
                                    </td>
                                    <div class="modal fade" id="statusModal_<?= $row['consultant_type_id'] ?>"
                                         data-backdrop="static">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form role="form"
                                                      action="<?= site_url('change_type_status')?>"
                                                      class="form-horizontal form-groups-bordered" method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Change Status For <strong><?= $row['type_name'] ?></strong></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div style="text-align: center; font-size: 20px;color: black">
                                                            <?php if($row['status'] == 0){ ?>
                                                                Are you sure you want to activate this user?
                                                            <?php }else{ ?>
                                                                Are you sure you want to Deactivate this user?
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input type="hidden" id="status_id" name="status_id" value="<?= $row['consultant_type_id'] ?>">
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

</div>