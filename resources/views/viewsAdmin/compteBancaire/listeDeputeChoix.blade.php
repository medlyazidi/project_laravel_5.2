@extends('adminNew')
<?php
include public_path().'/traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $depute !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $depute !!}</strong>
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <div class="ibox-tools">
                        <!-- data-toggle="modal" data-target="#myModal4" -->
                        <a href="{!! route('ajouterDepute') !!}"><button type="button" class="btn btn-primary btn-xs">
                                {!! $ajouteDepute !!}
                            </button></a>

                    </div>
                </div>

                <div class="ibox-content">
                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                           placeholder="{!! $recherche !!}" dir="rtl" >

                    <table class="footable table table-stripped" data-page-size="50" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>{!! $action !!}</th>
                            <th>{!! $local_var !!}</th>
                            <th>{!! $telephone !!}</th>
                            <th>{!! $email !!}</th>
                            <th>{!! $prenom !!}</th>
                            <th>{!! $nom !!} </th>
                            <th>N°</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deputes as $key => $depute)
                            <tr class="gradeX">
                                <td>


                                    <form  action="{!! route('listeCotisationchoix') !!}" >
                                        {{ csrf_field() }}
                                        <input name="id_depute" type="hidden" class="form-control" value="{!! $depute->id_depute !!}">
                                        <button class="btn btn-danger btn-sm delete-demmo" value="myformLocal{!! $depute->id_depute !!}"><i class="fa fa-info"></i> مساهمات </button>

                                    </form>
                                </td>
                                <td ><h4>{!! $depute->libelle_local!!}</h4></td>
                                <td ><h4>{!! $depute->telephone!!}</h4></td>
                                <td ><h4>{!! $depute->email!!}</h4></td>
                                <td ><h4>{!! $depute->prenom!!}</h4></td>
                                <td ><h4>{!! $depute->nom!!}</h4></td>
                                <td>{!! $key+1 !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="12">
                                <ul class="pagination pull-right" ></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>



            </div>
        </div>
    </div>
@endsection

