<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />

    <link rel="icon" href="<?php echo base_url()?>asset/admin/images/favicon.ico">

    <title>Home Care | Login</title>

    <link rel="stylesheet" href="<?php echo base_url()?>asset/admin/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/admin/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/admin/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/admin/css/neon-core.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/admin/css/neon-theme.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/admin/css/neon-forms.css">
    <link rel="stylesheet" href="<?php echo base_url()?>asset/admin/css/custom.css">

    <script src="<?php echo base_url()?>asset/admin/js/jquery-1.11.3.min.js"></script>

    <!--[if lt IE 9]><script src="<?php echo base_url()?>asset/admin/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
    var baseurl = "<?php echo base_url()?>login/login_check";
</script>

<div class="login-container">

    <div class="login-header login-caret">

        <div class="login-content">

            <a href="<?php echo base_url()?>" class="logo">
                <img src="<?php echo base_url()?>asset/admin/images/SF_Home_Care_White_Logo.png" width="120" alt="" />
            </a>

            <p class="description">Brining Health Care at Home</p>

            <!-- progress bar indicator -->
            <div class="login-progressbar-indicator">
                <h3>43%</h3>
                <span>logging in...</span>
            </div>
        </div>

    </div>

    <div class="login-progressbar">
        <div></div>
    </div>

    <div class="login-form">

        <div class="login-content">

            <div class="form-login-error">
                <h3>Invalid login</h3>
                <p>Please enter valid <strong>username and password</strong></p>
            </div>

            <form method="post"  role="form" id="form_login">

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-user"></i>
                        </div>

                        <input value="appinion" type="text" class="form-control" name="userid" id="userid" placeholder="User ID" autocomplete="off" />
                    </div>

                </div>

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>

                        <input value="123456" type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
                    </div>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-login"></i>
                        Login
                    </button>
                </div>

            </form>


            <!--<div class="login-bottom-links">

                <a href="extra-forgot-password.html" class="link">Forgot your password?</a>

            </div>-->

        </div>

    </div>

</div>


<!-- Bottom scripts (common) -->
<script src="<?php echo base_url()?>asset/admin/js/gsap/TweenMax.min.js"></script>
<script src="<?php echo base_url()?>asset/admin/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="<?php echo base_url()?>asset/admin/js/bootstrap.js"></script>
<script src="<?php echo base_url()?>asset/admin/js/joinable.js"></script>
<script src="<?php echo base_url()?>asset/admin/js/resizeable.js"></script>
<script src="<?php echo base_url()?>asset/admin/js/neon-api.js"></script>
<script src="<?php echo base_url()?>asset/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>asset/admin/js/neon-login.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="<?php echo base_url()?>asset/admin/js/neon-custom.js"></script>


<!-- Demo Settings -->
<script src="<?php echo base_url()?>asset/admin/js/neon-demo.js"></script>

</body>
</html>