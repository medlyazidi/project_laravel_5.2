@extends('adminNew')
<?php
include public_path().'\traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h3>النواب الذين بذمتهم دين</h3>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>النواب الذين بذمتهم دين</strong>
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
                                    <th>{!! $somme_ann_dpt_cheque !!}</th>
                                    <th>{!! $somme_ann_dpt !!} </th>
                                    <th>{!! $nom !!} {!! $prenom !!}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $tt = 0;
                                $tt_dette_ann_prec = 0;
                                $tt_cts_reste_annee = 0;
                                $tt_cts_tt_annee = 0;
                                $tt_cts_att_annee_crt = 0;
                                $tt_cts_annee_crt = 0;
                                ?>
                                @foreach($listDeputeMondats as $item)
                                    <?php
                                        $tt += $item->cts_reste_annee + $item->dette_ann_prec;
                                        $tt_dette_ann_prec += $item->dette_ann_prec;
                                        $tt_cts_reste_annee += $item->cts_reste_annee;
                                        $tt_cts_tt_annee += $item->cts_tt_annee;
                                        $tt_cts_att_annee_crt += $item->cts_att_annee_crt;
                                        $tt_cts_annee_crt += $item->cts_annee_crt;
                                    ?>
                                    <tr class="gradeU">
                                        <td>{!! number_format($item->cts_reste_annee + $item->dette_ann_prec,2,",","")  !!} </td>
                                        <td>{!! number_format($item->dette_ann_prec,2,",","")  !!} </td>
                                        <td>{!! number_format($item->cts_reste_annee,2,",","")  !!} </td>
                                        <td>{!! number_format($item->cts_tt_annee,2,",","")  !!} </td>
                                        <td>{!! number_format($item->cts_att_annee_crt,2,",","")  !!}</td>
                                        <td>{!! number_format($item->cts_annee_crt,2,",","")  !!} </td>
                                        <td >{!! $item->nom !!} {!! $item->prenom !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr  dir="ltr">
                                    <td>{!! number_format($tt,2,","," ") !!}</td>
                                    <td>{!! number_format($tt_dette_ann_prec,2,",","") !!}</td>
                                    <td>{!! number_format($tt_cts_reste_annee,2,",","") !!}</td>
                                    <td>{!! number_format($tt_cts_tt_annee,2,",","") !!}</td>
                                    <td>{!! number_format($tt_cts_att_annee_crt,2,",","") !!}</td>
                                    <td>{!! number_format($tt_cts_annee_crt,2,",","") !!}</td>
                                    <td>Total</td>
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




