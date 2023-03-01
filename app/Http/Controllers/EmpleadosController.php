<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;


class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleados::where('activo', '1')->get();
        //
        return[
            "ok" => true,
            "data" => $empleados,
           ];
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
        //
        $nss = $request->get('nss');
        $empleado  = Empleados::where('nss', $nss)->get()->first();
        if ($empleado) {
            return response("error to save", 500);
        }

        $empleado = new Empleados();
        $empleado->nombres = $request->get('nombres');
        $empleado->apellidos= $request->get('apellidos');
        $empleado->telefono = $request->get('telefono');
        $empleado->ciudad = $request->get('ciudad');
        $empleado->direccion = $request->get('direccion');
        $empleado->nss = $request->get('nss');
        $empleado->activo = $request->get('activo');
        $empleado->save();
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
        $empleado  = Empleados::where('id_empleado', $id)->get()->first();
        if (empty($empleado)) {
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
                "data" => $empleado,
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
        //
        $empleado = Empleados::where('id_empleado', $id)->get();
        return $empleado;
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
        //
        $empleado = Empleados::where('id_empleado', $id)->update(
            [
                "nombres" => $request->get('nombres'),
                "apellidos" => $request->get('apellidos'),
                "telefono" => $request->get('telefono'),
                "ciudad" => $request->get('ciudad'),
                "direccion" => $request->get('direccion'),
                "nss" => $request->get('nss'),
            ]
        );
        if (!$empleado) {
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
                "data" => Empleados::where('id_empleado', $id)->get()->first(),
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
        //
        $empleado = Empleados::where('id_empleado', $id)->update(['activo' => "0"]);
        if (!$empleado) {
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
                "data" => Empleados::where('id_empleado', $id)->get()->first(),
                "error" => null
            ];
            return response($success_message, 200);
        }
    }

}
