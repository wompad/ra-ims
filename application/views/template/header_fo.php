<?php

  if (session_status() == PHP_SESSION_ACTIVE) {
    if(!isset($_SESSION['username'])){
      header('Location: ../index');
    }
  }else{
    session_start();
  }

?>

<?php header('Access-Control-Allow-Origin: *'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets_0/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets_0/assets/images/favicon.png" type="image/x-icon">
    <title>DSWD RA-IMS</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/prism.css">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/select2.css">

    <link rel="stylesheet" type="text/css" href="../assets_0/assets/jquery-confirm/css/jquery-confirm.css">

    <!-- Plugins css Ends-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/leaflet/leaflet.css">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/leaflet/MarkerCluster.css">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/leaflet/MarkerCluster.Default.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets_0/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/toastify.css">

    <style>
      .notread{
        background-color: #FFFFFF;
      }
      .isread{
        background-color: #DADFD3;
      }

      .loader {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: inline-block;
        border-top: 4px solid #dc3545;
        border-right: 4px solid transparent;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
      }
      .loader::after {
        content: '';  
        box-sizing: border-box;
        position: absolute;
        left: 0;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border-bottom: 4px solid #2c323f;
        border-left: 4px solid transparent;
      }
      @keyframes rotation {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      } 
      

    </style>

  </head>
  <!-- <body onload="initKeycloak()" ng-app="myApp" ng-controller="FOCtrl"> -->
  <body ng-app="myApp" ng-controller="FOCtrl">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->

      <!-- Diri ang ulo -->
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="../assets_0/assets/images/logo/logo.png" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <div class="nav-right pull-right right-header p-0">
            <ul class="nav-menus">
              <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <li class="profile-nav onhover-dropdown p-0 me-0">
                <div class="media profile-media"><img class="b-r-10" ng-src="{{tmp_profile}}" alt="" style="width:40px">
                  <div class="media-body"><span>{{tmpfirstname}} {{tmplastname}}</span>
                    <p class="mb-0 font-roboto">Hello <i class="middle fa fa-angle-down"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <!-- <li><a href="#"><i data-feather="user"></i><span>Account </span></a></li>
                  <li><a href="#"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li><a href="#"><i data-feather="file-text"></i><span>Taskboard</span></a></li> -->
                  <li><a href="lgu_settings"><i data-feather="settings"></i><span>Settings</span></a></li>
                  <li><a href="logout"><i data-feather="log-out"> </i><span>Log Out</span></a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <!-- diri ang menu-->
        <div class="sidebar-wrapper">
          <div>
            <div class="logo-wrapper title text-danger"><h3>RA-IMS</h3>
              <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
            </div>
            <div class="logo-icon-wrapper"><a href="index"><img class="img-fluid" src="../assets_0/assets/images/logo/logo-icon.png" alt=""></a></div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn"><a href="index"><img class="img-fluid" src="../assets_0/assets/images/logo/logo-icon.png" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6>Main</h6>
                      <p>View your Dashboard</p>
                    </div>
                  </li>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="dashboard">
                    <i data-feather="home"></i><span> Dashboard</span></a>
                  </li>
                  <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="downloadables">
                    <i data-feather="download-cloud"></i><span> Downloadables</span></a>
                  </li> -->
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title"><i data-feather="user"></i><span>User Profile</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="user_profile"> About</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6>My DRRM Tools</h6>
                      <p>Select a tool to get started</p>
                    </div>
                  </li>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="inbox"></i><span>Augmentation</span> <label class="badge badge-danger"></label></a>
                    <ul class="sidebar-submenu">
                      <li><a href="manage_request"> Received Requests <span class="text-danger"></span></a></li>
                      <li><a href="track_request">Approved Requests</a></li>
                      <li><a href="request_summary">Request Summary</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="home"></i><span>Evacuation Centers</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="evacuation_centers"> EC List and Reports</a></li>
                      <li><a href="evacuation_map">View EC Map</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="stockpile">
                    <i data-feather="package"></i><span>Available Stockpile</span></a>
                  </li>
                  <!-- <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="github"></i><span>Trainings</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="enrol_courses"> Enrol to Courses</a></li>
                    </ul>
                  </li> -->
                  <!-- <li class="sidebar-main-title">
                    <div>
                      <h6 >User Management</h6>
                      <p>Choose certain actions for users</p>
                    </div>
                  </li>
                  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="landing-page.html"><i data-feather="users"> </i><span>Activate Users</span></a></li> -->
                </ul>
              </div>
            </nav>
          </div>  
        </div>
        <!-- Page Sidebar Ends-->