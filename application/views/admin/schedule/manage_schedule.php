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
                        Patient List<br>
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
                            <th>Patient Name</th>
                            <th>Last Schedule Date</th>
                            <th>Patient ID</th>
                            <th>Level Of care</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (sizeof($patients) != null) { ?>
                            <?php foreach ($patients as $key => $row) { ?>
                                <tr>
                                    <td><a href="<?= site_url('patient/view_profile') ?>/<?= $row->patient_id ?>" title="Go To Profile"><?= $row->patient_name ?></a></td>
                                    <td><?= $row->schedule_date ?></td>
                                    <td><?= $row->patient_id ?></td>
                                    <td><?= $row->level_name ?></td>
                                    <td>
                                        <a href="<?= site_url('schedule/add_schedule') . '/' . $row->patient_id ?>"
                                           class="btn btn-info btn-sm btn-icon icon-left">
                                            <i class="entypo-plus"></i>
                                            Add Schedule
                                        </a>
                                        <a href="<?= site_url('schedule/add_consultant') . '/' . $row->patient_id ?>"
                                           class="btn btn-green btn-sm btn-icon icon-left">
                                            <i class="entypo-plus"></i>
                                            Add Consultant
                                        </a>

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
    <!-- Footer -->
    <?php if (isset($footer)) {
        echo $footer;
    }
    ?>
    <script src="<?php echo base_url() ?>asset/admin/js/datatables/datatables.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/select2/select2.min.js"></script>

</div>