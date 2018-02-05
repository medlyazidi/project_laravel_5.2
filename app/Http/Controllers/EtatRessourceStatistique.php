<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class EtatRessourceStatistique extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function etat_ressource(Request $request){
        $ressources = DB::table('ressources')
            ->join('comptes', 'ressources.id_compte', '=', 'comptes.id_compte')
            ->join('type_ressouurces', 'ressources.id_type_ressouurce', '=', 'type_ressouurces.id_type_ressouurce')
            ->where([
                ['ressources.date','<=',$request->date_recherche_fin],
                ['ressources.date','>=',$request->date_recherche_debut]
            ])
            ->select('ressources.*','comptes.nom_banque','type_ressouurces.libelle_type_ressouurce')
            ->orderBy('ressources.id_ressource')
            ->get();

        return view('viewsAdmin.statistique.etat_ressource',compact('ressources'));

    }
}
