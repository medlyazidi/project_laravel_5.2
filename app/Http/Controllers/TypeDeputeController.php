<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\TypeDepute;
use Illuminate\Support\Facades\Auth;

class TypeDeputeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function listTypeDepute(){
        if(Auth::user()->id_role == 1){

            $typeDeputes= TypeDepute::paginate(10);
            return view('viewsAdmin.typeDepute.listeTypeDepute',compact('typeDeputes'));

        }
        return view('errors.404');
    }

    public function postTypeDepute(Request $request){
        if(Auth::user()->id_role == 1){

            TypeDepute::create($request->all());
            return redirect(route('listTypeDepute'));

        }
        return view('errors.404');
    }
    public function editTypeDepute(Request $request){
        if(Auth::user()->id_role == 1){

            TypeDepute::where('id_typeDepute',$request->id_typeDepute)->update([
                'libelle_typeDepute' => $request->libelle_typeDepute,
                'somme_type' => $request->somme_type,
                'updated_at' =>$request->updated_at
            ]);
            return redirect(route('listTypeDepute'));

        }
        return view('errors.404');
    }
    public function destroy(Request $request){

        if(Auth::user()->id_role == 1){

                try{
                    TypeDepute::where('id_typeDepute',$request->id_typeDepute)->delete();
                    return redirect(route('listTypeDepute'));
                }catch (\Exception $e){
                    return redirect(route('listTypeDepute').'/exception=exceptionLocal');
                }

        }
        return view('errors.404');
    }
    public function gestionException($exception){
        if(Auth::user()->id_role == 1){

            $typeDeputes= TypeDepute::paginate(10);
            return view('viewsAdmin.typeDepute.listeTypeDepute',compact('typeDeputes','exception'));

        }
        return view('errors.404');
    }
}
