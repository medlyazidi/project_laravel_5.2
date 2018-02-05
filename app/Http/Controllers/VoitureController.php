<?php

namespace App\Http\Controllers;

use App\Voiture;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class VoitureController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function liste(){
        if(Auth::user()->id_role == 1){

            $voitures= Voiture::get();
            return view('viewsAdmin.voiture.liste_voiture',compact('voitures'));

        }
        return view('errors.404');
    }

    public function ajoute(Request $request){
        if(Auth::user()->id_role == 1){

            Voiture::create($request->all());
            return redirect(route('listVoiture'));

        }
        return view('errors.404');
    }
    public function edit(Request $request){
        if(Auth::user()->id_role == 1){

            Voiture::where('id_voiture',$request->id_voiture)->update([
                'marque' => $request->marque,
                'matricule' => $request->matricule,
                'date_prochaine_assurance' =>$request->date_prochaine_assurance
            ]);
            return redirect(route('listVoiture'));

        }
        return view('errors.404');
    }
    public function destroy(Request $request){

        if(Auth::user()->id_role == 1){

                Voiture::where('id_voiture',$request->id_voiture)->delete();
                return redirect(route('listVoiture'));

        }
        return view('errors.404');
    }
}
