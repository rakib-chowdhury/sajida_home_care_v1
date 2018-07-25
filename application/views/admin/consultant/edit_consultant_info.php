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
                    <form role="form" action="<?= site_url('consultant_info_edit_post') ?>"
                          class="form-horizontal form-groups-bordered validate" method="post">
                        <div class="form-group">
                            <label for="consultant_user_id" class="col-sm-3 control-label">Consultant ID</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" disabled data-validate="required" id="consultant_user_id" name="consultant_user_id"
                                       value="<?= $get_consultant_info[0]->consultant_user_id ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><span>*</span>Name</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-validate="required" id="name" name="name"
                                       value="<?= $get_consultant_info[0]->name ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="col-sm-3 control-label"><span>*</span>Phone Number</label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" data-validate="required" id="phone_number" name="phone_number"
                                       value="<?= $get_consultant_info[0]->phone_number ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label"><span>*</span>Email</label>

                            <div class="col-sm-5">
                                <input type="email" class="form-control" data-validate="required" id="email" name="email"
                                       value="<?= $get_consultant_info[0]->email ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">Address</label>

                            <div class="col-sm-5">
                                <textarea class="form-control autogrow" id="address" name="address"><?= $get_consultant_info[0]->address ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-5">
                                <textarea class="form-control autogrow" id="description" name="description"><?= $get_consultant_info[0]->description ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><span>*</span>Consultant Type</label>

                            <div class="col-sm-5">
                                <select name="tbl_consultant_type_consultant_type_id" class="selectboxit">
                                    <?php foreach ($consultant_type as $row) { ?>
                                        <option value="<?= $row['consultant_type_id'] ?>" <?php if($row['consultant_type_id'] == $get_consultant_info[0]->consultant_type_id){echo 'selected';} ?>><?= $row['type_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><span
                                        style="color: red">*</span>Fixed Salary Rate</label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" data-validate="required" id="fixed_salary_rate" name="fixed_salary_rate"
                                       placeholder="Fixed Salary Rate" value="<?= $get_consultant_info[0]->fixed_session_rate ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payment_type" class="col-sm-3 control-label"><span>*</span>Payment Type</label>
                            <div class="col-sm-5">
                                <select name="payment_type" id="payment_type"  class="select2" data-validate="required"
                                        data-allow-clear="true">
                                    <option value="Cash" <?php if($get_consultant_info[0]->payment_type == "Cash"){echo 'selected';} ?>>Cash</option>
                                    <option value="Bank" <?php if($get_consultant_info[0]->payment_type == "Bank"){echo 'selected';} ?>>Bank</option>
                                    <option value="Mobile" <?php if($get_consultant_info[0]->payment_type == "Mobile"){echo 'selected';} ?>>Mobile</option>
                                </select>
                                <span id="payment_type_err"></span>
                            </div>
                        </div>
                        <div id="bank_div" hidden class="form-group">
                            <div class="form-group">
                                <label for="bank_name" class="col-sm-3 control-label"><span>*</span>Bank Name</label>
                                <div class="col-sm-5">
                                    <select name="tbl_bank_payment_bank_id" id="tbl_bank_payment_bank_id"
                                            class="select2" data-validate="required"
                                            data-allow-clear="true" data-placeholder="Select Bank Name...">
                                        <?php if(sizeof($bank_info) != null) { ?>
                                            <option value="-1">---Select A Bank---</option>
                                            <?php foreach ($bank_info as $row){ ?>
                                                <option value="<?= $row['bank_id'] ?>" <?php if($row['bank_id'] == $get_consultant_info[0]->tbl_bank_payment_bank_id){echo 'selected';} ?>><?= $row['bank_name'] ?></option>
                                            <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bank_account_number" class="col-sm-3 control-label"><span>*</span>Bank Account Number</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="bank_account_number"
                                           name="bank_account_number" maxlength="25"
                                           placeholder="Enter Bank Account Number" value="<?= $get_consultant_info[0]->bank_account_number ?>" >
                                </div>
                            </div>
                        </div>
                        <div id="mobile_div" hidden>
                            <div class="form-group">
                                <label for="bank_account_number" class="col-sm-3 control-label"><span>*</span>Payment Method</label>
                                <div class="col-sm-5">
                                    <select name="mobile_payment_method_id" id="mobile_payment_method_id"
                                            class="select2" data-validate="required"
                                            data-allow-clear="true">
                                        <?php if(sizeof($payment_method) != null) { ?>
                                            <option value="-1">---Select A Method---</option>
                                            <?php foreach ($payment_method as $row){ ?>
                                                <option value="<?= $row['payment_method_id'] ?>" <?php if($row['payment_method_id'] == $get_consultant_info[0]->tbl_mobile_payment_method_id){echo 'selected';} ?>><?= $row['payment_method_name'] ?></option>
                                            <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bank_account_number" class="col-sm-3 control-label"><span>*</span>Mobile Number</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="mobile_payment_number"
                                           name="mobile_payment_number" maxlength="15" value="<?= $get_consultant_info[0]->mobile_payment_number ?>"
                                           placeholder="Enter Mobile Number" >
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="hidden" name="id" id="id" value="<?= $get_consultant_info[0]->consultant_user_id ?>">
                            <input type="hidden" name="salary_id" id="salary_id" value="<?= $get_consultant_info[0]->consultant_salary_id ?>">
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
    <script type="text/javascript">
        $(document).ready(function () {
            var get_payment_type = $('#payment_type').val();
            //alert(get_payment_type);
            if(get_payment_type == 'Cash'){
                document.getElementById('mobile_div').style.display="";
                document.getElementById('bank_div').style.display="";
            }
            if(get_payment_type == 'Bank')
            {
                document.getElementById('mobile_div').style.display = "";
                document.getElementById('bank_div').style.display="block";
            }
            if(get_payment_type == 'Mobile')
            {
                document.getElementById('bank_div').style.display = "";
                document.getElementById('mobile_div').style.display="block";
            }
        });
        $("#payment_type").change(function () {
            var selectedValue = $(this).val();
            if(selectedValue == 'Cash'){
                document.getElementById('mobile_div').style.display="";
                document.getElementById('bank_div').style.display="";
            }
            if(selectedValue == 'Bank')
            {
                document.getElementById('mobile_div').style.display = "";
                document.getElementById('bank_div').style.display="block";
            }
            if(selectedValue == 'Mobile')
            {
                document.getElementById('bank_div').style.display = "";
                document.getElementById('mobile_div').style.display="block";
            }
        });
    </script>
    <script src="<?= base_url() ?>asset/admin/js/selectboxit/jquery.selectBoxIt.min.js"></script>
</div>