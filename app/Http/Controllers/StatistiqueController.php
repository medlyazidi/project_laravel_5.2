<?php

namespace App\Http\Controllers;

use App\Cotisation;
use App\Local;
use App\Typedepute;
use App\UnionDeputeType;
use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon;
use Illuminate\Support\Facades\DB;


class StatistiqueController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    static public function list_deputes_montant(){
        $mytime = Carbon\Carbon::now();

        $deputes = DB::table('deputes')
            ->leftJoin('union_depute_type', 'deputes.id_depute', '=', 'union_depute_type.id_depute')
            ->leftJoin('locals', 'deputes.id_local', '=', 'locals.id_local')
            ->leftJoin('type_deputes', 'union_depute_type.id_typeDepute', '=', 'type_deputes.id_typeDepute')
            ->select('deputes.*','locals.*')
            ->groupBy('deputes.id_depute')
            ->get();

        $listDeputeMondats = array();

        foreach ($deputes as $depute){
            //cree un objet de type DetteDepute
            $deputeMontant = new DeputeMontants();

            // pouur definir la cotisation l'année courante de ce depute
            $cotisations_ann_crt = Cotisation::groupBy('id_depute')
                ->selectRaw('*, sum(montant) as sum_montant')
                ->where([
                    ['date_encaissement','<>','0000-00-00'],
                    ['date_encaissement','<=',$mytime->toDateString()],
                    ['date_encaissement','>=',$mytime->year.'-01-01'],
                    ['id_depute','=',$depute->id_depute]
                ])
                ->value('sum_montant');
            //$cotisations_ann_crt

            // pouur definir la cotisation attente de ce depute en cas de chèque
            $cotisations_att_ann_crt = Cotisation::groupBy('id_depute')
                ->selectRaw('*, sum(montant) as sum_montant')
                ->where([
                    ['date_encaissement','=','0000-00-00'],
                    ['date_reception','<=',$mytime->toDateString()],
                    ['date_reception','>=',$mytime->year.'-01-01'],
                    ['id_depute','=',$depute->id_depute]
                ])
                ->value('sum_montant');
            //$cotisations_att_ann_crt

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

            //definir la dette des années précédants selon les les mois du type de deputes
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
            //dd($dette_prec - $cts_prec);

            //definire toutes les variable pour l'envoyer

            $deputeMontant->id_depute = $depute->id_depute;
            $deputeMontant->nom = $depute->nom;
            $deputeMontant->prenom = $depute->prenom;
            $deputeMontant->email = $depute->email;
            $deputeMontant->cts_annee_crt = $cotisations_ann_crt;
            $deputeMontant->cts_att_annee_crt = $cotisations_att_ann_crt;
            $deputeMontant->cts_tt_annee = $somme_tt_ann;
            $deputeMontant->cts_reste_annee = $somme_tt_ann - $cotisations_ann_crt;
            $deputeMontant->dette_ann_prec = $dette_prec - $cts_prec;

            //ajoute cet objet au tableau
            $listDeputeMondats[] = $deputeMontant;
        }
        //dd($listDeputeMondats);
        $dette_mise = array();
        foreach ($listDeputeMondats as $item){
            $dette_mise[$item->id_depute] = $item->dette_ann_prec + $item->cts_reste_annee;
        }
        //dd($listDeputeMondats);
        return view('viewsAdmin.statistique.liste_first',compact('listDeputeMondats','dette_mise'));

    }

    static public function list_deputes_montant_local(){
        $mytime = Carbon\Carbon::now();

        $deputes = DB::table('deputes')
            ->leftJoin('union_depute_type', 'deputes.id_depute', '=', 'union_depute_type.id_depute')
            ->leftJoin('locals', 'deputes.id_local', '=', 'locals.id_local')
            ->leftJoin('type_deputes', 'union_depute_type.id_typeDepute', '=', 'type_deputes.id_typeDepute')
            ->select('deputes.*','locals.*')
            ->groupBy('deputes.id_depute')
            ->get();

        $listDeputeMondats = array();

        foreach ($deputes as $depute){
            //cree un objet de type DetteDepute
            $deputeMontant = new DeputeMontants();

            // pouur definir la cotisation l'année courante de ce depute
            $cotisations_ann_crt = Cotisation::groupBy('id_depute')
                ->selectRaw('*, sum(montant) as sum_montant')
                ->where([
                    ['date_encaissement','<>','0000-00-00'],
                    ['date_encaissement','<=',$mytime->toDateString()],
                    ['date_encaissement','>=',$mytime->year.'-01-01'],
                    ['id_depute','=',$depute->id_depute]
                ])
                ->value('sum_montant');
            //$cotisations_ann_crt

            // pouur definir la cotisation attente de ce depute en cas de chèque
            $cotisations_att_ann_crt = Cotisation::groupBy('id_depute')
                ->selectRaw('*, sum(montant) as sum_montant')
                ->where([
                    ['date_encaissement','=','0000-00-00'],
                    ['date_reception','<=',$mytime->toDateString()],
                    ['date_reception','>=',$mytime->year.'-01-01'],
                    ['id_depute','=',$depute->id_depute]
                ])
                ->value('sum_montant');
            //$cotisations_att_ann_crt

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

            //definir la dette des années précédants selon les les mois du type de deputes
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
            //dd($dette_prec - $cts_prec);

            //definire toutes les variable pour l'envoyer

            $deputeMontant->id_depute = $depute->id_depute;
            $deputeMontant->id_local = $depute->id_local;
            $deputeMontant->cts_annee_crt = $cotisations_ann_crt;
            $deputeMontant->cts_att_annee_crt = $cotisations_att_ann_crt;
            $deputeMontant->cts_tt_annee = $somme_tt_ann;
            $deputeMontant->cts_reste_annee = $somme_tt_ann - $cotisations_ann_crt;
            $deputeMontant->dette_ann_prec = $dette_prec - $cts_prec;

            //ajoute cet objet au tableau
            $listDeputeMondats[] = $deputeMontant;
        }
        //dd($listDeputeMondats);
        $dette_mise = array();
        $listeDepute_local = array();
        $dette_mise_local = array();
        //dd($listDeputeMondats);
        $locals = Local::groupBy('id_local')->get()->keyBy('id_local');
        //dd($locals);
        foreach ($locals as $key => $local){
            $deputeMontant = new DeputeMontants();
            foreach ($listDeputeMondats as $item){

                if($item->id_local == $local->id_local) {

                    $deputeMontant->local = $local->libelle_local;
                    $deputeMontant->cts_annee_crt += $item->cts_annee_crt;
                    $deputeMontant->cts_tt_annee += $item->cts_tt_annee;
                    $deputeMontant->cts_reste_annee += $item->cts_reste_annee;
                    $deputeMontant->dette_ann_prec += $item->dette_ann_prec;
                    $deputeMontant->dette_mise += $item->dette_ann_prec + $item->cts_reste_annee;

                    $listeDepute_local[$item->id_local] = $deputeMontant;

                    //$dette_mise_local[$item->id_local] = 0;//+= $item->dette_ann_prec + $item->cts_reste_annee;
                }
            }
        }
        //dd($listeDepute_local);
        return view('viewsAdmin.statistique.liste_depute_local',compact('listeDepute_local'));

    }

    public function list_deputes_mois()
    {
        $mytime = Carbon\Carbon::now();

        $deputes = DB::table('deputes')
            ->leftJoin('union_depute_type', 'deputes.id_depute', '=', 'union_depute_type.id_depute')
            ->leftJoin('locals', 'deputes.id_local', '=', 'locals.id_local')
            ->leftJoin('type_deputes', 'union_depute_type.id_typeDepute', '=', 'type_deputes.id_typeDepute')
            ->select('deputes.*','locals.*')
            ->groupBy('deputes.id_depute')
            ->get();

        $listDeputeMois = array();

        foreach ($deputes as $depute) {
            //cree un objet de type DeputeMoisCtst
            $deputeMois = new DeputeMoisCtst();


            //les cotisation selon les mois pour chaque depute
            for ($i=1; $i<=$mytime->month; $i++ ){
                $cts_mois[$i] = Cotisation::groupBy('id_depute')
                    ->selectRaw('*, sum(montant) as sum_montant')
                    ->where([
                        ['id_depute', $depute->id_depute]
                    ])
                    ->whereMonth('date_encaissement', '=', $i)
                    ->whereYear('date_encaissement', '=', $mytime->year)
                    ->value('sum_montant');
                if (!isset($cts_mois[$i]))
                    $cts_mois[$i] = 0;
            }
            for ($i= $mytime->month+1 ; $i<=12; $i++)
                $cts_mois[$i] = '-';
            $cts_tt[$depute->id_depute] = $cts_mois;

            //definir la dette des années précédants selon les les mois du type de deputes
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
            //dd($dette_prec - $cts_prec);

            //definire toutes les variable pour l'envoyer

            $deputeMois->id_depute = $depute->id_depute;
            $deputeMois->nom = $depute->nom;
            $deputeMois->prenom = $depute->prenom;
            $deputeMois->cts_mois = $cts_mois;
            $deputeMois->dette_ann_prec = $dette_prec - $cts_prec;

            $listDeputeMois[] = $deputeMois;
        }
        $dette_mise = StatistiqueController::list_deputes_montant()->dette_mise;
        //dd($listDeputeMois);
        return view('viewsAdmin.statistique.ctst_mois_depute',compact('listDeputeMois','dette_mise'));

    }

     static public function date_diff($to, $from){

        $from1 = $from->copy();
		$to1=$to->copy();
		
        $nbr_rst = $to->endOfMonth()->diffInMonths($from->startOfMonth())+1;

		
		
        if($from1->day >= 15) $nbr_rst = $nbr_rst - 0.5;
        if($to1->day <= 15) $nbr_rst = $nbr_rst - 0.5;
        return $nbr_rst;
    }

}


class DeputeMontants
{
    public $id_depute;
    public $nom;
    public $prenom;
    public $local;
    public $cts_annee_crt;
    public $cts_att_annee_crt;
    public $cts_tt_annee;
    public $cts_reste_annee;
    public $dette_ann_prec;
    public $dette_mise;
}
class DeputeMoisCtst{
    public $id_depute;
    public $nom;
    public $prenom;
    public $cts_mois;
    public $dette_ann_prec;
}

