<?php

namespace App\Http\Controllers;

use App\SousLigneB;
use App\SousSouusLigneB;
use App\LigneBudgetaire;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Depute;
use Illuminate\Support\Facades\Auth;

class SousLigneBudgetaireController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function listSsLigneBudgetaire(Request $request){
        if(Auth::user()->id_role == 1){

            $ssLigneBudgetaires = SousLigneB::where('id_sousLigneBs', $request->id_sousLigneBs)->get();
            $ssSSLigneBs = SousSouusLigneB::where('id_ss_ligneB', $request->id_sousLigneBs)->get();
            return view('viewsAdmin.ligneBudgetaire.listeSousLigneBudgetaire',compact('ssSSLigneBs','ssLigneBudgetaires'));
        }
        return view('errors.404');
    }

    public function postSsLigneBudgetaire(Request $request){
        if(Auth::user()->id_role == 1){

            $request->request->add(['id_cree_par' => Auth::user()->id]);
            SousLigneB::create($request->all());
            if ($request->typeView == "true"){
                return redirect(route('listSsLigneBudgetaire'));
            }else
                return redirect(route('listLigneBudgetaire'));
        }
        return view('errors.404');
    }
    public function editSsLigneBudgetaire(Request $request){
        if(Auth::user()->id_role == 1){

            SousLigneB::where('id_sousLigneBs',$request->id_sousLigneBs)->update([
                'libelle_ss_ligneB' => $request->libelle_ss_ligneB,
                'dateCreation' => $request->dateCreation,
                'updated_at' =>$request->updated_at
            ]);
            if ($request->typeView == "true"){
                return redirect(route('listSsLigneBudgetaire'));
            }else
                return redirect(route('listLigneBudgetaire'));
        }
        return view('errors.404');
    }
    public function destroy(Request $request){
        if(Auth::user()->id_role == 1){

            try{
                //SousSouusLigneB::where('id_ss_ligneB',$request->id_sousLigneBs)->delete();
                SousLigneB::where('id_sousLigneBs',$request->id_sousLigneBs)->delete();
                if ($request->typeView == "true"){
                    return redirect(route('listSsLigneBudgetaire'));
                }else
                    return redirect(route('listLigneBudgetaire'));
            }catch (\Exception $e){
                return redirect(route('listSsLigneBudgetaire').'/exception=exceptionLocal');
            }
        }
        return view('errors.404');
    }

    public function getSousLigne(Request $request) {

        if(Auth::user()->id_role == 1){

            $sousLigne = SousLigneB::where('id_ligneB',$request->input('id_ligneB'))->get();
           // dd($sousLigne);

            if($request->ajax()){
                return response()->json([
                    'sousLigne' => $sousLigne
                ]);
            }
        }
        return view('errors.404');
    }

    public function getSousSousLigne(Request $request) {
        if(Auth::user()->id_role == 1){

            $sousSousLigne = SousSouusLigneB::where('id_ss_ligneB',$request->input('id_ss_ligneB'))->get();
            //dd($sousSousLigne);

            if($request->ajax()){
                return response()->json([
                    'sousSousLigne' => $sousSousLigne
                ]);
            }
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
