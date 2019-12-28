<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Categoria;
use App\Subcategoria;
use App\Producto;
use DB;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();

        $categoria->categoria  = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        $categoria->save();

        return redirect('/administrar/busquedaCat')->with('success', 'Categoria creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productos = Producto::where('categoria_id', $id)->paginate(9);
        $subcategorias = Subcategoria::where('categoria_id', $id)->get();
        $data = ['productos' => $productos, 'subcategorias' => $subcategorias];
        return view('pages.categorias')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        $categoria->categoria  = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        $categoria->save();

        return redirect('/administrar/busquedaCat')->with('success', 'Categoria editada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->tipo !== 2) {
            return redirect('/home')->with('error','Unauthorized page');
        }
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect('/administrar/busquedaCat')->with('success', 'Categoria eliminada');
    }
}
