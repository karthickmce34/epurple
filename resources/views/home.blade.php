@extends('_layouts.app')

@section('title', 'Home')
@section('page_title', 'Home')
@section('page_icon_cls', 'fa-building')

@section('page_home_li_cls', 'active')

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
                    <h3>Home</h3>
                    <h2 class="c-black f-500">Welcome {{strtoupper($username) }}</h2>
            </div>
            <div class="card-body card-padding " >


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



    });
</script>
@stop
