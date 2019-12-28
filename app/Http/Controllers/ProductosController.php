<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Subcategoria;
use App\Categoria;
use App\Comentario;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $subcategorias = Subcategoria::all();
        $categorias = Categoria::all();
        $productos = DB::table('productos')->where('user_id',$user_id)->orderBy('created_at','desc')->paginate(5);
        $data = ['productos' => $productos, 'subcategorias' => $subcategorias, 'categorias' => $categorias];
        return view('pages.productos')->with('data', $data);
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
        $filenameWithExt = $request->file('imagen')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('imagen')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $path = $request->file('imagen')->storeAs('public/img_productos', $fileNameToStore);

        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->user_id = Auth::id();
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $request->input('categoria');
        $producto->subcategoria_id = $request->input('subcategoria');
        $producto->precio = $request->input('precio');
        $producto->cantidad = $request->input('cantidad');
        $producto->imagen = $fileNameToStore;
        $producto->save();

        return redirect('/productos')->with('success', 'Producto creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        $coment = Comentario::where('producto_id',$id)->get();
        $comentarios = Comentario::where('producto_id',$id)->paginate(3);
        $user = User::all();

        //Calcular valoracion
        $total = 0;
        if (count($coment)>0) {
            foreach ($coment as $com) {
                $val = $com->valoracion;
                $total += $val;
            }
            $valoracion = $total/count($coment);
        }
        else {
            $valoracion = 0;
        }

        $data = ['producto' => $producto, 'comentarios' => $comentarios, 'user' => $user, 'valoracion' => $valoracion];
        return view('pages.producto')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $producto = Producto::find($id);
        if($request->hasFile('imagen')) {
            $filenameWithExt = $request->file('imagen')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('imagen')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('imagen')->storeAs('public/img_productos', $fileNameToStore);
            //Delete Image
            Storage::delete('public/img_productos/'.$producto->imagen);
            $producto->imagen = $fileNameToStore;
        }

        $producto->nombre = $request->input('nombre');
        $producto->user_id = Auth::id();
        $producto->descripcion = $request->input('descripcion');
        $producto->categoria_id = $request->input('categoria');
        $producto->subcategoria_id = $request->input('subcategoria');
        $producto->precio = $request->input('precio');
        $producto->cantidad = $request->input('cantidad');
        $producto->save();

        if(!is_null($request->input('admin'))) {
            return redirect('/administrar')->with('success', 'Producto editado');
        }
        return redirect('/productos')->with('success', 'Producto editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        if(auth()->user()->id !== $producto->user_id) {
            return redirect('/productos')->with('error','Unauthorized page');
        }
        Storage::delete('public/img_productos/'.$producto->imagen);
        $producto->delete();

        return redirect('/productos')->with('success', 'Producto eliminado');
    }
}
