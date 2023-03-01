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
                        <button class="btn btn-info" @click="mostrarModal(empleado)">Nuevo</button>
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
        <button id="button"  @click="editandoEmpleado(empleado)"><span class="fas fa-pen"></span></button>
        <button><span class="fas fa-trash"  @click="eliminarEmpleado(empleado)"></span></button>    
         
        </td>
      </tr>
    </tbody>
  </table>
  <!-- Modal detalles-->
      <!--inicio ventana Modal -->
          <div class="modal fade" id="modalEmpleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content" id="colorModal">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel" v-if="agregando == true">AGREGANDO EMPLEADO</h5>
                          <h5 class="modal-title" id="exampleModalLabel" v-if="agregando == false">EDITANDO EMPLEADO</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <h6>Nombres:</h6>
                            <input type="text" class="form-control" placeholder="Nombre del empleado" v-model="nombres" required>
                          <h6>Apellidos:</h6>
                            <input type="text" class="form-control" placeholder="Apellidos del empleado" v-model="apellidos" required>
                          <h6>Telefono:</h6>
                            <input type="number" class="form-control" placeholder=" Escriba el télefono" v-model="telefono">
                          <h6>Ciudad:</h6>
                            <input type="text" class="form-control" placeholder="Escriba la ciudad" v-model="ciudad">
                          <h6>Direccion:</h6>
                            <input type="text" class="form-control" placeholder="Escriba la dirección" v-model="direccion">
                          <h6>Nss:</h6>
                            <input type="text" class="form-control" placeholder=" Escriba el correo" v-model="nss">
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          <button type="button" class="btn btn-info" @click="guardarEmpleado" v-if="agregando == true">Guardar</button>
                          <button type="button" class="btn btn-info" @click="actualizarEmpleado" v-if="agregando == false">Guardar</button>
                      </div>
                  </div>
              </div>
          </div>
          <!--final de modal-->
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
      id_empleado: '',
      n_empleado:'',
      nombres:'',
      apellidos: '',
      telefono: '',
      ciudad: '',
      direccion: '',
      nss: '',
      activo: '1',
      agregando: true,
      buscar: '',
      // variables de paginacion
      paginaActual: 1,
      mostrarPorPagina: 7,
      // fin variables de paginacion
    }
  },

  mounted() {
    this.getEmpleados()
  },
  methods: {

    async getEmpleados() {
      try {
        const { data } = await Apicontrol.get('/apiEmpleado');
        this.empleados = data.data;
      } catch (error) {
        console.error(error);
      }
    },
    // async getEmpleados() {
    //   const { data }  = await Apicontrol.get('/apiEmpleado')
    //   this.empleados = data.data;
      
    // },

    mostrarModal: function () {
      this.agregando = true;
      this.nombres = '';
      this.apellidos = '';
      this.telefono = '';
      this.ciudad = '';
      this.direccion = ''; 
      this.nss = '';
      this.activo = '1';


      $('#modalEmpleado').modal('show');
    },

    guardarEmpleado: function () {
      let url = '/apiEmpleado';
      // se construye el json para enviar al controlador
      var empleado = {
        nombres: this.nombres,
        apellidos: this.apellidos,
        telefono: this.telefono,
        ciudad: this.ciudad,
        direccion: this.direccion,
        nss: this.nss,
        activo: this.activo

      };
      if (
        !empleado.nombres ||
        !empleado.apellidos ||
        !empleado.telefono ||
        !empleado.direccion ||
        !empleado.ciudad ||
        !empleado.nss) {
        swal("Por favor", "Rellene todos los campos del formulario", "warning");
        return
      };
      //se envia los datos del json al controlador
      axios.post(url, empleado).then(function (j) {
        this.getEmpleados();

        swal("Buen trabajo", "El empleado se ha agregado exitosamente!", "success");
        this.nombres = '';
        this.apellidos = '';
        this.ciudad = '';
        this.direccion = '';
        this.telefono = '';
        this.nss = '';
        this.activo = '1';

      }).catch(function (j) {
        swal("Ese empleado ya existe", "Intente con otro.", "error");
      });


      $('#modalEmpleado').modal('hide');

    },
    
    eliminarEmpleado: function(id) {
      swal("Esta seguro de eliminar al empleado?", {
        buttons: {
          cancel: "Cancelar",
          catch: {
            text: "Aceptar",
            value: "json",
          },

        },
      }).then( async value => {
        switch (value) {
          case "json":
            const { data } = await axios.delete(Apicontrol + '/apiEmpleado', data.data.id_empleado).then(function (json) {
              swal("Buen trabajo", "Se ha eliminado exitosamente!", "success");
              this.getEmpleados();
            }).catch(function (json) {

            });
            break;
          default: ;

        }
      })
    },
     
    // DetallesEmpleado(data = []) {
    //   this.arrayDetalleEmpleados = data;
    //   this.nombres = data['nombres'];
    //   this.apellidos = data['apellidos'];
    //   this.telefono = data['telefono'];
    //   this.ciudad = data['ciudad'];
    //   this.direccion = data['direccion'];
    //   this.nss = data['nss'];
    //   this.activo = data['activo'];
    //   $("#detalles").modal('show');
    // },

    //  salirEditar() {
    //   const e = this;
    //   e.nombres = "";
    //   e.apellidos = "";
    //   e.telefono = "";
    //   e.ciudad = "";
    //   e.direccion = "";
    //   e.nss = "";
    //   e.activo = "";
    //   $("#detalles").modal('hide');
    // },

     editandoEmpleado(data = []) {
      this.agregando = false;
       {
         this.nombres = data['nombres'];
         this.apellidos = data['apellidos'];
         this.telefono = data['telefono'];
         this.ciudad = data['ciudad'];
        this.direccion = data['direccion'];
        this.nss = data['nss'];
      }
      $('#modalEmpleado').modal('show');
       console.log(data);
    },

    actualizarEmpleado: function () {

      var jsonEmpleado = {
        nombres: this.nombres,
        apellidos: this.apellidos,
        ciudad: this.ciudad,
        direccion: this.direccion,
        telefono: this.telefono,
        nss: this.nss
      };
      console.log(jsonEmpleado);
      
      axios.patch(Apicontrol + '/apiEmpleado/' + this.id_empleado, jsonEmpleado).then(function (json) {
        this.getEmpleados();
        swal("Buen trabajo", "Se ha actualizado exitosamente el empleado!", "success");
      });

      $('#modalEmpleado').modal('hide');
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