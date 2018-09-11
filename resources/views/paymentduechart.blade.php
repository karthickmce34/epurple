@extends('_layouts.app')

@section('title', 'Payment Due')
@section('page_title', 'Payment Due')
@section('page_icon_cls', 'fa-building')

@section('page_payment_li_cls', 'toggled active')
@section('page_paymentduechart_li_cls', 'toggled active')
@section('page_paymentduechart_li_list_cls', 'active')
@section('page_paymentduechart_li_add_cls', '')

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
                <h3>Payment Due Chart</h3>
            </div>
            <div class="card-body card-padding " >
                <div style="border: 2px gray solid;border-radius: 5px" id="purcard">
                    <input class="roleid" id="roleid" type="hidden" value="{{$roleid}}">
                    <input class="sessionid" id="sessionid" type="hidden" value="{{$sessionid}}">
                    <div class="row m-25">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class="fg-line">
                                    <p class=" text-center f-500 m-b-15 c-black">Client</p>
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
                        <!--div class="col-xs-4">
                            <div class="form-group">
                                <div class="fg-line">
                                    <p class="f-500 m-b-15 c-black org">Organization</p>
                                    <select class="selectpicker" title='Organization' id="ad_org_id" name="ad_org_id">

                                            <option value=""></option>

                                    </select>
                                </div>
                            </div>
                        </div-->
                    </div>

                    </div>

                </div>
        </div>

        <div class="card" id="1">
            <div class="card-header card-padding text-center">
                <div id="text-center" style="font-size: 22px;"><b>Bar Chart of Payables and Recievables for Next Six Weeks </b></div>
            </div>
            <div class="card-body card-padding " >
                <div class="panel-group" data-collapse-color="indigo" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-collapse">
                        <div class="panel-heading color-block bgm-lightblue" role="tab" id="headWeek0">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#week0" aria-expanded="true" aria-controls="collapseOne">
                                    Current Week <span id="zero"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="week0" class="collapse in" role="tabpanel" aria-labelledby="headWeek0">
                            <div class="panel-body p-10">
                                <div class="row ">  
                                    <div class="col-sm-12">
                                        <div class="panel card" data-collapse-color="deeppurple" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-body card-padding pd-10-20">
                                                            <div class="row text-center">
                                                                <div class="col-xs-12">
                                                                    <div id="chart1"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- week1 -->
                <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-collapse">
                        <div class="panel-heading color-block bgm-blue" role="tab" id="headWeek1">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#week1" aria-expanded="false" aria-controls="collapseTwo">
                                    Week 1 <span id="one"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="week1" class="collapse" role="tabpanel" aria-labelledby="headWeek1">
                            <div class="panel-body p-10">
                                <div class="row ">  
                                    <div class="col-sm-12">
                                        <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-body card-padding pd-10-20">
                                                            <div class="row text-center">
                                                                <div class="col-xs-12">
                                                                    <div id="chart2"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- week2 -->
                <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-collapse">
                        <div class="panel-heading color-block bgm-cyan" role="tab" id="headWeek2">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#week2" aria-expanded="false" aria-controls="collapseThree">
                                    Week 2 <span id="two"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="week2" class="collapse" role="tabpanel" aria-labelledby="headWeek2">
                            <div class="panel-body p-10">
                                <div class="row ">  
                                    <div class="col-sm-12">
                                        <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-body card-padding pd-10-20">
                                                            <div class="row text-center">
                                                                <div class="col-xs-12">
                                                                    <div id="chart3"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- week3 -->
                <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-collapse">
                        <div class="panel-heading color-block bgm-blue" role="tab" id="headWeek3">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#week3" aria-expanded="false" aria-controls="collapseFour">
                                    Week 3 <span id="three"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="week3" class="collapse" role="tabpanel" aria-labelledby="headWeek3">
                            <div class="panel-body p-10">
                                <div class="row ">  
                                    <div class="col-sm-12">
                                        <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-body card-padding pd-10-20">
                                                            <div class="row text-center">
                                                                <div class="col-xs-12">
                                                                    <div id="chart4"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- week4 -->
                <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-collapse">
                        <div class="panel-heading color-block bgm-lightblue" role="tab" id="headWeek4">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#week4" aria-expanded="false" aria-controls="collapseFive">
                                    Week 4 <span id="four"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="week4" class="collapse" role="tabpanel" aria-labelledby="headWeek4">
                            <div class="panel-body p-10">
                                <div class="row ">  
                                    <div class="col-sm-12">
                                        <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-body card-padding pd-10-20">
                                                            <div class="row text-center">
                                                                <div class="col-xs-12">
                                                                    <div id="chart5"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- week5 -->
                <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-collapse">
                        <div class="panel-heading color-block bgm-cyan" role="tab" id="headWeek5">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#week5" aria-expanded="false" aria-controls="collapseSix">
                                    Week 5 <span id="five"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="week5" class="collapse" role="tabpanel" aria-labelledby="headWeek5">
                            <div class="panel-body p-10">
                                <div class="row ">  
                                    <div class="col-sm-12">
                                        <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-body card-padding pd-10-20">
                                                            <div class="row text-center">
                                                                <div class="col-xs-12">
                                                                    <div id="chart6"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- week6 -->
                <div class="panel-group" data-collapse-color="amber" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-collapse">
                        <div class="panel-heading color-block bgm-blue" role="tab" id="headWeek6">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#week6" aria-expanded="false" aria-controls="collapseSeven">
                                    Week 6 <span id="six"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="week6" class="collapse" role="tabpanel" aria-labelledby="headWeek6">
                            <div class="panel-body p-10">
                                <div class="row ">  
                                    <div class="col-sm-12">
                                        <div class="panel card" data-collapse-color="cyan" id="accordionCyan" role="tablist" aria-multiselectable="true">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-body card-padding pd-10-20">
                                                            <div class="row text-center">
                                                                <div class="col-xs-12">
                                                                    <div id="chart7"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade " id="transaction" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>Pending Detail </h4>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th> Date </th>
                                    <th> Order No </th>
                                    <th> Vendor </th>
                                    <th> Outstanding </th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
            
            /*for(var j=3;j<=7;j++)
            {
                $("#"+j).hide();
            }*/
            var data1 = [],data2 = [];
            var data3 = [];
            var data4 = [];
            var data5 = [];
            var data6 = [];
            var data7 = [];
            var data8 = [];
            
                      
            
            var days = [];
            var sdays = [];
            days = ['days', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            sdays = ['sdays', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            
            data1 = ['data1', 0, 0, 0, 0, 0, 0, 0];
            data2 = ['data2', 0, 0, 0, 0, 0, 0, 0];
            data3 = ['data3', 0, 0, 0, 0, 0, 0, 0];
            data4 = ['data4', 0, 0, 0, 0, 0, 0, 0];
            data5 = ['data5', 0, 0, 0, 0, 0, 0, 0];
            data6 = ['data6', 0, 0, 0, 0, 0, 0, 0];
            data7 = ['data7', 0, 0, 0, 0, 0, 0, 0];
            data8 = ['data8', 0, 0, 0, 0, 0, 0, 0];
            
            var chart1 = chgen(1,8,data1,data8,days,sdays);
            var chart2 = chgen(2,8,data2,data8,days,sdays);
            var chart3 = chgen(3,8,data3,data8,days,sdays);
            var chart4 = chgen(4,8,data4,data8,days,sdays);
            var chart5 = chgen(5,8,data5,data8,days,sdays);
            var chart6 = chgen(6,8,data6,data8,days,sdays);
            var chart7 = chgen(7,8,data7,data8,days,sdays);
            
            
            
            function chgen(k,m,pdata,sdata,day,sdays)
            {
                var plab = {};
                var slab = {};
                var pxaxis = {};
                var sxaxis = {};
                
                plab['data'+k] = 'Payables';
                plab['data'+m] = 'Receivables';
                
                pxaxis['data'+k] = 'days';
                pxaxis['data'+m] = 'sdays';
                
                
                c3.generate({
                    size: {
                        height: 500,
                    },
                    data: {
                        xs: 
                            pxaxis,
                        
                        columns: [
                            day,
                            sdays,
                            pdata,
                            sdata,
                        ],
                        onclick: function (d) { 
                            testing(d);
                            console.log("onclick", d);
                        },
                        type: 'bar',
                        names: plab,
                        labels: true,

                    },
                    /*zoom: {
                            enabled: true
                    },*/
                    axis: {
                        x: {
                            label: 'Days',
                            type: 'category',
                            tick: {
                                rotate: 75,
                                multiline: false
                            },
                            //height: 100
                        },
                        y: {
                            label: 'Pending Amount'
                        },
                    },
                    bar: {
                        width: {
                            ratio: 0.5 // this makes bar width 50% of length between ticks
                        }
                        // or
                        //width: 100 // this makes bar width 100px
                    },
                    bindto: '#chart'+k
                });
            }
                
            
           
            
            
          
            var _site_url = "{{url('/')}}/";
            
            function testing(d){
                var ad_client_id= $("#ad_client_id").val();
                var ad_org_id= 1;//$("#ad_org_id").val();
                var dataConfig = {index:d.index,value:d.value,id:d.id,ad_client_id:ad_client_id,ad_org_id:ad_org_id};
                var controller = 'paymentduechart/';
                 $.ajax({
                     method: "POST",
                     url: _site_url + controller + "pendingdetail",
                     data: dataConfig,
                 }).done(function (data, textStatus, jqXHR) {
                    console.log(" ajax done ");
                    //console.log(data, textStatus, jqXHR);
                    $("#transaction").modal();
                    $("#transaction table tbody tr").remove();
                     
                    var i;
                    for(i=0;i<data.daydetails.length;i++)
                    {
                        $("#transaction table tbody").append("<tr><td>"+data.daydetails[i].duedate+"</td><td>"+data.daydetails[i].documentno+"</td><td>"+data.daydetails[i].bpname+"</td><td>"+data.daydetails[i].outstandingamt+"</td></tr>");
                    }

                 }).fail(function (jqXHR, textStatus, errorThrown) {
                     console.log(" ajax fail ");
                     //console.log(jqXHR, textStatus, errorThrown);
                 }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                     console.log(" ajax always ");
                     //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                 });
            }
            
            $("#ad_client_id").change(function()
            {
                /*var ad_client_id= $("#ad_client_id").val();
                var role_id= $("#roleid").val();
                var sessionid= $("#sessionid").val();
                var dataConfig = {ad_client_id:ad_client_id,role_id:role_id,sessionid:sessionid,};
                var controller = 'paymentduechart/';
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
                 });*/
    
                 chartdata();
            });
            
            $("#ad_org_id").change(function()
            {
                //chartdata();
            });
            
            function chartdata()
            {
                
                var ad_client_id= $("#ad_client_id").val();
                //var ad_org_id= $("#ad_org_id").val();
                //var dataConfig = {ad_client_id:ad_client_id,ad_org_id:ad_org_id};
                var dataConfig = {ad_client_id:ad_client_id};
                
                var controller = 'paymentduechart/';
                 $.ajax({
                     method: "POST",
                     url: _site_url + controller + "chartdata",
                     data: dataConfig,
                 }).done(function (data, textStatus, jqXHR) {
                     console.log(" ajax done ");
                     console.log(data, textStatus, jqXHR);
                     if (data.status == 1)
                        {
                            var datas = [],days = [],data1 = [],days1 = [],data2 = [],days2 = [];
                            var data3 = [],days3 = [],data4 = [],days4 = [],data5 = [],days5 = [],data6 = [],days6 = [];
                            var sdatas = [],sdays = [],sdata1 = [],sdays1 = [],sdata2 = [],sdays2 = [],sdata3 = [],sdays3 = [];
                            var sdata4 = [],sdays4 = [],sdata5 = [],sdays5 = [],sdata6 = [],sdays6 = [];
                            var week0,week1,week2,week3,week4,week5,week6;
                            
                            
                            days = data.days;
                            datas = data.curoutstanding;
                            sdays = data.sdays;
                            sdatas = data.scuroutstanding;
                            week0 = data.currentweek;
                            
                            days1 = data.w1days;
                            data1 = data.w1outstanding;
                            sdays1 = data.sw1days;
                            sdata1 = data.sw1outstanding;
                            week1 = data.week1;
                            
                            days2 = data.w2days;
                            data2 = data.w2outstanding;
                            sdays2 = data.sw2days;
                            sdata2 = data.sw2outstanding;
                            week2 = data.week2;
                            
                            days3 = data.w3days;
                            data3 = data.w3outstanding;
                            sdays3 = data.sw3days;
                            sdata3 = data.sw3outstanding;
                            week3 = data.week3;
                            
                            days4 = data.w4days;
                            data4 = data.w4outstanding;
                            sdays4 = data.sw4days;
                            sdata4 = data.sw4outstanding;
                            week4 = data.week4;
                            
                            days5 = data.w5days;
                            data5 = data.w5outstanding;
                            sdays5 = data.sw5days;
                            sdata5 = data.sw5outstanding;
                            week5 = data.week5;
                            
                            days6 = data.w6days;
                            data6 = data.w6outstanding;
                            sdays6 = data.sw6days;
                            sdata6 = data.sw6outstanding;
                            week6 = data.week6;
                             
                            console.log(sdays);
                            chgen(1,8,datas,sdatas,days,sdays);
                            chgen(2,9,data1,sdata1,days1,sdays1);
                            chgen(3,10,data2,sdata2,days2,sdays2);
                            chgen(4,11,data3,sdata3,days3,sdays3);
                            chgen(5,12,data4,sdata4,days4,sdays4);
                            chgen(6,13,data5,sdata5,days5,sdays5);
                            chgen(7,14,data6,sdata6,days6,sdays6);
                            
                            $("#zero").text("("+ week0 + ")");
                            $("#one").text("("+ week1 + ")");
                            $("#two").text("("+ week2 + ")");
                            $("#three").text("("+ week3 + ")");
                            $("#four").text("("+ week4 + ")");
                            $("#five").text("("+ week5 + ")");
                            $("#six").text("("+ week6 + ")");
                        }
                    

                 }).fail(function (jqXHR, textStatus, errorThrown) {
                     console.log(" ajax fail ");
                     //console.log(jqXHR, textStatus, errorThrown);
                 }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                     console.log(" ajax always ");
                     //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                 });
                
            }
            
           
            
            

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

