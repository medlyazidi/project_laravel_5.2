<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DeputeCreditController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public static function list_deputes_avec_credit(){
        $listDeputeMondats = StatistiqueController::list_deputes_montant()->listDeputeMondats;
        foreach ($listDeputeMondats as $key => $item ){
            $somme_test = $item->cts_reste_annee + $item->dette_ann_prec;

            $item->somme_test = $somme_test;
            if ( $somme_test <= 0 ){
                unset($listDeputeMondats[$key]);
            }

        }

        return view('viewsAdmin.statistique.liste_avec_credit',compact('listDeputeMondats'));
    }

    public static function list_deputes_sans_credit(){
        $listDeputeMondats = StatistiqueController::list_deputes_montant()->listDeputeMondats;
        foreach ($listDeputeMondats as $key => $item ){
            $somme_test = $item->cts_reste_annee + $item->dette_ann_prec;
            $item->somme_test = $somme_test;
            if ($somme_test > 0 )
                unset($listDeputeMondats[$key]);
        }

        return view('viewsAdmin.statistique.liste_sans_credit',compact('listDeputeMondats'));
    }
}
