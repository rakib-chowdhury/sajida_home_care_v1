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
            var $table2 = jQuery('#table-2');

            // Initialize DataTable
            $table2.DataTable({
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "bStateSave": false,
                "responsive": true
            });

            // Initalize Select Dropdown after DataTables is created
            $table2.closest('.dataTables_wrapper').find('select').select2({
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
                        Promotional Items<br>
                    </div>
                    <br>
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
                <div class="panel-body">
                    <div class="col-md-12">
                        <!-- tabs for the profile links -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#requested_items">Requested Items</a></li>
                            <li><a data-toggle="tab" href="#approved_items">Approved Items</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="requested_items" class="tab-pane fade in active">
                            <table class="table table-bordered table-responsive datatable" id="table-1" width="100%">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Item Name</th>
                                    <th>Patient Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php if (sizeof($promo_item_request) != null) { ?>
                                    <?php foreach ($promo_item_request as $key => $row) { ?>
                                        <tr>
                                            <td><?= $row->date ?></td>
                                            <td><?= $row->promotional_name ?></td>
                                            <td><?= $row->patient_name ?></td>
                                            <td><a data-toggle="modal" data-target="#statusModal_<?= $row->promotional_item_request_id ?>">
                                                    <button class="btn btn-success">Approve<i class="entypo-check"></i></button></a>
                                                <div class="modal fade" id="statusModal_<?=$row->promotional_item_request_id?>"
                                                     data-backdrop="static">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form role="form"
                                                                  action="<?= site_url('Promotional_item/manage_items') ?>"
                                                                  class="form-horizontal form-groups-bordered" method="post">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Change Status For
                                                                        <strong><?= $row->promotional_name ?></strong></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div style="text-align: center; font-size: 20px; color: black">
                                                                        <?php if($row->is_accepted == 0){ ?>
                                                                            Are you sure you want to approve this request?
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <input type="hidden" id="status_id" name="status_id"
                                                                           value="<?= $row->promotional_item_request_id ?>">
                                                                    <input type="hidden" id="item_id" name="item_id" 
                                                                           value="<?= $row->tbl_promotional_items_pomotional_item_id ?>"
                                                                    >
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
                                            </td>

                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="approved_items" class="tab-pane fade">
                            <table class="table table-bordered table-responsive datatable" width="100%" id="table-2">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Item Name</th>
                                    <th>Patient Name</th>
                                    <th>Approved By</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php if (sizeof($promo_item_approved) != null) { ?>
                                    <?php foreach ($promo_item_approved as $key => $row) { ?>
                                        <tr>
                                            <td><?= $row->date ?></td>
                                            <td><?= $row->promotional_name ?></td>
                                            <td><?= $row->patient_name ?></td>
                                            <td><?= $row->admin_name ?></td>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            <!--            site_url('promotional_item/edit_promotional_items') . '/' . $row->promotional_item_id-->

        </div>
    </div>

    <!-- Footer -->
    <?php if (isset($footer)) {
        echo $footer;
    }
    ?>
    <script src="<?php echo base_url() ?>asset/admin/js/datatables/datatables.js"></script>
</div>