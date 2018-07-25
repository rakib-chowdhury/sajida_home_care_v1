<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Sajida Home Care"/>
    <meta name="author" content="Sudipta Ghosh"/>

    <link rel="icon" href="<?php echo base_url() ?>asset/admin/images/favicon.ico">

    <title><?php echo $active_page; ?></title>

    <link rel="stylesheet"
          href="<?php echo base_url() ?>asset/admin/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/css/font-icons/font-awesome/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/css/neon-core.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/css/neon-theme.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/css/neon-forms.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/css/neon-forms.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/select2/select2-bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/css/morris.css">
    <script src="<?php echo base_url() ?>asset/admin/js/jquery-1.11.3.min.js"></script>

    <!--[if lt IE 9]>
    <script src="<?php echo base_url()?>asset/admin/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body  page-fade gray" data-url="http://neon.dev">

<div class="page-container">
    <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="sidebar-menu">

        <div class="sidebar-menu-inner">

            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url() ?>asset/admin/images/SF_Home_Care_White_Logo.png" width="120"
                             alt=""/>
                    </a>
                </div>
                <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon">
                        <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>


                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>
            <?php if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2){ ?>
                <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <li
                    <?php
                    if (strcasecmp($active_page, "Home") == 0)
                        echo "class='active'";
                    else
                        echo "class='title'";
                    ?>
                >
                    <a href="<?php echo base_url(); ?>">
                        <i class="entypo-home"></i>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li
                    <?php
                    if (strcasecmp($active_page, "Add Patient") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Manage Patient") == 0)
                        echo "class='opened has-sub'";
                    else
                        echo "class='has-sub'";
                    ?>

                >
                    <a href="">
                        <i><img src="<?= base_url() ?>asset/admin/css/font-icons/patient.png"></img></i>
                        <span class="title" style="margin-left: 5px">Patient</span>
                    </a>
                    <ul>
                        <li
                            <?php
                            if (strcasecmp($active_page, "Add Patient") == 0)
                                echo "class='active'";
                            ?>
                        >
                            <a href="<?php echo base_url() . 'patient/add_patient'; ?>">
                                <span class="title">Add Patient</span>
                            </a>
                        </li>
                        <li
                            <?php
                            if (strcasecmp($active_page, "Manage Patient") == 0)
                                echo "class='active'";
                            ?>
                        >
                            <a href="<?= base_url().'patient/manage_patients'; ?>">
                                <span class="title">Manage Patient</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    <?php
                    if (strcasecmp($active_page, "Add Caregiver") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Manage Caregiver") == 0)
                        echo "class='opened has-sub'";
                    else
                        echo "class='has-sub'";
                    ?>

                >
                    <a href="">
                        <i><img src="<?= base_url() ?>asset/admin/css/font-icons/nurse.png"></img></i>
                        <span class="title" style="margin-left: 5px">Caregiver</span>
                    </a>
                    <ul>
                        <li
                            <?php
                            if (strcasecmp($active_page, "Add Caregiver") == 0)
                                echo "class='active'";
                            ?>
                        >
                            <a href="<?= base_url().'caregiver/add_caregiver'; ?>">
                                <span class="title">Add Caregiver</span>
                            </a>
                        </li>
                        <li
                            <?php
                            if (strcasecmp($active_page, "Manage Caregiver") == 0)
                                echo "class='active'";
                            ?>
                        >
                            <a href="<?= base_url().'caregiver/manage_caregiver'; ?>">
                                <span class="title">Manage Caregiver</span>
                            </a>
                        </li>
                    </ul>
                </li>

                    <li
                        <?php
                        if (strcasecmp($active_page, "Add Consultant Info") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Manage Consultant Info") == 0)
                            echo "class='opened has-sub'";
                        else
                            echo "class='has-sub'";
                        ?>

                    >
                        <a href="">
                            <i><img src="<?= base_url() ?>asset/admin/css/font-icons/nurse.png"></img></i>
                            <span class="title" style="margin-left: 5px">Consultant</span>
                        </a>
                        <ul>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Add Consultant Info") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= site_url('add_consultant_info') ?>">
                                    <span class="title">Add Consultant</span>
                                </a>
                            </li>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Manage Consultant Info") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= site_url('manage_consultant_info') ?>">
                                    <span class="title">Manage Consultants</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                <li
                    <?php
                    if (strcasecmp($active_page, "New Patient Schedule") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Caregiver Event List") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Consultant Event List") == 0)
                        echo "class='opened has-sub'";

                    else
                        echo "class='has-sub'";
                    ?>

                >
                    <a href="">
                        <i class="entypo-calendar"></i>
                        <span class="title">Schedule</span>
                    </a>
                    <ul>
                        <li
                            <?php
                            if (strcasecmp($active_page, "New Patient Schedule") == 0)
                                echo "class='active'";
                            ?>
                        >
                            <a href="<?= site_url('schedule/manage_schedule') ?>">
                                <span class="title">New Patient Schedule</span>
                            </a>
                        </li>
                        <li
                            <?php
                            if (strcasecmp($active_page, "Caregiver Event List") == 0)
                                echo "class='active'";
                            ?>
                        >
                            <a href="<?= site_url('schedule/show_caregivers') ?>">
                                <span class="title">Caregiver Event List</span>
                            </a>
                        </li>
                        <li
                            <?php
                            if (strcasecmp($active_page, "Consultant Event List") == 0)
                                echo "class='active'";
                            ?>
                        >
                            <a href="<?= site_url('schedule/show_consultants') ?>">
                                <span class="title">Consultant Event List</span>
                            </a>
                        </li>

                        <!--                        <li-->
                        <!--                            --><?php
                        //                            if (strcasecmp($active_page, "Consultant Event List") == 0)
                        //                                echo "class='active'";
                        //                            ?>
                        <!--                        >-->
                        <!--                            <a href="--><?//= site_url('schedule/show_consultants') ?><!--">-->
                        <!--                                <span class="title">Consultant Event List</span>-->
                        <!--                            </a>-->
                        <!--                        </li>-->

                    </ul>
                </li>

                <li
                    <?php
                    if (strcasecmp($active_page, "New Promotional Items") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Manage Promotional Items") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Track Promotional Items") == 0)
                        echo "class='opened has-sub'";
                    else
                        echo "class='has-sub'";
                    ?>

                >
                    <a href="">
                        <i class="entypo-sound"></i>
                        <span class="title">Promotional Items</span>
                    </a>
                    <ul>
                        <li
                            <?php
                            if (strcasecmp($active_page, "New Promotional Items") == 0)
                                echo "class='active'";
                            ?>
                        >
                            <a href="<?= site_url('promotional_items/add_promotional_items') ?>">
                                <span class="title">New</span>
                            </a>
                        </li>
                        <li
                            <?php
                            if (strcasecmp($active_page, "Manage Promotional Items") == 0)
                                echo "class='active'";
                            ?>
                        >
                            <a href="<?= site_url('promotional_items/manage_promotional_items') ?>">
                                <span class="title">Manage</span>
                            </a>
                        </li>
                        <li
                            <?php
                            if (strcasecmp($active_page, "Track Promotional Items") == 0)
                                echo "class='active'";
                            ?>
                        >
                            <a href="<?= site_url('promotional_items/track') ?>">
                                <span class="title">Track</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    <?php
                    if (strcasecmp($active_page, "New Area Code") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Manage Area Code") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Add Admin User") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Manage Admin User") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "New Consultant Type") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Manage Consultant Type") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "New Referral Info") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Manage Referral Info") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Add Bank Info") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Manage Bank Info") == 0)
                        echo "class='opened has-sub'";
                    else if (strcasecmp($active_page, "Add Mobile Banking Method") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Manage Mobile Banking Methods") == 0)
                            echo "class='opened has-sub'";
                    else
                        echo "class='has-sub'";
                    ?>
                >
                    <a href="">
                        <i class="entypo-cog"></i>
                        <span class="title">Settings</span>
                    </a>
                    <ul>
                        <li
                            <?php
                            if (strcasecmp($active_page, "New Area Code") == 0)
                                echo "class='opened has-sub'";
                            else if (strcasecmp($active_page, "Manage Area Code") == 0)
                                echo "class='opened has-sub'";
                            else
                                echo "class='has-sub'";
                            ?>
                        >
                            <a href="">
                                <span class="title">Area Code</span>
                            </a>
                            <ul>
                                <li
                                    <?php
                                    if (strcasecmp($active_page, "New Area Code") == 0)
                                        echo "class='active'";
                                    ?>
                                >
                                    <a href="<?= base_url() ?>settings/add_area_code">
                                        <span class="title">New</span>
                                    </a>
                                </li>
                                <li
                                    <?php
                                    if (strcasecmp($active_page, "Manage Area Code") == 0)
                                        echo "class='active'";
                                    ?>
                                >
                                    <a href="<?= base_url() ?>settings/manage_area_code">
                                        <span class="title">Manage</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            <?php
                            if (strcasecmp($active_page, "New Consultant Type") == 0)
                                echo "class='opened has-sub'";
                            else if (strcasecmp($active_page, "Manage Consultant Type") == 0)
                                echo "class='opened has-sub'";
                            else
                                echo "class='has-sub'";
                            ?>
                        >
                            <a href="">
                                <span class="title">Consultant Type</span>
                            </a>
                            <ul>
                                <li
                                    <?php
                                    if (strcasecmp($active_page, "New Consultant Type") == 0)
                                        echo "class='active'";
                                    ?>
                                >
                                    <a href="<?= site_url('add_consultant_type') ?>">
                                        <span class="title">New</span>
                                    </a>
                                </li>
                                <li
                                    <?php
                                    if (strcasecmp($active_page, "Manage Consultant Type") == 0)
                                        echo "class='active'";
                                    ?>
                                >
                                    <a href="<?= site_url('manage_consultant_type') ?>">
                                        <span class="title">Manage</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            <?php
                            if (strcasecmp($active_page, "New Referral Info") == 0)
                                echo "class='opened has-sub'";
                            else if (strcasecmp($active_page, "Manage Referral Info") == 0)
                                echo "class='opened has-sub'";
                            else
                                echo "class='has-sub'";
                            ?>
                        >
                            <a href="">
                                <span class="title">Referral Info</span>
                            </a>
                            <ul>
                                <li
                                    <?php
                                    if (strcasecmp($active_page, "New Referral Info") == 0)
                                        echo "class='active'";
                                    ?>
                                >
                                    <a href="<?= site_url('settings/add_referral_info') ?>">
                                        <span class="title">New</span>
                                    </a>
                                </li>
                                <li
                                    <?php
                                    if (strcasecmp($active_page, "Manage Referral Info") == 0)
                                        echo "class='active'";
                                    ?>
                                >
                                    <a href="<?= site_url('settings/manage_referral_info') ?>">
                                        <span class="title">Manage</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            <?php
                            if (strcasecmp($active_page, "Add Admin User") == 0)
                                echo "class='opened has-sub'";
                            else if (strcasecmp($active_page, "Manage Admin User") == 0)
                                echo "class='opened has-sub'";
                            else
                                echo "class='has-sub'";
                            ?>
                        >
                            <a href="">
                                <span class="title">Users</span>
                            </a>
                            <ul>
                                <li
                                    <?php
                                    if (strcasecmp($active_page, "Add Admin User") == 0)
                                        echo "class='active'";
                                    ?>
                                >
                                    <a href="<?= site_url('admin_users/add_new_user') ?>">
                                        <span class="title">New</span>
                                    </a>
                                </li>
                                <li
                                    <?php
                                    if (strcasecmp($active_page, "Manage Admin User") == 0)
                                        echo "class='active'";
                                    ?>
                                >
                                    <a href="<?= site_url('admin_users/manage_users') ?>">
                                        <span class="title">Manage</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li
                            <?php
                            if (strcasecmp($active_page, "Add Bank Info") == 0)
                                echo "class='opened has-sub'";
                            else if (strcasecmp($active_page, "Manage Bank Info") == 0)
                                echo "class='opened has-sub'";
                            else
                                echo "class='has-sub'";
                            ?>
                        >
                            <a href="">
                                <span class="title">Bank Info</span>
                            </a>
                            <ul>
                                <li
                                    <?php
                                    if (strcasecmp($active_page, "Add Bank Info") == 0)
                                        echo "class='active'";
                                    ?>
                                >
                                    <a href="<?= site_url('settings/add_bank') ?>">
                                        <span class="title">New</span>
                                    </a>
                                </li>
                                <li
                                    <?php
                                    if (strcasecmp($active_page, "Manage Bank Info") == 0)
                                        echo "class='active'";
                                    ?>
                                >
                                    <a href="<?= site_url('settings/manage_bank') ?>">
                                        <span class="title">Manage</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li
                                <?php
                                if (strcasecmp($active_page, "Add Mobile Banking Method") == 0)
                                    echo "class='opened has-sub'";
                                else if (strcasecmp($active_page, "Manage Mobile Banking Methods") == 0)
                                    echo "class='opened has-sub'";
                                else
                                    echo "class='has-sub'";
                                ?>
                            >
                                <a href="">
                                    <span class="title">Mobile Banking Method</span>
                                </a>
                                <ul>
                                    <li
                                        <?php
                                        if (strcasecmp($active_page, "Add Mobile Banking Method") == 0)
                                            echo "class='active'";
                                        ?>
                                    >
                                        <a href="<?= site_url('add_mobile_banking_method') ?>">
                                            <span class="title">New</span>
                                        </a>
                                    </li>
                                    <li
                                        <?php
                                        if (strcasecmp($active_page, "Manage Mobile Banking Methods") == 0)
                                            echo "class='active'";
                                        ?>
                                    >
                                        <a href="<?= site_url('manage_mobile_banking_method') ?>">
                                            <span class="title">Manage</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                    </ul>
                </li>
            </ul>
            <?php }else if($_SESSION['user_type'] == 3){ ?>
                <ul id="main-menu" class="main-menu">
                    <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                    <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                    <li
                        <?php
                        if (strcasecmp($active_page, "Home") == 0)
                            echo "class='active'";
                        else
                            echo "class='title'";
                        ?>
                    >
                        <a href="<?php echo base_url(); ?>">
                            <i class="entypo-home"></i>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <li
                        <?php
                        if (strcasecmp($active_page, "Manage Patient") == 0)
                            echo "class='opened has-sub'";
                        else
                            echo "class='has-sub'";
                        ?>

                    >
                        <a href="">
                            <i class="entypo-user"></i>
                            <span class="title">Patient</span>
                        </a>
                        <ul>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Manage Patient") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= base_url().'patient/manage_patients'; ?>">
                                    <span class="title">Manage Patient</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li
                        <?php
                        if (strcasecmp($active_page, "Manage Caregiver") == 0)
                            echo "class='opened has-sub'";
                        else
                            echo "class='has-sub'";
                        ?>

                    >
                        <a href="">
                            <i class="entypo-user"></i>
                            <span class="title">Caregiver</span>
                        </a>
                        <ul>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Manage Caregiver") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= base_url().'caregiver/manage_caregiver'; ?>">
                                    <span class="title">Manage Caregiver</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li
                        <?php
                        if (strcasecmp($active_page, "Caregiver Event List") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Consultant Event List") == 0)
                            echo "class='opened has-sub'";

                        else
                            echo "class='has-sub'";
                        ?>

                    >
                        <a href="">
                            <i class="entypo-calendar"></i>
                            <span class="title">Schedule</span>
                        </a>
                        <ul>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Caregiver Event List") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= site_url('schedule/show_caregivers') ?>">
                                    <span class="title">Caregiver Event List</span>
                                </a>
                            </li>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Consultant Event List") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= site_url('schedule/show_consultants') ?>">
                                    <span class="title">Consultant Event List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php }else if($_SESSION['user_type'] == 4){ ?>
                <ul id="main-menu" class="main-menu">
                    <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                    <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                    <li
                        <?php
                        if (strcasecmp($active_page, "Home") == 0)
                            echo "class='active'";
                        else
                            echo "class='title'";
                        ?>
                    >
                        <a href="<?php echo base_url(); ?>">
                            <i class="entypo-home"></i>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <li
                        <?php
                        if (strcasecmp($active_page, "Add Patient") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Manage Patient") == 0)
                            echo "class='opened has-sub'";
                        else
                            echo "class='has-sub'";
                        ?>

                    >
                        <a href="">
                            <i class="entypo-user"></i>
                            <span class="title">Patient</span>
                        </a>
                        <ul>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Add Patient") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?php echo base_url() . 'patient/add_patient'; ?>">
                                    <span class="title">Add Patient</span>
                                </a>
                            </li>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Manage Patient") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= base_url().'patient/manage_patients'; ?>">
                                    <span class="title">Manage Patient</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li
                        <?php
                        if (strcasecmp($active_page, "Add Caregiver") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Manage Caregiver") == 0)
                            echo "class='opened has-sub'";
                        else
                            echo "class='has-sub'";
                        ?>

                    >
                        <a href="">
                            <i class="entypo-user"></i>
                            <span class="title">Caregiver</span>
                        </a>
                        <ul>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Add Caregiver") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= base_url().'caregiver/add_caregiver'; ?>">
                                    <span class="title">Add Caregiver</span>
                                </a>
                            </li>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Manage Caregiver") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= base_url().'caregiver/manage_caregiver'; ?>">
                                    <span class="title">Manage Caregiver</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li
                        <?php
                        if (strcasecmp($active_page, "New Patient Schedule") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Caregiver Event List") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Consultant Event List") == 0)
                            echo "class='opened has-sub'";

                        else
                            echo "class='has-sub'";
                        ?>

                    >
                        <a href="">
                            <i class="entypo-calendar"></i>
                            <span class="title">Schedule</span>
                        </a>
                        <ul>
                            <li
                                <?php
                                if (strcasecmp($active_page, "New Patient Schedule") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= site_url('schedule/manage_schedule') ?>">
                                    <span class="title">New Patient Schedule</span>
                                </a>
                            </li>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Caregiver Event List") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= site_url('schedule/show_caregivers') ?>">
                                    <span class="title">Caregiver Event List</span>
                                </a>
                            </li>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Consultant Event List") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= site_url('schedule/show_consultants') ?>">
                                    <span class="title">Consultant Event List</span>
                                </a>
                            </li>

                            <!--                        <li-->
                            <!--                            --><?php
                            //                            if (strcasecmp($active_page, "Consultant Event List") == 0)
                            //                                echo "class='active'";
                            //                            ?>
                            <!--                        >-->
                            <!--                            <a href="--><?//= site_url('schedule/show_consultants') ?><!--">-->
                            <!--                                <span class="title">Consultant Event List</span>-->
                            <!--                            </a>-->
                            <!--                        </li>-->

                        </ul>
                    </li>

                    <li
                        <?php
                        if (strcasecmp($active_page, "New Promotional Items") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Manage Promotional Items") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Track Promotional Items") == 0)
                            echo "class='opened has-sub'";
                        else
                            echo "class='has-sub'";
                        ?>

                    >
                        <a href="">
                            <i class="entypo-sound"></i>
                            <span class="title">Promotional Items</span>
                        </a>
                        <ul>
                            <li
                                <?php
                                if (strcasecmp($active_page, "New Promotional Items") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= site_url('promotional_items/add_promotional_items') ?>">
                                    <span class="title">New</span>
                                </a>
                            </li>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Manage Promotional Items") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= site_url('promotional_items/manage_promotional_items') ?>">
                                    <span class="title">Manage</span>
                                </a>
                            </li>
                            <li
                                <?php
                                if (strcasecmp($active_page, "Track Promotional Items") == 0)
                                    echo "class='active'";
                                ?>
                            >
                                <a href="<?= site_url('promotional_items/track') ?>">
                                    <span class="title">Track</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li
                        <?php
                        if (strcasecmp($active_page, "New Area Code") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Manage Area Code") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "New Consultant Info") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Manage Consultant Info") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "New Referral Info") == 0)
                            echo "class='opened has-sub'";
                        else if (strcasecmp($active_page, "Manage Referral Info") == 0)
                            echo "class='opened has-sub'";

                        else
                            echo "class='has-sub'";
                        ?>
                    >
                        <a href="">
                            <i class="entypo-cog"></i>
                            <span class="title">Settings</span>
                        </a>
                        <ul>
                            <li
                                <?php
                                if (strcasecmp($active_page, "New Area Code") == 0)
                                    echo "class='opened has-sub'";
                                else if (strcasecmp($active_page, "Manage Area Code") == 0)
                                    echo "class='opened has-sub'";
                                else
                                    echo "class='has-sub'";
                                ?>
                            >
                                <a href="">
                                    <span class="title">Area Code</span>
                                </a>
                                <ul>
                                    <li
                                        <?php
                                        if (strcasecmp($active_page, "New Area Code") == 0)
                                            echo "class='active'";
                                        ?>
                                    >
                                        <a href="<?= base_url() ?>settings/add_area_code">
                                            <span class="title">New</span>
                                        </a>
                                    </li>
                                    <li
                                        <?php
                                        if (strcasecmp($active_page, "Manage Area Code") == 0)
                                            echo "class='active'";
                                        ?>
                                    >
                                        <a href="<?= base_url() ?>settings/manage_area_code">
                                            <span class="title">Manage</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                <?php
                                if (strcasecmp($active_page, "New Consultant Info") == 0)
                                    echo "class='opened has-sub'";
                                else if (strcasecmp($active_page, "Manage Consultant Info") == 0)
                                    echo "class='opened has-sub'";
                                else
                                    echo "class='has-sub'";
                                ?>
                            >
                                <a href="">
                                    <span class="title">Consultant Info</span>
                                </a>
                                <ul>
                                    <li
                                        <?php
                                        if (strcasecmp($active_page, "New Consultant Info") == 0)
                                            echo "class='active'";
                                        ?>
                                    >
                                        <a href="<?= site_url('settings/add_consultant_info') ?>">
                                            <span class="title">New</span>
                                        </a>
                                    </li>
                                    <li
                                        <?php
                                        if (strcasecmp($active_page, "Manage Consultant Info") == 0)
                                            echo "class='active'";
                                        ?>
                                    >
                                        <a href="<?= site_url('settings/manage_consultant_info') ?>">
                                            <span class="title">Manage</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                <?php
                                if (strcasecmp($active_page, "New Referral Info") == 0)
                                    echo "class='opened has-sub'";
                                else if (strcasecmp($active_page, "Manage Referral Info") == 0)
                                    echo "class='opened has-sub'";
                                else
                                    echo "class='has-sub'";
                                ?>
                            >
                                <a href="">
                                    <span class="title">Referral Info</span>
                                </a>
                                <ul>
                                    <li
                                        <?php
                                        if (strcasecmp($active_page, "New Referral Info") == 0)
                                            echo "class='active'";
                                        ?>
                                    >
                                        <a href="<?= site_url('settings/add_referral_info') ?>">
                                            <span class="title">New</span>
                                        </a>
                                    </li>
                                    <li
                                        <?php
                                        if (strcasecmp($active_page, "Manage Referral Info") == 0)
                                            echo "class='active'";
                                        ?>
                                    >
                                        <a href="<?= site_url('settings/manage_referral_info') ?>">
                                            <span class="title">Manage</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php }else{ ?>
            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <li
                    <?php
                    if (strcasecmp($active_page, "Home") == 0)
                        echo "class='active'";
                    else
                        echo "class='title'";
                    ?>
                >
                    <a href="<?php echo base_url(); ?>">
                        <i class="entypo-home"></i>
                        <span class="title">Home</span>
                    </a>
                </li>
            </ul>
            <?php } ?>
        </div>

    </div>

    <?php
    if (isset($master_body)) {
        echo $master_body;
    }
    ?>

</div>
<div class="page-loading-overlay">
    <div class="loader-2"></div>
</div>

<!-- Imported styles on this page -->
<link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="<?php echo base_url() ?>asset/admin/js/rickshaw/rickshaw.min.css">

<!-- Bottom scripts (common) -->
<script src="<?php echo base_url() ?>asset/admin/js/gsap/TweenMax.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/bootstrap.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/joinable.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/resizeable.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/neon-api.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>


<!-- Imported scripts on this page -->
<script src="<?php echo base_url() ?>asset/admin/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/rickshaw/vendor/d3.v3.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/rickshaw/rickshaw.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/raphael-min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/morris.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/toastr.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/neon-chat.js"></script>


<!-- Imported scripts on this page Form-->
<script src="<?php echo base_url() ?>asset/admin/js/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/typeahead.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/moment.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/select2/select2.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/jquery.multi-select.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/icheck/icheck.min.js"></script>


<script src="<?php echo base_url() ?>asset/admin/js/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/jquery.inputmask.bundle.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/selectboxit/jquery.selectBoxIt.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url() ?>asset/admin/js/fileinput.js"></script>


<!-- JavaScripts initializations and stuff -->
<script src="<?php echo base_url() ?>asset/admin/js/neon-custom.js"></script>


<!-- Demo Settings -->
<script src="<?php echo base_url() ?>asset/admin/js/neon-demo.js"></script>
</body>
</html>