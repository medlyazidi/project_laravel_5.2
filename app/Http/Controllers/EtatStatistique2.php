<?php

namespace App\Http\Controllers;

use App\Compte;
use App\Cotisation;
use App\Depense;
use App\Ressource;
use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon;

class EtatStatistique2 extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function list_etat_deux(Request $request){
        $mytime = Carbon\Carbon::today()->now();

        //Recuperer les montants des années precedant

        $ressources_prec = Ressource::groupBy('id_compte')
            ->selectRaw('sum(montant) as sum , id_compte')
            ->where('date', '<=', ($mytime->year-1).'-12-31')
            ->pluck('sum','id_compte');


        $depenses_prec = Depense::groupBy('id_compte')
            ->selectRaw('sum(solde) as sum , id_compte')
            ->where('date_operation', '<=', ($mytime->year-1).'-12-31')
            ->pluck('sum','id_compte');

        $cotisations_prec = Cotisation::groupBy('id_compte')
            ->selectRaw('sum(montant) as sum , id_compte')
            ->where('date_reception', '<=', ($mytime->year-1).'-12-31')
            ->pluck('sum','id_compte');


        //recuparation des montants courants

        $ressources_courant = Ressource::groupBy('id_compte')
            ->selectRaw('sum(montant) as sum , id_compte')
            ->where([
                ['date', '<=', $request->date_recherche_fin],
                ['date', '>=', ($mytime->year).'-01-01']
            ])
            ->pluck('sum','id_compte');


        $depenses_courant = Depense::groupBy('id_compte')
            ->selectRaw('sum(solde) as sum , id_compte')
            ->where([
                ['date_operation', '<=', $request->date_recherche_fin],
                ['date_operation', '>=', ($mytime->year).'-01-01']
            ])
            ->pluck('sum','id_compte');

        $cotisations_courant = Cotisation::groupBy('id_compte')
            ->selectRaw('sum(montant) as sum , id_compte')
            ->where([
                ['date_reception', '<=', $request->date_recherche_fin],
                ['date_reception', '>=', ($mytime->year).'-01-01']
            ])
            ->pluck('sum','id_compte');

        //get les comptes bancaires
        $comptes = Compte::select('nom_banque','id_compte')->get();
        //dd($comptes[0]->nom_banque);


        foreach ($comptes as $compte){
            //
            if(!isset($ressources_prec[$compte->id_compte]))
                $ressources_prec[$compte->id_compte] = 0;
            //
            if(!isset($depenses_prec[$compte->id_compte]))
                $depenses_prec[$compte->id_compte] = 0;
            //
            if(!isset($cotisations_prec[$compte->id_compte]))
                $cotisations_prec[$compte->id_compte] = 0;
            //
            if(!isset($ressources_courant[$compte->id_compte]))
                $ressources_courant[$compte->id_compte] = 0;
            //
            if(!isset($depenses_courant[$compte->id_compte]))
                $depenses_courant[$compte->id_compte] = 0;
            //
            if(!isset($cotisations_courant[$compte->id_compte]))
                $cotisations_courant[$compte->id_compte] = 0;
        }
        //dd($comptes);


        return  view('viewsAdmin.statistique.etat_deux',compact(
                            'ressources_prec','ressources_courant',
                            'depenses_prec','depenses_courant',
                            'cotisations_prec','cotisations_courant',
                            'comptes'
                        ));
    }
}
