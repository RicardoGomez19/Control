@extends('layouts.masterProveedor')
@section('titulo','Proveedores')
@section('contenido')

<!-- inicia vue -->
<div id="proveedor">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-gray">
                <div class="card-header">
                    <h4 class="text-center">PROVEEDORES
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
                        <input type="text" placeholder="Escriba el nombre del propietario" class="form-control text-center" v-model="buscar">
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
                            <th>CORREO</th>
                            <th hidden="">STATUS</th>
                            <th>ACCIONES</th>

                        </thead>

                        <tbody>
                            <tr v-for="(proveedor, i) in paginar" :key="i">
                                <td>@{{i + 1}}</td>
                                <td>@{{proveedor.nombre}}</td>
                                <td>@{{proveedor.apellidos}}</td>
                                <td>@{{proveedor.localidad}}</td>
                                <td>@{{proveedor.direccion}}</td>
                                <td>@{{proveedor.telefono}}</td>
                                <td>@{{proveedor.correo}}</td>
                                <td hidden="">@{{ proveedor ? "Activo" : "Inactivo" }}</td>


                                <td>
                                    <button id="edit" class="btn btn-sm" @click="editandoProveedor(proveedor.id_proveedor)">
                                        <i class="fas fa-pen">edit</i>
                                    </button>

                                    <button id="delete" class="btn btn-sm" @click="eliminarProveedor(proveedor.id_proveedor)">
                                        <i class="fas fa-trash">delete</i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--fin de tabla-->
                </div>
                <!--inicio paginacion-->
                <div class="w-33">
                    <div class="center">
                        <button type="button" id="btn" class="btn" @click="anteriorPagina">
                            << </button>
                                <button type="button" id="btn" class="btn" v-for="num in numeroDePaginas" :key="num" @click="seccionarPagina(num)">@{{num}}</button>
                                <button type="button" id="btn" class="btn" @click="siguientePagina"> >> </button>
                    </div>
                </div>
                <!--final paginacion-->

            </div>
            <!--fin de col-md-12-->
        </div>

        <!--inicio ventana Modal -->
        <div class="modal fade" id="modalProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" class="form-control" placeholder="Nombre del proveedor" v-model="nombre" required>
                        <h6>Apellidos:</h6>
                        <input type="text" class="form-control" placeholder="Apellidos del proveedor" v-model="apellidos" required>
                        <h6>Localidad:</h6>
                        <input type="text" class="form-control" placeholder="Escriba la localidad" v-model="localidad">
                        <h6>Direccion:</h6>
                        <input type="text" class="form-control" placeholder="Escriba la dirección" v-model="direccion">
                        <h6>Telefono:</h6>
                        <input type="number" class="form-control" placeholder=" Escriba el télefono" v-model="telefono">
                        <h6>Correo:</h6>
                        <input type="text" class="form-control" placeholder=" Escriba el correo" v-model="correo">

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