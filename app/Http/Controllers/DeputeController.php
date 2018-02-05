<?php

namespace App\Http\Controllers;

use App\Local;
use App\Trace;
use App\Typedepute;
use App\UnionDeputeType;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Depute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DeputeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function listDepute(){
        if(Auth::user()->id_role == 1){

            //$deputes = Depute::get();
            $locals = Local::get();
            $users = User::get();
            $typeDeputes = TypeDepute::get();
            $unios = UnionDeputeType::get();

            $deputes = DB::table('deputes')
                ->leftJoin('union_depute_type', 'deputes.id_depute', '=', 'union_depute_type.id_depute')
                ->leftJoin('locals', 'deputes.id_local', '=', 'locals.id_local')
                ->leftJoin('type_deputes', 'union_depute_type.id_typeDepute', '=', 'type_deputes.id_typeDepute')
                ->select('deputes.*','locals.*')
                ->groupBy('deputes.id_depute')
                ->get();


            return view('viewsAdmin.depute.listeDepute',compact('deputes','locals', 'users', 'typeDeputes', 'unios'));
        }
        return view('errors.404');
    }

    public function postDepute(Request $request){

        if(Auth::user()->id_role == 1){

            //dd($request->all());
            $id_typeDeputes = $request->id_typeDeputes;
            $date_debut = $request->date_debut;
            $date_fin = $request->date_fin;

            $request->request->add(['id_typeDeputes' => "rien"]);
            if($request->hasFile('image')){
                $photo = $request->file('image')->getClientOriginalName();
                $destination = base_path() . '/public/admin/img/deputes';

                $request->file('image')->move($destination, $photo);
                $photo = "admin/img/deputes/".$photo;
                $request->request->add(['photo' => $photo]);
            }

            $request->request->add(['id_cree_par' => Auth::user()->id]);

            $request->request->remove('id_typeDeputes');

            try{
                Depute::create($request->all());
            }catch (\Exception $e){
                return redirect(route('ajouterDepute').'/exception=exceptionLocal');
            }

            $id_depute = Depute::get()->last()->id_depute;
            foreach ($id_typeDeputes as $key => $typeDeputes) {
                DB::table('union_depute_type')->insert(
                    ['id_typeDepute' => $typeDeputes, 'id_depute' => $id_depute,
                        'date_debut' => $date_debut[$key], 'date_fin' => $date_fin[$key],
                    ]
                );
            }

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'deputes']);
            $request->request->add(['operation' => 'ajouter']);
            $request->request->add(['info' => 'ajout|deputes']);
            Trace::create($request->all());
            return redirect(route('listDepute'));
        }
        return view('errors.404');
    }
    public function editDepute(Request $request){
        if(Auth::user()->id_role == 1){

            //modification depute
            //UnionDeputeType::where('id_depute',$request->id_depute)->delete();

            try{
                Depute::where('id_depute',$request->id_depute)->update([
                    "nom" => $request->nom,
                    "prenom" => $request->prenom,
                    "sexe" => $request->sexe,
                    "email" => $request->email,
                    "telephone" => $request->telephone,
                    "dateDebutMandat" => $request->dateDebutMandat,
                    "dateFinMandat" => $request->dateFinMandat,
                    "id_local" => $request->id_local,
                    'updated_at' =>$request->updated_at
                ]);
            }catch (\Exception $e){
                return redirect(route('editDepute').'/exception=exceptionLocal');
            }

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'deputes']);
            $request->request->add(['operation' => 'modifier']);
            $request->request->add(['info' => 'modification|deputes']);
            Trace::create($request->all());

            return redirect(route('listDepute'));
        }
        return view('errors.404');
    }
    public function destroy(Request $request){
        if(Auth::user()->id_role == 1){

            try{
                //suppression depute
                Depute::where('id_depute',$request->id_depute)->delete();

            }catch (\Exception $e){
                return redirect(route('listDepute').'/exception=exceptionLocal');
            }

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'deputes']);
            $request->request->add(['operation' => 'supprimer']);
            $request->request->add(['info' => 'supprimer|deputes|'+$request->id_depute]);
            Trace::create($request->all());

            return redirect(route('listDepute'));
        }
        return view('errors.404');
    }
    public function gestionException($exception){
        if(Auth::user()->id_role == 1){

            $locals = Local::get();
            $users = User::get();
            $typeDeputes = TypeDepute::get();
            $unios = UnionDeputeType::get();

            $deputes  = DeputeController::listDepute()->deputes;
            return view('viewsAdmin.depute.listeDepute',compact('deputes','locals', 'users', 'typeDeputes', 'unios','exception'));
        }
        return view('errors.404');
    }
    //gestion des exception en cas d'ajout d'un deputes deja existe l'unicité
    public function gestionExcDepAdd($exceptionAddDep){
        if(Auth::user()->id_role == 1){

            $typeDeputes = Typedepute::get();
            $locals = Local::get();
            return view('viewsAdmin.depute.ajouterDepute',compact('typeDeputes','locals','exceptionAddDep'));
        }
        return view('errors.404');
    }
    //gestion des ecxeptions en cas de modification d'un depute
    public function gestionExcDepEdit($exceptionEditDep){
        if(Auth::user()->id_role == 1){

            $locals = Local::get();
            $users = User::get();
            $typeDeputes = TypeDepute::get();
            $unios = UnionDeputeType::get();

            $deputes = DB::table('deputes')
                ->leftJoin('union_depute_type', 'deputes.id_depute', '=', 'union_depute_type.id_depute')
                ->leftJoin('locals', 'deputes.id_local', '=', 'locals.id_local')
                ->leftJoin('type_deputes', 'union_depute_type.id_typeDepute', '=', 'type_deputes.id_typeDepute')
                ->select('deputes.*','locals.*')
                ->groupBy('deputes.id_depute')
                ->get();

            return view('viewsAdmin.depute.listeDepute',compact('deputes','locals', 'users', 'typeDeputes', 'unios','exceptionEditDep'));
        }
        return view('errors.404');
    }
    //page pour ajouter un depute
    public function ajouterDepute(){
        if(Auth::user()->id_role == 1){

            $typeDeputes = Typedepute::get();
            $locals = Local::get();
            return view('viewsAdmin.depute.ajouterDepute',compact('typeDeputes','locals'));
        }
        return view('errors.404');
    }

    //ajouter un type au deputes

    public function postTypeToDepute(Request $request){
        if(Auth::user()->id_role == 1){

            //dd($request->all());
            DB::table('union_depute_type')->insert(
                ['id_typeDepute' => $request->id_typeDepute, 'id_depute' => $request->id_depute,
                    'date_debut' => $request->date_debut, 'date_fin' => $request->date_fin
                    ]
            );
            return redirect(route('listDepute'));
        }
        return view('errors.404');
    }

    public function deleteUnion(Request $request){
        if(Auth::user()->id_role == 1){

            try{
            UnionDeputeType::where('id_union_depute_type',$request->id_union_depute_type)->delete();
            return redirect(route('listDepute'));
            }catch (\Exception $e){
                return redirect(route('listDepute').'/exception=exceptionLocal');
            }
        }
        return view('errors.404');
    }
    public function editDeputeImg(Request $request){
        if(Auth::user()->id_role == 1){
            if ($request->hasFile('image')){

                $photo = $request->file('image')->getClientOriginalName();
                $destination = base_path() . '/public/admin/img/deputes';
                $request->file('image')->move($destination, $photo);
                $photo = "admin/img/deputes/".$photo;
                $request->request->add(['photo' => $photo]);

                Depute::where('id_depute', $request->id_depute)->update([
                    "photo" => $photo,
                    'updated_at' =>$request->updated_at
                ]);

                //dd($request->all());
            }

            return redirect(route('listDepute'));
        }
        return view('errors.404');
    }
}
