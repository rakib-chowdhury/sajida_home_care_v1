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
                        Add Consultant Info<br>
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
                    <form role="form" action="<?= site_url('post_consultant_info') ?>"
                          onsubmit="return check_data()"
                          id='consultant_add_form' class="form-horizontal form-groups-bordered validate" method="post">
                        <div class="form-group">
                            <label for="consultant_user_id" class="col-sm-3 control-label">Consultant ID</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" disabled id="consultant_user_id"
                                       name="consultant_user_id"
                                       placeholder="This Will Be Auto-Generated">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><span
                                    style="color: red">*</span>Name</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-validate="required" id="name" name="name"
                                       placeholder="Consultant Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="col-sm-3 control-label"><span style="color: red">*</span>Phone
                                Number</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                       id="phone_number" name="phone_number" data-validate="required"
                                       data-numeric-align="right" placeholder="11 Numbers Right" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>

                            <div class="col-sm-5">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Enter Email ID">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">Address</label>

                            <div class="col-sm-5">
                                <textarea class="form-control autogrow" id="address" name="address"
                                          placeholder="Enter Address"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-5">
                                <textarea class="form-control autogrow" id="description" name="description"
                                          placeholder="Enter Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><span style="color: red">*</span>Consultant
                                Type</label>

                            <div class="col-sm-5">
                                <select name="tbl_consultant_type_consultant_type_id"
                                        id="tbl_consultant_type_consultant_type_id" class="select2">
                                    <option value="-1">Select a Consultancy Type</option>
                                    <?php foreach ($consultant_type as $row) { ?>
                                        <option
                                            value="<?= $row['consultant_type_id'] ?>"><?= $row['type_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <span id="type_error" name="type_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><span
                                        style="color: red">*</span>Fixed Salary Rate</label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" data-validate="required" id="fixed_salary_rate" name="fixed_salary_rate"
                                       placeholder="Fixed Salary Rate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payment_type" class="col-sm-3 control-label"><span>*</span>Payment Type</label>
                            <div class="col-sm-5">
                                <select name="payment_type" id="payment_type"  class="select2" data-validate="required"
                                        data-allow-clear="true">
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                    <option value="Mobile">Mobile</option>
                                </select>
                                <span id="payment_type_err"></span>
                            </div>
                        </div>
                        <div id="bank_div" hidden class="form-group">
                            <div class="form-group">
                                <label for="bank_name" class="col-sm-3 control-label">Bank Name</label>
                                <div class="col-sm-5">
                                    <select name="tbl_bank_payment_bank_id" id="tbl_bank_payment_bank_id"
                                            class="select2" data-validate="required"
                                            data-allow-clear="true" data-placeholder="Select Bank Name...">
                                        <?php if(sizeof($bank_info) != null) { ?>
                                            <option value="-1">---Select A Bank---</option>
                                            <?php foreach ($bank_info as $row){ ?>
                                                <option value="<?= $row['bank_id'] ?>"><?= $row['bank_name'] ?></option>
                                            <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bank_account_number" class="col-sm-3 control-label">Bank Account Number</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="bank_account_number"
                                           name="bank_account_number" readonly maxlength="25"
                                           placeholder="Enter Bank Account Number" >
                                </div>
                            </div>
                        </div>
                        <div id="mobile_div" hidden>
                            <div class="form-group">
                                <label for="bank_account_number" class="col-sm-3 control-label">Payment Method</label>
                                <div class="col-sm-5">
                                    <select name="mobile_payment_method_id" id="mobile_payment_method_id"
                                            class="select2" data-validate="required"
                                            data-allow-clear="true">
                                        <?php if(sizeof($payment_method) != null) { ?>
                                            <option value="-1">---Select A Method---</option>
                                            <?php foreach ($payment_method as $row){ ?>
                                                <option value="<?= $row['payment_method_id'] ?>"><?= $row['payment_method_name'] ?></option>
                                            <?php } }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bank_account_number" class="col-sm-3 control-label">Mobile Number</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="mobile_payment_number"
                                           name="mobile_payment_number" readonly maxlength="15"
                                           placeholder="Enter Mobile Number" >
                                </div>
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
            //console.log(type);
            if (type == -1) {
                var error = document.getElementById('type_error');
                error.style.color = 'red';
                error.innerHTML = 'Please Select a Consultancy Type.<br>';
                return false;
            }
            else {
                var error = document.getElementById('type_error');
                error.style.color = '';
                error.innerHTML = '';
               // $('#consultant_add_form').submit();
                return true;
            }
        }
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
        $('#tbl_bank_payment_bank_id').change(function () {
            //document.getElementById('bank_account_number').style.
            $("input[name='bank_account_number']").removeAttr( "readonly" );
        });
        $('#mobile_payment_method_id').change(function () {
            $("input[name='mobile_payment_number']").removeAttr( "readonly" );
        });
    </script>
</div>