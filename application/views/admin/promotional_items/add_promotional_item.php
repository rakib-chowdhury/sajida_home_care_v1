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
                    <div class="col-md-12">
                        <div class="row">
                           <div class="col-md-10" style="margin-top: 2%;margin-bottom: 2%">New Promotional Items</div>
                            <div class="col-md-2" style="margin-top: 2%;margin-bottom: 2%"><a href="<?= site_url('promotional_items/add_promotional_item_category') ?>" >
                                    <button type="button" class="btn btn-success">
                                        Add Category
                                    </button>
                                </a></div>
                        </div>
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
                    <form role="form" action="<?= site_url('promotional_item/promotional_item_add_post') ?>"
                          onsubmit="return check_data()" enctype="multipart/form-data"
                          id='consultant_add_form' class="form-horizontal form-groups-bordered validate" method="post">
                        <div class="form-group">
                            <label for="promotional_name" class="col-sm-3 control-label">Promotional Item Name<span
                                    style="color: red">*</span></label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-validate="required" id="promotional_name" name="promotional_name"
                                       placeholder="Promotional Item Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tbl_promotional_category_promotional_category_id" class="col-sm-3 control-label">Category<span style="color: red">*</span>
                                </label>

                            <div class="col-sm-5">
                                <select name="tbl_promotional_category_promotional_category_id" data-validate="required"
                                        id="tbl_promotional_category_promotional_category_id" class="selectboxit">
                                    <option value="-1">Select a Category</option>
                                    <?php if(sizeof($categories != null)){ ?>
                                    <?php foreach ($categories as $row) { ?>
                                        <option
                                            value="<?= $row['promotional_category_id'] ?>"><?= $row['category_name'] ?></option>
                                    <?php } }?>
                                </select>
                                <span id="type_error" name="type_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="item_quantity" class="col-sm-3 control-label">Quantity
                                </label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="item_quantity" name="item_quantity"
                                       placeholder="Enter Quantity">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="item_description" class="col-sm-3 control-label">Item Description</label>

                            <div class="col-sm-5">
                                <textarea class="form-control autogrow" id="item_description" name="item_description"
                                          placeholder="Enter Item Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="item_price" class="col-sm-3 control-label">Price<span style="color: red">*</span>
                            </label>

                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="item_price" name="item_price"
                                       placeholder="Enter Price" data-validate="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="item_picture" class="col-sm-3 control-label">Item Picture</label><br>
                            <div class="col-sm-5">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail"
                                         style="max-width: 200px; max-height: 150px;" data-trigger="fileinput">
                                        <img src="http://placehold.it/200x150" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                        <span id="p_img_err2"></span><br>
											<span class="btn btn-white btn-file">
												<span class="fileinput-new">Select Picture</span>
												<span class="fileinput-exists">Change</span>
												<input onchange="readURL(this);" type="file" name="item_picture" id="item_picture" accept="image/*">
											</span>
                                        <a href="#" class="btn btn-orange fileinput-exists"
                                           data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
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
        function check_data() {
            var type = $('#tbl_consultant_type_consultant_type_id').val();
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
            }
        }
    </script>
</div>