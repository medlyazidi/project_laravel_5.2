@extends('adminNew')
<?php
include public_path().'\traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">

        <h3>{!! $liste_depense !!} {{ app('request')->input('date_recherche_fin') }}</h3>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $liste_depense !!}</strong>
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
                            <form method="get" action="{!! route('etat_depense') !!}">

                                <input type="date" name="date_recherche_fin" class="input-sm m-b-xs" value="{{ app('request')->input('date_recherche_fin') }}"  placeholder="Search in table"> {!! $to !!}
                                <input type="date" name="date_recherche_debut" class="input-sm m-b-xs" value="{{ app('request')->input('date_recherche_debut') }}"  placeholder="Search in table"> {!! $from !!}
                                <button type="submit" class="btn btn-white btn-sm">{!! $recherche_stat !!} </button>
                            </form>

                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>{!! $total_date_lign !!}</th>
                                    <th>{!! $nomLignBM !!}، {!! $nomSousLignB !!} و {!! $nomSousSousLignB !!}  </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $tt = 0;
                                ?>

                                @foreach($depenses as $dps)
                                    <?php
                                            if (isset($depenses_total[$dps->id_ligneB]))
                                                $tt += $depenses_total[$dps->id_ligneB];
                                    ?>
                                    <tr class="gradeU">
                                        <td>
                                            {!! number_format(isset($depenses_total[$dps->id_ligneB])? $depenses_total[$dps->id_ligneB] : 0,2,",","")  !!} </td>
                                        <td>
                                            <ul>
                                                <li>{!! $dps->libelle_ligneB !!}</li>
                                                @if(isset($dps->libelle_ss_ligneB))<li>{!! $dps->libelle_ss_ligneB !!}</li>@endif
                                                @if(isset($dps->libelle_ss_ss_ligneB))<li>{!! $dps->libelle_ss_ss_ligneB !!}</li>@endif
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr  dir="ltr">
                                    <td>{!! number_format($tt,2,",","") !!}</td>
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




