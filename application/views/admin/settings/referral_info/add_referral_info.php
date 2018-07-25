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
                        Add Referral Info<br>
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
                    <form role="form" action="<?= site_url('settings/referral_info_add_post') ?>"
                          onsubmit="return check_data()"
                          id='consultant_add_form' class="form-horizontal form-groups-bordered validate" method="post">
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><span
                                    style="color: red">*</span>Name</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-validate="required" id="referral_name" name="referral_name"
                                       placeholder="Referral Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="organization" class="col-sm-3 control-label"><span
                                    style="color: red">*</span>Organization</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-validate="required" id="organization" name="organization"
                                       placeholder="Organization Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="designation" class="col-sm-3 control-label"><span
                                    style="color: red">*</span>Designation</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-validate="required" id="designation" name="designation"
                                       placeholder="Designation">
                            </div>
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
    <script type="text/javascript">
        function check_data() {
            var type = $('#tbl_consultant_type_consultant_type_id').val();
            console.log(type);
            if (type == -1) {
                var error = document.getElementById('type_error');
                error.style.color = 'red';
                error.innerHTML = 'Please Select a Consultant Type.<br>';
               // return false;
            }
            else {
                var error = document.getElementById('type_error');
                error.style.color = '';
                error.innerHTML = '';
               // $('#consultant_add_form').submit();
               // return true;
            }
        }
    </script>
</div>