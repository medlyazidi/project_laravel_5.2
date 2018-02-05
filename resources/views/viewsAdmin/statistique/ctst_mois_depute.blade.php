@extends('adminNew')
<?php
include public_path().'/traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h3>{!! $cotisations_var !!}</h3>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
            </li>
            <li class="active">
                <strong>{!! $cotisations_var !!}</strong>
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
                                    <th>{!! $somme_dette_prec !!}</th>
                                    <th>{!! $decembre !!}</th>
                                    <th>{!! $novembre !!}</th>
                                    <th>{!! $octobre !!}</th>
                                    <th>{!! $septembre !!} </th>
                                    <th>{!! $aout !!}</th>
                                    <th>{!! $juillet !!}</th>
                                    <th>{!! $juin !!}</th>
                                    <th>{!! $mai !!} </th>
                                    <th>{!! $avril !!}</th>
                                    <th>{!! $mars !!}</th>
                                    <th>{!! $fevrier !!}</th>
                                    <th>{!! $janvier !!} </th>
                                    <th>{!! $nom !!} {!! $prenom !!}</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                    $tt_rest = 0;
                                    $tt_mnt = 0;
                                ?>
                                @foreach($listDeputeMois as  $item)
                                    <?php
                                    $tt_mnt += $dette_mise[$item->id_depute];
                                    $tt_rest += $item->dette_ann_prec;
                                    ?>
                                    <tr class="gradeU">
                                        <td>{!! number_format($dette_mise[$item->id_depute],2,",","")  !!} </td>
                                        <td>{!! number_format($item->dette_ann_prec,2,",","")  !!} </td>
                                        @foreach(array_reverse($item->cts_mois) as $mois)
                                            <td>{!! $mois !!}</td>
                                        @endforeach
                                            <td >{!! $item->nom !!} {!! $item->prenom !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr  dir="ltr">
                                    <td>{!! number_format($tt_mnt,2,",","") !!}</td>
                                    <td>{!! number_format($tt_rest,2,",","") !!}</td>
                                    @foreach(array_reverse($item->cts_mois) as $mois)
                                        <td>-</td>
                                    @endforeach
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




