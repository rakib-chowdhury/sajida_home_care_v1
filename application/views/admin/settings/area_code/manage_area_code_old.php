<div class="main-content">

    <?php
    if (isset($top_header)) {

        echo $top_header;
    }
    ?>

    <hr/>
    <script type="text/javascript" q>
        jQuery(window).load(function () {
            var $table2 = jQuery("#table-2");

            // Initialize DataTable
            $table2.DataTable({
                "sDom": "tip",
                "bStateSave": false,
                "iDisplayLength": 8,
                "aoColumns": [
                    {"bSortable": false},
                    null,
                    null,
                    null,
                    null
                ],
                "bStateSave": true
            });

            // Highlighted rows
            $table2.find("tbody input[type=checkbox]").each(function (i, el) {
                var $this = $(el),
                    $p = $this.closest('tr');

                $(el).on('change', function () {
                    var is_checked = $this.is(':checked');

                    $p[is_checked ? 'addClass' : 'removeClass']('highlight');
                });
            });

            // Replace Checboxes
            $table2.find(".pagination a").click(function (ev) {
                replaceCheckboxes();
            });
        });
    </script>
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/datatables/datatables.css">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Area Code<br>
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-success">
                                <span style="color: red">
                                     <?= $this->session->flashdata('msg'); ?>
                                </span>
                            </div>
                        <?php } ?>
                    </div>
                    <br>
                </div>
                <div class="panel-body">

                    <table class="table table-bordered table-striped datatable" id="table-2">
                        <thead>
                        <tr>
                            <th>Area Name</th>
                            <th>Area Code</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if (sizeof($get_area_codes) != null) { ?>
                            <?php foreach ($get_area_codes as $key => $row) { ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['area_code_id'] ?></td>
                                    <td><?= $row['location'] ?></td>
                                    <td>
                                        <a href="<?= site_url('settings/edit_area_code') . '/' . $row['area_code_id'] ?>"
                                           class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i>
                                            Edit
                                        </a>

                                        <a data-toggle="modal" data-target="#deleteModal_<?= $row['area_code_id'] ?>"
                                           class="btn btn-danger btn-sm btn-icon icon-left">
                                            <i class="entypo-cancel"></i>
                                            Delete
                                        </a>
                                    </td>
                                    <div class="modal fade" id="deleteModal_<?= $row['area_code_id'] ?>" data-backdrop="static">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form role="form"
                                                      action="<?= site_url('settings/delete_area_code'). '/' . $row['area_code_id'] ?>"
                                                      class="form-horizontal form-groups-bordered" method="post">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Area Info?</h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div style="text-align: center; font-size: 20px;color: red">
                                                            <strong>Are You Sure?</strong>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input type="hidden" name="id" id="id"
                                                               value="<?= $row['area_code_id'] ?>">
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
    <script src="<?php echo base_url() ?>asset/admin/js/select2/select2.min.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/datatables/datatables.js"></script>

</div>