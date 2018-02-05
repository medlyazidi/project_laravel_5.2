@extends('admin')

@section('head')
    <div class="col-sm-4">
        <h2>Gestion des locaux</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>Ajouter un Local</strong>
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Ajouter un local  <small>....</small></h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>

            </div>
        </div>
        <div class="ibox-content">
            <form method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group"><label class="col-sm-2 control-label">Local</label>

                    <div class="col-sm-10"><input name="libelle_local" type="text" class="form-control"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection