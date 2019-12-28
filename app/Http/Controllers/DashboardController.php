<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Producto;
use App\Compra;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(is_null(auth()->user())) {
            return view(pages.index);
        }

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $compras_ = DB::table('compras')->where('comprador_id',$user_id)->get();
        $compras = DB::table('compras')->where('comprador_id',$user_id)->orderBy('created_at','desc')->paginate(5);
        $productos = Producto::all();
        $data = ['user' => $user, 'compras' => $compras, 'productos' => $productos];

        return view('dashboard')->with('data', $data);
    }
}
