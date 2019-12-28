<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Subcategoria;
use DB;

class SubcategoriasController extends Controller
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
        $subcategoria = new Subcategoria();

        $subcategoria->subcategoria  = $request->input('nombre');
        $subcategoria->descripcion = $request->input('descripcion');
        $subcategoria->categoria_id = $request->input('categoria');
        $subcategoria->save();

        return redirect('/administrar/busquedaSub')->with('success', 'Subcategoria creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productos = Producto::where('subcategoria_id', $id)->paginate(9);
        $categoria = DB::select("SELECT categoria_id FROM subcategorias WHERE id = $id");
        $categoria = $categoria[0];
        $data = ['productos' => $productos, 'categoria' => $categoria];
        return view('pages.subcategorias')->with('data',$data);
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
        $subcategoria = Subcategoria::find($id);

        $subcategoria->subcategoria  = $request->input('nombre');
        $subcategoria->descripcion = $request->input('descripcion');
        $subcategoria->categoria_id = $request->input('categoria');
        $subcategoria->save();

        return redirect('/administrar/busquedaSub')->with('success', 'Subcategoria editada');
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
        $subcategoria = Subcategoria::find($id);
        $subcategoria->delete();

        return redirect('/administrar/busquedaSub')->with('success', 'Subcategoria eliminada');
    }
}
