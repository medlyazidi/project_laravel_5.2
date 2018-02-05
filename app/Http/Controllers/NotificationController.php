<?php

namespace App\Http\Controllers;

use App\Cotisation;
use App\Depute;
use App\Local;
use App\Notification;
use App\Typedepute;
use App\UnionDeputeType;
use App\Voiture;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Psy\Util\Json;
use Carbon;

class NotificationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getNoty(){
        $noty_count = Notification::get()->count();
        $noty_count_vue = Notification::get()->where('vue','false')->count();

        return response()->json([
                'noty_count' => $noty_count,
                'noty_count_vue' => $noty_count_vue
            ]);

    }
    public function doDelt(Request $request){
        $deputes = Depute::get();
        $mytime = Carbon::now()->day;


        foreach ($deputes as $depute){
            $summe_depute = DB::table('union_depute_type')
                ->join('type_deputes', 'union_depute_type.id_typeDepute', '=', 'type_deputes.id_typeDepute')
                ->join('deputes', 'deputes.id_depute', '=', 'union_depute_type.id_depute')
                ->where('deputes.id_depute','=',$depute->id_depute)
                ->select('type_deputes.*')
                ->sum('type_deputes.somme_type');

            Depute::where('id_depute',$depute->id_depute)->update([
                'dette' => $depute->dette + $summe_depute,
                'updated_at' =>$request->updated_at
            ]);


        }

        /*
        return response()->json([
            'noty_count' => $noty_count,
            'noty_count_vue' => $noty_count_vue
        ]);
        */

    }
    public function doDeltTest(Request $request){
        $request->request->add(['libelle_local' => 222]);
        Local::create($request->all());
    }
    public function notification(){
        $mytime = Carbon\Carbon::now();
        $voitures = Voiture::where('date_prochaine_assurance', '<=', $mytime->addDay(+15)->toDateString())->get();

        $mytime = Carbon\Carbon::now();
        $mytime1 = Carbon\Carbon::now();
        $date1 = $mytime->addMonth(-1)->year.'-'.$mytime->addMonth(0)->month.'-01';
        $date2 = $mytime1->year.'-'.$mytime1->month.'-01';

        $cst = DB::table('deputes')
            ->join('cotisations', 'deputes.id_depute', '=', 'cotisations.id_depute')
            ->select('deputes.*','cotisations.*')
            ->where([
                ['date_encaissement', '>=' ,$date1],
                ['date_encaissement', '<' ,$date2]
            ])

            ->groupBy('cotisations.id_cotisation')
            ->get();
        //dd($date1."  to  ".$date2);

        $deputes = Depute::get();


        foreach ($deputes as  $depute){
            $liste_depute[$depute->id_depute] = $depute;

            foreach ($cst as $item){
                //$liste_date[$depute->id_depute] = $item->date_encaissement;
                if ($depute->id_depute == $item->id_depute){
                    unset($liste_depute[$depute->id_depute]);
                }
            }

                    $cotisations_ann_crt = Cotisation::groupBy('id_depute')
                        ->selectRaw('*, sum(montant) as sum_montant')
                        ->where([
                            ['date_encaissement','<>','0000-00-00'],
                            ['date_encaissement','<=',$mytime->toDateString()],
                            ['date_encaissement','>=',$mytime->year.'-01-01'],
                            ['id_depute','=',$depute->id_depute]
                        ])
                        ->value('sum_montant');

                    // pouur definir la somme proposée durant la l'année courante en relation avec les mois des typeDepute de ce depute
                    $unions = UnionDeputeType::
                    where([
                        ['id_depute',$depute->id_depute],
                        ['date_fin','>',$mytime->year.'-01-01']
                    ])
                        ->orWhere([
                            ['id_depute',$depute->id_depute],
                            ['date_fin','=','0000-00-00']
                        ])
                        ->get();


                    $somme_tt_ann = 0;
                    foreach ($unions as $union){
                        if($union->date_debut < $mytime->year.'-01-01' )
                        {
                            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $mytime->year.'-01-01');
                            //dd('good  '.$union->id_union_depute_type."=>  $union->date_debut <  $mytime->year.'-01-01'");
                        }
                        else  $from = \Carbon\Carbon::createFromFormat('Y-m-d', $union->date_debut);
                        if ($union->date_fin < ($mytime->year + 1).'-01-01' && $union->date_fin != '0000-00-00')
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $union->date_fin);
                        //else  $to = \Carbon\Carbon::createFromFormat('Y-m-d', ($mytime->year + 1).'-01-01');
                        else  $to = \Carbon\Carbon::createFromFormat('Y-m-d', ($mytime->year).'-12-31');

                        $mise_nmr_mnt = StatistiqueController::date_diff($to,$from);

                        $montant = Typedepute::where('id_typeDepute',$union->id_typeDepute)->value('somme_type');
                        $montant = $montant * $mise_nmr_mnt;
                        $somme_tt_ann += $montant;
                    }
                    //$somme_tt_ann

                    $dette_prec = 0;
                    $unions = UnionDeputeType::where([
                        ['id_depute',$depute->id_depute],
                        ['date_debut', '<' , $mytime->year.'-01-01']
                    ])->get();
                    foreach ($unions as $union){
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $union->date_debut);
                        if ($union->date_fin > $mytime->year.'-01-01' || $union->date_fin == '0000-00-00')
                            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $mytime->year.'-01-01');
                        else  $to = \Carbon\Carbon::createFromFormat('Y-m-d', $union->date_fin);


                        $mise_nmr_mnt = StatistiqueController::date_diff($to,$from);

                        $montant = Typedepute::where('id_typeDepute',$union->id_typeDepute)->value('somme_type');
                        $montant = $montant * $mise_nmr_mnt;
                        $dette_prec += $montant;
                    }

                    $cts_prec = Cotisation::groupBy('id_depute')
                        ->selectRaw('*, sum(montant) as sum_montant')
                        ->where([
                            ['date_encaissement','<',$mytime->year.'-01-01'],
                            ['date_reception','<',$mytime->year.'-01-01'],
                            ['id_depute','=',$depute->id_depute]
                        ])
                        ->value('sum_montant');
                    if (($somme_tt_ann - $cotisations_ann_crt + $dette_prec - $cts_prec) <= 0){
                        unset($liste_depute[$depute->id_depute]);
                    }


        }



        return view('viewsAdmin.notification', compact('voitures', 'liste_depute'));
    }
    public function getNotification(){
        //dd(NotificationController::notification()->voitures);

        ///count(NotificationController::notification()->voitures);
        //count(NotificationController::notification()->liste_depute);

        return response()->json([
            'count_noty' => count(NotificationController::notification()->voitures) + count(NotificationController::notification()->liste_depute)
        ]);

    }
}
