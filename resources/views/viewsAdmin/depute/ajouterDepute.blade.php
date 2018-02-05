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
            <li>{!! $depute !!}</li>
            <li ><strong>{!! $ajouteDepute !!}</strong></li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">


                    <div class="ibox-content">
                        <form method="post" action="ajouter" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><h3>{!!$nom !!} :</h3></label>
                                <div class="col-sm-6">
                                    <input name="nom" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><h3>{!! $prenom !!} :</h3></label>
                                <div class="col-sm-6">
                                    <input name="prenom" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-4 control-label"><h3>{!! $sexe !!} :</h3></label>

                                <div class="col-sm-6">
                                    <select class="form-control m-b" name="sexe">
                                        <option value="{!! $monsieur !!}">{!! $monsieur !!}</option>
                                        <option value="{!! $madame !!}">{!! $madame !!}</option>
                                        <option value="{!! $mademoiselle !!}">{!! $mademoiselle !!}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><h3>{!! $photo !!} :</h3></label>
                                <div class="col-sm-6">
                                    <input name="image" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><h3>{!! $email !!} :</h3></label>
                                <div class="col-sm-6">
                                    <input name="email" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><h3>{!! $telephone !!} :</h3></label>
                                <div class="col-sm-6">
                                    <input name="telephone" type="phone" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><h3>{!! $dateDebutMandat !!} :</h3></label>
                                <div class="col-sm-6" >
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input required type="date" name="dateDebutMandat" class="form-control" value="10/11/2013">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><h3>{!! $dateFinMandat !!} :</h3></label>
                                <div class="col-sm-6" >
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="date" name="dateFinMandat" class="form-control" value="10/11/2013">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-4 control-label"><h3>{!! $typeDepute_var !!} :</h3></label>

                                <div class="col-sm-5">
                                    <select class="form-control m-b" name="id_typeDeputes[]"  required>
                                        @foreach($typeDeputes as $typeDepute)
                                            <option value="{!! $typeDepute->id_typeDepute !!}">{!! $typeDepute->libelle_typeDepute !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-1"><button type="button" class="btn btn-primary add-option"><i class="fa fa-plus"></i></button></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-offset-4 col-sm-2 control-label"><h4>date debut :</h4></label>
                                <div class="col-sm-3">
                                    <input name="date_debut[]" type="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-offset-4 col-sm-2 control-label"><h4>date fin :</h4></label>
                                <div class="col-sm-3">
                                    <input name="date_fin[]" type="date" class="form-control" >
                                </div>
                            </div>
                            <div id="place-add"></div>

                            <div class="form-group"><label class="col-sm-4 control-label"><h3>{!! $local_var !!} :</h3></label>

                                <div class="col-sm-6">
                                    <select class="form-control m-b" name="id_local" required>
                                        @foreach($locals as $local)
                                            <option value="{!! $local->id_local !!}">{!! $local->libelle_local !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-8">
                                    <button class="btn btn-primary" type="submit">{!! $save !!}</button>
                                </div>
                            </div>
                        </form>
                    </div>


            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function () {
            var indice = 2;
            $('.delete').click(function(){
                alert('ok');
                //$('.add-option').html('');
            });
            $('.add-option').click(function(){
                $('#place-add').prepend("<div class=\"form-group\"><label class=\"col-sm-4 control-label\"><h3>{!! $typeDepute_var !!} :</h3></label>\n" +
                    "\n" +
                    "                                <div class=\"col-sm-5\">\n" +
                    "                                    <select class=\"form-control m-b\" name=\"id_typeDeputes[]\"  required>\n" +
                    "                                        @foreach($typeDeputes as $typeDepute)\n" +
                    "                                            <option value=\"{!! $typeDepute->id_typeDepute !!}\">{!! $typeDepute->libelle_typeDepute !!}</option>\n" +
                    "                                        @endforeach\n" +
                    "                                    </select>\n" +
                    "                                </div>\n" +
                    "                                <div class=\"col-sm-1\">"+indice+"</div>\n" +
                    "                            </div>\n" +
                    "                            <div class=\"form-group\">\n" +
                    "                                <label class=\"col-sm-offset-4 col-sm-2 control-label\"><h4>date debut :</h4></label>\n" +
                    "                                <div class=\"col-sm-3\">\n" +
                    "                                    <input name=\"date_debut[]\" type=\"date\" class=\"form-control\" required>\n" +
                    "                                </div>\n" +
                    "                            </div>\n" +
                    "                            <div class=\"form-group\">\n" +
                    "                                <label class=\"col-sm-offset-4 col-sm-2 control-label\"><h4>date fin :</h4></label>\n" +
                    "                                <div class=\"col-sm-3\">\n" +
                    "                                    <input name=\"date_fin[]\" type=\"date\" class=\"form-control\" >\n" +
                    "                                </div>\n" +
                    "                            </div>");
                indice++;
            });

            @if(!empty($exceptionAddDep)) toastr.error("{!! $msg_attetion_add !!}", "{!! $attention !!}"); @endif
        });
    </script>
@endsection


