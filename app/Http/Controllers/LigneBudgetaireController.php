<?php

namespace App\Http\Controllers;

use App\LigneBudgetaire;
use App\SousLigneB;
use App\Trace;
use Illuminate\Http\Request;

use App\Http\Requests;


use Illuminate\Support\Facades\Auth;


class LigneBudgetaireController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function listLigneBudgetaire(){
        if(Auth::user()->id_role == 1){

            $ligneBudgetaires = LigneBudgetaire::paginate(10);
            $ssLigneBudgetaires = SousLigneB::get();
            return view('viewsAdmin.ligneBudgetaire.listeLigneBudgetaire',compact('ligneBudgetaires','ssLigneBudgetaires'));
        }
        return view('errors.404');
    }

    public function postLigneBudgetaire(Request $request){
        if(Auth::user()->id_role == 1){

            //ajouter Ligne Budgetaire
            $request->request->add(['id_cree_par' => Auth::user()->id]);
            LigneBudgetaire::create($request->all());

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'ligneBudgetaires']);
            $request->request->add(['operation' => 'ajouter']);
            $request->request->add(['info' => 'ajout|ligneBudgetaires']);

            Trace::create($request->all());

            return redirect(route('listLigneBudgetaire'));
        }
        return view('errors.404');
    }
    public function editLigneBudgetaire(Request $request){
        if(Auth::user()->id_role == 1){

            //modifier Ligne budgetaire
            LigneBudgetaire::where('id_ligneBudgetaire',$request->id_ligneBudgetaire)->update([
                'libelle_ligneB' => $request->libelle_ligneB,
                'dateCreation' => $request->dateCreation,
                'updated_at' =>$request->updated_at
            ]);

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'ligneBudgetaires']);
            $request->request->add(['operation' => 'modifier']);
            $request->request->add(['info' => 'ajout|ligneBudgetaires']);
            Trace::create($request->all());

            return redirect(route('listLigneBudgetaire'));
        }
        return view('errors.404');
    }
    public function destroy(Request $request){
        if(Auth::user()->id_role == 1){

            try{
                //supprimer une ligne budgetaire
                //SousLigneB::where('id_ligneB',$request->id_ligneBudgetaire)->delete();
                LigneBudgetaire::where('id_ligneBudgetaire',$request->id_ligneBudgetaire)->delete();
            }catch (\Exception $e){
                return redirect(route('listLigneBudgetaire').'/exception=exceptionLocal');
            }


            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'ligneBudgetaires']);
            $request->request->add(['operation' => 'supprimer']);
            $request->request->add(['info' => 'supprimer|ligneBudgetaires|'+$request->id_ligneBudgetaire+ '=>'  +$request->id_ligneBudgetaire]);
            Trace::create($request->all());
            return redirect(route('listLigneBudgetaire'));
        }
        return view('errors.404');
    }
    public function gestionException($exception){
        if(Auth::user()->id_role == 1){

            $ligneBudgetaires = LigneBudgetaire::paginate(10);
            $ssLigneBudgetaires = SousLigneB::get();
            return view('viewsAdmin.ligneBudgetaire.listeLigneBudgetaire',compact('ligneBudgetaires','ssLigneBudgetaires','exception'));
        }
        return view('errors.404');
    }
}
