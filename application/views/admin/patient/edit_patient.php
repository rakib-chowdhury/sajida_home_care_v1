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
                        Edit Patient <br>
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true"><?= $this->session->flashdata('msg'); ?>&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="panel-body">

                    <form id="patient_add_form" method="post" action="<?= site_url('patient/patient_edit_post') ?>"
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
                                                   value="<?= $patient_info[0]['patient_id'] ?>"
                                                   disabled>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" id="id" value="<?= $patient_info[0]['patient_id'] ?>">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_name" class="control-label">Patient Name</label>
                                            <input type="text" class="form-control" id="patient_name"
                                                   name="patient_name"
                                                   data-validate="required"
                                                   value="<?= $patient_info[0]['patient_name'] ?>">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_dob" class="control-label">DOB(mm-dd-yyyy)</label>

                                            <div class="input-group">
                                                <input type="text" readonly class="form-control datepicker" data-date-end-date="+0d"
                                                       id="patient_dob" name="patient_dob" data-validate="required"
                                                    <?php $new_date = explode('-', $patient_info[0]['DOB']); ?>
                                                       value="<?= $new_date[1] . '/' . $new_date[2] . '/' . $new_date[0] ?>"
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

                                                <div class="make-switch switch-small"
                                                    <?php if($patient_info[0]['gender'] == 0) { ?>
                                                        data-on-label='M'
                                                        data-off-label = 'F'<?php }else{ ?>
                                                     data-on-label='F'
                                                     data-off-label = 'M'<?php } ?>">
                                                <input type="checkbox" id="patient_gender"
                                                       name="patient_gender">
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
                                                    <option value="A+" <?php if($patient_info[0]['blood_group'] == "A+"){echo 'selected';} ?>>A+</option>
                                                    <option value="A-" <?php if($patient_info[0]['blood_group'] == "A-"){echo 'selected';} ?>>A-</option>
                                                    <option value="B+" <?php if($patient_info[0]['blood_group'] == "B+"){echo 'selected';} ?>>B+</option>
                                                    <option value="B-" <?php if($patient_info[0]['blood_group'] == "B-"){echo 'selected';} ?>>B-</option>
                                                    <option value="AB+" <?php if($patient_info[0]['blood_group'] == "AB+"){echo 'selected';} ?>>AB+</option>
                                                    <option value="AB-" <?php if($patient_info[0]['blood_group'] == "AB-"){echo 'selected';} ?>>AB-</option>
                                                    <option value="O+" <?php if($patient_info[0]['blood_group'] == "O+"){echo 'selected';} ?>>O+</option>
                                                    <option value="O-" <?php if($patient_info[0]['blood_group'] == "O-"){echo 'selected';} ?>>O-</option>
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
                                            <input type="number" class="form-control" id="patient_nid"
                                                   name="patient_nid"
                                                   value="<?= $patient_info[0]['NID_number'] ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="area_code" class="control-label">Area</label>
                                            <div>
                                                <select name="area_code" class="select2" data-allow-clear="true"
                                                        data-placeholder="Select one area...">
                                                    <option value=""></option>
                                                    <?php foreach ($area as $row) { ?>
                                                        <option
                                                            value="<?= $row['area_code_id'] ?>" <?php if ($row['area_code_id'] == $patient_info[0]['tbl_area_code_area_code_id']) {
                                                            echo 'selected';
                                                        } ?>><?= $row['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_phone" class="control-label">Phone Number</label>
                                            <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true" min="0"
                                                   id="patient_phone" name="patient_phone" required value="<?= $patient_info[0]['phone_number'] ?>"
                                                   data-numeric-align="right" placeholder="11 Numbers Right" />
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_email" class="control-label">Patient Email</label>
                                            <input type="email" class="form-control" id="patient_email" name="patient_email"
                                                   value="<?= $patient_info[0]['email'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="patient_address">Patient Address</label>
                                            <textarea class="form-control autogrow" name="patient_address"
                                                      id="patient_address" data-validate="required" rows="4"
                                                      placeholder="Enter patient's address"><?= $patient_info[0]['address'] ?></textarea>
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
                                                        <?php if($patient_info[0]['picture']){ ?>
                                                        <img
                                                            src="<?php $img = filemtime($patient_info[0]['picture']);
                                                            echo site_url($patient_info[0]['picture']."?".$img);
                                                            ?>"
                                                            alt="...">
                                                        <?php }else{ ?>
                                                        <img
                                                            src="<?php echo site_url('uploads/patient_image/no_image.jpg');
                                                            ?>"
                                                            alt="...">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                         style="max-width: 200px; max-height: 150px"></div>
                                                    <div>
											<span class="btn btn-white btn-file">
												<span class="fileinput-new">Select image</span>
												<span class="fileinput-exists">Change</span>
												<input onchange="readURL(this);" type="file" name="patient_image"
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
                                                                value="<?= $row['level_care_type_id'] ?>" <?php if ($row['level_care_type_id'] == $patient_info[0]['level_name']) ?>><?= $row['level_name'] ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label for="patient_joining_date" class="control-label">Joining Date(mm-dd-yyyy)</label>

                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker"
                                                       id="patient_joining_date" name="patient_joining_date"
                                                       data-validate="required" data-date-end-date="+0d"
                                                    <?php $new_date = explode('-', $patient_info[0]['joining_date']); ?>
                                                       value="<?= $new_date[1].'/'.$new_date[2].'/'.$new_date[0] ?>"
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
                                                    <?php if (sizeof($referral) != null) { ?>
                                                        <?php foreach ($referral as $row) { ?>
                                                            <option
                                                                value="<?= $row['referral_id'] ?>" <?php if ($row['referral_id'] == $patient_info[0]['referral_id']) {
                                                                echo 'selected';
                                                            } ?>><?= $row['referral_name'] ?></option>
                                                        <?php }
                                                    } ?>
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
                                                    <?php if (sizeof($caregiver) != null) { ?>
                                                        <?php foreach ($caregiver as $row) { ?>
                                                            <option <?php foreach ($get_caregiver as $kc) {
                                                                if ($kc['caregiver_user_id'] == $row['caregiver_user_id']) {
                                                                    echo 'selected';
                                                                }
                                                            } ?>
                                                                value="<?= $row['caregiver_user_id'] ?>"><?= $row['caregiver_name'] ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

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
                                                   value="<?= $emergency_contact[0]['family_contact_name'] ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="emergency_contact_relationship" class="control-label">Relationship</label>
                                            <input type="text" class="form-control" id="emergency_contact_relationship"
                                                   name="emergency_contact_relationship" data-validate="required"
                                                   value="<?= $emergency_contact[0]['relationship'] ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="emergency_contact_phone" class="control-label">Phone
                                                Number</label>
                                            <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true" min="0"
                                                   id="emergency_contact_phone" name="emergency_contact_phone" data-validate="required" value="<?= $emergency_contact[0]['phone_number'] ?>"
                                                   data-numeric-align="right" placeholder="11 Numbers Right" />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for=" " class="control-label">Email</label>
                                            <input type="email" class="form-control" id="emergency_contact_email"
                                                   name="emergency_contact_email"
                                                   value="<?= $emergency_contact[0]['email'] ?>">
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
                                    <input type="hidden" id="emergency_contact" name="emergency_contact" value="<?= $emergency_contact[0]['patient_family_contact_id'] ?>">

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
                                                   name="family_contact_name_1" placeholder="Enter name" <?php if (isset($family_contact_name_1)) { ?>
                                                value="<?= $family_contact_name_1 ?>" <?php } ?>>
                                        </div>
                                    </div>
                                    <input type="hidden" id="contact1_id" name="contact1_id" <?php if (isset($family_contact_id_1)){ ?>
                                        value="<?= $family_contact_id_1 ?>" <?php }  ?>>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_relationship_1" class="control-label">Relationship</label>
                                            <input type="text" class="form-control" id="family_contact_relationship_1"
                                                   name="family_contact_relationship_1"
                                                   placeholder="Son, daughter or etc." <?php if (isset($family_contact_relationship_1)){ ?>
                                                value="<?= $family_contact_relationship_1 ?>" <?php }  ?>>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_phone_1" class="control-label">Phone
                                                Number</label>
                                            <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true" min="0"
                                                   id="family_contact_phone_1" name="family_contact_phone_1" <?php if (isset($family_contact_phone_1)) { ?>
                                                   value="<?= $family_contact_phone_1 ?>" <?php } ?>
                                                   data-numeric-align="right" placeholder="11 Numbers Right" />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_email_1" class="control-label">Email</label>
                                            <input type="email" class="form-control" id="family_contact_email_1"
                                                   name="family_contact_email_1" placeholder="Enter email" <?php if (isset($family_contact_email_1)) { ?>
                                                value="<?= $family_contact_email_1 ?>" <?php } ?>>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" for="family_contact_address_1">Address</label>
                                            <textarea class="form-control autogrow" name="family_contact_address_1"
                                                      id="family_contact_address_1"
                                                      placeholder="Enter address"><?php if (isset($family_contact_address_1)) {
                                                    echo $family_contact_address_1;
                                                } ?></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="family_contact_name_2" class="control-label">Name</label>
                                            <input type="text" class="form-control" id="family_contact_name_2"
                                                   name="family_contact_name_2" placeholder="Enter name" <?php if (isset($family_contact_name_2)){ ?>
                                                value="<?= $family_contact_name_2 ?>" <?php }  ?>>
                                        </div>
                                        <input type="hidden" id="contact2_id" name="contact2_id" <?php if (isset($family_contact_id_2)){ ?>
                                               value="<?= $family_contact_id_2 ?>" <?php }  ?>>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_relationship_2" class="control-label">Relationship</label>
                                            <input type="text" class="form-control" id="family_contact_relationship_2"
                                                   name="family_contact_relationship_2"
                                                   placeholder="Son, daughter or etc." <?php if (isset($family_contact_relationship_2)){ ?>
                                                value="<?= $family_contact_relationship_2 ?>" <?php }  ?>>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_phone_2" class="control-label">Phone
                                                Number</label>
                                            <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true" min="0"
                                                   id="family_contact_phone_2" name="family_contact_phone_2" <?php if (isset($family_contact_phone_2)) { ?>
                                                value="<?= $family_contact_phone_2 ?>" <?php } ?>
                                                   data-numeric-align="right" placeholder="11 Numbers Right" />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_email_2" class="control-label">Email</label>
                                            <input type="email" class="form-control" id="family_contact_email_2"
                                                   name="family_contact_email_2" placeholder="Enter email" <?php if (isset($family_contact_email_2)){ ?>
                                                value="<?= $family_contact_email_2 ?>" <?php }  ?>>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" for="family_contact_address_2">Address</label>
                                            <textarea class="form-control autogrow" name="family_contact_address_2"
                                                      id="family_contact_address_2"
                                                      placeholder="Enter address"><?php if (isset($family_contact_address_2)) {
                                                    echo $family_contact_address_2;
                                                } ?></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="family_contact_name_3" class="control-label">Name</label>
                                            <input type="text" class="form-control" id="family_contact_name_3"
                                                   name="family_contact_name_3" placeholder="Enter name" <?php if (isset($family_contact_name_3)){ ?>
                                                value="<?= $family_contact_name_3 ?>" <?php }  ?>>
                                        </div>
                                    </div>
                                    <input type="hidden" id="contact3_id" name="contact3_id" <?php if (isset($family_contact_id_3)){ ?>
                                        value="<?= $family_contact_id_3 ?>" <?php }  ?>>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_relationship_3" class="control-label">Relationship</label>
                                            <input type="text" class="form-control" id="family_contact_relationship_3"
                                                   name="family_contact_relationship_3"
                                                   placeholder="Son, daughter or etc." <?php if (isset($family_contact_relationship_3)){ ?>
                                                value="<?= $family_contact_relationship_3 ?>" <?php }  ?>>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_phone_3" class="control-label">Phone
                                                Number</label>
                                            <input type="text" class="form-control"  data-mask="99999999999" data-numeric="true" min="0"
                                                   id="family_contact_phone_3" name="family_contact_phone_3" <?php if (isset($family_contact_phone_3)) { ?>
                                                value="<?= $family_contact_phone_3 ?>" <?php } ?>
                                                   data-numeric-align="right" placeholder="11 Numbers Right" />

                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="family_contact_email_3" class="control-label">Email</label>
                                            <input type="email" class="form-control" id="family_contact_email_3"
                                                   name="family_contact_email_3" placeholder="Enter email" <?php if (isset($family_contact_email_3)){ ?>
                                                value="<?= $family_contact_email_3 ?>" <?php }  ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label" for="family_contact_address_3">Address</label>
                                            <textarea class="form-control autogrow" name="family_contact_address_3"
                                                      id="family_contact_address_3"
                                                      placeholder="Enter address"><?php if (isset($family_contact_address_3)) {
                                                    echo $family_contact_address_3;
                                                } ?></textarea>
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
                                    <button type="submit"  class="btn btn-primary">Save Information</button>
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
    <script>
        $(document).ready(function () {
            // var d = new Date();
            $("#patient_dob").datepicker();
            $("#patient_joining_date").datepicker();
        });


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

    </script>
    <script>
        function chk_gender() {
            //console.log(document.getElementById('patient_gender').value);
            if ($(this).prop("checked") == true) {
                document.getElementById('patient_gender').value = 1;
            }
            else {
                document.getElementById('patient_gender').value = 0;
            }
            console.log(document.getElementById('patient_gender').value);
        }
    </script>
</div>