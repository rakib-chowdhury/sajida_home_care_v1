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
                        Edit Caregiver <br>
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
                    <form id="caregiver_edit_form" method="post"
                          action="<?= site_url('caregiver/caregiver_edit_post') ?>"
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
                                            <input type="text" class="form-control" id="caregiver_user_id"
                                                   name="caregiver_user_id"
                                                <?php if (isset($get_caregiver[0]['caregiver_user_id'])) { ?>
                                                    value="<?= $get_caregiver[0]['caregiver_user_id'] ?>" <?php } ?>
                                                   disabled>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" id="id"
                                           value="<?= $get_caregiver[0]['caregiver_user_id'] ?>">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="caregiver_name" class="control-label">Caregiver Name</label>
                                            <input type="text" class="form-control" id="caregiver_name"
                                                   name="caregiver_name"
                                                   required <?php if (isset($get_caregiver[0]['caregiver_name'])) { ?>
                                                value="<?= $get_caregiver[0]['caregiver_name'] ?>" <?php } ?>
                                                   data-validate="required" placeholder="Enter Caregiver Name">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="caregiver_nid" class="control-label">Caregiver NID</label>
                                            <input type="number" class="form-control"
                                                   id="caregiver_nid" <?php if (isset($get_caregiver[0]['caregiver_name'])) { ?>
                                                value="<?= $get_caregiver[0]['NID_number'] ?>" <?php } ?>
                                                   name="caregiver_nid" placeholder="Enter Caregiver NID">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="caregiver_dob" class="control-label">DOB(mm/dd/yyyy)</label>

                                            <div class="input-group">
                                                <input type="text" required class="form-control datepicker input-mini"
                                                       id="caregiver_dob"
                                                       name="caregiver_dob" readonly
                                                       data-validate="required"
                                                    <?php $new_date = explode('-', $get_caregiver[0]['DOB']); ?>
                                                       value="<?= $new_date[1] . '/' . $new_date[2] . '/' . $new_date[0] ?>"
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
                                                <div class="make-switch switch-small"
                                                    <?php if ($get_caregiver[0]['gender'] == 0) { ?>
                                                        data-on-label='M'
                                                        data-off-label='F'<?php }else{ ?>
                                                     data-on-label='F'
                                                     data-off-label='M'<?php } ?>">
                                                <input type="checkbox" id="cg_gender" name="cg_gender" >
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
                                                    <option value="A+" <?php if($get_caregiver[0]['blood_group'] == "A+"){echo "selected";} ?>>A+</option>
                                                    <option value="A-" <?php if($get_caregiver[0]['blood_group'] == "A-"){echo "selected";} ?>>A-</option>
                                                    <option value="B+" <?php if($get_caregiver[0]['blood_group'] == "B+"){echo "selected";} ?>>B+</option>
                                                    <option value="B-" <?php if($get_caregiver[0]['blood_group'] == "B-"){echo "selected";} ?>>B-</option>
                                                    <option value="AB+" <?php if($get_caregiver[0]['blood_group'] == "AB+"){echo "selected";} ?>>AB+</option>
                                                    <option value="AB-" <?php if($get_caregiver[0]['blood_group'] == "AB-"){echo "selected";} ?>>AB-</option>
                                                    <option value="O+" <?php if($get_caregiver[0]['blood_group'] == "O+"){echo "selected";} ?>>O+</option>
                                                    <option value="O-" <?php if($get_caregiver[0]['blood_group'] == "O-"){echo "selected";} ?>>O-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number" class="control-label">Phone Number</label>

                                        <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                               id="phone_number" name="phone_number" data-validate="required" min="0"
                                            <?php if ($get_caregiver[0]['cg_phone'] != null) { ?>
                                               value="<?= $get_caregiver[0]['cg_phone'] ?>" <?php }else{ ?>value=""<?php } ?>
                                               data-numeric-align="right" placeholder="11 Numbers Right" />
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Caregiver Email</label>
                                        <input class="form-control" id="email" type="email"
                                               name="email" <?php if (isset($get_caregiver[0]['email'])) { ?>
                                            value="<?= $get_caregiver[0]['email'] ?>" <?php } ?>
                                               placeholder="Enter patient's email address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="caregiver_address">Caregiver Address</label>
                                            <textarea class="form-control autogrow" name="caregiver_address"
                                                      id="caregiver_address" data-validate="required" rows="4"
                                                      placeholder="Enter caregiver_address's address"><?php if (isset($get_caregiver[0]['cg_address'])) { ?><?= $get_caregiver[0]['cg_address'] ?><?php } ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stored_document" class="control-label">Stored Document</label>
                                        <input type="text" class="form-control" id="stored_document"
                                               name="stored_document"
                                            <?php if (isset($get_caregiver[0]['stored_document'])) { ?>
                                                value="<?= $get_caregiver[0]['stored_document'] ?>" <?php } ?>
                                               placeholder="Enter Stored Document">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="educational_background" class="control-label">Educational
                                            Background</label>
                                        <input type="text" class="form-control" id="educational_background"
                                               name="educational_background"
                                               placeholder="Enter Educational Background" <?php if (isset($get_caregiver[0]['educational_background'])) { ?>
                                            value="<?= $get_caregiver[0]['educational_background'] ?>" <?php } ?>>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="patient_image" class="control-label">Caregiver Image</label><br>
                                        <span id="c_img_err2"></span>
                                        <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail"
                                                     style="max-width: 200px; max-height: 150px;" data-trigger="fileinput">
                                                    <img
                                                        src="<?php $img = filemtime($get_caregiver[0]['picture']);
                                                        echo site_url($get_caregiver[0]['picture']."?".$img);
                                                        ?>"
                                                        alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                     style="max-width: 200px; max-height: 150px"></div>
                                                <div>
											<span class="btn btn-white btn-file">
												<span class="fileinput-new">Select image</span>
												<span class="fileinput-exists">Change</span>
												<input onchange="readURL(this);" type="file" name="caregiver_image"
                                                       accept="image/*">
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
                                                <?php if (sizeof($level_care) != null) { ?>
                                                    <?php foreach ($level_care as $row) { ?>
                                                        <option
                                                            value="<?= $row['level_care_type_id'] ?>" <?php if ($row['level_care_type_id'] == $caregiver_info[0]['level_care_type_id']) {
                                                            echo 'selected';
                                                        } ?>><?= $row['level_name'] ?></option>
                                                    <?php }
                                                } ?>
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
                                                <?php if (sizeof($engagement_type) != null) { ?>
                                                    <?php foreach ($engagement_type as $row) { ?>
                                                        <option
                                                            value="<?= $row['caregiver_engagment_type_id'] ?>" <?php if ($row['caregiver_engagment_type_id'] == $get_caregiver[0]['tbl_caregiver_engagment_type_caregiver_engagment_type_id']) {
                                                            echo 'selected';
                                                        } ?>><?= $row['engagement_name'] ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="preferable_caregiver" class="control-label">Caregiver
                                            Availability</label>

                                        <div>
                                            <select name="caregiver_availability[]" class="select2" multiple>
                                                <option value="Sunday" <?php if ($caregiver_info[0]['Sunday'] == 1) {
                                                    echo 'selected';
                                                } ?>>Sunday
                                                </option>
                                                <option value="Monday" <?php if ($caregiver_info[0]['Monday'] == 1) {
                                                    echo 'selected';
                                                } ?>>Monday
                                                </option>
                                                <option value="Tuesday" <?php if ($caregiver_info[0]['Tuesday'] == 1) {
                                                    echo 'selected';
                                                } ?>>Tuesday
                                                </option>
                                                <option
                                                    value="Wednesday" <?php if ($caregiver_info[0]['Wednesday'] == 1) {
                                                    echo 'selected';
                                                } ?>>Wednesday
                                                </option>
                                                <option
                                                    value="Thursday" <?php if ($caregiver_info[0]['Thursday'] == 1) {
                                                    echo 'selected';
                                                } ?>>Thursday
                                                </option>
                                                <option value="Friday" <?php if ($caregiver_info[0]['Friday'] == 1) {
                                                    echo 'selected';
                                                } ?>>Friday
                                                </option>
                                                <option
                                                    value="Saturday" <?php if ($caregiver_info[0]['Saturday'] == 1) {
                                                    echo 'selected';
                                                } ?>>Saturday
                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="joining_date" class="control-label">Joining Date(mm-dd-yyyy)</label>

                                    <div class="input-group">
                                        <input type="text" required class="form-control datepicker" id="joining_date"
                                               name="joining_date" readonly data-date-end-date="+0d"
                                               data-validate="required"
                                            <?php $new_date = explode('-', $get_caregiver[0]['joining_date']); ?>
                                               value="<?= $new_date[1].'/'.$new_date[2].'/'.$new_date[0] ?>"
                                        >

                                        <div class="input-group-addon">
                                            <a href="#"><i class="entypo-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="fixed_salary_rate" class="control-label">Fixed Salary Rate</label>

                                    <div class="input-group">
                                        <input type="number" required class="form-control" id="fixed_salary_rate"
                                               name="fixed_salary_rate"
                                               value="<?= $caregiver_salary[0]['fixed_salary_rate'] ?>"
                                        >
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="hourly_salary_rate" class="control-label">Hourly Salary Rate</label>

                                    <div class="input-group">
                                        <input type="number" required class="form-control" id="hourly_salary_rate"
                                               name="hourly_salary_rate"
                                               value="<?= $caregiver_salary[0]['hourly_salary_rate'] ?>"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="payment_type" class="control-label">Payment Type</label>
                                        <div>
                                            <select name="payment_type" id="payment_type" onload="chk()" class="select2"
                                                    data-validate="required"
                                                    data-allow-clear="true" data-placeholder="Select Payment Type...">
                                                <option
                                                    value="Cash" <?php if ($caregiver_salary[0]['payment_type'] == 'Cash') {
                                                    echo 'selected';
                                                } ?>>Cash
                                                </option>
                                                <option
                                                    value="Bank" <?php if ($caregiver_salary[0]['payment_type'] == 'Bank') {
                                                    echo 'selected';
                                                } ?>>Bank
                                                </option>
                                                <option
                                                    value="Mobile" <?php if ($caregiver_salary[0]['payment_type'] == 'Mobile') {
                                                    echo 'selected';
                                                } ?>>Mobile
                                                </option>
                                            </select>
                                            <span id="payment_type_err"></span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="check_payment" id="check_payment"
                                       value="<?= $caregiver_salary[0]['payment_type'] ?>">
                                <input type="hidden" name="salary_id" id="salary_id"
                                       value="<?= $caregiver_salary[0]['caregiver_salary_id'] ?>">
                                <!--                                --><?php //if($caregiver_salary[0]['payment_type'] == 'Mobile'){ ?>
                                <div class="col-md-8" id="mobile_div" hidden>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bank_account_number" class="control-label">Payment Method</label>
                                                <div>
                                                    <select name="mobile_payment_method_id"
                                                            class="select2" data-validate="required"
                                                            data-allow-clear="true">
                                                        <?php if(sizeof($payment_method) != null) { ?>
                                                            <option value="-1">---Select A Method---</option>
                                                            <?php foreach ($payment_method as $row){ ?>
                                                                <option value="<?= $row['payment_method_id'] ?>"<?php if($row['payment_method_id'] == $caregiver_salary[0]['tbl_mobile_payment_method_id']){echo 'selected';} ?>><?= $row['payment_method_name'] ?></option>
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
                                                           name="mobile_payment_number"
                                                           value="<?php if (isset($caregiver_salary[0]['mobile_payment_number'])) {
                                                               echo $caregiver_salary[0]['mobile_payment_number'];
                                                           } ?>"
                                                           placeholder="Enter Mobile Number">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--                                --><?php //} ?>
                                <!--                                --><?php //if($caregiver_salary[0]['payment_type'] == 'Bank'){ ?>
                                <div class="col-md-8" id="bank_div" hidden>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bank_account_number" class="control-label">Bank Name</label>
                                                <div>
                                                    <select name="tbl_bank_payment_bank_id"
                                                            class="select2" data-validate="required"
                                                            data-allow-clear="true" data-placeholder="Select Bank Name...">
                                                        <?php if(sizeof($bank_info) != null) { ?>
                                                            <option value="-1">---Select A Bank---</option>
                                                            <?php foreach ($bank_info as $row){ ?>
                                                                <option value="<?= $row['bank_id'] ?>"<?php if($row['bank_id'] == $caregiver_salary[0]['tbl_bank_payment_bank_id']){echo 'selected';} ?>><?= $row['bank_name'] ?></option>
                                                            <?php } }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bank_account_number" class="control-label">Bank Account Number</label>
                                                <div>
                                                    <input type="number" class="form-control" id="bank_account_number"
                                                           name="bank_account_number"
                                                           value="<?php if (isset($caregiver_salary[0]['bank_account_number'])) {
                                                               echo $caregiver_salary[0]['bank_account_number'];
                                                           } ?>"
                                                           placeholder="Enter Bank Account Number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--                                --><?php //} ?>
                            </div>
                        </div>

                        <div class="tab-pane" id="contacts">

                            <strong>Emergency Contact</strong>
                            <br/>
                            <br/>

                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="emergency_contact_name" class="control-label">Name</label>
                                        <input type="text" class="form-control" id="emergency_contact_name"
                                               name="emergency_contact_name" data-validate="required"
                                               placeholder="Enter name"
                                               value="<?= $emergency_contact[0]['family_contact_name'] ?>">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="emergency_contact_relationship"
                                               class="control-label">Relationship</label>
                                        <input type="text" class="form-control" id="emergency_contact_relationship"
                                               name="emergency_contact_relationship" data-validate="required"
                                               placeholder="Son, daughter or etc."
                                               value="<?= $emergency_contact[0]['relationship'] ?>">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="emergency_contact_phone" class="control-label">Phone
                                            Number</label>
                                        <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                               id="emergency_contact_phone" name="emergency_contact_phone" data-validate="required" min="0"
                                            <?php if ($emergency_contact[0]['phone_number'] != null) { ?>
                                                value="<?= $emergency_contact[0]['phone_number'] ?>" <?php }else{ ?>value=""<?php } ?>
                                               data-numeric-align="right" placeholder="11 Numbers Right" />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for=" " class="control-label">Email</label>
                                        <input type="email" class="form-control" id="emergency_contact_email"
                                               name="emergency_contact_email"
                                               placeholder="Enter email" value="<?= $emergency_contact[0]['email'] ?>">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="emergency_contact_address">Address</label>
                                            <textarea class="form-control autogrow" name="emergency_contact_address"
                                                      id="emergency_contact_address"
                                                      placeholder="Enter address"><?= $emergency_contact[0]['address'] ?></textarea>
                                    </div>
                                </div>
                                <input type="hidden" id="emergency_contact" name="emergency_contact"
                                       value="<?= $emergency_contact[0]['caregiver_family_contact_id'] ?>">

                            </div>

                            <br/>

                            <strong>Family Contacts</strong>
                            <br/>
                            <br/>

                            <div class="row">
                                <input type="hidden" name="contact1_id" id="contact1_id"
                                       value="<?php if ($family_contact_id_1) {
                                           echo $family_contact_id_1;
                                       } ?>">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="family_contact_name_1" class="control-label">Name</label>
                                        <input type="text" class="form-control" id="family_contact_name_1"
                                               name="family_contact_name_1"
                                               placeholder="Enter name" <?php if ($family_contact_name_1) { ?>
                                            value="<?= $family_contact_name_1 ?>" <?php } ?> >
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="family_contact_relationship_1"
                                               class="control-label">Relationship</label>
                                        <input type="text" class="form-control" id="family_contact_relationship_1"
                                               name="family_contact_relationship_1" <?php if ($family_contact_relationship_1) { ?>
                                            value="<?= $family_contact_relationship_1 ?>" <?php } ?>
                                               placeholder="Son, daughter or etc.">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="family_contact_phone_1" class="control-label">Phone
                                            Number</label>
                                        <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                               id="family_contact_phone_1" name="family_contact_phone_1" min="0"
                                            <?php if ($family_contact_phone_1) { ?>
                                                value="<?= $family_contact_phone_1 ?>" <?php }else{ ?>value=""<?php } ?>
                                               data-numeric-align="right" placeholder="11 Numbers Right" />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="family_contact_email_1" class="control-label">Email</label>
                                        <input type="email" class="form-control" id="family_contact_email_1"
                                               name="family_contact_email_1"
                                               placeholder="Enter email" <?php if ($family_contact_email_1) { ?>
                                            value="<?= $family_contact_email_1 ?>" <?php } ?>>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="family_contact_address_1">Address</label>
                                            <textarea class="form-control autogrow" name="family_contact_address_1"
                                                      id="family_contact_address_1"
                                                      placeholder="Enter address"><?php if ($family_contact_address_1) {
                                                    echo $family_contact_address_1;
                                                } ?></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <input type="hidden" name="contact2_id" id="contact2_id"
                                       value="<?php if ($family_contact_id_2) {
                                           echo $family_contact_id_2;
                                       } ?>">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="family_contact_name_2" class="control-label">Name</label>
                                        <input type="text" class="form-control" id="family_contact_name_2"
                                               name="family_contact_name_2"
                                               placeholder="Enter name" <?php if ($family_contact_name_2) { ?>
                                            value="<?= $family_contact_name_2 ?>" <?php } ?>>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="family_contact_relationship_2"
                                               class="control-label">Relationship</label>
                                        <input type="text" class="form-control" id="family_contact_relationship_2"
                                               name="family_contact_relationship_2" <?php if ($family_contact_relationship_2) { ?>
                                            value="<?= $family_contact_relationship_2 ?>" <?php } ?>
                                               placeholder="Son, daughter or etc.">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="family_contact_phone_2" class="control-label">Phone
                                            Number</label>
                                        <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                               id="family_contact_phone_2" name="family_contact_phone_2" min="0"
                                            <?php if ($family_contact_phone_2) { ?>
                                                value="<?= $family_contact_phone_2 ?>" <?php }else{ ?>value=""<?php } ?>
                                               data-numeric-align="right" placeholder="11 Numbers Right" />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="family_contact_email_2" class="control-label">Email</label>
                                        <input type="email" class="form-control" id="family_contact_email_2"
                                               name="family_contact_email_2"
                                               placeholder="Enter email" <?php if ($family_contact_email_2) { ?>
                                            value="<?= $family_contact_email_2 ?>" <?php } ?>>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="family_contact_address_2">Address</label>
                                            <textarea class="form-control autogrow" name="family_contact_address_2"
                                                      id="family_contact_address_2"
                                                      placeholder="Enter address"><?php if ($family_contact_address_2) {
                                                    echo $family_contact_address_2;
                                                } ?></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <input type="hidden" name="contact3_id" id="contact3_id"
                                       value="<?php if ($family_contact_id_3) {
                                           echo $family_contact_id_3;
                                       } ?>">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="family_contact_name_3" class="control-label">Name</label>
                                        <input type="text" class="form-control" id="family_contact_name_3"
                                               name="family_contact_name_3"
                                               placeholder="Enter name" <?php if ($family_contact_name_3) { ?>
                                            value="<?= $family_contact_name_3 ?>" <?php } ?>>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="family_contact_relationship_3"
                                               class="control-label">Relationship</label>
                                        <input type="text" class="form-control" id="family_contact_relationship_3"
                                               name="family_contact_relationship_3" <?php if ($family_contact_relationship_3) { ?>
                                            value="<?= $family_contact_relationship_3 ?>" <?php } ?>
                                               placeholder="Son, daughter or etc.">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="family_contact_phone_3" class="control-label">Phone
                                            Number</label>
                                        <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true"
                                               id="family_contact_phone_3" name="family_contact_phone_3" min="0"
                                            <?php if ($family_contact_phone_3 ){ ?>
                                                value="<?= $family_contact_phone_3 ?>" <?php }else{ ?>value=""<?php } ?>
                                               data-numeric-align="right" placeholder="11 Numbers Right" />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="family_contact_email_3" class="control-label">Email</label>
                                        <input type="email" class="form-control" id="family_contact_email_3"
                                               name="family_contact_email_3" placeholder="Enter email"
                                            <?php if ($family_contact_email_3) { ?>
                                                value="<?= $family_contact_email_3 ?>" <?php } ?>>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="family_contact_address_3">Address</label>
                                            <textarea class="form-control autogrow" name="family_contact_address_3"
                                                      id="family_contact_address_3"
                                                      placeholder="Enter address"><?php if ($family_contact_address_3) {
                                                    echo $family_contact_address_3;
                                                } ?></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="tab-pane" id="final">


<!--                            <div class="form-group">-->
<!--                                <div class="checkbox checkbox-replace">-->
<!--                                    <input type="checkbox" name="chk-rules" id="chk-rules" data-validate="required"-->
<!--                                           data-message-message="You must accept rules in order to complete this registration.">-->
<!--                                    <label for="chk-rules">By registering I accept terms and conditions.</label>-->
<!--                                </div>-->
<!--                            </div>-->

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
<script type="text/javascript">
    function chk_gender() {
        if ($(this).prop("checked") == true) {
            document.getElementById('caregiver_gender').value = 1;
        }
        else {
            document.getElementById('caregiver_gender').value = 0;
        }
    }
    $("#payment_type").change(function () {
        var selectedValue = $(this).val();
        if (selectedValue == 'Cash') {
            document.getElementById('mobile_div').style.display = "";
            document.getElementById('bank_div').style.display = "";
        }
        if (selectedValue == 'Bank') {
            document.getElementById('mobile_div').style.display = "";
            document.getElementById('bank_div').style.display = "block";
        }
        if (selectedValue == 'Mobile') {
            document.getElementById('bank_div').style.display = "";
            document.getElementById('mobile_div').style.display = "block";
        }

    });
    function chk() {
        $("#payment_type").load(function () {
            var selectedValue = $(this).val();
            console.log(selectedValue);
            if (selectedValue == 'Cash') {
                document.getElementById('mobile_div').style.display = "";
                document.getElementById('bank_div').style.display = "";
            }
            if (selectedValue == 'Bank') {
                document.getElementById('mobile_div').style.display = "";
                document.getElementById('bank_div').style.display = "block";
            }
            if (selectedValue == 'Mobile') {
                document.getElementById('bank_div').style.display = "";
                document.getElementById('mobile_div').style.display = "block";
            }

        });
    }
    $("#payment_type").ready(function () {
        var selectedValue = $('#check_payment').val();

        //console.log(selectedValue);
        if (selectedValue == 'Cash') {
            document.getElementById('mobile_div').style.display = "";
            document.getElementById('bank_div').style.display = "";
        }
        if (selectedValue == 'Bank') {
            document.getElementById('mobile_div').style.display = "";
            document.getElementById('bank_div').style.display = "block";
        }
        if (selectedValue == 'Mobile') {
            document.getElementById('bank_div').style.display = "";
            document.getElementById('mobile_div').style.display = "block";
        }

    });
    $(document).ready(function () {
         var d = new Date();
        //$("#caregiver_dob").datepicker();
        //$("#caregiver_dob").datepicker("max", new Date());
        $("#joining_date").datepicker();
    });

</script>
</div>