@extends('adminNew')
<?php
include public_path().'/traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h3>{!! $titre_stat_one !!} {{ app('request')->input('date_recherche_fin') }}</h3>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $titre_stat_one !!}</strong>
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <form method="get" action="{!! route('list_etat_deux') !!}">

                                <input type="date" name="date_recherche_fin" class="input-sm m-b-xs" value="{{ app('request')->input('date_recherche_fin') }}"  placeholder="Search in table">
                                <button type="submit" class="btn btn-white btn-sm">{!! $recherche_stat !!} </button>
                            </form>

                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" dir="rtl">
                                <thead>
                                <tr>
                                    <th>{!! $nomBanque !!}</th>
                                    <th>{!! $rst_ann_tt !!}</th>
                                    <th>{!! $tt_ann_c_r !!}</th>
                                    <th>{!! $dps_ann !!}</th>
                                    <th>{!! $tot_mis !!}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $total_final = 0;
                                        $total_ann_pre = 0;$total_RC_crt = 0;$total_D_crt = 0;
                                ?>
                                @foreach($comptes as $cpt)
                                    <tr class="gradeU" dir="ltr">
                                        <td>{!! $cpt->nom_banque !!}</td>
                                        <td>{!! number_format($total_prec_bk = $ressources_prec[$cpt->id_compte]+$cotisations_prec[$cpt->id_compte]-$depenses_prec[$cpt->id_compte],2,",","")  !!}</td>
                                        <td>{!! number_format($beni_cour_bk = $ressources_courant[$cpt->id_compte]+$cotisations_courant[$cpt->id_compte],2,",","")  !!}</td>
                                        <td>{!! number_format($depense_bk =  $depenses_courant[$cpt->id_compte],2,",","")  !!}</td>
                                        <td>{!! number_format($total_prec_bk + $beni_cour_bk - $depense_bk,2,",","")  !!}</td>
                                    </tr>
                                    <?php
                                    $total_ann_pre += $total_prec_bk;
                                    $total_RC_crt += $beni_cour_bk;
                                    $total_D_crt += $depense_bk;
                                    $total_final += $total_prec_bk + $beni_cour_bk - $depense_bk;
                                    ?>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr  dir="ltr">
                                    <td >Total</td>
                                    <td>{!! number_format($total_ann_pre,2,",","")  !!}</td>
                                    <td>{!! number_format($total_RC_crt,2,",","")  !!}</td>
                                    <td>{!! number_format($total_D_crt,2,",","")  !!}</td>
                                    <td>{!! number_format($total_final,2,",","")  !!}</td>
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




