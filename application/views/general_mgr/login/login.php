<!DOCTYPE html>
<html>

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title><?= get_site_config('backend_title') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/skin/default_skin/css/theme.css">
    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/admin-tools/admin-forms/css/admin-forms.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/favicon.ico">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="external-page external-alt sb-l-c sb-r-c">

<!-- Start: Main -->
<div id="main" class="animated fadeIn">

    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">

        <!-- Begin: Content -->
        <section id="content">

            <div class="admin-form theme-info mw500" id="login">

                <!-- Login Logo -->
                <div class="row table-layout">
                    <a href="#" title="Return to Dashboard">
                        <img src="<?= base_url() ?>assets/img/logos/logo.png" title="AdminDesigns Logo"
                             class="center-block img-responsive" style="max-width: 275px;">
                    </a>
                </div>
                <!-- Login Panel/Form -->
                <div class="panel mt30 mb25">
                    <?= form_open(base_url('general_mgr/login/login_do'), [
                        'id' => 'contact_form',
                        'method' => 'post'
                    ]) ?>
                    <div class="panel-body bg-light p25 pb15">
                        <div class="section row">
                            <div class="col-md-6">
                                <a href="<?= base_url('/general_mgr/login/fb') ?>"
                                   class="button btn-social facebook span-left btn-block">
                                    <span><i class="fa fa-facebook"></i></span>Facebook</a>
                            </div>
                            <div class="col-md-6">
                                <a href="<?= base_url('/general_mgr/login/google') ?>"
                                   class="button btn-social googleplus span-left btn-block">
                                    <span><i class="fa fa-google-plus"></i></span>Google+</a>
                            </div>
                        </div>
                        <div class="section-divider mv30">
                            <span>OR</span>
                        </div>
                        <!-- Username Input -->
                        <div class="section">
                            <label for="admin_mail" class="field-label text-muted fs18 mb10">Username</label>
                            <label for="admin_mail" class="field prepend-icon">
                                <input type="text" name="admin_mail" id="admin_mail" class="gui-input"
                                       placeholder="Enter username">
                                <label for="username" class="field-icon">
                                    <i class="fa fa-user"></i>
                                </label>
                            </label>
                        </div>
                        <!-- Password Input -->
                        <div class="section">
                            <label for="admin_password" class="field-label text-muted fs18 mb10">Password</label>
                            <label for="admin_password" class="field prepend-icon">
                                <input type="password" name="admin_password" id="admin_password" class="gui-input"
                                       placeholder="Enter password">
                                <label for="password" class="field-icon">
                                    <i class="fa fa-lock"></i>
                                </label>
                            </label>
                        </div>
                    </div>
                    <div class="panel-footer clearfix">
                        <button type="button" id="submit_button" class="button btn-primary mr10 pull-right">登入</button>
                    </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- End: Content -->
    </section>
    <!-- End: Content-Wrapper -->
</div>
<!-- End: Main -->

<!-- BEGIN: PAGE SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url() ?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script src="<?= base_url() ?>vendor/jquery/jquery_ui/jquery-ui.min.js"></script>
<!-- Theme Javascript -->
<script src="<?= base_url() ?>assets/js/utility/utility.js"></script>
<script src="<?= base_url() ?>assets/js/demo/demo.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.blockUI.js"></script>
<!-- Page Javascript -->
<script type="text/javascript">
    <?php if($error = $this->session->flashdata('error')){ ?>
        alert('<?=$error?>');
    <?php } ?>
    jQuery(document).ready(function () {
        "use strict";

        // Init Theme Core
        Core.init();

        $('#submit_button').click(function () {
            $.ajax({
                url: $('#contact_form').attr('action'), // form action url,
                method: 'post',
                dataType: 'html', // request type html/json/xml
                data: $('#contact_form').serialize(), // serialize form data
                cache: false,
                beforeSend: function () {
                    $.blockUI({message: null});
                },
                success: function (url) {
                    window.location = url;
                },
                error: function (e) {
                    $.unblockUI();
                    alert(e.responseText);
                }
            });
        });
    });
</script>

<!-- END: PAGE SCRIPTS -->

</body>

</html>
