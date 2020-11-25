<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.ico')); ?>">

        <title>UNAB | <?php echo $__env->yieldContent('title'); ?></title>

        <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins\morris\morris.css')); ?>">

        <link href="<?php echo e(asset('css\bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('css\core.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('css\components.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('css\icons.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('css\pages.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('css\responsive.css')); ?>" rel="stylesheet" type="text/css">

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo e(asset('js\modernizr.min.js')); ?>"></script>
<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-69506598-1', 'auto');
          ga('send', 'pageview');
        </script>



    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.htm" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Ub<i class="md md-album"></i>ld</span></a>
                        <!-- Image Logo here -->
                        <!--<a href="index.html" class="logo">-->
                            <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                            <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                        <!--</a>-->
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav hidden-xs">
                                <li><a href="#" class="waves-effect waves-light">Files</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </li>
                            </ul>

                            <form role="search" class="navbar-left app-search pull-left hidden-xs">
                           <input type="text" placeholder="Search..." class="form-control">
                           <a href=""><i class="fa fa-search"></i></a>
                      </form>
        <style>
          .noti-me>li>a{
            padding-top: 20px;
                height: 60px;
          }
          .noti-me>li>a #noti-user{
            padding-top: 80px;
                height: 60px;
          }
        </style>

                            <ul class="noti-me nav navbar-nav navbar-right pull-right">
                                <li class="dropdown top-menu-item-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="icon-bell"></i> <span class="badge badge-xs badge-danger">3</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>
                                        <li class="list-group slimscroll-noti notification-list">
                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-diamond noti-primary"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-cog noti-warning"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">New settings</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-bell-o noti-custom"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">Updates</h5>
                                                    <p class="m-0">
                                                        <small>There are <span class="text-primary font-600">2</span> new updates available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-user-plus noti-pink"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">New user registered</h5>
                                                    <p class="m-0">
                                                        <small>You have 10 unread messages</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                            <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-diamond noti-primary"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-cog noti-warning"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">New settings</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="list-group-item text-right">
                                                <small class="font-600">See all notifications</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="icon-settings"></i></a>
                                </li>
                                <li id="noti-user" class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="images\users\avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a></li>
                                        <li class="divider"></li>
                                        <li><a href="javascript:void(0)"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                          <li class="text-muted menu-title">Navigation</li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="index.htm">Dashboard 1</a></li>
                                    <li><a href="dashboard_2.htm">Dashboard 2</a></li>
                                    <li><a href="dashboard_3.htm">Dashboard 3</a></li>
                                    <li><a href="dashboard_4.htm">Dashboard 4</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-paint-bucket"></i> <span> UI Kit </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="ui-buttons.htm">Buttons</a></li>
                                    <li><a href="ui-loading-buttons.htm">Loading Buttons</a></li>
                                    <li><a href="ui-panels.htm">Panels</a></li>
                                    <li><a href="ui-portlets.htm">Portlets</a></li>
                                    <li><a href="ui-checkbox-radio.htm">Checkboxs-Radios</a></li>
                                    <li><a href="ui-tabs.htm">Tabs</a></li>
                                    <li><a href="ui-modals.htm">Modals</a></li>
                                    <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                    <li><a href="ui-notification.htm">Notification</a></li>
                                    <li><a href="ui-images.htm">Images</a></li>
                                    <li><a href="ui-carousel.htm">Carousel</a>
                                    <li><a href="ui-video.htm">Video</a>
                                    <li><a href="ui-bootstrap.htm">Bootstrap UI</a></li>
                                    <li><a href="ui-typography.htm">Typography</a></li>
                                </li></li></ul>
                            

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-light-bulb"></i><span class="label label-primary pull-right">10</span><span> Components </span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="components-grid.htm">Grid</a></li>
                                    <li><a href="components-widgets.htm">Widgets</a></li>
                                    <li><a href="components-nestable-list.htm">Nesteble</a></li>
                                    <li><a href="components-range-sliders.htm">Range sliders</a></li>
                                    <li><a href="components-masonry.htm">Masonry</a></li>
                                    <li><a href="components-animation.htm">Animation</a></li>
                                    <li><a href="components-sweet-alert.htm">Sweet Alert</a></li>
                                    <li><a href="components-sweet-alert_2.htm">Sweet Alert 2</a></li>
                                    <li><a href="components-treeview.htm">Treeview</a></li>
                                    <li><a href="components-tour.htm">Tour</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-spray"></i> <span> Icons </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                  <li><a href="icons-glyphicons.htm">Glyphicons</a></li>
                                    <li><a href="icons-materialdesign.htm">Material Design</a></li>
                                    <li><a href="icons-ionicons.htm">Ion Icons</a></li>
                                    <li><a href="icons-fontawesome.htm">Font awesome</a></li>
                                    <li><a href="icons-themifyicon.htm">Themify Icons</a></li>
                                    <li><a href="icons-simple-line.htm">Simple line Icons</a></li>
                                    <li><a href="icons-weather.htm">Weather Icons</a></li>
                                    <li><a href="icons-typicons.htm">Typicons</a></li>
                                    <li><a href="icons-dripicons.htm">Dripicons</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i><span> Forms </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="form-elements.htm">General Elements</a></li>
                                    <li><a href="form-advanced.htm">Advanced Form</a></li>
                                    <li><a href="form-validation.htm">Form Validation</a></li>
                                    <li><a href="form-pickers.htm">Form Pickers</a></li>
                                    <li><a href="form-wizard.htm">Form Wizard</a></li>
                                    <li><a href="form-mask.htm">Form Masks</a></li>
                                    <li><a href="form-summernote.htm">Summernote</a></li>
                                    <li><a href="form-wysiwig.htm">Wysiwig Editors</a></li>
                                    <li><a href="form-code-editor.htm">Code Editor</a></li>
                                    <li><a href="form-uploads.htm">Multiple File Upload</a></li>
                                    <li><a href="form-filer.htm">Jquery Filer</a></li>
                                    <li><a href="form-xeditable.htm">X-editable</a></li>
                                    <li><a href="form-image-crop.htm">Image Crop</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-menu-alt"></i><span>Tables </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="tables-basic.htm">Basic Tables</a></li>
                                    <li><a href="tables-datatable.htm">Data Table</a></li>
                                    <li><a href="tables-editable.htm">Editable Table</a></li>
                                    <li><a href="tables-responsive.htm">Responsive Table</a></li>
                                    <li><a href="tables-foo-tables.htm">FooTable</a></li>
                                    <li><a href="tables-bootstrap.htm">Bootstrap Tables</a></li>
                                    <li><a href="tables-tablesaw.htm">Tablesaw Tables</a></li>
                                    <li><a href="tables-jsgrid.htm">JsGrid Tables</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-bar-chart"></i><span class="label label-pink pull-right">11</span><span> Charts </span></a>
                                <ul class="list-unstyled">
                                  <li><a href="chart-flot.htm">Flot Chart</a></li>
                                    <li><a href="chart-morris.htm">Morris Chart</a></li>
                                    <li><a href="chart-chartjs.htm">Chartjs</a></li>
                                    <li><a href="chart-peity.htm">Peity Charts</a></li>
                                    <li><a href="chart-chartist.htm">Chartist Charts</a></li>
                                    <li><a href="chart-c3.htm">C3 Charts</a></li>
                                    <li><a href="chart-nvd3.htm"> Nvd3 Charts</a></li>
                                    <li><a href="chart-sparkline.htm">Sparkline charts</a></li>
                                    <li><a href="chart-radial.htm">Radial charts</a></li>
                                    <li><a href="chart-other.htm">Other Chart</a></li>
                                    <li><a href="chart-ricksaw.htm">Ricksaw Chart</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-location-pin"></i><span> Maps </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="map-google.htm"> Google Map</a></li>
                                    <li><a href="map-vector.htm"> Vector Map</a></li>
                                </ul>
                            </li>

                            <li class="text-muted menu-title">More</li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-files"></i><span> Pages </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                  <li><a href="page-starter.htm">Starter Page</a></li>
                                    <li><a href="page-login.htm">Login</a></li>
                                    <li><a href="page-login-v2.htm">Login v2</a></li>
                                    <li><a href="page-register.htm">Register</a></li>
                                    <li><a href="page-register-v2.htm">Register v2</a></li>
                                    <li><a href="page-signup-signin.htm">Signin - Signup</a></li>
                                    <li><a href="page-recoverpw.htm">Recover Password</a></li>
                                    <li><a href="page-lock-screen.htm">Lock Screen</a></li>
                                    <li><a href="page-400.htm">Error 400</a></li>
                                    <li><a href="page-403.htm">Error 403</a></li>
                                    <li><a href="page-404.htm">Error 404</a></li>
                                    <li><a href="page-404_alt.htm">Error 404-alt</a></li>
                                    <li><a href="page-500.htm">Error 500</a></li>
                                    <li><a href="page-503.htm">Error 503</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-gift"></i><span> Extras </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="extra-profile.htm">Profile</a></li>
                                    <li><a href="extra-timeline.htm">Timeline</a></li>
                                    <li><a href="extra-sitemap.htm">Site map</a></li>
                                    <li><a href="extra-invoice.htm">Invoice</a></li>
                                    <li><a href="extra-email-template.htm">Email template</a></li>
                                    <li><a href="extra-maintenance.htm">Maintenance</a></li>
                                    <li><a href="extra-coming-soon.htm">Coming-soon</a></li>
                                    <li><a href="extra-faq.htm">FAQ</a></li>
                                    <li><a href="extra-search-result.htm">Search result</a></li>
                                    <li><a href="extra-gallery.htm">Gallery</a></li>
                                    <li><a href="extra-gallery_2.htm">Gallery 2</a></li>
                                    <li><a href="extra-pricing.htm">Pricing</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-crown"></i><span class="label label-success pull-right">3</span><span> Apps </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="apps-calendar.htm"> Calendar</a></li>
                                    <li><a href="apps-contact.htm"> Contact</a></li>
                                    <li><a href="apps-taskboard.htm"> Taskboard</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-email"></i><span> Email </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="email-inbox.htm"> Inbox</a></li>
                                    <li><a href="email-read.htm"> Read Mail</a></li>
                                    <li><a href="email-compose.htm"> Compose Mail</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-widget"></i><span> Layouts </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="layout-leftbar_2.htm"> Leftbar with User</a></li>
                                    <li><a href="layout-menu-collapsed.htm"> Menu Collapsed</a></li>
                                    <li><a href="layout-menu-small.htm"> Small Menu</a></li>
                                    <li><a href="layout-header_2.htm"> Header style</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-share"></i><span>Multi Level </span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li class="has_sub">
                                        <a href="javascript:void(0);" class="waves-effect"><span>Menu Level 1.1</span>  <span class="menu-arrow"></span></a>
                                        <ul style="">
                                            <li><a href="javascript:void(0);"><span>Menu Level 2.1</span></a></li>
                                            <li><a href="javascript:void(0);"><span>Menu Level 2.2</span></a></li>
                                            <li><a href="javascript:void(0);"><span>Menu Level 2.3</span></a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"><span>Menu Level 1.2</span></a>
                                    </li>
                                </ul>
                            </li>

                            <li class="text-muted menu-title">Extra</li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i><span> Crm </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="crm-dashboard.htm"> Dashboard </a></li>
                                    <li><a href="crm-contact.htm"> Contacts </a></li>
                                    <li><a href="crm-opportunities.htm"> Opportunities </a></li>
                                    <li><a href="crm-leads.htm"> Leads </a></li>
                                    <li><a href="crm-customers.htm"> Customers </a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-shopping-cart"></i><span class="label label-warning pull-right">6</span><span> eCommerce </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="ecommerce-dashboard.htm"> Dashboard</a></li>
                                    <li><a href="ecommerce-products.htm"> Products</a></li>
                                    <li><a href="ecommerce-product-detail.htm"> Product Detail</a></li>
                                    <li><a href="ecommerce-product-edit.htm"> Product Edit</a></li>
                                    <li><a href="ecommerce-orders.htm"> Orders</a></li>
                                    <li><a href="ecommerce-sellers.htm"> Sellers</a></li>
                                </ul>
                            </li>

                        </li></ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">


                    <?php echo $__env->yieldContent('content'); ?>



                </div> <!-- content -->

                <footer class="footer text-right">
                    © 2017. All rights reserved.
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


         
        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo e(asset('js\jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js\bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js\detect.js')); ?>"></script>
        <script src="<?php echo e(asset('js\fastclick.js')); ?>"></script>

        <script src="<?php echo e(asset('js\jquery.slimscroll.js')); ?>"></script>
        <script src="<?php echo e(asset('js\jquery.blockUI.js')); ?>"></script>
        <script src="<?php echo e(asset('js\waves.js')); ?>"></script>
        <script src="<?php echo e(asset('js\wow.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js\jquery.nicescroll.js')); ?>"></script>
        <script src="<?php echo e(asset('js\jquery.scrollTo.min.js')); ?>"></script>

        <script src="<?php echo e(asset('plugins\peity\jquery.peity.min.js')); ?>"></script>

        <!-- jQuery  -->
        <script src="<?php echo e(asset('plugins\waypoints\lib\jquery.waypoints.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins\counterup\jquery.counterup.min.js')); ?>"></script>



        <script src="<?php echo e(asset('plugins\morris\morris.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins\raphael\raphael-min.js')); ?>"></script>

        <script src="<?php echo e(asset('plugins\jquery-knob\jquery.knob.js')); ?>"></script>

        <script src="<?php echo e(asset('pages\jquery.dashboard.js')); ?>"></script>

        <script src="<?php echo e(asset('js\jquery.core.js')); ?>"></script>
        <script src="<?php echo e(asset('js\jquery.app.js')); ?>"></script>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });

                $(".knob").knob();

            });
        </script>




    </body>
</html>