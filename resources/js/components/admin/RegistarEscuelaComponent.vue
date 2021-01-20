<template>
<div class="card">
            <div class="card-header">
                Registrar Escuela
            </div>
            <div class="card-body">
                <div class="alert alert-success alert-block" v-if="alerat_buena">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>Se ha gurdado corectamente</strong>
                </div>
                <div class="alert alert-danger alert-block" v-if="alerta_mala">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>Todos los campos son requeridos</strong>
                </div>
                <form id="formulario_escuela" @submit="checkForm" method="post">
                    <div class="form-group">
                        <label for="escuela">Nombre de la escuela</label>
                        <input type="text" class="form-control" id="escuela" v-model="escuela" />
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" id="direccion" v-model="Direccion"/>
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <input type="submit" value="Guardar">
                </form>
                <hr>
                
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">NOMBRE DE LA ESCUELA</th>
                        <th scope="col">DIRECCION</th>
                        <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in listaescue" :key="index">
                            <td>
                                {{item.id}}
                            </td>
                            <td>
                                {{item.nombre_escuela}}
                            </td>
                            <td>
                                {{item.direccion}}
                            </td>
                            <td>
                                <button @click="asignacionEscuela(item.id)">Asignar</button>
                                <button @click="editarEscuela(item.id)">Editar</button>
                                <button @click="eliminarEscuela(item.id)">Eliminar</button>
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
                escuela:"",
                Direccion:"",
                alerat_buena:false,
                alerta_mala:false,
                listaescue:[],
            }
        },
        methods:{
            checkForm(e){
                e.preventDefault();
                let me=this;
                let url="/GuardarEscuela";
                axios.post(url,{'nombreescuela':me.escuela,'direccion':me.Direccion}).then(response =>{
                    if(response.data==="true"){
                        me.alerat_buena=true;
                    }
                }).catch(error=>{
                    me.alerta_mala=true;
                });
            },
            getlistescuela(){
                let me=this;
                let url="/listaEscuela";
                axios.get(url).then(response=>{
                    me.listaescue=response.data;
                }).catch(error=>{
                    console.log(error);
                })
            },
            asignacionEscuela(id){
                let me=this;
                let url="/AsignarEscuela/"+id;
                axios.get(url).then(response=>{
                    console.log(response);
                }).catch(error=>{
                    console.log(error);
                })
            },
            editarEscuela(id){

            },
            eliminarEscuela(id){

            }
            

        },
        mounted(){
            this.getlistescuela();
        }

}
</script>