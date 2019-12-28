<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Compra;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null(session('carrito'))) {
            session(['carrito' => array()]);
        }
        $carrito = session('carrito');
        $total = 0;
        foreach ($carrito as $compra){
            $total += $compra['producto']->precio*$compra['cantidad'];
        }
        array_push($carrito, $total);
        return view('pages.carrito')->with('carrito', $carrito);
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
        $id = $request->input('id');

        //Se valida el login
        if(is_null(auth()->user())) {
            return redirect("/productos/$id")->with('error','Debes estar logeado para poder agregar al carrito');
        }

        //Se obtienen los datos
        $producto = Producto::find($id);
        $cantidad = $request->input('cantidad');
        $compra = ['producto' => $producto, 'cantidad' => $cantidad];

        //Se valida el stock
        $stock = $producto->cantidad;
        if($stock<$cantidad) {
            return redirect("/productos/$id")->with('error','No hay stock suficiente para la cantidad solicitada.');
        }

        //Se crea la cookie si no existe y actualiza
        if(is_null(session('carrito'))) {
            session(['carrito' => array()]);
        }
        $carrito = session('carrito');
        array_push($carrito, $compra);
        session(['carrito' => $carrito]);

        return redirect("/productos/$id")->with('success', 'Producto añadido a carrito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compras = session('carrito');
        foreach ($compras as $index => $compra_) {
            if($compra_['producto']->id == $id) {
                unset($compras[$index]);
            }
        }
        session(['carrito' => array_values($compras)]);
        return redirect("/carrito");
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
        $compras = session('carrito');

        //Valida stock
        foreach ($compras as $compra_) {
            $cantidad = $compra_['cantidad'];
            $producto = $compra_['producto'];
            $producto_id = $producto->id;
            $producto = Producto::find($producto_id);
            $stock = $producto->cantidad;
            if($stock < $cantidad) {
                return redirect("/carrito")->with('error',"No hay stock suficiente para la cantidad solicitada del producto: $producto->nombre");
            }
        }

        //Ejecuta
        foreach ($compras as $compra_) {

            //Se crea la compra e inserta en BD
            $compra = new Compra;
            $compra->cantidad = $compra_['cantidad'];
            $compra->producto_id = $compra_['producto']->id;
            $compra->comprador_id = auth()->user()->id;
            $compra->vendedor_id = $compra_['producto']->user_id;
            $compra->fecha = date('d/m/Y H:i:s');
            $compra->save();

            //Se resta la cantidad comprada al stock
            $cantidad = $compra_['cantidad'];
            $producto_id = $compra_['producto']->id;
            DB::update("UPDATE productos SET cantidad = (cantidad-$cantidad) WHERE id = $producto_id");
        }

        $request->session()->forget('carrito');
        return redirect("/dashboard")->with('success', 'Compra realizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$request->session()->forget('carrito');
        session(['carrito' => null]);
        return redirect("/carrito");
    }
}
