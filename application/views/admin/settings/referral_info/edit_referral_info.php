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
                    <form role="form" action="<?= site_url('settings/consultant_info_edit_post') ?>"
                          class="form-horizontal form-groups-bordered validate" method="post">
                        <div class="form-group">
                            <label for="consultant_user_id" class="col-sm-3 control-label">Consultant ID</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" disabled data-validate="required" id="consultant_user_id" name="consultant_user_id"
                                       value="<?= $get_consultant_info[0]->consultant_user_id ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-validate="required" id="name" name="name"
                                       value="<?= $get_consultant_info[0]->name ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="col-sm-3 control-label">Phone Number</label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" data-validate="required" id="phone_number" name="phone_number"
                                       value="<?= $get_consultant_info[0]->phone_number ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>

                            <div class="col-sm-5">
                                <input type="email" class="form-control" data-validate="required" id="email" name="email"
                                       value="<?= $get_consultant_info[0]->email ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">Address</label>

                            <div class="col-sm-5">
                                <textarea class="form-control autogrow" data-validate="required" id="address" name="address"><?= $get_consultant_info[0]->address ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-5">
                                <textarea class="form-control autogrow" data-validate="required" id="description" name="description"><?= $get_consultant_info[0]->description ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Consultant Type</label>

                            <div class="col-sm-5">
                                <select name="tbl_consultant_type_consultant_type_id" class="selectboxit">
                                    <?php foreach ($consultant_type as $row) { ?>
                                        <option value="<?= $row['consultant_type_id'] ?>" <?php if($row['consultant_type_id'] == $get_consultant_info[0]->consultant_type_id){echo 'selected';} ?>><?= $row['type_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <input type="hidden" name="id" id="id" value="<?= $get_consultant_info[0]->consultant_user_id ?>">
                        </div>
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