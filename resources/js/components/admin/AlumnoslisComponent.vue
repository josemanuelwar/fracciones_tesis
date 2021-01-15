<template>
    <div class="card">
        <div class="card-header">Lista de alumnos</div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO PATERNO</th>
                    <th scope="col">APELLIDO MATERNO</th>
                    <th scope="col">DIRECCION</th>
                    <th scope="col">ESCUELA</th>
                    <th scope="col">CORREO ELECTRONICO</th>
                    <th scope="col">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for=" lista in lisalum" v-bind:key="lista.id">
                        <td>
                            {{lista.Nombre}}
                        </td>
                        <td>
                            {{lista.App}}
                        </td>
                        <td>
                            {{lista.Apm}}
                        </td>
                        <td>
                            {{lista.Direccion}}
                        </td>
                        <td>
                            {{lista.Escuela}}
                        </td>
                        <td>
                            {{lista.email}}
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a :href="urlEditar+lista.id" class="btn btn-primary">Editar</a>
                                <button type="button" class="btn btn-danger" id="show-modal" @click="Eliminar(lista.id)">Eliminar</button>
                                <!-- <button type="button" class="btn btn-secondary">Right</button> -->
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- modal -->
            <modal name="example" :width="300" :height="250" :adaptive="true">
                 <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Eliminar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="canselar()">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Seguro de Eliminar a este usuario ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="enviarEliminar()">Aceptar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="canselar()">Canselar</button>
                        </div>
                    </div>
                 </div>       
            </modal>
            <!-- fin del modal -->
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return{
              lisalum:[],
              urlEditar:'/EditarAulm/',
              showModal:false,
              idusaurio:0,
          } 
        },
        methods:{
            getlistalumno(){
                let me=this;
                let url='/Lista-alumno';
                axios.get(url).then(function(response){
                    me.lisalum=response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            Eliminar(id){
                let me=this;
                me.idusaurio=id;
                this.$modal.show('example');  
            },
            canselar(){
                this.$modal.hide('example');
            },
            enviarEliminar(){
                let met=this;
                axios.get().then(function(response){

                }).catch(function(error){
                    console.log(error);
                });  
            }
        },
        mounted() {
            this.getlistalumno();
        }
    }
</script>
