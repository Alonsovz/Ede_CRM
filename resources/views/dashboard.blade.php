<html ng-app="inspinia" class="ng-scope"><head><style type="text/css">[uib-typeahead-popup].dropdown-menu{display:block;}</style><style type="text/css">.uib-time input{width:50px;}</style><style type="text/css">.uib-datepicker .uib-title{width:100%;}.uib-day button,.uib-month button,.uib-year button{min-width:100%;}.uib-datepicker-popup.dropdown-menu{display:block;}.uib-button-bar{padding:10px 9px 2px;}</style><style type="text/css">.ng-animate.item:not(.left):not(.right){-webkit-transition:0s ease-in-out left;transition:0s ease-in-out left}</style><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title set in pageTitle directive -->
    <title page-title="">EDESAL | CRM</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Font awesome -->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Main Inspinia CSS files -->
    <link href="css/animate.css" rel="stylesheet">
    <link id="loadBefore" href="css/style.css" rel="stylesheet"><script src="js/plugins/flot/jquery.flot.js"></script><script src="js/plugins/chartJs/angles.js" async=""></script><script src="js/plugins/chartJs/Chart.min.js" async=""></script><script src="js/plugins/peity/jquery.peity.min.js" async=""></script><script src="js/plugins/peity/angular-peity.js" async=""></script><script src="js/plugins/flot/jquery.flot.time.js"></script><script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script><script src="js/plugins/flot/jquery.flot.spline.js"></script><script src="js/plugins/flot/jquery.flot.resize.js"></script><script src="js/plugins/flot/jquery.flot.pie.js"></script><script src="js/plugins/flot/curvedLines.js"></script><script src="js/plugins/flot/angular-flot.js"></script>




    <script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/35/1/intl/es_ALL/common.js"></script><script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/35/1/intl/es_ALL/util.js"></script></head>

<!-- ControllerAs syntax -->
<!-- Main controller with serveral data used in Inspinia theme on diferent view -->
<body ng-controller="MainCtrl as main" class="fixed-sidebar fixed-nav md-skin  pace-done" landing-scrollspy="" id="page-top"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div></div>

<!-- Main view  -->
<!-- uiView:  --><div ui-view="" class="ng-scope"><!-- Wrapper-->
    <div id="wrapper" class="ng-scope">

        <!-- Navigation -->
        <!-- ngInclude: 'views/common/navigation.html' --><div ng-include="'views/common/navigation.html'" class="ng-scope"><nav class="navbar-default navbar-static-side ng-scope" role="navigation">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="sidebar-collapse" style="overflow: hidden; width: auto; height: 100%;">
                        <ul side-navigation="" class="nav metismenu" id="side-menu">
                            <li class="nav-header">

                                <div class="profile-element dropdown" uib-dropdown="">
                                    <img alt="image" class="img-circle" src="img/profile_small.jpg">
                                    <a uib-dropdown-toggle="" href="" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">David Williams</strong>
                             </span>
                                <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                            </span>
                                    </a>
                                    <ul uib-dropdown-menu="" class="animated fadeInRight m-t-xs dropdown-menu">
                                        <li><a ui-sref="app.profile" href="#/app/profile">Profile</a></li>
                                        <li><a ui-sref="app.contacts" href="#/app/contacts">Contacts</a></li>
                                        <li><a ui-sref="mailbox.inbox" href="#/mailbox/inbox">Mailbox</a></li>
                                        <li class="divider"></li>
                                        <li><a ui-sref="login">Logout</a></li>
                                    </ul>
                                </div>
                                <div class="logo-element">
                                    IN+
                                </div>
                            </li>
                            <li ng-class="{active: $state.includes('dashboards')}">
                                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label ng-binding">Dashboard</span> <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse" ng-class="{in: $state.includes('dashboards')}">
                                    <li ui-sref-active="active"><a ui-sref="dashboards.dashboard_1" class="ng-binding" href="#/dashboards/dashboard_1">Dashboard v.1</a></li>
                                    <li ui-sref-active="active"><a ui-sref="dashboards.dashboard_2" class="ng-binding" href="#/dashboards/dashboard_2">Dashboard v.2</a></li>
                                    <li ui-sref-active="active"><a ui-sref="dashboards.dashboard_3" class="ng-binding" href="#/dashboards/dashboard_3">Dashboard v.3</a></li>
                                    <li ui-sref-active="active"><a ui-sref="dashboards.dashboard_4_1" class="ng-binding" href="#/dashboards/dashboard_4_1">Dashboard v.4</a></li>
                                    <li ui-sref-active="active"><a ui-sref="dashboards.dashboard_5" class="ng-binding" href="#/dashboards/dashboard_5">Dashboard v.5 </a></li>
                                </ul>
                            </li>
                            <li ui-sref-active="active">
                                <a ui-sref="layouts" href="#/layouts"><i class="fa fa-diamond"></i> <span class="nav-label ng-binding">Layouts</span> </a>
                            </li>

                            <li ng-class="{active: $state.includes('charts')}">
                                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label ng-binding">Graphs</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse" ng-class="{in: $state.includes('charts')}">
                                    <li ui-sref-active="active"><a ui-sref="charts.flot_chart" href="#/charts/flot_chart">Flot Charts</a></li>
                                    <li ui-sref-active="active"><a ui-sref="charts.rickshaw_chart" href="#/charts/rickshaw_chart">Rickshaw Charts</a></li>
                                    <li ui-sref-active="active"><a ui-sref="charts.c3charts" href="#/charts/c3charts">c3 charts</a></li>
                                    <li ui-sref-active="active"><a ui-sref="charts.chartjs_chart" href="#/charts/chartjs_chart">Chart.js</a></li>
                                    <li ui-sref-active="active"><a ui-sref="charts.chartist_chart" href="#/charts/chartist_chart">Chartist</a></li>
                                    <li ui-sref-active="active"><a ui-sref="charts.peity_chart" href="#/charts/peity_chart">Peity Charts</a></li>
                                    <li ui-sref-active="active"><a ui-sref="charts.sparkline_chart" href="#/charts/sparkline_chart">Sparkline Charts</a></li>
                                </ul>
                            </li>
                            <li ng-class="{active: $state.includes('mailbox')}">
                                <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label ng-binding">Mailbox </span><span class="label label-warning pull-right">16/24</span></a>
                                <ul class="nav nav-second-level collapse" ng-class="{in: $state.includes('mailbox')}">
                                    <li ui-sref-active="active"><a ui-sref="mailbox.inbox" href="#/mailbox/inbox">Inbox</a></li>
                                    <li ui-sref-active="active"><a ui-sref="mailbox.email_view" href="#/mailbox/email_view">Email view</a></li>
                                    <li ui-sref-active="active"><a ui-sref="mailbox.email_compose" href="#/mailbox/email_compose">Compose email</a></li>
                                    <li ui-sref-active="active"><a ui-sref="mailbox.email_template" href="#/mailbox/email_template">Email template</a></li>
                                </ul>
                            </li>
                            <li ui-sref-active="active">
                                <a ui-sref="metrics" href="#/metrics"><i class="fa fa-pie-chart"></i> <span class="nav-label ng-binding">Metrics</span> </a>
                            </li>
                            <li ui-sref-active="active">
                                <a ui-sref="widgets" href="#/widgets"><i class="fa fa-flask"></i> <span class="nav-label ng-binding">Widgets</span></a>
                            </li>
                            <li ng-class="{active: $state.includes('forms')}">
                                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label ng-binding">Forms</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse" ng-class="{in: $state.includes('forms')}">
                                    <li ui-sref-active="active"><a ui-sref="forms.basic_form" href="#/forms/basic_form">Basic form</a></li>
                                    <li ui-sref-active="active"><a ui-sref="forms.advanced_plugins" href="#/forms/advanced_plugins">Advanced Plugins</a></li>
                                    <li ui-sref-active="active"><a ui-sref="forms.wizard.step_one" href="#/forms/wizard/step_one">Wizard</a></li>
                                    <li ui-sref-active="active"><a ui-sref="forms.file_upload" href="#/forms/file_upload">File Upload</a></li>
                                    <li ui-sref-active="active"><a ui-sref="forms.text_editor" href="#/forms/text_editor">Text Editor</a></li>
                                    <li ui-sref-active="active"><a ui-sref="forms.autocomplete" href="#/forms/autocomplete">Autocomplete</a></li>
                                    <li ui-sref-active="active"><a ui-sref="forms.markdown" href="#/forms/markdown">Markdown</a></li>
                                </ul>
                            </li>
                            <li ng-class="{active: $state.includes('app')}">
                                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label ng-binding">App views</span>  <span class="pull-right label label-primary">SPECIAL</span></a>
                                <ul class="nav nav-second-level collapse" ng-class="{in: $state.includes('app')}">
                                    <li ui-sref-active="active"><a ui-sref="app.contacts" href="#/app/contacts">Contacts</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.profile" href="#/app/profile">Profile</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.profile_2" href="#/app/profile_2">Profile v.2</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.contacts_2" href="#/app/contacts_2">Contacts v.2</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.projects" href="#/app/projects">Projects</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.project_detail" href="#/app/project_detail">Project detail</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.activity_stream" href="#/app/activity_stream">Activity stream</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.teams_board" href="#/app/teams_board">Teams board</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.social_feed" href="#/app/social_feed">Social feed</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.clients" href="#/app/clients">Clients</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.vote_list" href="#/app/vote_list">Vote list</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.file_manager" href="#/app/file_manager">File manager</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.calendar" href="#/app/calendar">Calendar</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.issue_tracker" href="#/app/issue_tracker">Issue tracker</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.blog" href="#/app/blog">Blog</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.article" href="#/app/article">Article</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.faq" href="#/app/faq">FAQ</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.timeline" href="#/app/timeline">Timeline</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.pin_board" href="#/app/pin_board">Pin board</a></li>
                                    <li ui-sref-active="active"><a ui-sref="app.invoice" href="#/app/invoice">Invoice</a></li>
                                </ul>
                            </li>
                            <li ng-class="{active: $state.includes('pages')}" class="">
                                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label ng-binding">Other pages</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse" ng-class="{in: $state.includes('pages')}" style="height: 0px;">
                                    <li ui-sref-active="active"><a ui-sref="pages.search_results" href="#/pages/search_results">Search results</a></li>
                                    <li><a ui-sref="lockscreen" href="#/lockscreen">Lockscreen</a></li>
                                    <li><a ui-sref="errorOne" href="#/errorOne">404 Page</a></li>
                                    <li><a ui-sref="errorTwo" href="#/errorTwo">500 Page</a></li>
                                    <li><a ui-sref="login">Login</a></li>
                                    <li><a ui-sref="login_two_columns" href="#/login_two_columns">Login v.2</a></li>
                                    <li><a ui-sref="forgot_password" href="#/forgot_password">Forgot password</a></li>
                                    <li><a ui-sref="register" href="#/register">Register</a></li>
                                    <li ui-sref-active="active" class="active"><a ui-sref="pages.empy_page" href="#/pages/empy_page">Empty page</a></li>
                                </ul>
                            </li>
                            <li ng-class="{active: $state.includes('miscellaneous')}">
                                <a href="#"><i class="fa fa-globe"></i> <span class="nav-label ng-binding">Miscellaneous</span> <span class="label label-info pull-right">NEW</span></a>
                                <ul class="nav nav-second-level collapse" ng-class="{in: $state.includes('miscellaneous')}">
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.notify" href="#/miscellaneous/notify">Notification</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.nestable_list" href="#/miscellaneous/nestable_list">Nestable list</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.agile_board" href="#/miscellaneous/agile_board">Agile board</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.timeline_2" href="#/miscellaneous/timeline_2">Timeline v.2</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.diff" href="#/miscellaneous/diff">Diff</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.pdf_viewer" href="#/miscellaneous/pdf_viewer">PDF viewer</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.i18support" href="#/miscellaneous/i18support">i18support</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.sweet_alert" href="#/miscellaneous/sweet_alert">Sweet alert</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.idle_timer" href="#/miscellaneous/idle_timer">Idle timer</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.truncate" href="#/miscellaneous/truncate">Truncate</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.password_meter" href="#/miscellaneous/password_meter">Password meter</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.spinners" href="#/miscellaneous/spinners">Spinners</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.spinners_usage" href="#/miscellaneous/spinners_usage">Spinners usage</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.live_favicon" href="#/miscellaneous/live_favicon">Live favicon</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.google_maps" href="#/miscellaneous/google_maps">Google maps</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.datamaps" href="#/miscellaneous/datamaps">Datamaps</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.socialbuttons" href="#/miscellaneous/socialbuttons">Social buttons</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.code_editor" href="#/miscellaneous/code_editor">Code editor</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.modal_window" href="#/miscellaneous/modal_window">Modal window</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.clipboard" href="#/miscellaneous/clipboard">Clipboard</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.text_spinners" href="#/miscellaneous/text_spinners">Text spinners</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.forum_view" href="#/miscellaneous/forum_view">Forum view</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.validation" href="#/miscellaneous/validation">Validation</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.tree_view" href="#/miscellaneous/tree_view">Tree view</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.loading_buttons" href="#/miscellaneous/loading_buttons">Loading buttons</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.chat_view" href="#/miscellaneous/chat_view">Chat view</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.masonry" href="#/miscellaneous/masonry">Masonry</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.toastr" href="#/miscellaneous/toastr">Toastr notification</a></li>
                                    <li ui-sref-active="active"><a ui-sref="miscellaneous.tour" href="#/miscellaneous/tour">Tour</a></li>
                                </ul>
                            </li>
                            <li ng-class="{active: $state.includes('ui')}">
                                <a href="#"><i class="fa fa-flask"></i> <span class="nav-label ng-binding">UI elements</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse" ng-class="{in: $state.includes('ui')}">
                                    <li ui-sref-active="active"><a ui-sref="ui.typography" href="#/ui/typography">Typography</a></li>
                                    <li ui-sref-active="active"><a ui-sref="ui.icons" href="#/ui/icons">Icons</a></li>
                                    <li ui-sref-active="active"><a ui-sref="ui.draggable" href="#/ui/draggable">Draggable Panels</a></li>
                                    <li ui-sref-active="active"><a ui-sref="ui.buttons" href="#/ui/buttons">Buttons</a></li>
                                    <li ui-sref-active="active"><a ui-sref="ui.video" href="#/ui/video">Video</a></li>
                                    <li ui-sref-active="active"><a ui-sref="ui.tabs_panels" href="#/ui/tabs_panels">Panels</a></li>
                                    <li ui-sref-active="active"><a ui-sref="ui.tabs" href="#/ui/tabs">Tabs</a></li>
                                    <li ui-sref-active="active"><a ui-sref="ui.notifications_tooltips" href="#/ui/notifications_tooltips">Notifications &amp; Tooltips</a></li>
                                    <li ui-sref-active="active"><a ui-sref="ui.helper_classes" href="#/ui/helper_classes">Helper css classes</a></li>
                                    <li ui-sref-active="active"><a ui-sref="ui.badges_labels" href="#/ui/badges_labels">Badges, Labels, Progress</a></li>
                                </ul>
                            </li>
                            <li ui-sref-active="active">
                                <a ui-sref="grid_options"><i class="fa fa-laptop"></i> <span class="nav-label ng-binding">Grid options</span></a>
                            </li>
                            <li ng-class="{active: $state.includes('tables')}">
                                <a href="#"><i class="fa fa-table"></i> <span class="nav-label ng-binding">Tables</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse" ng-class="{in: $state.includes('tables')}">
                                    <li ui-sref-active="active"><a ui-sref="tables.static_table" href="#/tables/static_table">Static Tables</a></li>
                                    <li ui-sref-active="active"><a ui-sref="tables.data_tables" href="#/tables/data_tables">Data Tables</a></li>
                                    <li ui-sref-active="active"><a ui-sref="tables.foo_table" href="#/tables/foo_table">Foo Table</a></li>
                                    <li ui-sref-active="active"><a ui-sref="tables.nggrid" href="#/tables/nggrid">NG Grid</a></li>
                                </ul>
                            </li>
                            <li ng-class="{active: $state.includes('commerce')}">
                                <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label ng-binding">E-commerce</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse" ng-class="{in: $state.includes('commerce')}">
                                    <li ui-sref-active="active"><a ui-sref="commerce.products_grid" href="#/commerce/products_grid">Products grid</a></li>
                                    <li ui-sref-active="active"><a ui-sref="commerce.product_list" href="#/commerce/product_list">Products list</a></li>
                                    <li ui-sref-active="active"><a ui-sref="commerce.product" href="#/commerce/product">Product edit</a></li>
                                    <li ui-sref-active="active"><a ui-sref="commerce.product_details" href="#/commerce/product_details">Product detail</a></li>
                                    <li ui-sref-active="active"><a ui-sref="commerce.cart" href="#/commerce/cart">Cart</a></li>
                                    <li ui-sref-active="active"><a ui-sref="commerce.orders" href="#/commerce/orders">Orders</a></li>
                                    <li ui-sref-active="active"><a ui-sref="commerce.payments" href="#/commerce/payments">Credit Card form</a></li>
                                </ul>
                            </li>
                            <li ng-class="{active: $state.includes('gallery')}">
                                <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label ng-binding">Gallery</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse" ng-class="{in: $state.includes('gallery')}">
                                    <li ui-sref-active="active"><a ui-sref="gallery.basic_gallery" href="#/gallery/basic_gallery">Lightbox Gallery</a></li>
                                    <li ui-sref-active="active"><a ui-sref="gallery.slick_gallery" href="#/gallery/slick_gallery">Slick Carousel</a></li>
                                    <li ui-sref-active="active"><a ui-sref="gallery.bootstrap_carousel" href="#/gallery/bootstrap_carousel">Bootstrap Carousel</a></li>

                                </ul>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-sitemap"></i> <span class="nav-label ng-binding">Menu levels</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li>
                                        <a href="">Third Level <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level collapse">
                                            <li>
                                                <a href="">Third Level Item</a>
                                            </li>
                                            <li>
                                                <a href="">Third Level Item</a>
                                            </li>
                                            <li>
                                                <a href="">Third Level Item</a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li><a href="">Second Level Item</a></li>
                                    <li>
                                        <a href="">Second Level Item</a></li>
                                    <li>
                                        <a href="">Second Level Item</a></li>
                                </ul>
                            </li>
                            <li ui-sref-active="active">
                                <a ui-sref="css_animations" href="#/css_animations"><i class="fa fa-magic"></i> <span class="nav-label ng-binding">Animations</span><span class="label label-info pull-right">62</span></a>
                            </li>
                            <li class="landing_link">
                                <a ui-sref="landing" href="#/landing"><i class="fa fa-star"></i> <span class="nav-label ng-binding">Landing page</span> <span class="label label-warning pull-right">NEW</span></a>
                            </li>
                        </ul>

                    </div><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 0px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 376.921px;"></div><div class="slimScrollRail" style="width: 0px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
            </nav></div>

        <!-- Page wraper -->
        <!-- ng-class with current state name give you the ability to extended customization your view -->
        <div id="page-wrapper" class="gray-bg pages.empy_page" style="min-height: 567px;">

            <!-- Page wrapper -->
            <!-- ngInclude: 'views/common/topnavbar.html' --><div ng-include="'views/common/topnavbar.html'" class="ng-scope"><div class="row border-bottom ng-scope">
                    <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <span minimaliza-sidebar=""><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="" ng-click="minimalize()"><i class="fa fa-bars"></i></a></span>
                            <form role="search" class="navbar-form-custom ng-pristine ng-valid" method="post" action="views/search_results.html">
                                <div class="form-group">
                                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                                </div>
                            </form>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <!--<li>-->
                            <!--<span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>-->
                            <!--</li>-->
                            <li uib-dropdown="" class="dropdown">
                                <a class="count-info dropdown-toggle" href="" uib-dropdown-toggle="" aria-haspopup="true" aria-expanded="false">
                                    Language
                                </a>
                                <ul uib-dropdown-menu="" class="animated fadeInRight m-t-xs ng-scope dropdown-menu" ng-controller="translateCtrl">
                                    <li><a ng-click="changeLanguage('en')">English</a></li>
                                    <li><a ng-click="changeLanguage('es')">Spanish</a></li>
                                </ul>
                            </li>
                            <li uib-dropdown="" class="dropdown">
                                <a class="count-info dropdown-toggle" href="" uib-dropdown-toggle="" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                                </a>
                                <ul class="dropdown-messages dropdown-menu" uib-dropdown-menu="">
                                    <li>
                                        <div class="dropdown-messages-box">
                                            <a ui-sref="profile" class="pull-left">
                                                <img alt="image" class="img-circle" src="img/a7.jpg">
                                            </a>

                                            <div>
                                                <small class="pull-right">46h ago</small>
                                                <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                                <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="dropdown-messages-box">
                                            <a ui-sref="profile" class="pull-left">
                                                <img alt="image" class="img-circle" src="img/a4.jpg">
                                            </a>

                                            <div>
                                                <small class="pull-right text-navy">5h ago</small>
                                                <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                                <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="dropdown-messages-box">
                                            <a ui-sref="profile" class="pull-left">
                                                <img alt="image" class="img-circle" src="img/profile.jpg">
                                            </a>

                                            <div>
                                                <small class="pull-right">23h ago</small>
                                                <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                                <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="text-center link-block">
                                            <a ui-sref="mailbox.inbox" href="#/mailbox/inbox">
                                                <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li uib-dropdown="" class="dropdown">
                                <a class="count-info dropdown-toggle" href="" uib-dropdown-toggle="" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                                </a>
                                <ul class="dropdown-alerts dropdown-menu" uib-dropdown-menu="">
                                    <li>
                                        <a ui-sref="inbox">
                                            <div>
                                                <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                                <span class="pull-right text-muted small">4 minutes ago</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a ui-sref="profile">
                                            <div>
                                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                                <span class="pull-right text-muted small">12 minutes ago</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a ui-sref="grid_options">
                                            <div>
                                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                                <span class="pull-right text-muted small">4 minutes ago</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="text-center link-block">
                                            <a ui-sref="miscellaneous.notify" href="#/miscellaneous/notify">
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a ui-sref="login">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                            <li>
                                <a ng-click="$root.rightSidebar = !$root.rightSidebar">
                                    <i class="fa fa-tasks"></i>
                                </a>
                            </li>
                        </ul>

                    </nav>
                </div></div>

            <!-- Main view  -->
            <!-- uiView:  --><div ui-view="" class="ng-scope"><div class="row wrapper border-bottom white-bg page-heading ng-scope">
                    <div class="col-sm-4">
                        <h2>This is main title</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="index.html">This is</a>
                            </li>
                            <li class="active">
                                <strong>Breadcrumb</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-8">
                        <div class="title-action">
                            <a href="" class="btn btn-primary">This is action area</a>
                        </div>
                    </div>
                </div>
                <div class="row ng-scope">
                    <div class="col-lg-12">
                        <div class="wrapper wrapper-content">
                            <div class="middle-box text-center animated fadeInRightBig">
                                <h3 class="font-bold">This is page content</h3>

                                <div class="error-desc">
                                    You can create here any grid layout you want. And any variation layout you imagine:) Check out main dashboard and other site. It use many different layout.
                                    <br><a ui-sref="dashboard_1" class="btn btn-primary m-t">Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></div>

            <!-- Footer -->
            <!-- ngInclude: 'views/common/footer.html' --><div ng-include="'views/common/footer.html'" class="ng-scope"><div class="footer ng-scope">
                    <div class="pull-right">
                        10GB of <strong>250GB</strong> Free.
                    </div>
                    <div>
                        <strong>Copyright</strong> Example Company © 2015-2017
                    </div>
                </div>
            </div>

        </div>
        <!-- End page wrapper-->

        <!-- Right Sidebar -->
        <!-- ngInclude: 'views/common/right_sidebar.html' --><div ng-include="'views/common/right_sidebar.html'" class="ng-scope"><div id="right-sidebar" ng-show="rightSidebar" class="sidebar-open ng-scope ng-hide">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="sidebar-container" full-scroll="" style="overflow: hidden; width: auto; height: 100%;">

                        <ul class="nav nav-tabs navs-3">

                            <li ng-class="{active: tab1}" class="active"><a ng-click="tab1 = true; tab2 = false; tab3 = false" ng-init="tab1 = true">
                                    Notes
                                </a></li>
                            <li ng-class="{active: tab2}"><a ng-click="tab2 = true; tab1 = false; tab3 = false">
                                    Projects
                                </a></li>
                            <li ng-class="{active: tab3}"><a ng-click="tab3 = true; tab1 = false; tab2 = false">
                                    <i class="fa fa-gear"></i>
                                </a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" ng-class="{active: tab1}">
                                <div class="sidebar-title">
                                    <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                                    <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                                </div>
                                <div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a1.jpg">

                                                <div class="m-t-xs">
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">

                                                There are many variations of passages of Lorem Ipsum available.
                                                <br>
                                                <small class="text-muted">Today 4:21 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a2.jpg">
                                            </div>
                                            <div class="media-body">
                                                The point of using Lorem Ipsum is that it has a more-or-less normal.
                                                <br>
                                                <small class="text-muted">Yesterday 2:45 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                                <div class="m-t-xs">
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                <br>
                                                <small class="text-muted">Yesterday 1:10 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                            </div>

                                            <div class="media-body">
                                                Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                                <br>
                                                <small class="text-muted">Monday 8:37 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a8.jpg">
                                            </div>
                                            <div class="media-body">

                                                All the Lorem Ipsum generators on the Internet tend to repeat.
                                                <br>
                                                <small class="text-muted">Today 4:21 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a7.jpg">
                                            </div>
                                            <div class="media-body">
                                                Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                                <br>
                                                <small class="text-muted">Yesterday 2:45 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                                <div class="m-t-xs">
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                                <br>
                                                <small class="text-muted">Yesterday 1:10 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                            </div>
                                            <div class="media-body">
                                                Uncover many web sites still in their infancy. Various versions have.
                                                <br>
                                                <small class="text-muted">Monday 8:37 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" ng-class="{active: tab2}">
                                <div class="sidebar-title">
                                    <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                                    <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                                </div>
                                <ul class="sidebar-list">
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Business valuation</h4>
                                            It is a long established fact that a reader will be distracted.

                                            <div class="small">Completion with: 22%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                            </div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Contract with Company </h4>
                                            Many desktop publishing packages and web page editors.

                                            <div class="small">Completion with: 48%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Meeting</h4>
                                            By the readable content of a page when looking at its layout.

                                            <div class="small">Completion with: 14%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-primary pull-right">NEW</span>
                                            <h4>The generated</h4>
                                            <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                            There are many variations of passages of Lorem Ipsum available.
                                            <div class="small">Completion with: 22%</div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Business valuation</h4>
                                            It is a long established fact that a reader will be distracted.

                                            <div class="small">Completion with: 22%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                            </div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Contract with Company </h4>
                                            Many desktop publishing packages and web page editors.

                                            <div class="small">Completion with: 48%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Meeting</h4>
                                            By the readable content of a page when looking at its layout.

                                            <div class="small">Completion with: 14%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-primary pull-right">NEW</span>
                                            <h4>The generated</h4>
                                            <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                            There are many variations of passages of Lorem Ipsum available.
                                            <div class="small">Completion with: 22%</div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>

                                </ul>

                            </div>

                            <div class="tab-pane" ng-class="{active: tab3}">

                                <div class="sidebar-title">
                                    <h3><i class="fa fa-gears"></i> Settings</h3>
                                    <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                                </div>

                                <div class="setings-item">
                    <span>
                        Show notifications
                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                            <label class="onoffswitch-label" for="example">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                    <span>
                        Disable Chat
                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" checked="" class="onoffswitch-checkbox" id="example2">
                                            <label class="onoffswitch-label" for="example2">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                    <span>
                        Enable history
                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                            <label class="onoffswitch-label" for="example3">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                    <span>
                        Show charts
                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                            <label class="onoffswitch-label" for="example4">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                    <span>
                        Offline users
                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" checked="" name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                                            <label class="onoffswitch-label" for="example5">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                    <span>
                        Global search
                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" checked="" name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                                            <label class="onoffswitch-label" for="example6">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                    <span>
                        Update everyday
                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                            <label class="onoffswitch-label" for="example7">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="sidebar-content">
                                    <h4>Settings</h4>
                                    <div class="small">
                                        I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                        Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.9; z-index: 90; right: 1px;"></div></div>
            </div></div>

    </div>
    <!-- End wrapper--></div>

<!-- jQuery and Bootstrap -->
<script async="" src="//www.google-analytics.com/analytics.js"></script><script src="js/jquery/jquery-3.1.1.min.js"></script>
<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>

<!--<script src="js/plugins/d3/d3.min.js"></script>-->
<!--<script src="js/plugins/topojson/topojson.js"></script>-->

<!-- MetsiMenu -->
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- SlimScroll -->
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Peace JS -->
<script src="js/plugins/pace/pace.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>

<!-- Main Angular scripts-->
<script src="js/angular/angular.min.js"></script>
<script src="js/angular/angular-sanitize.js"></script>
<script src="js/plugins/oclazyload/dist/ocLazyLoad.min.js"></script>
<script src="js/angular-translate/angular-translate.min.js"></script>
<script src="js/ui-router/angular-ui-router.min.js"></script>
<script src="js/bootstrap/ui-bootstrap-tpls-1.1.2.min.js"></script>
<script src="js/plugins/angular-idle/angular-idle.js"></script>

<!--
 You need to include this script on any page that has a Google Map.
 When using Google Maps on your own site you MUST signup for your own API key at:
 https://developers.google.com/maps/documentation/javascript/tutorial#api_key
 After your sign up replace the key in the URL below..
-->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQTpXj82d8UpCi97wzo_nKXL7nYrd4G70"></script>

<!-- Anglar App Script -->
<script src="js/app.js"></script>
<script src="js/config.js"></script>
<script src="js/translations.js"></script>
<script src="js/directives.js"></script>
<script src="js/controllers.js"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-4625583-2', 'webapplayers.com');
    ga('send', 'pageview');

</script>



</body></html>