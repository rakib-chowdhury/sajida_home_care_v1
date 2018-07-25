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
                        Add Caregiver <br>
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
                    <form id="caregiver_add_form" method="post" action="<?= site_url('caregiver/caregiver_add_post') ?>"
                          class="form-wizard validate" enctype="multipart/form-data">

                        <div class="steps-progress">
                            <div class="progress-indicator"></div>
                        </div>

                        <ul>
                            <li class="active">
                                <a href="#basic_info" data-toggle="tab"><span>1</span>Basic Info</a>
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
                            <div class="tab-pane active" id="basic_info">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="caregiver_user_id" class="control-label">Caregiver ID</label>
                                            <input type="text" class="form-control" id="caregiver_user_id" name="caregiver_user_id"
                                                   placeholder="This Will Be Auto-Generated" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="caregiver_name" class="control-label">Caregiver Name<span>*</span></label>
                                            <input type="text" class="form-control" id="caregiver_name"
                                                   name="caregiver_name" required
                                                   data-validate="required" placeholder="Enter Caregiver Name">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="caregiver_nid" class="control-label">Caregiver NID</label>
                                            <input type="number" class="form-control" id="caregiver_nid" minlength="10"
                                                   maxlength="17"
                                                   name="caregiver_nid" placeholder="Enter Caregiver NID">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="caregiver_dob" class="control-label">DOB<span>*</span></label>

                                            <div class="input-group">
                                                <input type="text" required class="form-control datepicker input-mini" id="caregiver_dob" data-date-end-date="+0d"
                                                        name="caregiver_dob" readonly data-validate="required" data-format="yyyy-mm-dd"
                                                >

                                                <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="patient_gender" class="control-label">Gender</label>

                                                <br/>

                                                <div class="make-switch switch-small" data-on-label="M" data-off-label="F">
                                                    <input type="checkbox" id="caregiver_gender" onchange="chk_gender()" name="caregiver_gender" checked>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="caregiver_blood_group" class="control-label">Blood Group</label>

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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone_number" class="control-label">Phone Number<span>*</span></label>
                                            <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                                   id="phone_number" name="phone_number" data-validate="required" min="0"
                                                   data-numeric-align="right" placeholder="11 Numbers Right" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="control-label">Caregiver Email</label>
                                            <input class="form-control" id="email" name="email"
                                                   placeholder="Enter patient's email address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="caregiver_address">Caregiver Address<span>*</span></label>
                                            <textarea class="form-control autogrow" name="caregiver_address"
                                                      id="caregiver_address" data-validate="required" rows="4"
                                                      placeholder="Enter Address"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stored_document" class="control-label">Stored Document</label>
                                            <input type="text" class="form-control" id="stored_document" name="stored_document"
                                                   placeholder="Enter Stored Document">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="educational_background" class="control-label">Educational Background</label>
                                            <input type="text" class="form-control" id="educational_background" name="educational_background"
                                                   placeholder="Enter Educational Background">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_image" class="control-label">Caregiver Image<span>*</span></label><br>
                                            <span id="c_img_err2"></span>
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
												<input onchange="readURL(this);" type="file" required name="caregiver_image" accept="image/*">
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

                                            <label for="tbl_caregiver_engagment_type_caregiver_engagment_type_id"
                                                   class="control-label">Engagement Type</label>

                                            <div>
                                                <select name="tbl_caregiver_engagment_type_caregiver_engagment_type_id"
                                                        class="select2" data-validate="required"
                                                        data-allow-clear="true" data-placeholder="Select care plan...">
                                                    <?php if(sizeof($engagement_type) != null) { ?>
                                                        <?php foreach ($engagement_type as $row){ ?>
                                                            <option value="<?= $row['caregiver_engagment_type_id'] ?>"><?= $row['engagement_name'] ?></option>
                                                        <?php } }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="joining_date" class="control-label">Joining Date <span>*</span></label>

                                        <div class="input-group">
                                            <input type="text" required class="form-control datepicker" id="joining_date"
                                                   name="joining_date" readonly data-validate="required" data-date-end-date="+1m"
                                            >

                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="fixed_salary_rate" class="control-label">Fixed Salary Rate</label>

                                        <div class="input-group">
                                            <input type="number" class="form-control" id="fixed_salary_rate"
                                                   name="fixed_salary_rate">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="hourly_salary_rate" class="control-label">Hourly Salary Rate</label>

                                        <div class="input-group">
                                            <input type="number" class="form-control" id="hourly_salary_rate"
                                                   name="hourly_salary_rate">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="preferable_caregiver" class="control-label">Caregiver Availability</label>

                                            <div>
                                                <select name="caregiver_availability[]" class="select2" multiple>
                                                    <option value="Sunday">Sunday</option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                    <option value="Friday">Friday</option>
                                                    <option value="Saturday">Saturday</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="payment_type" class="control-label">Payment Type <span>*</span></label>
                                        <div>
                                            <select name="payment_type" id="payment_type" onchange="type_check()"  class="select2" data-validate="required"
                                                    data-allow-clear="true" data-placeholder="Select care plan...">
                                                <option value="Cash">Cash</option>
                                                <option value="Bank">Bank</option>
                                                <option value="Mobile">Mobile</option>
                                            </select>
                                            <span id="payment_type_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-8" hidden id="bank_div">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bank_name" class="control-label">Bank Name</label>
                                                    <div>
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
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bank_account_number" class="control-label">Bank Account Number</label>
                                                    <div>
                                                        <input type="text" class="form-control" id="bank_account_number"
                                                               name="bank_account_number" readonly
                                                               placeholder="Enter Bank Account Number" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8" hidden id="mobile_div">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bank_account_number" class="control-label">Payment Method</label>
                                                    <div>
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
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bank_account_number" class="control-label">Mobile Number</label>
                                                    <div>
                                                        <input type="number" class="form-control" id="mobile_payment_number"
                                                               name="mobile_payment_number" readonly
                                                               placeholder="Enter Mobile Number" >
                                                    </div>
                                                </div>
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
                                <li class="previous" id="previous">
                                    <a href="#"><i class="entypo-left-open"></i> Previous</a>
                                </li>

                                <li class="next" id="next">
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
                    var x = document.getElementById('c_img_err2');
                    x.style.color = 'red';
                    x.innerText = 'Image should be png/PNG/jpg/JPG/jpeg/JPEG format and Image size should be less than 3 mb.';
                    document.getElementById('next').disabled = true;
                    document.getElementById('p_img').value = '';
                } else {
                    var x = document.getElementById('c_img_err2');
                    x.style.color = 'red';
                    x.innerText = '';
                    document.getElementById('next').disabled = false;
                    var reader = new FileReader();
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }

    </script>
    <script>
        function chk_gender() {
            if($(this).prop("checked") == true){
                document.getElementById('caregiver_gender').value = 1;
            }
            else
            {
                document.getElementById('caregiver_gender').value = 0;
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
//        $(document).ready(function () {
//            // var d = new Date();
//
//        });
        $(document).ready(function () {
            // var d = new Date();
            $("#caregiver_dob").datepicker();
            //$("#caregiver_dob").datepicker("max", new Date());
            $("#joining_date").datepicker();
           // $("#joining_date").datepicker("max", new Date());
        });
    </script>
</div>