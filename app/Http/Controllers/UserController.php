<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Trace;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function listUser(){
        if(Auth::user()->id_role == 1){
            $roles = Role::get();
            $users = DB::table('users')
                ->join('roles', 'users.id_role', '=', 'roles.id_role')
                ->select('users.*', 'roles.nom_role')
                ->where('users.id','!=',Auth::user()->id)
                ->get();
            return view('viewsAdmin.user.listeUser',compact('roles','users'));
        }
        return view('errors.404');
    }
    public function addUser(Request $request){

        if(Auth::user()->id_role == 1){

            $hash_pass = bcrypt($request->password);
            $request->request->add(['password' => $hash_pass]);

            if ($request->hasFile('image')) {

                $photo = $request->file('image')->getClientOriginalName();
                $destination = base_path() . '/public/admin/img/users';

                $request->file('image')->move($destination, $photo);
                $photo = "admin/img/users/".$photo;
                $request->request->add(['photo' => $photo]);
            }

            User::create($request->all());
            return redirect(route('listeUser'));
        }
        return view('errors.404');
    }
    public function editUser(Request $request){

        if(Auth::user()->id_role == 1){
            User::where('id',$request->id)->update([
                "nom" => $request->nom,
                "prenom" => $request->prenom,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "date_naissance" => $request->date_naissance,
                'updated_at' =>$request->updated_at
            ]);

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'deputes']);
            $request->request->add(['operation' => 'modifier']);
            $request->request->add(['info' => 'modification|deputes']);
            Trace::create($request->all());

            return redirect(route('listeUser'));
        }
        return view('errors.404');
    }

    public function editUserMe(Request $request){

            User::where('id',$request->id)->update([
                "nom" => $request->nom,
                "prenom" => $request->prenom,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "date_naissance" => $request->date_naissance,
                'updated_at' =>$request->updated_at
            ]);

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'deputes']);
            $request->request->add(['operation' => 'modifier']);
            $request->request->add(['info' => 'modification|deputes']);
            Trace::create($request->all());

            return redirect(route('menu_img'));

    }

    public function editUserImage(Request $request){

            if ($request->hasFile('image')){

                $photo = $request->file('image')->getClientOriginalName();
                $destination = base_path() . '/public/admin/img/users';
                $request->file('image')->move($destination, $photo);
                $photo = "admin/img/users/".$photo;
                $request->request->add(['photo' => $photo]);

                User::where('id',$request->id)->update([
                    "photo" => $photo,
                    'updated_at' =>$request->updated_at
                ]);
            }

            return redirect(route('menu_img'));

    }

    public function destroy(Request $request){
        if(Auth::user()->id_role == 1){

            try{
                //suppression depute
                User::where('id',$request->id)->delete();
            }catch (\Exception $e){
                return redirect(route('listeUser').'/exception=exceptionLocal');
            }

            //tracabilité
            $request->request->add(['id_user' => Auth::user()->id]);
            $request->request->add(['table' => 'users']);
            $request->request->add(['operation' => 'supprimer']);
            //$request->request->add(['info' => 'supprimer|users|'+$request->id]);
            Trace::create($request->all());

            return redirect(route('listeUser'));

        }
        return view('errors.404');
    }
    public function gestionException($exception){
        if(Auth::user()->id_role == 1){

            $roles = Role::get();
            $users = DB::table('users')
                ->join('roles', 'users.id_role', '=', 'roles.id_role')
                ->select('users.*', 'roles.nom_role')
                ->where('users.id','!=',Auth::user()->id)
                ->get();
            return view('viewsAdmin.user.listeUser',compact('roles','users','exception'));
        }
        return view('errors.404');
    }
}
