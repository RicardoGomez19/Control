@extends('layouts.masterEmple')
@section('titulo','Empleados')
@section('contenido')

<!-- inicia vue -->
<div id="empleado">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-gray">
                <div class="card-header">
                    <h4 class="text-center">EMPLEADOS
                        <span class="float-right" @click="mostrarModal()">
                            <div class="btn btn-block" id="add">
                                <i class="fa fa-plus-circle fa-lg" aria-hidden="true">Add</i>
                            </div>
                        </span>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-gray">
                <div class="card-header">

                    <div class="col-md-4">
                        <input type="text" placeholder="Escriba el nombre del empleado" class="form-control text-center" v-model="buscar">
                    </div>
                </div>

                <div class="card-body" id="table">

                    <!-- inicio de la tabla-->
                    <table id="columna" class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>NOMBRES</th>
                            <th>APELLIDOS</th>
                            <th>CIUDAD</th>
                            <th>DIRECCION</th>
                            <th>TELEFONO</th>
                            <th>NSS</th>
                            <th hidden="">STATUS</th>
                            <th>ACCIONES</th>

                        </thead>

                        <tbody>
                            <tr v-for="empleado in empleados">
                                <td>@{{empleado.n_empleado}}</td>
                                <td>@{{empleado.nombres}}</td>
                                <td>@{{empleado.apellidos}}</td>
                                <td>@{{empleado.ciudad}}</td>
                                <td>@{{empleado.direccion}}</td>
                                <td>@{{empleado.telefono}}</td>
                                <td>@{{empleado.nss}}</td>

                                <td hidden="">@{{ empleado ? "Activo" : "Inactivo" }}</td>


                                <td>
                                    <button id="edit" class="btn btn-sm" @click="editandoProveedor(empleado.id_empleado)">
                                        <i class="fas fa-pen">edit</i>
                                    </button>

                                    <button id="delete" class="btn btn-sm" @click="eliminarProveedor(empleado.id_empleado)">
                                        <i class="fas fa-trash">delete</i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--fin de tabla-->
                </div>
                

            </div>
            <!--fin de col-md-12-->
        </div>

        <!--inicio ventana Modal -->
        <div class="modal fade" id="modalEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="colorModal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">AGREGANDO PROVEEDOR</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">EDITANDO PROVEEDOR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Nombre:</h6>
                        <input type="text" class="form-control" placeholder="Nombre del proveedor" v-model="nombres" required>
                        <h6>Apellidos:</h6>
                        <input type="text" class="form-control" placeholder="Apellidos del proveedor" v-model="apellidos" required>
                        <h6>Ciudad:</h6>
                        <input type="text" class="form-control" placeholder="Escriba la localidad" v-model="ciudad">
                        <h6>Direccion:</h6>
                        <input type="text" class="form-control" placeholder="Escriba la dirección" v-model="direccion">
                        <h6>Telefono:</h6>
                        <input type="number" class="form-control" placeholder=" Escriba el télefono" v-model="telefono">
                        <h6>Nss:</h6>
                        <input type="text" class="form-control" placeholder=" Escriba el correo" v-model="nss">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-info" @click="guardarProveedor" v-if="agregando==true">Guardar</button>
                        <button type="button" class="btn btn-info" @click="actualizarProveedor" v-if="agregando==false">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--final de modal-->

    </div>
</div>
<!-- termina vue-->
@endsection

@push('scripts')
<script type="text/javascript" src="js/vue-resource.js"></script>
<script type="text/javascript" src="js/apis/apiProveedor.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">
<link type="text/css" rel="stylesheet" href="css/estilo.css">