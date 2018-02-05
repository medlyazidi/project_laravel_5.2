<?php

namespace App\Http\Controllers;

use App\Cotisation;
use App\Typedepute;
use App\UnionDeputeType;
use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon;
use Illuminate\Support\Facades\DB;

class StatistiqueDeptAnnController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    static public function liste(){
        $mytime = Carbon\Carbon::now();

        $deputes = DB::table('deputes')
            ->leftJoin('union_depute_type', 'deputes.id_depute', '=', 'union_depute_type.id_depute')
            ->leftJoin('locals', 'deputes.id_local', '=', 'locals.id_local')
            ->leftJoin('type_deputes', 'union_depute_type.id_typeDepute', '=', 'type_deputes.id_typeDepute')
            ->select('deputes.*','locals.*')
            ->groupBy('deputes.id_depute')
            ->get();

        $listDeputeAnnee = array();

        foreach ($deputes as $depute){
            //cree un objet de type DetteDepute
            $deputeMontant = new DeputeAnnee();

            // pouur definir la cotisation l'année courante de ce depute
            for($i =0; $i<5; $i++ ){
                $cotisations_ann_crt[$mytime->year - $i] = Cotisation::groupBy('id_depute')
                    ->selectRaw('*, sum(montant) as sum_montant')
                    ->where([
                        ['date_encaissement','<>','0000-00-00'],
                        ['date_encaissement','<=',($mytime->year - $i).'-12-31'],
                        ['date_encaissement','>=',($mytime->year - $i).'-01-01'],
                        ['id_depute','=',$depute->id_depute]
                    ])
                    ->value('sum_montant');
            }


            //$cotisations_ann_crt

            // pouur definir la somme proposée durant la l'année courante en relation avec les mois des typeDepute de ce depute

            for($i =0; $i<5; $i++ ){
                $unions = UnionDeputeType::
                where([
                    ['id_depute',$depute->id_depute],
                    ['date_fin','>',($mytime->year-$i).'-01-01']
                ])
                    ->orWhere([
                        ['id_depute',$depute->id_depute],
                        ['date_fin','=','0000-00-00']
                    ])
                    ->get();
                $somme_tt_ann[$mytime->year - $i] = 0;

                foreach ($unions as $union){
                    if($union->date_debut < ($mytime->year-$i).'-01-01' )
                    {
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d', ($mytime->year-$i).'-01-01');
                    }
                    else if($union->date_debut <= ($mytime->year-$i).'-12-31' )
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $union->date_debut);
                    else $from = \Carbon\Carbon::createFromFormat('Y-m-d', '1000-12-31');

                    if ($union->date_fin <= ($mytime->year - $i).'-12-31' && $union->date_fin != '0000-00-00')
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $union->date_fin);
                    else if (($union->date_fin > ($mytime->year - $i).'-12-31' && $union->date_fin < ($mytime->year - $i).'-01-01') || $union->date_fin == '0000-00-00')
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d', ($mytime->year - $i).'-12-31');
                    else $to = \Carbon\Carbon::createFromFormat('Y-m-d', '1000-12-31');

                    $test_test[$mytime->year - $i] = $from.'  =>  '.$to;//debug
                    if ($from < '1001-12-31' || $to < '1001-12-31')
                        $mise_nmr_mnt = 0;
                    else
                        $mise_nmr_mnt = StatistiqueController::date_diff($to,$from);
                    //if ($from!=0 && $to!=0)
                    $somme_tt_test[$mytime->year - $i] = $mise_nmr_mnt;

                    $montant = Typedepute::where('id_typeDepute',$union->id_typeDepute)->value('somme_type');
                    $montant = $montant * $mise_nmr_mnt;
                    $somme_tt_ann[$mytime->year - $i] += $montant;
                }
                $somme_tt_ann[$mytime->year - $i] -=  $cotisations_ann_crt[$mytime->year - $i];
            }

            //dd($somme_tt_ann);
            //definire toutes les variable pour l'envoyer

            $deputeMontant->id_depute = $depute->id_depute;
            $deputeMontant->nom = $depute->nom;
            $deputeMontant->prenom = $depute->prenom;
            $deputeMontant->cts_annee = $cotisations_ann_crt;
            $deputeMontant->dette_ann = $somme_tt_ann;


            //ajoute cet objet au tableau
            $listDeputeAnnee[] = $deputeMontant;
        }
        //dd($listDeputeAnnee);
        return view('viewsAdmin.statistique.depute_annee',compact('listDeputeAnnee'));

    }

}

class DeputeAnnee
{
    public $id_depute;
    public $nom;
    public $prenom;
    public $cts_annee;
    public $dette_ann;
}
