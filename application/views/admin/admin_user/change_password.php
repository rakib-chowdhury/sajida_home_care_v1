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
                        Change Password <br>
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
                    <form role="form" action="<?= site_url('login/password_change_post') ?>"
                          onsubmit="return check_data()"
                          id='user_add_form' class="form-horizontal form-groups-bordered validate" method="post">
                        <div class="form-group">
                            <label for="old_password" class="col-sm-3 control-label">Old Password<span
                                    style="color: red">*</span></label>

                            <div class="col-sm-5">
                                <input type="password" class="form-control" data-validate="required" onkeyup="check_old_password()" id="old_password" name="old_password"
                                       placeholder="Old Password">
                                <span id="old_password_err"></span>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['login_id'] ?>">
                        <div class="form-group">
                            <label for="new_password" class="col-sm-3 control-label">New Password<span
                                    style="color: red">*</span></label>

                            <div class="col-sm-5">
                                <input type="password" class="form-control" data-validate="required" onkeyup="" id="new_password" name="new_password"
                                       placeholder="New Password">
                                <span id="new_password_err"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="col-sm-3 control-label">Confirm Password<span
                                    style="color: red">*</span></label>

                            <div class="col-sm-5">
                                <input type="password" class="form-control" data-validate="required" onkeyup="" id="confirm_password" name="confirm_password"
                                       placeholder="Confirm Password">
                                <span id="confirm_password_err"></span>
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
        function check_data() {
            var old_password = $('#old_password').val();
            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_password').val();
            //console.log(old_password +' '+new_password+' '+confirm_password);
            if(new_password == confirm_password)
            {
               // alert('Matched');
                return true;
            }
            else {
               // alert('Not Matched');
                var x = document.getElementById('confirm_password_err');
                x.style.color = "red";
                x.innerHTML = "<strong>Password Doesn't Match! Please Type Carefully.</strong><br>";
                return false;
            }
            return false;
        }
        function check_old_password() {
            var old_password = $('#old_password').val();
            var login_id = $('#user_id').val();
            console.log(login_id+' '+old_password);
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("login/check_old_password");?>',
                data: {
                    'login_id': login_id,
                    'password': old_password
                },
                success: function (data) {
                    // alert(data);
                    console.log(data);
                    if(data == 1)
                    {
                        var x = document.getElementById('old_password_err');
                        x.style.color = "";
                        x.innerHTML = "";
                        $('#myBtn').prop('disabled', false);
                    }
                    else
                    {
                        var x = document.getElementById('old_password_err');
                        x.style.color = "red";
                        x.innerHTML = "<strong>Incorrect Old Password!</strong><br>";
                        $('#myBtn').prop('disabled', true);
                    }
                }
            });
        }
    </script>
</div>