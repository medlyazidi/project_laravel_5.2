@extends('adminNew')
<?php
include public_path().'\traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h3>وضعية مساهمات حسب اللوائح {{ app('request')->input('date_recherche_fin') }}</h3>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>وضعية مساهمات حسب اللوائح</strong>
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr >
                                    <th>{!! $mise_dette_tt_rst !!}</th>
                                    <th>{!! $dette_rest_ann !!}</th>
                                    <th>{!! $rst_ann !!}</th>
                                    <th>{!! $proposition_ann_tt_dpt !!}</th>
                                    <th>{!! $somme_ann_dpt !!} </th>
                                    <th>{!! $nom !!} {!! $prenom !!}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $tt_1 = 0;
                                $dette_ann_prec_1 = 0;
                                $cts_reste_annee_1 = 0;
                                $cts_tt_annee_1 = 0;
                                $cts_att_annee_crt_1 = 0;
                                $cts_annee_crt_1 = 0;

                                ?>
                                @foreach($listeDepute_local as $item)
                                    <?php
                                    $tt_1 += ($item->dette_ann_prec + $item->cts_reste_annee);
                                    $dette_ann_prec_1 += $item->dette_ann_prec;
                                    $cts_reste_annee_1 += $item->cts_reste_annee;
                                    $cts_tt_annee_1 += $item->cts_tt_annee;
                                    $cts_annee_crt_1 +=$item->cts_annee_crt;
                                    ?>
                                    <tr class="gradeU">
                                        <td>{!!  number_format(($item->dette_ann_prec + $item->cts_reste_annee),2,",","")  !!} </td>
                                        <td>{!!  number_format($item->dette_ann_prec,2,",","")  !!} </td>
                                        <td>{!!  number_format($item->cts_reste_annee,2,",","")  !!} </td>
                                        <td>{!!  number_format($item->cts_tt_annee,2,",","")  !!} </td>
                                        <td>{!!  number_format($item->cts_annee_crt,2,",","")  !!} </td>
                                        <td >{!! $item->local !!} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr  dir="ltr">
                                    <td>{!! number_format($tt_1,2,",","")  !!}</td>
                                    <td>{!! number_format($dette_ann_prec_1,2,",","")  !!}</td>
                                    <td>{!! number_format($cts_reste_annee_1,2,",","")  !!}</td>
                                    <td>{!! number_format($cts_tt_annee_1,2,",","")  !!}</td>
                                    <td>{!! number_format($cts_annee_crt_1,2,",","")  !!}</td>
                                    <td >Total</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <!-- Custom and plugin javascript -->
    <script src="{{URL::asset('admin/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{URL::asset('admin/js/plugins/pace/pace.min.js')}}"></script>
    <script src="{{URL::asset('admin/js/inspinia.js')}}"></script>
    <script>

        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [

                    { extend: 'copy'},
                    { extend: 'excel', title: 'ExampleFile'},
                    { extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });
        });

    </script>
@endsection




