@extends('adminNew')
<?php
include public_path().'\traduction.php';
?>
@section('head')
    <div class="col-sm-12" dir="rtl">
        <h3>وضعية مساهمات النواب في 5 سنوات</h3>
        <ol class="breadcrumb">
            <li>
                <a href="{!! route('menu_img') !!}">{!! $accueil !!} </a>
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
                                    <th>{!! $nom !!} {!! $prenom !!}</th>
                                    <th>{!! Carbon\Carbon::today()->year !!}</th>
                                    <th>{!! Carbon\Carbon::today()->year - 1 !!}</th>
                                    <th>{!! Carbon\Carbon::today()->year - 2 !!}</th>
                                    <th>{!! Carbon\Carbon::today()->year - 3 !!}</th>
                                    <th>{!! Carbon\Carbon::today()->year - 4 !!}</th>
                                </tr>
                                <tr class="gradeU">
                                    <td ></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-xs-6">{!! $reste_var !!}</div>
                                            <div class="col-xs-6" style="border-left: 1px solid gray;">{!! $cts_var !!}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-xs-6">{!! $reste_var !!}</div>
                                            <div class="col-xs-6" style="border-left: 1px solid gray;">{!! $cts_var !!}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-xs-6">{!! $reste_var !!}</div>
                                            <div class="col-xs-6" style="border-left: 1px solid gray;">{!! $cts_var !!}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-xs-6">{!! $reste_var !!}</div>
                                            <div class="col-xs-6" style="border-left: 1px solid gray;">{!! $cts_var !!}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-xs-6">{!! $reste_var !!}</div>
                                            <div class="col-xs-6" style="border-left: 1px solid gray;">{!! $cts_var !!}</div>
                                        </div>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($listDeputeAnnee as $item)
                                    <tr class="gradeU">
                                        <td >{!! $item->nom !!} {!! $item->prenom !!}</td>
                                        @for($i = 0; $i<5; $i++)
                                            <td>
                                                <div class="row">
                                                    <div class="col-xs-6" >
                                                        {!! number_format($item->dette_ann[Carbon\Carbon::today()->year - $i],2,",","")!!}
                                                    </div>
                                                    <div class="col-xs-6"style="border-left: 2px solid gray;">
                                                        {!! number_format($item->cts_annee[Carbon\Carbon::today()->year - $i],2,",","")!!}
                                                    </div>
                                                </div>
                                            </td>
                                        @endfor
                                    </tr>
                                @endforeach

                                </tbody>
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




