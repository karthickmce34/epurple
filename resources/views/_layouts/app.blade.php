<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title','Home') - Megawin SwitchGear</title>
        <?php
        $base_material_path = "/material_admin_1.7.1/jQuery/light/seed/";
        $base_material_path_ful = "/material_admin_1.7.1/jQuery/light/full/";
        ?>
        
        @section('css')
        <!-- Vendor CSS -->
        <link rel="shortcut icon" href="{{asset("")}}favicon.ico" />

        <link href="{{asset($base_material_path)}}/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path_ful)}}/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
        <link href="{{asset($base_material_path_ful)}}/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path_ful)}}/vendors/bower_components/chosen/chosen.css" rel="stylesheet">
        <link href="{{asset($base_material_path_ful)}}/vendors/bower_components/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path_ful)}}/vendors/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        
       
        <!-- CSS -->
        <link href="{{asset($base_material_path_ful)}}/css/app_1.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path_ful)}}/css/app_2.min.css" rel="stylesheet">
        
        <!--link href="{{asset("/Treegrid/")}}/docs/bootstrap/css/bootstrap.min.css" rel="stylesheet"-->
        <link href="{{asset("/Treegrid/")}}/dist/css/jquery.treegrid.css" rel="stylesheet">
        
        <link href="{{asset("/balancesheet/")}}/css/infragistics.theme.css" rel="stylesheet" />
        <link href="{{asset("/balancesheet/")}}/css/infragistics.css" rel="stylesheet" />
        <link href="{{asset("/balancesheet/")}}/css/infragistics.ui.treegrid.css" rel="stylesheet" />

        <link href="{{asset("/c3/")}}/c3.css" rel="stylesheet">
        
        @show
        
        <style type='text/css'>
            /* Overwrite your normal rows (make them light green) */
            /*.ui-iggrid-table tr {
                  background: white;
            }*/

            /* Add a style to handle the hovering event */
            /*.ui-iggrid-table tr .ui-state-hover {
                  background: green;
                  color: #FFF;
            }

            /* You'll also need to handle the alternating row styles */
           /* .ui-iggrid-table tr.ui-ig-altrecord {
                  background: lightblue;
            }

            /* As well as the hover styles for those as well */
            /*.ui-iggrid-table tr.ui-ig-altrecord .ui-state-hover {
                  background: blue;
                  color: #FFF;
            }*/
        </style>

    </head>

    <body>
        <header id="header" class="clearfix" data-ma-theme="blue">
            <ul class="h-inner">
                <li class="hi-trigger ma-trigger" data-ma-action="sidebar-open" data-ma-target="#sidebar">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>

                <li class="hi-logo hidden-xs">
                    <a href="#">Megawin Switchgear Private Limited </a>
                </li>

                <li class="pull-right">
                    <ul class="hi-menu">

                        <!--li data-ma-action="search-open">
                            <a href=""><i class="him-icon zmdi zmdi-search"></i></a>
                        </li-->

                        <li class="dropdown">
                            <a data-toggle="dropdown" href=""><i class="him-icon zmdi zmdi-more-vert"></i></a>
                            <ul class="dropdown-menu pull-right">
                                <li class="hidden-xs">
                                    <a data-ma-action="fullscreen" href="">Toggle Fullscreen</a>
                                </li>
                                <!--li>
                                    <a href="">Privacy Settings</a>
                                </li>
                                <li>
                                    <a href="">Other Settings</a>
                                </li-->
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Top Search Content -->
            <div class="h-search-wrap">
                <div class="hsw-inner">
                    <i class="hsw-close zmdi zmdi-arrow-left" data-ma-action="search-close"></i>
                    <input type="text">
                </div>
            </div>
        </header>
        <section id="main">
            <aside id="sidebar" class="sidebar " style="overflow: visible;">
                <div class="s-profile">
                    <a href="" data-ma-action="profile-menu-toggle">
                        <div class="sp-pic">
                            <!--img src="<?php echo url('../material_admin_1.7.1/jQuery/light/full/img/demo/profile-pics/1.jpg') ?>" alt=""-->
                        </div>

                        <!--div class="sp-info">
                            Malinda Hollaway

                            <i class="zmdi zmdi-caret-down"></i>
                        </div--->
                    </a>

                    <!--<ul class="main-menu">
                        <li>
                            <a href=""><i class="zmdi zmdi-account"></i> View Profile</a>
                        </li>
                        <li>
                            <a href=""><i class="zmdi zmdi-input-antenna"></i> Privacy Settings</a>
                        </li>
                        <li>
                            <a href=""><i class="zmdi zmdi-settings"></i> Settings</a>
                        </li>
                        <li>
                            <a href=""><i class="zmdi zmdi-time-restore"></i> Logout</a>
                        </li>
                    </ul>-->
                </div>

                @include('_layouts._partials.left_menu')
                
                
            </aside>
            
            
            <section id="content">
                <div class="container">
                    @yield('content')
                </div>
            </section>
        </section>
                
        <footer id="footer">
            Copyright &copy; 2017 - 2018 Shriganesh Biztech

            <ul class="f-menu">
                <!--li><a href="">Home</a></li>
                <li><a href="">Dashboard</a></li>
                <li><a href="">Reports</a></li>
                <li><a href="">Support</a></li>
                <li><a href="">Contact</a></li-->
            </ul>
        </footer>

        @section('js')
        
        <!-- Javascript Libraries -->
        <script src="{{asset($base_material_path)}}/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="{{asset($base_material_path_ful)}}/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="{{asset($base_material_path_ful)}}/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="{{asset($base_material_path_ful)}}/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="{{asset($base_material_path_ful)}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="{{asset($base_material_path_ful)}}/vendors/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
        <script src="{{asset($base_material_path_ful)}}/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script src="{{asset($base_material_path_ful)}}/vendors/bower_components/chosen/chosen.jquery.js"></script>

         <script src="{{asset($base_material_path_ful)}}/js/app.min.js"></script>
         
        <!--TESTING 1
         <script src="{{asset("/Treegrid/")}}/dist/js/jquery.min.js"></script>
        <script src="{{asset("/Treegrid/")}}/docs/bootstrap/js/bootstrap.min.js"></script>-->
        <script src="{{asset("/Treegrid/")}}/dist/js/jquery.treegrid.js"></script>
        <!--script src="{{asset("/Table-Pagination/")}}/paging.js"></script> 
        <script src="{{asset("/Table-Pagination/")}}/jquery-ui.min.js"></script--> 
        
        <script src="{{asset("/bootstrap-treeview-master/")}}/public/js/bootstrap-treeview.js"></script>

        <script src="{{asset("/balancesheet/")}}/js/jquery-ui.min.js"></script>

        <!-- Ignite UI Required Combined JavaScript Files -->
        
        
        <script src="{{asset("/d3/")}}/d3.min.js" charset="utf-8"></script>
        <script src="{{asset("/c3/")}}/c3.min.js"></script>
        
        <script>
            $(window).load(function(){
					//Welcome Message (not for login page)
                    /*
					function notify(message, type){
						$.growl({
							message: message
						},{
							type: type,
							allow_dismiss: false,
							label: 'Cancel',
							className: 'btn-xs btn-inverse',
							placement: {
								from: 'top',
								align: 'right'
							},
							delay: 2500,
							animate: {
									enter: 'animated fadeIn',
									exit: 'animated fadeOut'
							},
							offset: {
								x: 20,
								y: 85
							}
						});
					};
					*/		
					
                    
                    
                    
                    
				});
        </script>
        @show
    </body>
  </html>
