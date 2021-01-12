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
                                <button type="button" class="btn btn-primary">Editar</button>
                                <button type="button" class="btn btn-danger">Eliminar</button>
                                <!-- <button type="button" class="btn btn-secondary">Right</button> -->
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return{
              lisalum:[],
          } 
        },
        methods:{
            getlistalumno(){
                let me=this;
                let url='/Lista-alumno';
                axios.get(url).then(function(response){
                    me.lisalum=response.data;
                    console.log(me.lisalum);
                })
                .catch(function(error){
                    console.log(error);
                });
            }
        },
        mounted() {
            this.getlistalumno();
            console.log('Component mounted.')
        }
    }
</script>
