<?php

namespace App\Http\Controllers;

use App\Depense;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use File;

class EtatDepenseStatistique extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function etat_depense(Request $request){

        $depenses = DB::table('depenses')
            ->join('comptes', 'depenses.id_compte', '=', 'comptes.id_compte')
            ->join('ligne_budgetaires', 'depenses.id_ligneB', '=', 'ligne_budgetaires.id_ligneBudgetaire')
            ->leftJoin('sous_ligne_bs', 'depenses.id_ss_ligneB', '=', 'sous_ligne_bs.id_sousLigneBs')
            ->leftJoin('sous_sous_ligne_bs', 'depenses.id_ss_ss_ligneB', '=', 'sous_sous_ligne_bs.id_sousSousligneBs')
            ->where([
                ['depenses.date_operation','<',$request->date_recherche_fin],
                ['depenses.date_operation','>',$request->date_recherche_debut]
            ])
            ->select('depenses.*','comptes.nom_banque','ligne_budgetaires.libelle_ligneB','sous_ligne_bs.libelle_ss_ligneB','sous_sous_ligne_bs.libelle_ss_ss_ligneB')
            ->orderBy('depenses.id_compte')
            ->get();


        foreach ($depenses as $depense){
            if(File::exists(public_path().$depense->lien)) {
                $files[$depense->id_depense] = File::allFiles(public_path().$depense->lien);
            }
        }
        //dd($files);
        return view('viewsAdmin.statistique.etat_depense',compact('depenses','files'));
    }
    public function etat_depense_ligne(Request $request){
        $depenses_total = Depense::groupBy('id_ligneB')
            ->selectRaw('sum(solde) as sum , id_ligneB')
            ->where([
                ['depenses.date_operation','<',$request->date_recherche_fin],
                ['depenses.date_operation','>',$request->date_recherche_debut]
            ])
            ->pluck('sum','id_ligneB');

        $depenses = DB::table('depenses')
            ->join('comptes', 'depenses.id_compte', '=', 'comptes.id_compte')
            ->join('ligne_budgetaires', 'depenses.id_ligneB', '=', 'ligne_budgetaires.id_ligneBudgetaire')
            ->leftJoin('sous_ligne_bs', 'depenses.id_ss_ligneB', '=', 'sous_ligne_bs.id_sousLigneBs')
            ->leftJoin('sous_sous_ligne_bs', 'depenses.id_ss_ss_ligneB', '=', 'sous_sous_ligne_bs.id_sousSousligneBs')
            ->where([
                ['depenses.date_operation','<',$request->date_recherche_fin],
                ['depenses.date_operation','>',$request->date_recherche_debut]
            ])
            ->select('depenses.id_ligneB','ligne_budgetaires.libelle_ligneB','sous_ligne_bs.libelle_ss_ligneB','sous_sous_ligne_bs.libelle_ss_ss_ligneB')
            ->groupBy('depenses.id_ligneB')
            ->get();
        //dd($depenses);
        return view('viewsAdmin.statistique.etat_depense_budg',compact('depenses','depenses_total'));
    }
}
