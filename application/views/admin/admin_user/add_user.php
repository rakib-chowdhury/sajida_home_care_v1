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
                        New User <br>
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
                    <form role="form" action="<?= site_url('admin_users/user_add_post') ?>"
                          onsubmit="return check_data()"
                          id='user_add_form' class="form-horizontal form-groups-bordered validate" method="post">
                        <div class="form-group">
                            <label for="admin_name" class="col-sm-3 control-label">Employee ID<span
                                    style="color: red">*</span></label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-validate="required" onkeyup="check_id()" id="admin_user_id" name="admin_user_id"
                                       placeholder="ID" autocomplete="off">
                                <span id="user_name_err"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="admin_name" class="col-sm-3 control-label">Name<span
                                    style="color: red">*</span></label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-validate="required" id="admin_name" name="admin_name"
                                       placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="DOB" class="col-sm-3 control-label">DOB<span
                                    style="color: red">*</span></label>

                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" id="DOB"
                                           name="DOB" readonly data-validate="required" data-format="yyyy-mm-dd"
                                    >
                                    <div class="input-group-addon">
                                        <a href="#"><i class="entypo-calendar"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-sm-3 control-label">Gender
                            </label>

                            <div class="col-sm-5">
                                <div class="make-switch switch-small" data-on-label="M" data-off-label="F">
                                    <input type="checkbox" id="gender" onchange="chk_gender()" name="gender" checked>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="col-sm-3 control-label">Phone Number</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                       id="phone_number" name="phone_number" min="0"
                                       data-numeric-align="right" placeholder="Type Phone Number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email<span style="color: red">*</span>
                            </label>

                            <div class="col-sm-5">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Enter Email" data-validate="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">User Role<span style="color: red">*</span>
                            </label>

                            <div class="col-sm-5">
                                <select name="tbl_admin_user_type_admin_user_type_id" data-validate="required"
                                        id="tbl_admin_user_type_admin_user_type_id" class="selectboxit">
                                    <option value="-1">Select User Type</option>
                                    <?php if(sizeof($user_type != null)){ ?>
                                        <?php foreach ($user_type as $row) { ?>
                                            <option
                                                value="<?= $row['admin_user_type_id'] ?>"><?= $row['user_type_name'] ?></option>
                                        <?php } }?>
                                </select>
                                <span id="type_error" name="type_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">Address
                            </label>

                            <div class="col-sm-5">
                                <textarea class="form-control autogrow" name="address"
                                          id="address" rows="4"
                                          placeholder="Enter user's address"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-5">
                                <button type="submit" id="myBtn" class="btn btn-success">Submit</button>
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
        //        function check_id()
        //        {
        //            $.ajax({
        //                type: 'POST',
        //                url: '<?php //echo site_url('settings/check_consultant_id') ?>//',
        //                success: function (data) {
        //                    var res = $.parseJSON(data);
        //                    console.log(res);
        //                    if (res['consultant_user_id'].value == 0) {
        //                        var x = document.getElementById('consultant_user_id');
        //                        x.style.color = "red";
        //                        x.value = 'C-'+res['new_date']+'-'+res['consultant_user_id'];
        //                    }
        //                    else {
        //                        //$('#username').removeClass('loadinggif');
        //                        var x = document.getElementById('consultant_user_id');
        //                        x.style.color = "";
        //                        x.value = 'C-'+res['new_date']+'-'+res['consultant_user_id'];
        //                    }
        //                }
        //            });
        //        }
        function check_data() {
            var type = $('#tbl_admin_user_type_admin_user_type_id').val();
            console.log(type);
            if (type == -1) {
                var error = document.getElementById('type_error');
                error.style.color = 'red';
                error.innerHTML = 'Please Select a Category.<br>';
                return false;
            }
            else {
                var error = document.getElementById('type_error');
                error.style.color = '';
                error.innerHTML = '';
                return true;
//                $('#user_add_form').submit();
            }
        }
        function check_id() {
            document.getElementById('myBtn').disabled = true;
            var user_id = $('#admin_user_id').val();
            $('#admin_user_id').addClass('loadinggif');
            console.log(user_id);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('admin_user/check_user_id') ?>',
                data: {
                    user_name: user_id
                }, success: function (data) {
                    var res = $.parseJSON(data);
                    //console.log(res);
                    if (res['result'].length == 1) {
                        var x = document.getElementById('user_name_err');
                        x.style.color = "red";
                        x.innerHTML = "<strong>ID Already Exists</strong><br>";
                    }
                    else {
                        $('#admin_user_id').removeClass('loadinggif');
                        document.getElementById('myBtn').disabled = false;
                        var x = document.getElementById('user_name_err');
                        x.style.color = "black";
                        x.innerHTML = "";
                    }
                }
            });
        }
    </script>
</div>