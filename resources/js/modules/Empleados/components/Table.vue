<template>
  <div class="col-lg-12">
    <div class="card">
      <div v-if="table">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Clientes frecuentes</h6>
        </div>
        <div class="table-responsive">
          
          <div class="form-group row" id="navegador">
              <div class="col-md-6">
                  <div class="input-group">
                      <select class="form-control col-md-3" v-model="criterio">
                        <option value="nombres">Nombre</option>
                        <option value="apellidos">Apellido</option>
                      </select>
                      <input type="text" class="form-control" placeholder="Texto a buscar" v-model="buscar" 
                     >
                      <button type="button" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                      <button class="btn btn-info" >Nuevo</button>
                  </div>
              </div>
          </div>

          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Telefono</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="empleado in empleados" :key="empleado.id_empleado">
                <td><a href="#">{{empleado.id_empleado}}</a></td>
                <td>{{empleado.nombres}}</td>
                <td>{{empleado.apellidos}}</td>
                <td><span class="badge badge-success">{{empleado.telefono}}</span></td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary">Detales</button>
                    <button type="button"class="btn btn-sm btn-warning">Editar</button>
                </td>
              </tr> 
            </tbody>
          </table>
          <nav id="navegador">
              <!-- aplicar paginacion -->
              <ul class="pagination">
                  <li class="page-item" v-if="pagination.current_page > 1">
                      <a class="page-link" href="#" >Ant</a>
                  </li>

                  <li class="page-item " v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                      <a class="page-link" href="#"></a>
                  </li>
                
                  <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                      <a class="page-link" >Sig</a>
                  </li>
              </ul>
          </nav>
        </div>
    </div>
    
    <div  v-if="form==1">
     
        <div class="card mb-3">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary" >Nuevo cliente</h6>
            <h6 class="m-0 font-weight-bold text-primary">Editar cliente</h6>
          </div>
            <center><p style="color:red" v-show="error" v-for="error in arrayError" :key="error"></p></center>
          <div class="card-body">
          
              <div class="form-row">
                <div class="col">
                  <label for="exampleInputPassword1">Nombres</label>
                  <input type="text" class="form-control" placeholder="Nombres" v-model="nombres">
                  
                </div>
                <div class="col">
                  <label for="exampleInputPassword1">Apellidos</label>
                  <input type="text" class="form-control" placeholder="Apellidos" v-model="">
                  
                </div>
              </div>

              <div class="form-row">
                <div class="col">
                  <label for="exampleInputPassword1">Telefono</label>
                  <input type="text" class="form-control" maxlength="10" placeholder="- - - - - - - - - -" v-model="">
                 
                </div>
                <div class="col">
                  <label for="exampleInputPassword1">Email</label>
                  <input type="email" class="form-control" placeholder="@correo.com" v-model="">
                </div>
              </div>

              <div class="form-row">
                <div class="col">
                  <label for="exampleInputPassword1">Nacionalidad</label>
                  <input type="text" class="form-control" placeholder="Nacionalidad" v-model="">
                </div>
                <div class="col">
                  <label for="exampleInputPassword1">Pais</label>
                  <input type="email" class="form-control" placeholder="Pais" v-model="">
                </div>
              </div>

              <div class="form-row">
                <div class="col">
                  <label for="exampleInputPassword1">Ciudad</label>
                  <input type="text" class="form-control" placeholder="Ciudad" v-model="">
                </div>
                
              </div>

              <hr>
              <button class="btn btn-danger" >Cancelar</button>

              <button class="btn btn-primary" >Registrar</button>
              <button class="btn btn-primary"  >Actualizar</button>

          </div>
        </div>
    </div>
    </div> 

    <!-- Modal detalles-->
    <div class="modal fade" id="detalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalles del cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <div class="col-12">
                <table class="table table-striped">
                    <tbody>
                      <tr>
                        <th>Nombre: {{nombres}}</th> 
                      </tr>
                      <tr>
                        <th>Apellidos: {{apellidos}}</th>
                      </tr>
                      <tr>
                        <th>Telefono: {{telefono}}</th>
                      </tr>
                      <tr>
                        <th>Email: {{ciudad}}</th>
                      </tr>
                      <tr>
                        <th>Nacionalidad: {{nss}}</th>
                      </tr>
                      <tr>
                        <th>Pais: {{activo}}</th>
                      </tr>
                      <tr>
                        <th>Ciudad: {{n_empleado}}</th>
                      </tr>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" >Salir</button>
            <button type="button" class="btn btn-primary" >Editar</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import Table from '../../../api/apiEmpleado';
import axios from 'axios';

export default {
  name: 'App',
  components: {
    Table,
  },
  data() {
    return {
          empleados:[],
          n_empleado:'',
          id_empleado:'',
          nombres:'',
          apellidos:'',
          telefono:'',
          direccion:'',
          ciudad:'',
          activo:'',
          nss:'',
    };
  },
  methods:{
        getempleados(){

           

            axios.get(Table).then(function (response) {
              // handle success
              var respuesta = response.data;

              
              console.log(response.data.data);
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
        },
  }
};
</script>
