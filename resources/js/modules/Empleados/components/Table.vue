<template>
  <div class="form-group row" id="navegador">
                <div class="col-md-6">
                    <div class="input-group">
                        <select class="form-control col-md-3" v-model="criterio">
                          <option value="nombres">Nombre</option>
                          <option value="apellidos">Apellido</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Texto a buscar" v-model="buscar" 
                       >
                        <button type="button"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        <button class="btn btn-info">Nuevo</button>
                    </div>
                </div>
            </div>
  <table>
    <thead class="thead-dark">
      <tr class="table-active">
        <th scope="col">#</th>
        <th scope="col">Nombres</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Ciudad</th>
        <th scope="col">Telefono</th>
        <th scope="col">Dirección</th>
        <th scope="col">NSS</th>
        <th scope="col">Activo</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="empleado in empleados" :key="empleado" class="table">
        <td scope="row">{{ empleado.n_empleado }}</td>
        <td>{{ empleado.nombres }}</td>
        <td>{{ empleado.apellidos }}</td>
        <td>{{ empleado.ciudad }}</td>
        <td>{{ empleado.telefono }}</td>
        <td>{{ empleado.direccion }}</td>
        <td>{{ empleado.nss }}</td>
        <td>
        <button id="button" @click="editarEmpleado(empleado)"><span class="fas fa-pen"></span></button>
        <button><span class="fas fa-trash"></span></button>    
         
        </td>
      </tr>
    </tbody>
  </table>
  <!-- Modal detalles-->
      <div  v-if="form == 1">
     
          <div class="card mb-3">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary" v-if="bandera == 1">Nuevo cliente</h6>
              <h6 class="m-0 font-weight-bold text-primary" v-if="bandera == 2">Editar cliente</h6>
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
                    <input type="text" class="form-control" placeholder="Apellidos" v-model="apellidos">
                  
                  </div>
                </div>

                <div class="form-row">
                  <div class="col">
                    <label for="exampleInputPassword1">Telefono</label>
                    <input type="text" class="form-control" maxlength="10" placeholder="- - - - - - - - - -" v-model="telefono">
                 
                  </div>
                  <div class="col">
                    <label for="exampleInputPassword1">Ciudad</label>
                    <input type="email" class="form-control" placeholder="ciudad" v-model="ciudad">
                  </div>
                </div>

                <div class="form-row">
                  <div class="col">
                    <label for="exampleInputPassword1">Direccion</label>
                    <input type="text" class="form-control" placeholder="Direccion" v-model="direccion">
                  </div>
                  <div class="col">
                    <label for="exampleInputPassword1">Nss</label>
                    <input type="email" class="form-control" placeholder="Nss" v-model="nss">
                  </div>
                </div>


                <hr>
                <button class="btn btn-danger" @click="cancelar()">Cancelar</button>

                <button class="btn btn-primary" @click="storeEmpleado()" v-if="bandera == 1">Registrar</button>
                <button class="btn btn-primary"  v-if="bandera == 2" @click="updateEmpleado()">Actualizar</button>

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
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="salirDetalles">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div>
                <div class="col-12">
                  <table class="table table-striped">
                      <tbody>
                        <tr>
                          <th>Nombres: {{ nombres }}</th> 
                        </tr>
                        <tr>
                          <th>Apellidos: {{ apellidos }}</th>
                        </tr>
                        <tr>
                          <th>Telefono: {{ telefono }}</th>
                        </tr>
                        <tr>
                          <th>Ciudad: {{ ciudad }}</th>
                        </tr>
                        <tr>
                          <th>Direccion: {{ direccion }}</th>
                        </tr>
                        <tr>
                          <th>NSS: {{ nss }}</th>
                        </tr>
                        <tr>
                          <th>Activo: {{ activo }}</th>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal" @click="salirEditar()">Salir</button>
              <button type="button" class="btn btn-primary" @click="editEmpleado(arrayDetalleEmpleado)">Editar</button>
            </div>
          </div>
        </div>
      </div>
       <prueba></prueba>  
</template>

<script>
import { defineAsyncComponent } from "vue"
import Apicontrol from '../../../api/apiEmpleado'

export default {
  components: {
    prueba:defineAsyncComponent(()=>import('./prueba.vue'))
  },
  data() {
    return {
      empleados: [],
      arrayDetalleEmpleado: [],
      id_empleado: '',
      n_empleado:'',
      nombres:'',
      apellidos: '',
      ciudad: '',
      telefono: '',
      direccion: '',
      nss: '',
      activo: 1,
    }
  },

  mounted() {
    this.getEmpleados()
  },
  methods: {
    async getEmpleados() {
      const { data }  = await Apicontrol.get('/apiEmpleado')
      this.empleados = data.data;
      
    },
    createEmpleado() {
      const e = this;
      e.table = 0;
      e.form = 1;
      e.bandera = 1;
    },
    validarInputs() {
      this.error = 0;
      this.arrayError = [];

      if (!this.nombres) this.arrayError.push('los nombres son requeridos');
      if (!this.apellidos) this.arrayError.push('los apellidos son requeridos');
      if (!this.telefono) this.arrayError.push('El telefono es requeridos');

      if (this.arrayError.length) this.error = 1;

      return this.error;
      //console.log(this.arrayError)

    },
    
    storeEmpleado() {
      if (this.validarInputs()) {
        return;
      }

      let e = this;
      let url = '/apiEmpleado';
      var arrayEmpleado = {
        'nombres': this.nombres,
        'apellidos': this.apellidos,
        'telefono': this.telefono,
        'email': this.email,
        'nacionalidad': this.nacionalidad,
        'pais': this.pais,
        'ciudad': this.ciudad
      };
      axios.post(url, arrayEmpleado).then(function (response) {
        // handle success
        e.nombres = "";
        e.apellidos = "";
        e.telefono = "";
        e.email = "";
        e.nacionalidad = "";
        e.pais = "";
        e.ciudad = "";
        e.form = 0;
        e.table = 1;
        e.getEmpleados(1, e.criterio, '');

      })
        .catch(function (error) {
          // handle error
          console.log(error);
        });

    },
     cancelar() {
      const e = this;
      e.table = 1;
      e.form = 0;
      e.bandera = 1;
      e.nombres = "";
      e.apellidos = "";
      e.telefono = "";
      e.email = "";
      e.nacionalidad = "";
      e.pais = "";
      e.ciudad = "";
      e.arrayError = [];
    },
    DetallesEmpleado(data = []) {
      this.arrayDetalleEmpleados = data;
      this.nombres = data['nombres'];
      this.apellidos = data['apellidos'];
      this.telefono = data['telefono'];
      this.ciudad = data['ciudad'];
      this.direccion = data['direccion'];
      this.nss = data['nss'];
      this.activo = data['activo'];
      $("#detalles").modal('show');
    },

     salirEditar() {
      const e = this;
      e.nombres = "";
      e.apellidos = "";
      e.telefono = "";
      e.ciudad = "";
      e.direccion = "";
      e.nss = "";
      e.activo = "";
      $("#detalles").modal('hide');
    },


   
    updateEmpleado() {
      if (this.validarInputs()) {
        return;
      }

      let e = this;
      let url = '/apiEmpleado';
      var arrayCliente = {
        'nombres': this.nombres,
        'apellidos': this.apellidos,
        'telefono': this.telefono,
        'email': this.email,
        'nacionalidad': this.nacionalidad,
        'pais': this.pais,
        'ciudad': this.ciudad,
        'id_empleado': this.id_empleado
      };
      axios.put(url, arrayEmpleado).then(function (response) {
        // handle success
        e.id_empleado = 0;
        e.nombres = "";
        e.apellidos = "";
        e.telefono = "";
        e.email = "";
        e.nacionalidad = "";
        e.pais = "";
        e.ciudad = "";
        e.form = 0;
        e.table = 1;
        e.getEmpleados(1, e.criterio, '');

      })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    
    editarEmpleado(data = []) {
      this.agregando = false;
      $('#detalles').modal('show');
      this.nombres = data['nombres'];
      this.apellidos = data['apellidos'];
      this.ciudad = data['ciudad'];
      this.direccion = data['direccion'];
      this.telefono = data['telefono'];
      this.nss = data['nss'];
      console.log(data['nombres']);
    },

    actualizarEmpleado: function () {

      var jsonProveedor = {
        nombre: this.nombre,
        apellidos: this.apellidos,
        localidad: this.localidad,
        direccion: this.direccion,
        telefono: this.telefono,
        correo: this.correo
      };
      if (
        !jsonProveedor.nombre ||
        !jsonProveedor.apellidos ||
        !jsonProveedor.localidad ||
        !jsonProveedor.direccion ||
        !jsonProveedor.telefono ||
        !jsonProveedor.correo) {
        swal("Por favor", "Rellene todos los campos del formulario", "warning");
        return
      };
      axios.get(url).then(function (json) {
        this.obtenerProveedores();
        swal("Buen trabajo", "Se ha actualizado exitosamente el proveedor!", "success");
      });

      $('#modalProveedor').modal('hide');
    },

  }
}

</script>
<style scoped>
table{
  margin: 0px auto; 
  width: 95%;
  text-align: center;
}

#button{
  margin: 3%;
}

</style>