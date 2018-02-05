@extends('admin')

@section('head')
    <div class="col-sm-4">
        <h2>Project list</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li class="active">
                <strong>Project list</strong>
            </li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Menu des Villes<small></small></h5>
            </div>
            <div class="ibox-content">

                <div class="form-horizontal"  >
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                            Test22</br>
                            <form method="post" action="../region/liste" >
                                <input type="hidden" name="_token" value="{{csrf_token()}}" style="display: inline-block;"/>
                                <input type="hidden" name="id" value="1"/>
                                <button type="submit" class="btn btn-xs btn-outline btn-warning">Modifier <i class="fa fa-gear"></i> </button>
                            </form>
                            <form method="post" action="../region/liste/delete" style="display: inline-block;">
                                <input  type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <input  type="hidden" name="id" value="1"/>
                                <button type="submit" class="btn btn-xs btn-outline btn-danger">Supprimer <i class="fa fa-close"></i> </button>
                            </form>
                        </label>
                        <div class="col-sm-10">
                            <ul style="list-style-type:decimal;">
                                <div class="row">
                                    <li>
                                        <h5 style="display: inline-block;" class="col-lg-2">test</h5> :
                                        <form method="post" action="" style="display: inline-block;">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            <input type="hidden" name="idville" value="1"/>
                                            <input type="hidden" name="nomville" value="Rabat"/>
                                            <input type="hidden" name="nomregion" value="Rabat-Kenitra"/>
                                            <button type="submit" class="btn btn-xs btn-outline btn-warning">Modifier <i class="fa fa-gear"></i> </button> ||
                                        </form>
                                        <form method="post" action="liste/delete" style="display: inline-block;">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            <input type="hidden" name="idv" value="1"/>
                                            <button type="submit" class="btn btn-xs btn-outline btn-danger">Supprimer <i class="fa fa-close"></i></button>
                                        </form>
                                    </li>
                                </div>
                                <div class="row">
                                    <li>
                                        <h5 style="display: inline-block;" class="col-lg-2">test2</h5> :
                                        <form method="post" action="" style="display: inline-block;">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            <input type="hidden" name="idville" value="2"/>
                                            <input type="hidden" name="nomville" value="kenitra"/>
                                            <input type="hidden" name="nomregion" value="Rabat-Kenitra"/>
                                            <button type="submit" class="btn btn-xs btn-outline btn-warning">Modifier <i class="fa fa-gear"></i> </button> ||
                                        </form>
                                        <form method="post" action="liste/delete" style="display: inline-block;">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            <input type="hidden" name="idv" value="2"/>
                                            <button type="submit" class="btn btn-xs btn-outline btn-danger">Supprimer <i class="fa fa-close"></i></button>
                                        </form>
                                    </li>
                                </div>
                            </ul>
                            <ul style="list-style-type:none;">
                                <li>
                                    <form method="post" action="../ville" style="display: inline-block;">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                        <input type="hidden" name="idr" value="1"/>
                                        <input type="hidden" name="nomr" value="rabat_test"/>
                                        <button type="submit" class="btn btn-sm btn-outline btn-primary">Ajouter une ville <i class="fa fa-plus-circle"></i></button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                </div>
            </div>
        </div>
    </div>
@endsection