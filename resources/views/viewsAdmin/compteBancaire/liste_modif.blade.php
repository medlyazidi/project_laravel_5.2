@extends('adminNew')
<?php
include public_path().'/traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h2>{!! $miseAjour_Bank_titre !!}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $miseAjour_Bank_titre !!}</strong>
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-4">
            <div class="contact-box">
                <a href="{!! route('listeDepense') !!}">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-8">
                        <h2><strong>{!! $depense !!}</strong></h2>
                        <address>
                            <strong></strong><br>
                        </address>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box">
                <a href="{!! route('listeRessource') !!}">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-8">
                        <h2><strong>{!! $ressources_var !!}</strong></h2>
                        <address>
                            <strong></strong><br>
                        </address>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box">
                <a href="{!! route('listeCotisation') !!}">
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-8">
                        <h2><strong>{!! $cotisations_var !!}</strong></h2>
                        <address>
                            <strong></strong><br>
                        </address>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {

            $('.delete-demmo').click(function () {
                var idForm = "#" + $(this).val();

                swal({
                        title: "{!! $sur_supp !!}",
                        text: "{!! $msg_supp !!}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{!! $yes !!}, {!! $do_supp !!}",
                        cancelButtonText: "{!! $non !!}, {!! $not_supp !!}",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("{!! $do_supp_after !!}!", "{!! $do_supp_nice !!}.", "success");
                            $(idForm).submit();
                        } else {
                            swal("{!! $not_supp_after !!}", "{!! $not_supp_after2 !!}", "error");
                        }
                    });
            });
        });
    </script>

@endsection