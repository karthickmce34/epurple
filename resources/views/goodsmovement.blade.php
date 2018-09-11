@extends('_layouts.app')

@section('title', 'Goods Movement')
@section('page_title', 'Goods Movement')
@section('page_icon_cls', 'fa-building')

@section('page_stores_li_cls', 'toggled active')
@section('page_goodsmovement_li_cls', 'toggled active')
@section('page_goodsmovement_li_list_cls', 'active')
@section('page_goodsmovement_li_add_cls', '')

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
            <div class="card-header card-padding text-center ch-alt bgm-cyan">
                    <h3>Goods Movement
                    <button type="button" class="btn bgm-deeppurple pull-right upload"><i class="zmdi zmdi-upload"></i>&nbsp; BOM ISSUE</button>
                    </h3>
            </div>
            <div class="card-body card-padding brd-2" >
                <div class="row m-t-20">
                    <div class="col-sm-12"></div>
                </div>
                <div class="row m-t-20">
                    <div class="col-xs-3">
                        <div class="fg-line form-group">
                            <p class="f-500 m-b-15 c-black org">Organization</p>
                            <select class="selectpicker" title='Organization' id="ad_org_id" name="ad_org_id">
                                    <option value=""></option>
                                @foreach($orgs as $org)
                                    @if($org->ad_org_id == $user->default_ad_org_id)
                                    <option value="{{$org->ad_org_id}}" selected>{{$org->name}}</option>
                                    @else
                                    <option value="{{$org->ad_org_id}}">{{$org->name}}</option>
                                    @endif
                                    
                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="fg-line form-group">
                            <p class="f-500 m-b-15 c-black org">Document No.</p>
                            <input type="text" id="docnum" class="form-control input-sm" readonly="true" placeholder="Document No." value="{{$documentno->currentnext}}">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="fg-line form-group">
                            <p class="f-500 m-b-15 c-black">Name</p>
                            <input type="text" id="name" class="form-control input-sm"  placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <p class="f-500 m-b-15 m-l-15 c-black">Movement Date</p>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                            <div class="fg-line">
                                <?php  $currdate = date('d/m/Y'); ?>
                                <input type='text' class="form-control date-picker" id="movdate"
                           placeholder="Movementdate" value="{{$currdate}}">
                            </div>
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

    $(function () {

            $(".upload").click(function(){
                 var org_id = $("#ad_org_id option:selected").val();
                 var docnum = $("#docnum").val();
                 var name = $("#name").val();
                 var movdate = $("#movdate").val();
                
                if(org_id == "" || docnum == "" || name == "" || movdate == "")
                {
                    alert("Check Input Data");
                }
                else
                {
                    alert("hai");
                }
                
            });

    });
</script>
@stop
