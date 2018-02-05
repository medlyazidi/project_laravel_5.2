<?php

namespace App\Http\Controllers;

use App\LigneBudgetaire;
use App\SousLigneB;
use App\SousSouusLigneB;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class SousSousLigneBudgeatireController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function listSsLigneBudgetaire(){
        if(Auth::user()->id_role == 1){

            $ligneBudgetaires = LigneBudgetaire::get();
            $ssLigneBudgetaires = SousLigneB::get();
            $ssSSLigneBs = SousSouusLigneB::get();
            return view('viewsAdmin.ligneBudgetaire.listeSousLigneBudgetaire',
                compact('ligneBudgetaires','ssSSLigneBs','ssLigneBudgetaires'));
        }
        return view('errors.404');
    }

    public function postSsSsLigneBudgetaire(Request $request){
        if(Auth::user()->id_role == 1){

            $request->request->add(['id_cree_par' => Auth::user()->id]);
            //dd($request->all());
            SousSouusLigneB::create($request->all());
            /*
            if ($request->typeView == "true"){
                return redirect(route('listSsLigneBudgetaire'));
            }else
                */
            return redirect(route('listLigneBudgetaire'));
        }
        return view('errors.404');
    }
    public function editSsSsLigneBudgetaire(Request $request){
        if(Auth::user()->id_role == 1){

            SousSouusLigneB::where('id_sousSousligneBs',$request->id_sousSousligneBs)->update([
                'libelle_ss_ss_ligneB' => $request->libelle_ss_ss_ligneB,
                'dateCreation' => $request->dateCreation,
                'updated_at' =>$request->updated_at
            ]);
            return redirect(route('listSsLigneBudgetaire'));
        }
        return view('errors.404');
    }
    public function destroy(Request $request){
        if(Auth::user()->id_role == 1){

            try{
            SousSouusLigneB::where('id_sousSousligneBs',$request->id_sousSousligneBs)->delete();
            return redirect(route('listLigneBudgetaire'));
            }catch (\Exception $e){
                return redirect(route('listSsLigneBudgetaire').'/exceptionSS=exceptionLocal');
            }
        }
        return view('errors.404');
    }
    public function gestionException($exception){
        if(Auth::user()->id_role == 1){

            $ligneBudgetaires = LigneBudgetaire::get();
            $ssLigneBudgetaires = SousLigneB::get();
            return view('viewsAdmin.ligneBudgetaire.listeLigneBudgetaire',
                compact('ligneBudgetaires','ssLigneBudgetaires','exception'));
        }
        return view('errors.404');
    }
}
