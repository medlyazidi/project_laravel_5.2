<?php

namespace App\Http\Controllers;

use App\Ressource;
use App\TypeRessouurce;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Carbon;
use File;

class RessourceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function ajoutRessource(Request $request){
        if(Auth::user()->id_role <= 2){

            $mytime = Carbon\Carbon::now();

            $request->request->add(['id_cree_par' => Auth::user()->id]);
            $request->request->add(['descriptif' => trim($request->descriptif)]);

            $images = $request->img;
            $request->request->add(['piece_joint' => count($images)]);
            $lien = '/admin/img/ressources/ressource-' . $mytime->toDateString().'-'. $mytime->hour .'-'. $mytime->minute .'-'. $mytime->second;
            $request->request->add(['lien' => $lien]);

            Ressource::create($request->all());

            if ($request->hasFile('img')){
                foreach ($images as $key => $image){
                    $name = $request->img[$key]->getClientOriginalName();
                    $name = str_replace(" ","_",$name);
                    $destination = base_path() . '/public/admin/img/ressources/ressource-' . $mytime->toDateString().'-'. $mytime->hour .'-'. $mytime->minute .'-'. $mytime->second;
                    $image->move($destination, $name);
                }
            }

            return redirect(route('listeDepenses'));
        }
        return view('errors.404');
    }

    public function listeRessource(){

        if(Auth::user()->id_role <= 2){

            $ressources = DB::table('ressources')
                ->join('comptes', 'ressources.id_compte', '=', 'comptes.id_compte')
                ->join('type_ressouurces', 'ressources.id_type_ressouurce', '=', 'type_ressouurces.id_type_ressouurce')
                ->select('ressources.*','comptes.nom_banque','type_ressouurces.libelle_type_ressouurce')
                ->groupBy('ressources.id_ressource')
                ->get();

            //dd($ressources);
            $type_ressources = TypeRessouurce::get();

            $MyObjects = array();
            foreach ($ressources as $ressource){
                $MyObject = new FileClass;
                if(File::exists(public_path().$ressource->lien)) {
                    // path does not exist
                    $files = File::allFiles(public_path().$ressource->lien);
                    //dd($files);
                    $MyObject->piece_joint = $files;
                    $MyObject->id_file = $ressource->id_ressource;
                    $MyObjects[] = $MyObject;
                }
            }
            $files = $MyObjects;

            //dd($type_ressources);
            return view('viewsAdmin.compteBancaire.listeRessource',compact('ressources','type_ressources','files'));
        }
        return view('errors.404');
    }

    public function editRessource(Request $request){
        if(Auth::user()->id_role <= 2){

            //dd($request->all());
            Ressource::where('id_ressource',$request->id_ressource)->update([
                'montant' => $request->montant,
                'id_type_ressouurce' => $request->id_type_ressouurce,
                'date' => $request->date,
                'descriptif' => $request->descriptif,
                'updated_at' =>$request->updated_at
            ]);

            return redirect(route('listeRessource'));
        }
        return view('errors.404');
    }

    public function deleteRessource(Request $request){
        if(Auth::user()->id_role <= 2){

            try{
            Ressource::where('id_ressource',$request->id_ressource)->delete();
            return redirect(route('listeRessource'));

            }catch (\Exception $e){
                return redirect(route('listeRessource').'/exception=exceptionLocal');
            }
        }
        return view('errors.404');
    }
    public function gestionException($exception){
        if(Auth::user()->id_role <= 2){

            $ressources = DB::table('ressources')
                ->join('comptes', 'ressources.id_compte', '=', 'comptes.id_compte')
                ->join('type_ressouurces', 'ressources.id_type_ressouurce', '=', 'type_ressouurces.id_type_ressouurce')
                ->select('ressources.*','comptes.nom_banque','type_ressouurces.libelle_type_ressouurce')
                ->groupBy('ressources.id_ressource')
                ->get();

            $type_ressources = TypeRessouurce::get();
            return view('viewsAdmin.compteBancaire.listeRessource',compact('ressources','type_ressources','exception'));
        }
        return view('errors.404');
    }

    //liste des type de ressource
    public function listTypeRessource(){
        if(Auth::user()->id_role == 1){

            $type_ressources = TypeRessouurce::get();
            return view('viewsAdmin.compteBancaire.listeTypeRessource',compact('type_ressources'));
        }
        return view('errors.404');
    }

    public function editTypeRessource(Request $request){
        if(Auth::user()->id_role == 1){

            TypeRessouurce::where('id_type_ressouurce',$request->id_type_ressouurce)->update([
               'libelle_type_ressouurce' => $request->libelle_type_ressouurce
            ]);
            return redirect(route('listTypeRessource'));
        }
        return view('errors.404');
    }
    public function deleteTypeRessource(Request $request){
        if(Auth::user()->id_role == 1){

            try{
                TypeRessouurce::where('id_type_ressouurce',$request->id_type_ressouurce)->delete();
                return redirect(route('listTypeRessource'));
            }catch (\Exception $e){
                return redirect(route('listTypeRessource').'/exception=exceptionLocal');
            }
        }
        return view('errors.404');
    }
    public function gestionExceptionTypeRessource($exception){
        if(Auth::user()->id_role == 1){

            $type_ressources = TypeRessouurce::get();
            return view('viewsAdmin.compteBancaire.listeTypeRessource',compact('type_ressources','exception'));
        }
        return view('errors.404');
    }

    public function addTypeRessource(Request $request){
        if(Auth::user()->id_role == 1){

            TypeRessouurce::create($request->all());
            return redirect(route('listTypeRessource'));
        }
        return view('errors.404');
    }
}
class FileClass
{
    public $id_file;
    public $piece_joint;
}
