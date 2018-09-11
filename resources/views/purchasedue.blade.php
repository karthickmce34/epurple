@extends('_layouts.app')

@section('title', 'Purchase Payment')
@section('page_title', 'Purchase Payment')
@section('page_icon_cls', 'fa-building')

@section('page_payment_li_cls', 'toggled active')
@section('page_purchasedue_li_cls', 'toggled active')
@section('page_purchasedue_li_list_cls', 'active')
@section('page_purchasedue_li_add_cls', '')

@section('style')
@parent
<style>

</style> 
@stop
@section('menu')
    @parent

@stop
@section('content')
    @parent
    
        <div class="card">
            <div class="card-header card-padding text-center">
                <h3>Purchase Payment</h3>
            </div>
            <div class="card-body card-padding " >
                <div style="border: 2px gray solid;border-radius: 5px" id="purcard">
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
                    <div class="row text-center pursearch">
                        <div class="col-xs-12">
                           <div class="form-group">
                               <div class="fg-line">
                                    <button type="button" class="btn bgm-green search"><i class="zmdi zmdi-download"></i> Download</button>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="m-t-25" id="purview">
                    <div class="loader text-center" style="display: none;height: 150px; ">
                        <div class="preloader pls-gray">
                            <svg class="pl-circular m-b-25" viewBox="25 25 50 50">
                                <circle class="plc-path" cx="50" cy="50" r="20"></circle>
                            </svg>

                            <p class="m-t-25">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
   
    
@stop

@section('css')
    @parent

@stop    
@section('js')
    @parent

<script>
    $(document).ready(function(){

        $( '#todate' ).datepicker({defaultDate:'',dateFormat:"dd-mm-yy"});
        $( '#fromdate' ).datepicker({defaultDate:'',dateFormat:"dd-mm-yy"});

        var data1 = [];
        var days = [];
        days = ['days', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        data1 = ['Pending Payments', 0, 0, 0, 0, 0, 0];


        var chart = c3.generate({
            data: {
                x : 'days',
                columns: [
                    days,
                    data1,
                ],
                type: 'bar'
            },
            axis: {
                x: {
                    type: 'category',
                    tick: {
                        rotate: 75,
                        multiline: false
                    },
                    height: 130
                }
            },
            bar: {
                width: {
                    ratio: 0.5 // this makes bar width 50% of length between ticks
                }
                // or
                //width: 100 // this makes bar width 100px
            },
            bindto: '#chart'
        });

        var chart1 = c3.generate({
            data: {
                x : 'days',
                columns: [
                    days,
                    data1,
                ],
                type: 'bar'
            },
            axis: {
                x: {
                    type: 'category',
                    tick: {
                        rotate: 75,
                        multiline: false
                    },
                    height: 130
                }
            },
            bar: {
                width: {
                    ratio: 0.5 // this makes bar width 50% of length between ticks
                }
                // or
                //width: 100 // this makes bar width 100px
            },
            bindto: '#chart1'
        });



        var _site_url = "{{url('/')}}/";

        $("#ad_client_id").change(function()
        {
            var ad_client_id= $("#ad_client_id").val();
            var role_id= $("#roleid").val();
            var sessionid= $("#sessionid").val();
            var dataConfig = {ad_client_id:ad_client_id,role_id:role_id,sessionid:sessionid,};
            var controller = 'purchasedue/';
             $.ajax({
                 method: "POST",
                 url: _site_url + controller + "org",
                 data: dataConfig,
             }).done(function (data, textStatus, jqXHR) {
                 console.log(" ajax done ");
                 console.log(data, textStatus, jqXHR);

                if(data.session_active == 'Y')
                {
                    if (data.status == 1)
                    {
                      console.log(data);
                      $('.org').closest('div').find(".bootstrap-select").remove();
                      $('.org').closest('div').append("<select class='selectpicker' id='ad_org_id' name='ad_org_id'><option value=''></option></select>");
                      for(var i=0;i<data.orgs.length;i++)
                      {
                           $('.org').closest('div').find('#ad_org_id').append("<option value="+data.orgs[i].ad_org_id+">"+data.orgs[i].name+"</option>");
                      }

                      $('.org').closest('div').find('.selectpicker').selectpicker();

                      $("#ad_org_id").change(function()
                        {
                            chartdata();
                        });
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

        $("#ad_org_id").change(function()
        {
            chartdata();
        });

        function chartdata()
        {

            var ad_client_id= $("#ad_client_id").val();
            var ad_org_id= $("#ad_org_id").val();
            var dataConfig = {ad_client_id:ad_client_id,ad_org_id:ad_org_id};
            var controller = 'purchasedue/';
             $.ajax({
                 method: "POST",
                 url: _site_url + controller + "chartdata",
                 data: dataConfig,
             }).done(function (data, textStatus, jqXHR) {
                 console.log(" ajax done ");
                 console.log(data, textStatus, jqXHR);
                 if (data.status == 1)
                    {
                        var data2 = [];
                        var days2 = [];
                        var data3 = [];
                        var days3 = [];

                        days2 = data.days;
                        data2 = data.curoutstanding;

                        days3 = data.nxtweekdays;
                        data3 = data.nxtoutstanding;

                        chart.load({
                                x : 'days',
                                columns: [
                                    days2,
                                    data2,
                                ],

                            });
                        chart1.load({
                                x : 'days',
                                columns: [
                                    days3,
                                    data3,
                                ],
                            });

                    }


             }).fail(function (jqXHR, textStatus, errorThrown) {
                 console.log(" ajax fail ");
                 //console.log(jqXHR, textStatus, errorThrown);
             }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                 console.log(" ajax always ");
                 //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
             });

        }

        $(".search").click(function()
        {
            var ad_client_id= $("#ad_client_id").val();
            var ad_org_id= $("#ad_org_id").val();
            //var c_acctschema_id= $("#c_acctschema_id").val();
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
                    $("#purcard").find(".pursearch").css("display","none");
                    $(".loader").css("display","block");
                    var ad_client_id= $("#ad_client_id").val();
                    var ad_org_id= $("#ad_org_id").val();
                    var fdate = $("#fromdate").val();
                    var tdate = $("#todate").val();
                    var date1 = fdate.split("-");
                    var date2 = tdate.split("-");
                    var fromdate = date1[0]+"/"+date1[1]+"/"+date1[2];
                    var todate = date2[0]+"/"+date2[1]+"/"+date2[2];
                    //console.log(fdate);
                    var dataConfig = {ad_client_id:ad_client_id,
                                      fromdate:fromdate,
                                      todate:todate,
                                      org_id:ad_org_id,
                                     };
                    //alert("hai");
                    var dataConfig1 = {sessionid:sessionid,
                                     };                 
                    var controller = 'purchasedue/';

                    $.ajax({
                         method: "GET",
                         url: _site_url + controller + "activedata",
                         data: dataConfig1,
                    }).done(function (data, textStatus, jqXHR) {
                        if(data.session_active == 'Y')
                        {

                            $.ajax({
                                method: "GET",
                                url: _site_url + controller + "purdata",
                                data: dataConfig,
                            }).done(function (data, textStatus, jqXHR) {
                                console.log(" ajax done ");
                                //alert("hai");
                                 if(data.status == 1)
                                    {


                                        setTimeout(function() {
                                            var win = window.open(data.filepath, '_blank');
                                            $("#purcard").find(".pursearch").css("display","block");
                                            $(".loader").css("display","none");

                                            if (win) {
                                                //Browser has allowed it to be opened
                                                win.focus();
                                            } else {
                                                //Browser has blocked it
                                                alert('Please allow popups for this website');
                                            }
                                        }, 6000);
                                    }    
                                    else
                                    {

                                    }




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



        /*setTimeout(function () {
            chart.load({
                columns: [
                    ['Pending Payments', 130, 150, 200, 300, 200, 100]
                ]
            });
        }, 10000);*/
    });
</script>
@stop
