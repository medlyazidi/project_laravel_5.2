<?php

namespace App\Http\Controllers;

use App\Banque;
use App\Compte;
use App\Trace;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompteBancaireController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function listCompteBancaire(){
        if(Auth::user()->id_role == 1){

            $banques = Banque::get();
            $comptes = DB::table('comptes')
                ->join('banques', 'comptes.id_banque', '=', 'banques.id_banque')
                ->select('comptes.*', 'banques.libelle_banque')
                ->get();
            return view('viewsAdmin.compteBancaire.listeCompteBancaire',compact('banques','comptes'));
        }
        return view('errors.404');
    }

    public function ajouterBanque(Request $request){
        if(Auth::user()->id_role == 1){

            //ajouter Banque
            $request->request->add(['id_cree_par' => Auth::user()->id]);
            Banque::create($request->all());

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'banques']);
            $request->request->add(['operation' => 'ajouter']);
            $request->request->add(['info' => 'ajout|banques']);
            Trace::create($request->all());

            //reterner a la liste des comptes bancaire
            return redirect(route('listCompteBancaire'));
        }
        return view('errors.404');
    }

    public function ajouterCompte(Request $request){
        if(Auth::user()->id_role == 1){

            //ajouter un compte bancaire
            $request->request->add(['id_cree_par' => Auth::user()->id]);
            Compte::create($request->all());

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'comptes']);
            $request->request->add(['operation' => 'ajouter']);
            $request->request->add(['info' => 'ajout|comptes']);
            Trace::create($request->all());

            return redirect(route('listCompteBancaire'));
        }
        return view('errors.404');
    }
    public function editBanque(Request $request){
        if(Auth::user()->id_role == 1){

            //modification Banque
            Banque::where('id_banque',$request->id_banque)->update([
                'libelle_banque' => $request->libelle_banque,
                'dateAjout' => $request->dateAjout,
                'updated_at' =>$request->updated_at
            ]);
            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'banques']);
            $request->request->add(['operation' => 'modifier']);
            $request->request->add(['info' => 'modification|banques']);
            Trace::create($request->all());

            return redirect(route('listCompteBancaire'));
        }
        return view('errors.404');
    }

    public function editCompte(Request $request){
        if(Auth::user()->id_role == 1){

            //modifcation un compte
            Compte::where('id_compte',$request->id_compte)->update([
                'numero_banque' => $request->numero_banque,
                'nom_banque' => $request->nom_banque,
                'sugnataire' =>$request->sugnataire,
                'dateAjout' => $request->dateAjout,
                'dateOuvrageCompte' => $request->dateOuvrageCompte,
                'updated_at' =>$request->updated_at
            ]);

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'comptes']);
            $request->request->add(['operation' => 'modifier']);
            $request->request->add(['info' => 'modification|compte']);
            Trace::create($request->all());

            return redirect(route('listCompteBancaire'));
        }
        return view('errors.404');
    }

    public function destroyBanque(Request $request){
        if(Auth::user()->id_role == 1){

            try{
                //supprimer banque
                //Compte::where('id_banque',$request->id_banque)->delete();
                Banque::where('id_banque',$request->id_banque)->delete();
            }catch (\Exception $e){
                return redirect(route('listCompteBancaire').'/exception=exceptionLocal');
            }

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'banques']);
            $request->request->add(['operation' => 'supprimer']);
            $request->request->add(['info' => 'supprimer|banques|'+$request->id_banque]);
            Trace::create($request->all());

            return redirect(route('listCompteBancaire'));
        }
        return view('errors.404');
    }

    public function destroyCompte(Request $request){

        if(Auth::user()->id_role == 1){

            try{
                //supprmer un compte
                Compte::where('id_compte',$request->id_compte)->delete();
            }catch (\Exception $e){
                return redirect(route('listCompteBancaire').'/exception=exceptionLocal');
            }

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'comptes']);
            $request->request->add(['operation' => 'supprimer']);
            $request->request->add(['info' => 'supprimer|comptes|'+$request->id_compte]);
            Trace::create($request->all());

            return redirect(route('listCompteBancaire'));
        }
        return view('errors.404');
    }
    public function gestionException($exception){
        if(Auth::user()->id_role == 1){

            $banques = Banque::get();
            $comptes = DB::table('comptes')
                ->join('banques', 'comptes.id_banque', '=', 'banques.id_banque')
                ->select('comptes.*', 'banques.libelle_banque')
                ->get();
            return view('viewsAdmin.compteBancaire.listeCompteBancaire',compact('banques','comptes','exception'));
        }
        return view('errors.404');
    }
}
