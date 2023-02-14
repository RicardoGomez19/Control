var ruta = document.querySelector("[name=route]").value;

var apiEmpleado = ruta + '/api/apiEmpleado';


new Vue({

    el: "#empleado",

    data: {
        empleados: [],
        agregando: true,
        id_empleado: '',
        nombres: '',
        apellidos: '',
        direccion: '',
        ciudad: '',
        telefono: '',
        nss:'',
        activo: '1',
        buscar: '',
        // variables de paginacion
        paginaActual: 1,
        mostrarPorPagina: 7,
        // fin variables de paginacion


    },

    //AL CREARSE LA PAGINA
    created: function () {
        this.obtenerProveedores();
        ;


    },

    methods: {
        obtenerProveedores: function () {
            this.$http.get(apiEmpleado).then(function (json) {
                this.empleados = json.data.data;
                console.log(json.data);
            }).catch(function (json) {
               console.log(json);
            })
        },


        mostrarModal: function () {
            this.agregando = true;
            this.nombres = '';
            this.apellidos = '';
            this.ciudad = '';
            this.direccion = '';
            this.telefono = '';
            this.nss = '';
            this.activo = '1';


            $('#modalEmpleado').modal('show');
        },

        guardarProveedor: function () {

            // se construye el json para enviar al controlador
            var empleado = {
                nombres: this.nombres,
                apellidos: this.apellidos,
                ciudad:this.ciudad,
                direccion: this.direccion,
                telefono: this.telefono,
                nss: this.nss,
                activo: this.activo

            };
            if (
                !empleado.nombres ||
                !empleado.apellidos ||
                !empleado.ciudad ||
                !empleado.direccion ||
                !empleado.telefono ||
                !empleado.nss) {
                swal("Por favor", "Rellene todos los campos del formulario", "warning");
                return
            };
            //se envia los datos del json al controlador
            this.$http.post(apiEmpleado, empleado).then(function (j) {
                this.obtenerProveedores();
                swal("Buen trabajo", "El proveedor se ha agregado exitosamente!", "success");
                this.nombres = '';
                this.apellidos = '';
                this.ciudad = '';
                this.direccion = '';
                this.telefono = '';
                this.nss = '';
                this.activo = '1';


            }).catch(function (j) {
                swal("Ese correo ya existe", "Intente con otro.", "error");
            });


            $('#modalProveedor').modal('hide');

          //  console.log(proveedor);

        },

        //funcion para eliminar
        eliminarProveedor: function (id) {
            swal("Esta seguro de eliminar al proveedor?", {
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                        text: "Aceptar",
                        value: "json",
                    },

                },
            }).then(value => {
                switch (value) {
                    case "json":
                        this.$http.delete(apiEmpleado + '/' + id).then(function (json) {
                            swal("Buen trabajo", "Se ha eliminado exitosamente!", "success");
                            this.obtenerProveedores();
                        }).catch(function (json) {

                        });
                        break;
                    default: ;

                }
            })
        },


        editandoProveedor: function (id) {
            this.agregando = false;
            this.id_empleado = id;

            this.$http.get(apiEmpleado + '/' + id).then(function (json) {
                this.nombres = json.data.data.nombres;
                this.apellidos = json.data.data.apellidos;
                this.ciudad = json.data.data.ciudad;
                this.direccion = json.data.data.direccion;
                this.telefono = json.data.data.telefono;
                this.nss = json.data.data.nss;
            });           
            $('#modalEmpleado').modal('show');
            
        },

        actualizarProveedor: function () {

            var jsonEmpleado = {
                nombres: this.nombres,
                apellidos: this.apellidos,
                ciudad: this.ciudad,
                direccion: this.direccion,
                telefono: this.telefono,
                nss: this.nss
            };
            if (
                !jsonEmpleado.nombres ||
                !jsonEmpleado.apellidos ||
                !jsonEmpleado.ciudad ||
                !jsonEmpleado.direccion ||
                !jsonEmpleado.telefono ||
                !jsonEmpleado.nss) {
                swal("Por favor", "Rellene todos los campos del formulario", "warning");
                return
            };
            this.$http.patch(apiEmpleado + '/' + this.id_empleado, jsonEmpleado).then(function (json) {
                this.obtenerProveedores();
                swal("Buen trabajo", "Se ha actualizado exitosamente el proveedor!", "success");
            });

            $('#modalEmpleado').modal('hide');
        },

        // metodos de paginacion
        siguientePagina: function () {
            if (this.paginaActual < this.numeroDePaginas) { this.paginaActual++ }
        },

        anteriorPagina: function () {
            if (this.paginaActual != 1) { this.paginaActual-- }
        },

        seccionarPagina: function (pagina) {
            this.paginaActual = pagina;
        },
        // fin metodos de paginacion


    },
    //FIN DE MITHODS

    //inicio de reaccion automatica
    
    //fin computed

});
