<?php

namespace App\Http\Controllers;

use App\Compte;
use App\Cotisation;
use App\Depense;
use App\Depute;
use App\LigneBudgetaire;
use App\ModePaiement;
use App\Ressource;
use App\SousLigneB;
use App\SousSouusLigneB;
use App\Typedepute;
use App\TypeRessouurce;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use function Sodium\add;
use Carbon;
use File;

class DepenseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function listeDepenses(){
        if(Auth::user()->id_role <= 2){

            $mytime = Carbon\Carbon::today();
            $mytime = $mytime->toDateString();


            $ligneBudgetaires = LigneBudgetaire::get();
            $ssLigneBs = SousLigneB::get();
            $ssSsLignBs = SousSouusLigneB::get();
            $mode_paiements = ModePaiement::get();
            $deputes = Depute::where('dateFinMandat','>',$mytime)->orwhere('dateFinMandat','=','0000-00-00')->orderBy('nom')->get();

            $type_ressources = TypeRessouurce::get();
            $ressources = Ressource::get();

            $comptes = Compte::get();

            foreach ($comptes as $compte){
                $depense_somme = Depense::where('id_compte',$compte->id_compte)->sum('solde');
                $cotisation_somme = Cotisation::where([
                    ['id_compte',$compte->id_compte],
                    ['date_encaissement','<=',$mytime],
                    ['date_encaissement','<>','0000-00-00']
                ])->sum('montant');
                $ressource_somme = Ressource::where('id_compte',$compte->id_compte)->sum('montant');
                $total = $ressource_somme + $cotisation_somme - $depense_somme;
                Compte::where('id_compte',$compte->id_compte)->update([
                    'somme_compte' => $total
                ]);
            }
            $comptes = Compte::get();


            return view('viewsAdmin.compteBancaire.liste'
                ,compact('comptes','ligneBudgetaires', 'ssLigneBs', 'ssSsLignBs',
                    'mode_paiements','deputes','type_ressources', 'ressources'));
        }
        return view('errors.404');
    }

    public function depenseAg(Request $request){
        if(Auth::user()->id_role <= 2){

            $mytime = Carbon\Carbon::now();

            $request->request->add(['id_cree_par' => Auth::user()->id]);

            $id_ss_ligneB = $request->input('id_ss_ligneB');
            $id_ss_ss_ligneB = $request->input('id_ss_ss_ligneB');
            $request->request->add(['descriptif' => trim($request->descriptif)]);

            if (!$id_ss_ss_ligneB)
                $request->request->add(['id_ss_ss_ligneB' => null]);
            if (!$id_ss_ligneB)
                $request->request->add(['id_ss_ligneB' => null]);

            $images = $request->img;
            $request->request->add(['piece_joint' => count($images)]);
            $lien = '/admin/img/depenses/depense-' . $mytime->toDateString().'-'. $mytime->hour .'-'. $mytime->minute .'-'. $mytime->second;
            $request->request->add(['lien' => $lien]);


            $depense = Depense::create($request->all());

            if ($request->hasFile('img')){
                foreach ($images as $key => $image){
                    $name = $request->img[$key]->getClientOriginalName();
                    $name = str_replace(" ","_",$name);
                    $destination = base_path() . '/public/admin/img/depenses/depense-' . $mytime->toDateString().'-'. $mytime->hour .'-'. $mytime->minute .'-'. $mytime->second;
                    $image->move($destination, $name);
                }
            }

            return redirect(route('listeDepenses'));
        }
        return view('errors.404');
    }

    public function listeModif(){
        if(Auth::user()->id_role <= 2){

            $typeDeputes= Typedepute::paginate(2);
            return view('viewsAdmin.compteBancaire.liste_modif', compact('typeDeputes'));
        }
        return view('errors.404');
    }

    public function listeDepense(){
        if(Auth::user()->id_role <= 2){

            $depenses = DB::table('depenses')
                ->join('comptes', 'depenses.id_compte', '=', 'comptes.id_compte')
                ->join('ligne_budgetaires', 'depenses.id_ligneB', '=', 'ligne_budgetaires.id_ligneBudgetaire')
                ->select('depenses.*','comptes.nom_banque','ligne_budgetaires.libelle_ligneB')
                ->groupBy('depenses.id_depense')
                ->get();
            $MyObjects = array();

            foreach ($depenses as $depense){
                $libelle_ss_ligneB = DB::table('sous_ligne_bs')->where('id_sousLigneBs', $depense->id_ss_ligneB)->value('libelle_ss_ligneB');
                $libelle_ss_ss_ligneB = DB::table('sous_sous_ligne_bs')->where('id_sousSousligneBs', $depense->id_ss_ss_ligneB)->value('libelle_ss_ss_ligneB');

                $MyObject = new myObject;

                $MyObject->solde = $depense->solde;
                $MyObject->libelle_ss_ligneB = $libelle_ss_ligneB;
                $MyObject->libelle_ss_ss_ligneB = $libelle_ss_ss_ligneB;
                $MyObject->libelle_ligneB = $depense->libelle_ligneB;
                $MyObject->nom_banque = $depense->nom_banque;
                $MyObject->id_depense = $depense->id_depense;
                $MyObject->lien = $depense->lien;
                $MyObject->date_operation = $depense->date_operation;
                $MyObject->num_cheque = $depense->num_cheque;
                $MyObject->calssement = $depense->calssement;
                $MyObject->descriptif = $depense->descriptif;


                if(File::exists(public_path().$depense->lien)) {
                    $files = File::allFiles(public_path() . $depense->lien);
                    $MyObject->piece_joint = $files;
                }
                //dd($files);


                $MyObjects[] = $MyObject;
            }
            $depenses = $MyObjects;
            //dd($depenses);
            $comptes = Compte::get();
            return view('viewsAdmin.compteBancaire.listeDepense',compact('depenses','comptes'));
        }
        return view('errors.404');
    }

    public function editDepense(Request $request){
        if(Auth::user()->id_role <= 2){

            Depense::where('id_depense',$request->id_depense)->update([
                'solde' => $request->solde,
                'date_operation' => $request->date_operation,
                'num_cheque' => $request->num_cheque,
                'calssement' => $request->calssement,
                'descriptif' => $request->descriptif,
                'updated_at' =>$request->updated_at
            ]);
            return redirect(route('listeDepense'));
        }
        return view('errors.404');
    }

    public function deleteDepense(Request $request){
        if(Auth::user()->id_role <= 2){

            try{
            Depense::where('id_depense',$request->id_depense)->delete();
            return redirect(route('listeDepense'));
            }catch (\Exception $e){
                return redirect(route('listeDepense').'/exception=exceptionLocal');
            }
        }
        return view('errors.404');
    }
    public function gestionException($exception){
        if(Auth::user()->id_role <= 2){

            $depenses = DB::table('depenses')
                ->join('comptes', 'depenses.id_compte', '=', 'comptes.id_compte')
                ->join('ligne_budgetaires', 'depenses.id_ligneB', '=', 'ligne_budgetaires.id_ligneBudgetaire')
                ->select('depenses.*','comptes.nom_banque','ligne_budgetaires.libelle_ligneB')
                ->groupBy('depenses.id_depense')
                ->get();
            $MyObjects = array();

            foreach ($depenses as $depense){
                $libelle_ss_ligneB = DB::table('sous_ligne_bs')->where('id_sousLigneBs', $depense->id_ss_ligneB)->value('libelle_ss_ligneB');
                $libelle_ss_ss_ligneB = DB::table('sous_sous_ligne_bs')->where('id_sousSousligneBs', $depense->id_ss_ss_ligneB)->value('libelle_ss_ss_ligneB');

                $MyObject = new myObject;

                $MyObject->solde = $depense->solde;
                $MyObject->libelle_ss_ligneB = $libelle_ss_ligneB;
                $MyObject->libelle_ss_ss_ligneB = $libelle_ss_ss_ligneB;
                $MyObject->libelle_ligneB = $depense->libelle_ligneB;
                $MyObject->nom_banque = $depense->nom_banque;
                $MyObject->id_depense = $depense->id_depense;
                $MyObject->lien = $depense->lien;
                $MyObject->date_operation = $depense->date_operation;
                $MyObject->num_cheque = $depense->num_cheque;
                $MyObject->calssement = $depense->calssement;
                $MyObject->descriptif = $depense->descriptif;


                $MyObjects[] = $MyObject;
            }
            $depenses = $MyObjects;
            //dd($depenses);
            return view('viewsAdmin.compteBancaire.listeDepense',compact('depenses','exception'));
        }
        return view('errors.404');
    }

}
class myObject
{
    public $id_depense;
    public $solde;
    public $libelle_ligneB;
    public $libelle_ss_ligneB;
    public $libelle_ss_ss_ligneB;
    public $nom_banque;
    public $piece_joint;
    public $date_operation;
    public $num_cheque;
    public $calssement;
    public $descriptif;
}
