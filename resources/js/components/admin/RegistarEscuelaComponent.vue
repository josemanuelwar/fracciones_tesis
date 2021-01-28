<template>
<div class="card">
            <div class="card-header">
                Registrar Escuela
            </div>
            <div class="card-body">
                <div class="alert alert-success alert-block" v-if="alerat_buena">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{  mesaje }}</strong>
                </div>
                <div class="alert alert-danger alert-block" v-if="alerta_mala">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ mesaje }}</strong>
                </div>
                <form id="formulario_escuela" @submit="checkForm" method="post">
                    <div class="form-group">
                        <label for="escuela">Nombre de la escuela</label>
                        <input type="text" class="form-control" id="escuela" v-model="escuela" required/>
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" id="direcion" v-model="Direccion" required/>
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <input type="submit" value="Guardar" class="btn btn-outline-primary">
                </form>
                <hr>
                <div class="table-responsive">
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
                                    <button @click="asignacionEscuela(item.id)" class="btn btn-outline-success">Asignar</button>
                                    <button @click="editarEscuela(item.id)" class="btn btn-outline-primary">Editar</button>
                                    <button @click="eliminarEscuela(item.id)" class="btn btn-outline-danger">Eliminar</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <modal name="editar" :width="500" :height="350" :adaptive="true">
                    <hr>
                        <h3>Editar Escuela</h3>
                    <hr>
                    <form  @submit="editarEs" method="post">
                        <div class="form-group" style="margin:5px;">
                            <input type="hidden" name="idescuela" v-model="idescuela">
                            <label for="escuela">Nombre de la escuela</label>
                            <input type="text" id="escuela"  class="form-control" v-model="escuela"/>
                        </div>
                        <div class="form-group" style="margin:5px;">
                            <label for="direcion">Direccion</label>
                            <input type="text" id="direcion"  class="form-control" v-model="Direccion"/>
                        </div>
                        <div class="modal-footer" style="margin:5px;">
                            <button type="submit" class="btn btn-primary" data-dismiss="modal" >Aceptar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" @click="Modealcerrar()">Canselar</button>
                        </div>
                    </form>
                </modal>
            </div>
        </div>

</template>
<script>
export default {
        data(){
            return{
                escuela:"",
                Direccion:"",
                idescuela:0,
                alerat_buena:false,
                alerta_mala:false,
                mesaje:"",
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
                         me.mesaje="Se ha guardado correcta mente";
                    }
                }).catch(error=>{
                    me.alerta_mala=true;
                    me.mesaje="Todos los campos son requeridos";
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
                    if(response.data === true){
                        me.alerat_buena=true;
                        me.mesaje="Se ha asignado correctamente correcta mente";
                    }
                }).catch(error=>{
                    console.log(error);
                })
            },
            editarEscuela(id){
                let me=this;
                let  url="/GetEscuela/"+id;
                axios.get(url).then(response=>{
                    me.id=response.data.id;
                    me.escuela=response.data.nombre_escuela;
                    me.Direccion=response.data.direccion;
                }).catch(error=>{
                    console.log(error);
                })
               this.$modal.show("editar");
            },
            eliminarEscuela(id){

            },
            Modealcerrar(){
                this.$modal.hide("editar");
                this.clear();
            },
            clear(){
                let me=this;
                me.escuela="";
                me.Direccion="";
                me.id="";
            },
            editarEs(e){
                e.preventDefault();
                let me=this;
                let url="/UpdateEscuela";
                axios.post(url,{
                    'idEscuela':me.id,
                    'nombreescuela':me.escuela,
                    'direccion':me.Direccion
                }).then(response=>{
                    if(response.data===true){
                        me.alerat_buena=true;
                        me.mesaje="Se han actualizado correctamente los datos ";
                        this.Modealcerrar();
                        this.getlistescuela();
                    }
                }).catch(error=>{
                    console.log(error);
                })
            }
            

        },
        mounted(){
            this.getlistescuela();
        }

}
</script>