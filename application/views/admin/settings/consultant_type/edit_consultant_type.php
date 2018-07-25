<div class="main-content">

    <?php
    if (isset($top_header)) {

        echo $top_header;
    }
    ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/selectboxit/jquery.selectBoxIt.css">
    <hr/>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        <?= $active_page ?><br>
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
                    <form role="form" action="<?= site_url('consultancy_type_edit_post') ?>"
                          class="form-horizontal form-groups-bordered" method="post">
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Type Name</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" required id="type_name" name="type_name"
                                       placeholder="Consultancy Type" value="<?= $consultancy_type[0]->type_name ?>">
                            </div>
                        </div>
                        <input type="hidden" id="consultant_type_id" name="consultant_type_id" value="<?= $consultancy_type[0]->consultant_type_id ?>">
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-5">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>


        </div>
    </div>

    <!-- Footer -->
    <?php if (isset($footer)) {
        echo $footer;
    }
    ?>
    <script src="<?= base_url() ?>asset/admin/js/selectboxit/jquery.selectBoxIt.min.js"></script>
</div>