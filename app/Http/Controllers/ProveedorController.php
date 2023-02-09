<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return [
            "ok" => true,
            "data" => Proveedor::where('activo', '1')->orderBy('created_at', 'desc')->get()
        ];


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $correo = $request->get('correo');
        $proveedor  = Proveedor::where('correo', $correo)->get()->first();
        if ($proveedor) {
            return response("error to save", 500);
        }

        $proveedor = new Proveedor();
        $proveedor->nombre = $request->get('nombre');
        $proveedor->apellidos= $request->get('apellidos');
        $proveedor->localidad = $request->get('localidad');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->correo = $request->get('correo');
        $proveedor->activo = $request->get('activo');
        $proveedor->save();
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
        $proveedor  = Proveedor::where('id_proveedor', $id)->get()->first();
        if (empty($proveedor)) {
            $error_message = [
                "ok" => false,
                "data" => null,
                "error" => [
                    "message:" => "Resource not found with id $id"
                ]
            ];
            return response($error_message, 404);
        } else {
            $success_message = [
                "ok" => true,
                "data" => $proveedor,
                "error" => null
            ];
            return response($success_message, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor  = Proveedor::where('id_proveedor', $id)->get();
        return $proveedor;
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
        $proveedor = Proveedor::where('id_proveedor', $id)->update(
            [
                "nombre" => $request->get('nombre'),
                "apellidos" => $request->get('apellidos'),
                "localidad" => $request->get('localidad'),
                "direccion" => $request->get('direccion'),
                "telefono" => $request->get('telefono'),
                "correo" => $request->get('correo'),
               
            ]
        );
        if (!$proveedor) {
            $error_message = [
                "ok" => false,
                "data" => null,
                "error" => [
                    "message:" => "Resource not found with id $id"
                ]
            ];
            return response($error_message, 404);
        } else {
            $success_message = [
                "ok" => true,
                "data" => Proveedor::where('id_proveedor', $id)->get()->first(),
                "error" => null
            ];
            return response($success_message, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::where('id_proveedor', $id)->update(['activo' => "0"]);
        if (!$proveedor) {
            $error_message = [
                "ok" => false,
                "data" => null,
                "error" => [
                    "message:" => "Resource not found with id $id"
                ]
            ];
            return response($error_message, 404);
        } else {
            $success_message = [
                "ok" => true,
                "data" => Proveedor::where('id_proveedor', $id)->get()->first(),
                "error" => null
            ];
            return response($success_message, 200);
        }
    }
}
