<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trial Balance</title>
        <?php
        $base_material_path = "/material_admin_1.7.1/jQuery/light/seed/";
        $base_material_path_ful = "/material_admin_1.7.1/jQuery/light/full/";
        ?>
        <!-- Vendor CSS -->
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

                <ul class="main-menu">
                    <li><a href="home"><i class="zmdi zmdi-home"></i> Home</a></li>
                    <li class="active"><a href="trialbalance"><i class="zmdi zmdi-format-underlined"></i> TrialBalance</a></li>
                    <li class="sub-menu">
                        <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Payment Due</a>
                        <ul>
                            <li><a href="purchasedue"><i class="zmdi zmdi-view-list"></i> Purchase Payment</a></li>
                            <li><a href="salesdue"><i class="zmdi zmdi-view-list"></i> Sales Payment</a></li>
                            <li><a href="paymentfollowup"><i class="zmdi zmdi-view-list"></i> Payment Followup</a></li>
                        </ul>
                    </li>
                    <!--<li><a href="form-elements.html"><i class="zmdi zmdi-collection-text"></i> Form Elements</a></li>
                    <li><a href="buttons.html"><i class="zmdi zmdi-crop-16-9"></i> Buttons</a></li>
                    <li><a href="icons.html"><i class="zmdi zmdi-airplane"></i>Icons</a></li>
                    <li class="sub-menu">
                        <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-collection-item"></i> Sample Pages</a>
                        <ul>
                            <li><a href="login.html">Login and Sign Up</a></li>
                            <li><a href="lockscreen.html">Lockscreen</a></li>
                            <li><a href="404.html">Error 404</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="" data-ma-action="submenu-toggle"><i class="zmdi zmdi-menu"></i> 3 Level Menu</a>

                        <ul>
                            <li><a href="form-elements.html">Level 2 link</a></li>
                            <li class="sub-menu">
                                <a href="" data-ma-action="submenu-toggle">I have children too</a>

                                <ul>
                                    <li><a href="">Level 3 link</a></li>
                                    <li><a href="">Another Level 3 link</a></li>
                                    <li><a href="">Third one</a></li>
                                </ul>
                            </li>
                            <li><a href="">One more 2</a></li>
                        </ul>
                    </li>-->
                </ul>
            </aside>

            <section id="content">
                <div class="container">
                    <div class="card">
                        <div class="card-header card-padding text-center">
                            <h3>Trial Balance</h3>
                            
                        </div>
                        <div class="card-body card-padding " >
                            <div style="border: 2px gray solid;border-radius: 5px">
                                <input class="roleid" id="roleid" type="hidden" value="{{$roleid}}">
                                <input class="sessionid" id="sessionid" type="hidden" value="{{$sessionid}}">
                                <div class="row m-25">
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <p class="f-500 m-b-15 c-black">Client</p>
                                                <select class="selectpicker" title='Client' id="ad_client_id" name="ad_client_id">
                                                    @foreach($clients as $client)
                                                        @if( (in_array($client->ad_client_id, $clientlist)))
                                                        <option value="{{$client->ad_client_id}}">{{$client->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <p class="f-500 m-b-15 c-black org">Organization</p>
                                                <select class="selectpicker" title='Organization' id="ad_org_id" name="ad_org_id">

                                                        <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <p class="f-500 m-b-15 c-black schema">Account Schema</p>
                                                <select class="selectpicker" title='Account Schema' id="c_acctschema_id" name="c_acctschema_id">

                                                        <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-25">
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <div class="fg-line">
                                                <?php $currdate = date("d-m-Y"); ?>
                                                <p class="c-black f-500 m-b-20">From date</p>
                                                <div class="input-group form-group">
                                                    <input type='text' class="form-control"
                                                               placeholder="Click here..." id='fromdate' name='fromdate' value="{{$currdate}}">
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="col-xs-3">
                                       <div class="form-group">
                                            <div class="fg-line">
                                                <p class="c-black f-500 m-b-20">To date</p>

                                                <div class="input-group form-group">
                                                    <input type='text' class="form-control"
                                                               placeholder="Click here..." id='todate' name='todate' value="{{$currdate}}">
                                                </div>
                                            </div>
                                        </div>
                                   </div>   
                                </div>
                                <div class="row text-center">
                                    <div class="col-xs-12">
                                       <div class="form-group">
                                           <div class="fg-line">
                                                <button type="button" class="btn bgm-green search"><i class="zmdi zmdi-search"></i> Search</button>
                                           </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-25" id="treeview">
                                <div class="loader text-center" style="display: none;height: 150px; ">
                                    <div class="preloader pls-gray">
                                        <svg class="pl-circular m-b-25" viewBox="25 25 50 50">
                                            <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                                        </svg>

                                        <p class="m-t-25">Loading...</p>
                                    </div>
                                </div>
                            </div>
                            <table class="m-t-25" id="treegrid1" style="border: 2px gray solid;border-radius: 5px"></table>
                        </div>
                        <!----  Modal  --->
                        <div class="modal fade " id="transaction" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4>Account Transaction</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="initialbalnce">
                                            
                                        </div>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <th> Date </th>
                                                <th> Description</th>
                                                <th> Debit </th>
                                                <th> Credit</th>
                                                <th> Balance</th>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
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

         <script src="{{asset("/balancesheet/")}}/js/modernizr-2.8.3.js"></script>
        <script src="{{asset("/balancesheet/")}}/js/jquery-ui.min.js"></script>

        <!-- Ignite UI Required Combined JavaScript Files -->
        <script src="{{asset("/balancesheet/")}}/js/infragistics.core.js"></script>
        <script src="{{asset("/balancesheet/")}}/js/infragistics.lob.js"></script>
        
        <script>
        $(document).ready(function(){
            
                   function actview1(){
                
                                            alert("hai1");
                                        }    
           /* $('.date-picker').datetimepicker({
                format: "DD-MM-YYYY"
            });*/
            $( '#todate' ).datepicker({defaultDate:'',dateFormat:"dd-mm-yy"});
            $( '#fromdate' ).datepicker({defaultDate:'',dateFormat:"dd-mm-yy"});
            
           /* $("td").each(function() {
            //loop through the values and assign it to a variable 
                var currency = $(this).html();

                var val = Number(currency.replace(/[^0-9\.-]+/g,""));
                if(!isNaN(val) && val != 0){
                    console.log("******"+val);
                    $(this).html(12);
                }
            });*/
            //$('.trialbalance').treegrid();
            /* $('#trialbalance').paging({
            limit: 30
            });*/
            var _site_url = "{{url('/')}}/";
            //$('.buttons').on('click', 'button', function(){
            
            $(document).on('click', '.actview',function(){
                 console.log("----------inside ------------");
                $("#transaction").modal();
                $("#transaction .initialbalnce span").remove();
                $("#transaction .initialbalnce").append("<span class='f-18 c-bluegray m-b-20'> loading .... </span>");
                $("#transaction table").hide();
                var dataid = $(this).data('id');
                var initialbalance = $(this).data('initialbalance');
               
                var fdate = $("#fromdate").val();
                var tdate = $("#todate").val();
                var ad_client_id= $("#ad_client_id").val();
                var ad_org_id= $("#ad_org_id").val();
                var date1 = fdate.split("-");
                    var date2 = tdate.split("-");
                    var fromdate = date1[2]+"-"+date1[1]+"-"+date1[0];
                    var todate = date2[2]+"-"+date2[1]+"-"+date2[0];
                     alert(dataid);
                      alert(fromdate);
                       alert(todate);
                        alert(ad_client_id);
                         alert(ad_org_id);
                       
                var dataConfig = {  node_id:dataid,
                                  fromdate:fromdate,
                                  todate:todate,
                                  ad_client_id:ad_client_id,
                                  org_id:ad_org_id,
                                 };

                var controller = 'trialbalance/';
                $.ajax({
                   method: "GET",
                   url: _site_url + controller + "transactiondata",
                   data: dataConfig,
                }).done(function (data, textStatus, jqXHR) {
                   console.log(" ajax done ");
                   if(data.status ==1)
                   {
                        $("#transaction").modal();
                        $("#transaction table").show();
                        $("#transaction .initialbalnce span").remove();
                        $("#transaction .initialbalnce").append("<span class='f-16 c-bluegray m-b-25'> Previous Balance :"+initialbalance +"</span>");
                        $("#transaction table tbody tr").remove();
                        var init = initialbalance;
                        for(var i=0;i<data.transdata.length;i++)
                        {
                            
                            if(data.transdata[i].amtacctdr > 0)  
                            {
                               init = parseFloat(init)+parseFloat(data.transdata[i].amtacctdr) ; 
                            }
                            if(data.transdata[i].amtacctcr > 0)  
                            {
                               init = parseFloat(init)-parseFloat(data.transdata[i].amtacctcr) ; 
                            }
                            
                            $("#transaction table tbody").append("<tr><td>"+data.transdata[i].dateacct+"</td><td>"+data.transdata[i].acctdescription+"</td><td>"+data.transdata[i].amtacctdr+"</td><td>"+data.transdata[i].amtacctcr+"</td><td>"+init+"</td></tr>");
                        }
                   } 
                   else
                   {
                        $("#transaction .initialbalnce span").remove();
                        $("#transaction .initialbalnce").append("<span class='f-18 c-red m-b-20 text-center'> No Transaction </span>");
                   }

                }).fail(function (jqXHR, textStatus, errorThrown) {
                    console.log(" ajax fail ");
                    //console.log(jqXHR, textStatus, errorThrown);
                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                    console.log(" ajax always ");
                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                });
                console.log("----------outsi ------------");
            });
            
            
            
            $("#ad_client_id").change(function()
            {
                var ad_client_id= $("#ad_client_id").val();
                var role_id= $("#roleid").val();
                var sessionid= $("#sessionid").val();
                var dataConfig = {ad_client_id:ad_client_id,role_id:role_id,sessionid:sessionid,};
                var controller = 'trialbalance/';
                 $.ajax({
                     method: "POST",
                     url: _site_url + controller + "org",
                     data: dataConfig,
                 }).done(function (data, textStatus, jqXHR) {
                     console.log(" ajax done ");
                     //console.log(data, textStatus, jqXHR);
                     
                    if(data.session_active == 'Y')
                    {
                        if (data.status == 1)
                        {
                          console.log(data);
                          $('.org').closest('div').find(".bootstrap-select").remove();
                          $('.schema').closest('div').find(".bootstrap-select").remove();
                          $('.org').closest('div').append("<select class='selectpicker' id='ad_org_id' name='ad_org_id'></select>");
                          $('.schema').closest('div').append("<select class='selectpicker' id='c_acctschema_id' name='c_acctschema_id'></select>");
                          for(var i=0;i<data.orgs.length;i++)
                          {
                               $('.org').closest('div').find('#ad_org_id').append("<option value="+data.orgs[i].ad_org_id+">"+data.orgs[i].name+"</option>");
                          }
                          for(var j=0;j<data.acctschema.length;j++)
                          {
                               $('.schema').closest('div').find('#c_acctschema_id').append("<option value="+data.acctschema[j].c_acctschema_id+">"+data.acctschema[j].name+"</option>");
                          }
                          $('.org').closest('div').find('.selectpicker').selectpicker();
                          $('.schema').closest('div').find('.selectpicker').selectpicker();
                        }
                    }
                    else
                    {
                            
                            
                            var openbravoip = data.openbravoip;
                            window.location.replace(openbravoip);
                    }

                 }).fail(function (jqXHR, textStatus, errorThrown) {
                     console.log(" ajax fail ");
                     //console.log(jqXHR, textStatus, errorThrown);
                 }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                     console.log(" ajax always ");
                     //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                 });
            });
            
            
            $(".search").click(function()
            {
                var ad_client_id= $("#ad_client_id").val();
                var ad_org_id= $("#ad_org_id").val();
                var c_acctschema_id= $("#c_acctschema_id").val();
                var fdate = $("#fromdate").val();
                var tdate = $("#todate").val();
                var sessionid= $("#sessionid").val();
                
                if(ad_client_id == "")
                {
                  alert("Choose Client") ; 
                }
                else if(ad_org_id == "")
                {
                  alert("Choose Organisation") ; 
                }
                else if(c_acctschema_id == "")
                {
                  alert("Choose Account Schema") ; 
                }
                else if(fdate == "")
                {
                  alert("Choose From date") ; 
                }
                else if(tdate == "")
                {
                  alert("Choose To date") ; 
                }
                else if(tdate != "" && fdate != "")
                {
                    if(fdate > tdate)
                    {
                      alert("Todate is Greater than From date") ;
                    }
                    else
                    {
                        $("#treegrid1_container").remove();
                        $(".loader").css("display","block");
                        var ad_client_id= $("#ad_client_id").val();
                        var ad_org_id= $("#ad_org_id").val();
                        var c_acctschema_id= $("#c_acctschema_id").val();
                        var fdate = $("#fromdate").val();
                        var tdate = $("#todate").val();
                        var date1 = fdate.split("-");
                        var date2 = tdate.split("-");
                        var fromdate = date1[2]+"-"+date1[1]+"-"+date1[0];
                        var todate = date2[2]+"-"+date2[1]+"-"+date2[0];
                        //console.log(fdate);
                        var dataConfig = {ad_client_id:ad_client_id,
                                          c_acctschema_id:c_acctschema_id,
                                          fromdate:fromdate,
                                          todate:todate,
                                          org_id:ad_org_id,
                                         };
                        var dataConfig1 = {sessionid:sessionid,
                                         };
                                         
                        var controller = 'trialbalance/';
                        
                        $.ajax({
                             method: "GET",
                             url: _site_url + controller + "activedata",
                             data: dataConfig1,
                        }).done(function (data, textStatus, jqXHR) {
                            if(data.session_active == 'Y')
                            {
                                
                                $.ajax({
                                    method: "GET",
                                    url: _site_url + controller + "acctdata",
                                    data: dataConfig,
                                }).done(function (data, textStatus, jqXHR) {
                                    console.log(" ajax done ");
                                    /****************/
                                       var dataArray = [];
                                       for (var key in data) {
                                           if (data.hasOwnProperty(key)) {
                                               dataArray.push(data[key]);
                                           }
                                       };
                                       $(".loader").css("display","none");

                                       $("#treegrid1").igTreeGrid({
                                           width: "100%",
                                           dataSource: dataArray,
                                           autoGenerateColumns: false,
                                           primaryKey: "number",
                                           dataType: "json", 
                                           columns: [
                                               { headerText: "Code", key: "number", width: "40%", dataType: "string", hidden : "true" },
                                               { headerText: "Account Name", key: "name", width: "70%", dataType: "string" },
                                               { headerText: "Initialbalance", key: "initialbalance", width: "20%", dataType: "number", formatter: initialSum, template: "${initialbalance}"},
                                               { headerText: "Debit", key: "amtacctdr", width: "20%", dataType: "number",formatter: debitSum, template: "${amtacctdr}"  },
                                               { headerText: "Credit", key: "amtacctcr", width: "20%", dataType: "number", formatter: creditSum, template: "${amtacctcr}"},
                                               //{ headerText: "Debit", key: "amtacctdr", width: "20%", dataType: "number", formatter: balanceSum, template: "${balance}" }
                                               { headerText: "Closingbalance", key: "closingbalance", width: "20%", dataType: "number", formatter: closeSum, template: "${closingbalance}"},
                                               { headerText: "View", key: "elementlevel", width: "20%", dataType: "string",formatter: acctview},
                                               { headerText: "Node", key: "node_id", width: "20%", dataType: "string"},

                                           ],
                                           childDataKey: "assets",
                                           initialExpandDepth: 0,
                                           features: [
                                               {
                                                   name: "Resizing"
                                               },
                                               {
                                                   name: "Paging",
                                                   type: "local",
                                                   pageSize: 20
                                               },
                                               {
                                                   name: "ColumnMoving",
                                                   columnMovingDialogContainment: "window"
                                               },
                                               {
                                                   name: 'Hiding',
                                                   columnSettings: [
                                                   { 
                                                       columnKey: 'node_id', 
                                                       allowHiding: true, 
                                                       hidden: true
                                                   }]
                                               },
                                       ]
                                       });

                                       function creditSum(val, record) {

                                           if (val) {
                                               return val;
                                           }
                                           return calcCrSum(record, 0);
                                       }
                                       function calcCrSum(row, sum) {
                                           var i, child;
                                           if (row["assets"]) {
                                               for (i = 0; i < row["assets"].length; i++) {
                                                   child = row["assets"][i];
                                                   sum = child["assets"] ? calcCrSum(child, sum) : sum + calcCrSum(child, sum);
                                               }
                                               return Math.trunc(sum * 100) / 100;
                                           }

                                           return row["amtacctcr"];
                                       }

                                       function debitSum(val, record) {

                                           if (val) {
                                               return val;
                                           }
                                           return calcDrSum(record, 0);
                                       }
                                       function calcDrSum(row, sum) {
                                           var i, child;
                                           if (row["assets"]) {
                                               for (i = 0; i < row["assets"].length; i++) {
                                                   child = row["assets"][i];
                                                   sum = child["assets"] ? calcDrSum(child, sum) : sum + calcDrSum(child, sum);
                                               }
                                               return Math.trunc(sum * 100) / 100;
                                           }

                                           return row["amtacctdr"];
                                       }
                                       function initialSum(val, record) {

                                           if (val) {
                                               return val;
                                           }
                                           return calcInitSum(record, 0);
                                       }
                                       function calcInitSum(row, sum) {
                                           var i, child;
                                           if (row["assets"]) {
                                               for (i = 0; i < row["assets"].length; i++) {
                                                   child = row["assets"][i];
                                                   sum = child["assets"] ? calcInitSum(child, sum) : sum + calcInitSum(child, sum);
                                               }
                                               return Math.trunc(sum * 100) / 100;
                                           }

                                           return row["initialbalance"];
                                       }
                                       function closeSum(val, record) {

                                           if (val) {
                                               return val;
                                           }
                                           return calcCloseSum(record, 0);
                                       }
                                       function calcCloseSum(row, sum) {
                                           var i, child;
                                           if (row["assets"]) {
                                               for (i = 0; i < row["assets"].length; i++) {
                                                   child = row["assets"][i];
                                                   sum = child["assets"] ? calcCloseSum(child, sum) : sum + calcCloseSum(child, sum);
                                               }
                                               return Math.trunc(sum * 100) / 100;
                                           }

                                           return row["closingbalance"];
                                       }

                                       function acctview(row,acctview) 
                                       {

                                           console.log(row);
                                           var rownew = row.split("_")
                                           if(rownew[0]=="subaccount")
                                           {
                                                acctview = "<button class='btn bgm-bluegray btn-sm waves-effect actview' data-id='"+rownew[1]+"' data-initialbalance='"+rownew[2]+"'><i class='zmdi'></i>V</button>";
                                           }
                                           else
                                           {
                                               acctview = "";
                                           }

                                           return acctview;
                                       }

                                       
                                       /*$("td:contains('subaccount')").html("<a href='#'>hai</a>");
                                       $("td:contains('account')").html("");*/
                                       //$("td:contains('S')").html("<a href='#'>hai</a>");
                                    /*****************/

                                    //console.log(data.test);
                                    /*var tree = [
                                           {
                                             text: "Parent 1",
                                             nodes: [
                                               {
                                                 text: "Child 1",
                                                 nodes: [
                                                   {
                                                     text: "Grandchild 1"
                                                   },
                                                   {
                                                     text: "Grandchild 2"
                                                   }
                                                 ]
                                               },
                                               {
                                                 text: "Child 2"
                                               }
                                             ]
                                           },
                                           {
                                             text: "Parent 2"
                                           },
                                           {
                                             text: "Parent 3"
                                           },
                                           {
                                             text: "Parent 4"
                                           },
                                           {
                                             text: "Parent 5"
                                           }
                                         ];
                                         console.log(data.test);
                                         console.log("****------+++---------************");
                                         console.log(tree);
                                    var tree1 = data.test;
                                    $('#treeview').treeview({data: tree1});
                                    /*if (data.status == 1)
                                    {
                                      //$('#treeview').treeview({data: data.data});
                                    }*/
                                   
                                }).fail(function (jqXHR, textStatus, errorThrown) {
                                    console.log(" ajax fail ");
                                    //console.log(jqXHR, textStatus, errorThrown);
                                }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                                    console.log(" ajax always ");
                                    //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                                });
                                
                                
                            }
                            else
                            {
                                var openbravoip = data.openbravoip
                                window.location.replace(openbravoip);
                            } 
                             
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            console.log(" ajax fail ");
                            //console.log(jqXHR, textStatus, errorThrown);
                        }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                            console.log(" ajax always ");
                            //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                        });
                        
                                    
                         
                         

                     }
                }
            });
        });
        </script>
        
    </body>
  </html>
