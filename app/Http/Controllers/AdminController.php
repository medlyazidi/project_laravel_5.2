<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use Illuminate\Support\Facades\DB;

use App\User;

use App\Trace;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon;


class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getView(){
        return redirect(route('menu_img'));
    }
    public function post_delete_folder(Request $request){
        File::delete($request->path);
        return redirect(route('listeModif'));
    }
    public function add_piece_joint(Request $request){
        $images = $request->img;
        if ($request->hasFile('img')){
            foreach ($images as $key => $image){
                $name = $request->img[$key]->getClientOriginalName();
                $name = str_replace(" ","_",$name);
                $destination = public_path().$request->lien;
                $image->move($destination, $name);
            }
        }



        return redirect(route('listeModif'));
    }
    public function MenuImg(){
        return view('viewsAdmin.accueil');
    }

    public function test(){


        $from = \Carbon\Carbon::createFromFormat('Y-m-d', '2017-01-01');
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', '2017-02-02');


        $test_var = AdminController::date_diff($to,$from);
        //dd($test_var);
        $nbr_rst = $to->diff($from);
        //dd($nbr_rst);

        $roles = Role::get();
        $users = DB::table('users')
            ->join('roles', 'users.id_role', '=', 'roles.id_role')
            ->select('users.*', 'roles.nom_role')
            ->where('users.id','!=',Auth::user()->id)
            ->get();
        return view('viewsAdmin.view',compact('roles','users'));
    }

   public function date_diff($to, $from){

        $from1 = $from->copy();
		$to1=$to->copy();
		
        $nbr_rst = $to->endOfMonth()->diffInMonths($from->startOfMonth())+1;

		
		
        if($from1->day >= 15) $nbr_rst = $nbr_rst - 0.5;
        if($to1->day <= 15) $nbr_rst = $nbr_rst - 0.5;
        return $nbr_rst;
    }
}
