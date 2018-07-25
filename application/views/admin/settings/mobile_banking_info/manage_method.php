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
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Mobile Banking Methods<br>
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
                            <th style="">Payment Method Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if (sizeof($methods) > 0) { ?>
                            <?php foreach ($methods as $key => $row) { ?>
                                <tr>
                                    <td><?= $row['payment_method_name'] ?></td>
                                    <td>
                                        <a href="<?= site_url('edit_mobile_banking_method') . '/' . $row['payment_method_id'] ?>">
                                            <span data-toggle="tooltip" data-placement="top" title="Edit"
                                                  class="glyphicon glyphicon-edit"></span>
                                        </a>

                                        <a data-toggle="modal" data-target="#deleteModal_<?= $row['payment_method_id'] ?>">
                                            <span data-toggle="tooltip" data-placement="top" title="Delete"
                                                  style="color: red" class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>
                                    <div class="modal fade" id="deleteModal_<?= $row['payment_method_id'] ?>"
                                         data-backdrop="static">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form role="form"
                                                      action="<?= site_url('delete_mobile_banking_method') ?>"
                                                      class="form-horizontal form-groups-bordered" method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Info for <strong><?= $row['payment_method_name'] ?></strong>?</h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div style="text-align: center; font-size: 20px;color: red">
                                                            <strong>Are You Sure?</strong>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input type="hidden" name="id" id="id"
                                                               value="<?= $row['payment_method_id'] ?>">
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
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/datatables/datatables.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/select2/select2.css">
    <script src="<?php echo base_url() ?>asset/admin/js/datatables/datatables.js"></script>

</div>