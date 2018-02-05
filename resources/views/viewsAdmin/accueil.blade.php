@extends('adminNew')

<?php
include public_path().'/traduction.php';
?>

@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $menu !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $menu !!}</strong>
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="row">
        <div  style="text-align: center">
            <span style="display: inline-block"><img alt="image" class="img-responsive" src="{{URL::asset('admin/img/logo-groupe.png')}}"></span>
            <span style="display: inline-block"><img alt="image" class="img-responsive" src="{{URL::asset('admin/img/logo-pjd.png')}}"></span>
        </div>


    </div>

@endsection
