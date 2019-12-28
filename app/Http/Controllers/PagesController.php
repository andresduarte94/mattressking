<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Producto;
use App\Categoria;
use App\Subcategoria;
use App\Comentario;
use App\Compra;
use App\User;

class PagesController extends Controller
{
    public function index() {
        $productos = Producto::paginate(9);
        $categorias = Categoria::all();
        $data = ['productos' => $productos, 'categorias' => $categorias];
        return view('pages.index')->with('data',$data);
    }

    public function busqueda(Request $request) {
        $busqueda = $request->input('search');
        $productos = Producto::where('nombre', 'LIKE' , "%$busqueda%")->paginate(9);
        $categorias = Categoria::all();
        $data = ['productos' => $productos, 'categorias' => $categorias];
        return view('pages.busqueda')->with('data',$data);
    }

    public function comentario (Request $request) {
        $producto_id = $request->input( 'producto');
        if(is_null(auth()->user())) {
            return redirect("/productos/$producto_id")->with('error','Debes estar logeado para poder comentar.');
        }

        $compras = Compra::where('producto_id',$producto_id)->get();
        foreach ($compras as $compra) {
            $user_id = $compra->comprador_id;
            if (auth()->user()->id == $user_id) {
                $comentario = new Comentario;
                $comentario->comentario = $request->input('comentario');
                $comentario->producto_id = $producto_id;
                $comentario->user_id = auth()->user()->id;
                $comentario->valoracion = $request->input( 'valoracion');
                $comentario->save();
                return redirect("/productos/$producto_id")->with('success','Comentario agregado');
            }
        }

        return redirect("/productos/$producto_id")->with('error', 'Debes haber comprado este producto para poder comentar.');

    }

    public function ventas () {
        $id = auth()->id();
        $ventas = Compra::where('vendedor_id',$id)->paginate(9);
        $total = DB::select('SELECT SUM(p.precio*c.cantidad) as total FROM compras c JOIN productos p ON c.producto_id = p.id WHERE vendedor_id = :id',['id' => $id]);
        $total = $total[0]->total;
        $users = User::all();
        $productos = Producto::all();
        $data = ['ventas' => $ventas, 'users' => $users, 'productos' => $productos, 'total' => $total ];
        return view('pages.ventas')->with('data', $data);
    }

    //Admin y busquedas
    public function admin() {
        $users = User::paginate(10);
        $productos = Producto::paginate(10);
        $categorias = Categoria::paginate(10);
        $subcategorias = Subcategoria::paginate(10);
        $active = 0;
        $data = ['users' => $users, 'productos' => $productos, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'active' => $active];
        return view('pages.admin')->with('data', $data);
    }

    public function busquedaProd(Request $request) {
        $busqueda = $request->input('search');
        $users = User::paginate(10);
        $productos = Producto::where('nombre', 'LIKE' , "%$busqueda%")->paginate(10);
        $categorias = Categoria::paginate(10);
        $subcategorias = Subcategoria::paginate(10);
        $active = 0;
        $data = ['users' => $users, 'productos' => $productos, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'active' => $active];
        return view('pages.admin')->with('data', $data);
    }

    public function busquedaUser(Request $request) {
        if(!is_null($request)) {
            $busqueda = $request->input('search');
        }
        else {
            $busqueda = "";
        }
        $users = User::where('name', 'LIKE' , "%$busqueda%")->paginate(10);
        $productos = Producto::paginate(10);
        $categorias = Categoria::paginate(10);
        $subcategorias = Subcategoria::paginate(10);
        $active = 1;
        $data = ['users' => $users, 'productos' => $productos, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'active' => $active];
        return view('pages.admin')->with('data', $data);
    }

    public function busquedaCat(Request $request) {
        if(!is_null($request)) {
            $busqueda = $request->input('search');
        }
        else {
            $busqueda = "";
        }

        $users = User::paginate(10);
        $productos = Producto::paginate(10);
        $categorias = Categoria::where('categoria', 'LIKE' , "%$busqueda%")->paginate(10);
        $subcategorias = Subcategoria::paginate(10);
        $active = 2;
        $data = ['users' => $users, 'productos' => $productos, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'active' => $active];
        return view('pages.admin')->with('data', $data);
    }

    public function busquedaSub(Request $request) {
        if(!is_null($request)) {
            $busqueda = $request->input('search');
        }
        else {
            $busqueda = "";
        }
        $users = User::paginate(10);
        $productos = Producto::paginate(10);
        $categorias = Categoria::paginate(10);
        $subcategorias = Subcategoria::where('subcategoria', 'LIKE' , "%$busqueda%")->paginate(10);
        $active = 3;
        $data = ['users' => $users, 'productos' => $productos, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'active' => $active];
        return view('pages.admin')->with('data', $data);
    }



    //Acciones users
    public function edit(Request $request) {
        $id = $request->input('user');
        $user = User::find($id);
        $user->name = $request->input('nombre');
        $user->email = $request->input('email');
        $user->tipo = $request->input('tipo');
        $user->password = Hash::make($request->input('pass'));
        $user->save();
        return redirect('/administrar/busquedaUser')->with('success', 'Usuario editado');
    }

    public function nuevo(Request $request) {

        $user = new User();
        $user->name = $request->input('nombre');
        $user->email = $request->input('email');
        $user->tipo = $request->input('tipo');
        $user->password = Hash::make($request->input('pass'));
        $user->save();
        return redirect('/administrar/busquedaUser')->with('success', 'Usuario creado');
    }

    public function destroy (Request $request) {
        $id = $request->input('user');
        $user = User::find($id);
        $user->delete();
        return redirect('/administrar/busquedaUser')->with('success', 'Usuario eliminado');
    }

}
