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
                        Promotional Items<br>
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
                    <table class="table table-bordered table-responsive datatable" id="table-1" width="100%">
                        <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 8%">Item Name</th>
                            <th style="width: 5%">Category</th>
                            <th style="width: 5%">Quantity</th>
                            <th style="width: 20%">Description</th>
                            <th>Price</th>
                            <th style="width: 10%">Picture</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if (sizeof($promo_items) != null) { ?>
                            <?php foreach ($promo_items as $key => $row) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $row->promotional_name ?></td>
                                    <td><?= $row->category_name ?></td>
                                    <td><?= $row->item_quantity ?></td>
                                    <td><?= $row->item_description ?></td>
                                    <td><?= $row->item_price ?></td>
                                    <td><img src="<?= base_url().$row->item_picture ?>" class="img-circle"
                                             alt="Promotional Item" width="80" height="50"></td>
                                    <td>
                                        <?php if($row->status == 1 && $row->item_quantity > 0){echo 'Available';}?><?php if($row->status == 0 || $row->item_quantity <= 0){echo 'Not Available';}?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url() ?>promotional_items/edit_promotional_items/<?= $row->promotional_item_id ?>">
                                            <span data-toggle="tooltip" data-placement="top" title="Edit"
                                                  class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a data-toggle="modal" data-target="#statusModal_<?= $row->promotional_item_id ?>"> <?php if($row->status == 1){ ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Change Status"
                                                      class="glyphicon glyphicon-thumbs-up"></span>
                                            <?php }?>
                                            <?php if($row->status == 0){ ?>
                                                <span data-toggle="tooltip" data-placement="top" title="Change Status"
                                                      class="glyphicon glyphicon-thumbs-down"></span>
                                            <?php }?>
                                        </a>
                                        <a data-toggle="modal" data-target="#deleteModal<?=$row->promotional_item_id?>">
                                            <span data-toggle="tooltip" data-placement="top" title="Delete"
                                                  style="color: red" class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        <div id="deleteModal<?=$row->promotional_item_id?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <form action="<?= base_url() ?>Promotional_item/delete_promotional_items" method="post">
                                                    <input type="hidden" name="id" value="<?=$row->promotional_item_id ?>">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <p style="color: red; text-align: center; font-size: 25px" >Are You Sure You Want To Delete?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Yes</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="statusModal_<?=$row->promotional_item_id?>"
                                             data-backdrop="static">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form role="form"
                                                          action="<?= site_url('Promotional_item/change_status') ?>"
                                                          class="form-horizontal form-groups-bordered" method="post">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Change Status For
                                                                <strong><?= $row->promotional_name ?></strong></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div style="text-align: center; font-size: 20px; color: black">
                                                                <?php if($row->status == 0){ ?>
                                                                    Are you sure you want to activate this Item?
                                                                <?php }else{ ?>
                                                                    Are you sure you want to Deactivate this Item?
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <input type="hidden" id="status_id" name="status_id"
                                                                   value="<?= $row->promotional_item_id ?>">
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
    <script type="text/javascript">
        function change_status() {
            var item = $('#promotional_item_id').val();
            console.log(item);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('promotional_item/change_status') ?>',
                data: {
                    item: item
                }, success: function (data) {
                    var res = $.parseJSON(data);
                }
            });
        }
    </script>
</div>