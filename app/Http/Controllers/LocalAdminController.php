<?php

namespace App\Http\Controllers;

use App\Depute;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Local;
use Illuminate\Support\Facades\Auth;


class LocalAdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function listLocal(Request $request){
        if(Auth::user()->id_role == 1){
            $locals = Local::get();
            return view('viewsAdmin.local.listeLocal',compact('locals'));
        }
        return view('errors.404');
    }
    public function gestionException($exception){
        if(Auth::user()->id_role == 1){

            $locals = Local::get();
            return view('viewsAdmin.local.listeLocal',compact('locals','exception'));

        }
        return view('errors.404');
    }

    public function postLocal(Request $request){
        if(Auth::user()->id_role == 1){

            Local::create($request->all());
            return redirect(route('listLocal'));
        }
        return view('errors.404');
    }
    public function editLocal(Request $request){
        if(Auth::user()->id_role == 1){

            Local::where('id_local',$request->id_local)->update([
                'libelle_local' => $request->libelle_local,
                'updated_at' =>$request->updated_at
            ]);
            return redirect(route('listLocal'));
        }
        return view('errors.404');
    }
    public function destroy(Request $request){

        if(Auth::user()->id_role == 1){
            try{
                //Depute::where('id_local',$request->id_local)->delete();
                Local::where('id_local',$request->id_local)->delete();
                return redirect(route('listLocal'));

            }catch (\Exception $e){
                return redirect(route('listLocal').'/exception=exceptionLocal');
            }
        }
        return view('errors.404');


    }
}
