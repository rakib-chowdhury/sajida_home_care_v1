<div class="main-content">

    <?php
    if (isset($top_header)) {

        echo $top_header;
    }
    ?>

    <hr/>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="panel-heading">
                    <div class="panel-title">
                        Add Patient <br>
                    </div>

                    <!--<div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>-->
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
                    <form id="patient_add_form" method="post" action="<?= site_url('patient/patient_add_post') ?>"
                          class="form-wizard validate" enctype="multipart/form-data">

                        <div class="steps-progress">
                            <div class="progress-indicator"></div>
                        </div>

                        <ul>
                            <li class="active">
                                <a href="#personal_info" data-toggle="tab"><span>1</span>Personal Info</a>
                            </li>
                            <li>
                                <a href="#care_engagement" data-toggle="tab"><span>2</span>Care Engagement</a>
                            </li>
                            <li>
                                <a href="#contacts" data-toggle="tab"><span>3</span>Contacts</a>
                            </li>
                            <li>
                                <a href="#final" data-toggle="tab"><span>4</span>Complete Profile</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="personal_info">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_id" class="control-label">Medical ID</label>
                                            <input type="text" class="form-control" id="patient_id"
                                                   placeholder="This Will Be Auto-Generated" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_name" class="control-label">Patient Name<span>*</span></label>
                                            <input type="text" class="form-control" id="patient_name"
                                                   name="patient_name"
                                                   data-validate="required" placeholder="Enter patient name">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_dob" class="control-label">DOB<span>*</span>(mm-dd-yyyy)</label>

                                            <div class="input-group">

                                                <input type="text" class="form-control datepicker"
                                                       id="patient_dob" data-date-end-date="+0d"
                                                       name="patient_dob" readonly data-validate="required"
                                                >

                                                <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="patient_gender" class="control-label">Gender</label>

                                                <br/>

                                                <div class="make-switch switch-small" data-on-label="M" data-off-label="F">
                                                    <input type="checkbox" id="patient_gender" onchange="chk_gender()" name="patient_gender" checked>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="patient_blood_group" class="control-label">Blood Group</label>

                                                <br/>
                                                <div class="input-group" style="width: 120%">
                                                    <select name="blood_group" class="select2" data-allow-clear="true"
                                                            data-placeholder="Select Blood Group...">
                                                        <option value="A+">A+</option>
                                                        <option value="A-">A-</option>
                                                        <option value="B+">B+</option>
                                                        <option value="B-">B-</option>
                                                        <option value="AB+">AB+</option>
                                                        <option value="AB-">AB-</option>
                                                        <option value="O+">O+</option>
                                                        <option value="O-">O-</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_id" class="control-label">National ID</label>
                                            <input type="text" class="form-control" id="patient_nid" minlength="10"
                                                   name="patient_nid" onkeyup="checkNumber(this.id)" maxlength="17"
                                                   placeholder="Enter patient's national ID card number">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="area_code" class="control-label">Area</label>
                                            <div>
                                                <select name="area_code" class="select2" data-allow-clear="true"
                                                        data-placeholder="Select one area...">
                                                    <option value=""></option>
                                                    <?php foreach ($area_info as $row) { ?>
                                                        <option
                                                            value="<?= $row['area_code_id'] ?>"><?= $row['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_phone" class="control-label">Phone Number<span>*</span></label>
                                            <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true" 
                                                   id="patient_phone" name="patient_phone" required min-length="11" min="0"
                                                   data-numeric-align="right" placeholder="11 Numbers Right" />
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_email" class="control-label">Patient Email</label>
                                            <input type="email" class="form-control" id="patient_email" name="patient_email"
                                                   placeholder="Enter patient's email address">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="patient_address">Patient Address<span>*</span></label>
                                            <textarea class="form-control autogrow" name="patient_address"
                                                      id="patient_address" data-validate="required" rows="4"
                                                      placeholder="Enter patient's address"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_image" class="control-label">Patient Image</label><br>
                                            <span id="p_img_err2"></span>
                                            <div>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail"
                                                         style="max-width: 200px; max-height: 150px;" data-trigger="fileinput">
                                                        <img src="http://placehold.it/200x150" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                         style="max-width: 200px; max-height: 150px"></div>
                                                    <div>
											<span class="btn btn-white btn-file">
												<span class="fileinput-new">Select image</span>
												<span class="fileinput-exists">Change</span>
												<input onchange="readURL(this);" type="file" name="patient_image" accept="image/*">
											</span>
                                                        <a href="#" class="btn btn-orange fileinput-exists"
                                                           data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                            <div class="tab-pane" id="care_engagement">

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="level_care" class="control-label">Level Care</label>
                                            <div>
                                                <select name="level_care" class="select2" data-validate="required"
                                                        data-allow-clear="true" data-placeholder="Select care plan...">
                                                    <?php if(sizeof($level_care_info) != null) { ?>
                                                    <?php foreach ($level_care_info as $row){ ?>
                                                    <option value="<?= $row['level_care_type_id'] ?>"><?= $row['level_name'] ?></option>
                                                    <?php } }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label for="patient_joining_date" class="control-label">Joining Date<span>*</span>(mm-dd-yyyy)</label>

                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" id="patient_joining_date"
                                                       name="patient_joining_date" data-date-end-date="+1m" readonly data-validate="required"
                                                >

                                                <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="referred_by" class="control-label">Referral Name</label>
                                            <div>
                                                <select name="referred_by" class="select2" data-allow-clear="true"
                                                        data-placeholder="Select referral name...">
                                                    <option value=""></option>
                                                    <?php if(sizeof($referral_info) != null) { ?>
                                                    <?php foreach ($referral_info as $row) { ?>
                                                    <option value="<?= $row['referral_id'] ?>"><?= $row['referral_name'] ?></option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="preferable_caregiver" class="control-label">Preferable Caregiver
                                                List</label>

                                            <div>
                                                <select name="preferable_caregiver[]" class="select2" multiple>
                                                    <?php if(sizeof($caregiver_info) != null){ ?>
                                                    <?php foreach ($caregiver_info as $row) { ?>
                                                    <option value="<?= $row->caregiver_user_id ?>"><?= $row->caregiver_name ?></option>
                                                    <?php }} ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane" id="contacts">

                                <strong>Emergency Contact<span>*</span></strong>
                                <br/>
                                <br/>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="emergency_contact_name" class="control-label">Name<span>*</span></label>
                                            <input type="text" class="form-control" id="emergency_contact_name"
                                                   name="emergency_contact_name" data-validate="required"
                                                   placeholder="Enter name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="emergency_contact_relationship" class="control-label">Relationship<span>*</span></label>
                                            <input type="text" class="form-control" id="emergency_contact_relationship"
                                                   name="emergency_contact_relationship" data-validate="required"
                                                   placeholder="Son, daughter or etc.">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="emergency_contact_phone" class="control-label">Phone
                                                Number<span>*</span></label>
                                            <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                                   id="emergency_contact_phone" name="emergency_contact_phone" data-validate="required"
                                                   data-numeric-align="right" placeholder="11 Numbers Right" min="0" />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for=" " class="control-label">Email</label>
                                            <input type="email" class="form-control" id="emergency_contact_email"
                                                   name="emergency_contact_email" placeholder="Enter email">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" for="emergency_contact_address">Address</label>
                                            <textarea class="form-control autogrow" name="emergency_contact_address"
                                                      id="emergency_contact_address" placeholder="Enter address"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <br/>

                                <strong>Family Contacts</strong>
                                <br/>
                                <br/>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="family_contact_name_1" class="control-label">Name</label>
                                            <input type="text" class="form-control" id="family_contact_name_1"
                                                   name="family_contact_name_1" placeholder="Enter name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_relationship_1" class="control-label">Relationship</label>
                                            <input type="text" class="form-control" id="family_contact_relationship_1"
                                                   name="family_contact_relationship_1"
                                                   placeholder="Son, daughter or etc.">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_phone_1" class="control-label">Phone
                                                Number</label>
                                            <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                                   id="family_contact_phone_1" name="family_contact_phone_1" min="0"
                                                   data-numeric-align="right" placeholder="11 Numbers Right" />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_email_1" class="control-label">Email</label>
                                            <input type="email" class="form-control" id="family_contact_email_1"
                                                   name="family_contact_email_1" placeholder="Enter email">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" for="family_contact_address_1">Address</label>
                                            <textarea class="form-control autogrow" name="family_contact_address_1"
                                                      id="family_contact_address_1"
                                                      placeholder="Enter address"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="family_contact_name_2" class="control-label">Name</label>
                                            <input type="text" class="form-control" id="family_contact_name_2"
                                                   name="family_contact_name_2" placeholder="Enter name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_relationship_2" class="control-label">Relationship</label>
                                            <input type="text" class="form-control" id="family_contact_relationship_2"
                                                   name="family_contact_relationship_2"
                                                   placeholder="Son, daughter or etc.">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_phone_2" class="control-label">Phone
                                                Number</label>
                                            <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                                   id="family_contact_phone_2" name="family_contact_phone_2" min="0"
                                                   data-numeric-align="right" placeholder="11 Numbers Right" />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_email_2" class="control-label">Email</label>
                                            <input type="email" class="form-control" id="family_contact_email_2"
                                                   name="family_contact_email_2" placeholder="Enter email">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" for="family_contact_address_2">Address</label>
                                            <textarea class="form-control autogrow" name="family_contact_address_2"
                                                      id="family_contact_address_2"
                                                      placeholder="Enter address"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="family_contact_name_3" class="control-label">Name</label>
                                            <input type="text" class="form-control" id="family_contact_name_3"
                                                   name="family_contact_name_3" placeholder="Enter name">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_relationship_3" class="control-label">Relationship</label>
                                            <input type="text" class="form-control" id="family_contact_relationship_3"
                                                   name="family_contact_relationship_3"
                                                   placeholder="Son, daughter or etc.">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_phone_3" class="control-label">Phone
                                                Number</label>
                                            <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                                   id="family_contact_phone_3" name="family_contact_phone_3" min="0"
                                                   data-numeric-align="right" placeholder="11 Numbers Right" />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_email_3" class="control-label">Email</label>
                                            <input type="email" class="form-control" id="family_contact_email_3"
                                                   name="family_contact_email_3" placeholder="Enter email">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" for="family_contact_address_3">Address</label>
                                            <textarea class="form-control autogrow" name="family_contact_address_3"
                                                      id="family_contact_address_3"
                                                      placeholder="Enter address"></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="tab-pane" id="final">


<!--                                <div class="form-group">-->
<!--                                    <div class="checkbox checkbox-replace">-->
<!--                                        <input type="checkbox" name="chk-rules" id="chk-rules" data-validate="required"-->
<!--                                               data-message-message="You must accept rules in order to complete this registration.">-->
<!--                                        <label for="chk-rules">By registering I accept terms and conditions.</label>-->
<!--                                    </div>-->
<!--                                </div>-->

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Information</button>
                                </div>

                            </div>

                            <ul class="pager wizard">
                                <li class="previous">
                                    <a href="#"><i class="entypo-left-open"></i> Previous</a>
                                </li>

                                <li class="next">
                                    <a href="#">Next <i class="entypo-right-open"></i></a>
                                </li>
                            </ul>
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

    <script src="<?php echo base_url() ?>asset/admin/js/select2/select2.min.js"></script>
    <script src="<?php echo base_url() ?>asset/admin/js/bootstrap-timepicker.min.js"></script>
    <script>

        var img_extn = ['png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG'];
        function readURL(input) {
            if (input.files && input.files[0]) {
                var i_name = input.files[0]['name'].split('.');

                var img = false;
                $.each(img_extn, function (i, v) {
                    if (i_name[i_name.length - 1] == v) {
                        img = true;
                    }
                });
                if (input.files[0]['size'] > 3145728) {///1mb=1048576 bytes
                    img = false;
                }
                if (img == false) {
                    var x = document.getElementById('p_img_err2');
                    x.style.color = 'red';
                    x.innerText = 'Image should be png/PNG/jpg/JPG/jpeg/JPEG format and Image size should be less than 3 mb.';
                    document.getElementById('myBtn').disabled = true;
                    document.getElementById('p_img').value = '';
                } else {
                    var x = document.getElementById('p_img_err2');
                    x.style.color = 'red';
                    x.innerText = '';
                    document.getElementById('myBtn').disabled = false;
                    var reader = new FileReader();
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }
        $(document).ready(function () {
            // var d = new Date();
            $("#patient_dob").datepicker();
            $("#patient_dob").datepicker("max", new Date());
            $("#patient_joining_date").datepicker();
            $("#patient_joining_date").datepicker("max", new Date());

        });
    </script>
    <script>
        function chk_gender()
        {
            if($(this).prop("checked") == true){
                document.getElementById('patient_gender').value = 1;
            }
            else
            {
                document.getElementById('patient_gender').value = 0;
            }
        }
        function checkNumber(id) {
            var tmp_num = $('#' + id).val();
            tmp_num = tmp_num.replace(/\s+/g, '');

            $('#' + id).val(tmp_num);
            var tmp_num = $('#' + id).val();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
        }
//        $(document).ready(function () {
        //            // var d = new Date();
        //            $('.select2').dropdown({
        //                searchable: true
        //            })
        //        });
    </script>
</div>