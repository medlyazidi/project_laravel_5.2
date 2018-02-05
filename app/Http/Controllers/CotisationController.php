<?php

namespace App\Http\Controllers;

use App\Compte;
use App\Cotisation;
use App\Depute;
use App\ModePaiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Carbon;
use File;

class CotisationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function ajoutCotisation(Request $request){
        if(Auth::user()->id_role <= 2){

            $mytime = Carbon\Carbon::now();

            $request->request->add(['id_cree_par' => Auth::user()->id]);

            if (($request->date_encaissement == '') && ($request->id_mode_paiement != 1))
                $request->request->add(['date_encaissement' => $request->date_reception]);


            $images = $request->img;
            $request->request->add(['piece_joint' => count($images)]);
            $lien = '/admin/img/cotisations/cotisation-' . $mytime->toDateString().'-'. $mytime->hour .'-'. $mytime->minute .'-'. $mytime->second;
            $request->request->add(['lien' => $lien]);


            Cotisation::create($request->all());

            if ($request->hasFile('img')) {
                foreach ($images as $key => $image) {
                    $name = $request->img[$key]->getClientOriginalName();
                    $name = str_replace(" ", "_", $name);
                    $destination = base_path() . '/public/admin/img/cotisations/cotisation-' . $mytime->toDateString().'-'. $mytime->hour .'-'. $mytime->minute .'-'. $mytime->second;
                    $image->move($destination, $name);
                }
            }
            return redirect(route('listeDepenses'));
        }
        return view('errors.404');
    }

    public function listeCotisation(){
        if(Auth::user()->id_role <= 2){

            $cotisations = DB::table('cotisations')
                ->join('comptes', 'cotisations.id_compte', '=', 'comptes.id_compte')
                ->join('deputes', 'cotisations.id_depute', '=', 'deputes.id_depute')
                ->join('mode_paiements', 'cotisations.id_mode_paiement', '=', 'mode_paiements.id_mode_paiement')
                ->select('cotisations.*','comptes.nom_banque','mode_paiements.libelle_mode_paiement','deputes.nom','deputes.prenom')
                ->groupBy('cotisations.id_cotisation')
                ->get();
            $mode_paiements = ModePaiement::get();
            $deputes = Depute::get();
            //dd($cotisations);
            $MyObjects = array();
            foreach ($cotisations as $cotisation){
                $MyObject = new FileClass;
                if(File::exists(public_path().$cotisation->lien)) {
                    // path does not exist
                    $files = File::allFiles(public_path().$cotisation->lien);
                    $MyObject->piece_joint = $files;
                    $MyObject->id_file = $cotisation->id_cotisation;
                    $MyObjects[] = $MyObject;
                }
            }
            $files = $MyObjects;

            return view('viewsAdmin.compteBancaire.listeCotisation',
                compact('cotisations','mode_paiements','deputes','files'));
        }
        return view('errors.404');
    }

    public function getEditCotisation(Request $request){
        if(Auth::user()->id_role <= 2){

            $cotisation = Cotisation::where('id_cotisation',$request->id_cotisation)->get()->first();
            $nom_banque_db = Compte::where('id_compte',$cotisation->id_compte)->value('nom_banque');

            //dd($nom_banque_db);
            $deputes = Depute::get();
            $mode_paiements = ModePaiement::get();
            return view('viewsAdmin.compteBancaire.edit_cotisation',
                compact('cotisation','mode_paiements','deputes','nom_banque_db'));
        }
        return view('errors.404');

    }

    public function editCotisation(Request $request){
        if(Auth::user()->id_role <= 2){

            if ($request->id_mode_paiement != 1)
                $request->request->add(['date_encaissement' => $request->date_reception]);

            //dd($request->all());
            Cotisation::where('id_cotisation',$request->id_cotisation)->update([
                'montant' => $request->montant,
                'id_mode_paiement' => $request->id_mode_paiement,
                'id_depute' => $request->id_depute,
                'descriptif' => $request->descriptif,
                'date_reception' => $request->date_reception,
                'date_encaissement' => $request->date_encaissement,
                'updated_at' =>$request->updated_at
            ]);

            return redirect(route('listeCotisation'));
        }
        return view('errors.404');
    }
    public function deleteCotisation(Request $request){
        if(Auth::user()->id_role <= 2){

            try{
            Cotisation::where('id_cotisation',$request->id_cotisation)->delete();
            return redirect(route('listeCotisation'));
            }catch (\Exception $e){
                return redirect(route('listeCotisation').'/exception=exceptionLocal');
            }
        }
        return view('errors.404');
    }
    public function gestionException($exception){
        if(Auth::user()->id_role <= 2){

            $cotisations = DB::table('cotisations')
                ->join('comptes', 'cotisations.id_compte', '=', 'comptes.id_compte')
                ->join('deputes', 'cotisations.id_depute', '=', 'deputes.id_depute')
                ->join('mode_paiements', 'cotisations.id_mode_paiement', '=', 'mode_paiements.id_mode_paiement')
                ->select('cotisations.*','comptes.nom_banque','mode_paiements.libelle_mode_paiement','deputes.nom','deputes.prenom')
                ->groupBy('cotisations.id_cotisation')
                ->get();
            $mode_paiements = ModePaiement::get();
            $deputes = Depute::get();
            //dd($cotisations);
            return view('viewsAdmin.compteBancaire.listeCotisation',
                compact('cotisations','mode_paiements','deputes','exception'));
        }
        return view('errors.404');
    }
}
class FileClass
{
    public $id_file;
    public $piece_joint;
}
