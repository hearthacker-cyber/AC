<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from coderthemes.com/hyper/saas/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 10:18:47 GMT -->

<head>
    <meta charset="utf-8" />
    <title>AC project demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- third party css -->
    <link href="assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link rel="manifest" href="../manifest.json">

    <style>
    @media (max-width: 768px) {
        .btn.btn-secondary.buttons-print {
            display: none;
        }
    }
    </style>
    </s <?php session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['email'])) {
        // Redirect to login page if not logged in
        header('Location: login.html');
        exit();
    }

    ?><body class="loading" data-layout-color="dark" data-leftbar-theme="dark" data-layout-mode="fluid"
        data-rightbar-onstart="true">
    < !-- Begin page -->
        <div class="wrapper"></div>
        < < !-- <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="s<link rel=" manifest"
            href="/manifest.json">
            tylesheet" type="text/css" /> -->




</head>

<body class="loading" data-layout-color="dark" data-leftbar-theme="dark" data-layout-mode="fluid"
    data-rightbar-onstart="true">
    <!-- Pre-loader -->
    <div id="preloader">
        <div id="status">
            <div class="bouncing-loader">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- End Preloader-->
    <div class="wrapper"></div>