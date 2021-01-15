<template>
    <div class="card">
        <div class="card-header">Temario</div>
        <div class="card-body">
            
            <div class="alert alert-success alert-block" v-if="status">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ mesaje }}</strong>
            </div>

            <form  @submit="checkForm" method="post">
                <div class="form-group">
                    <label for="tema">Nombre del tema</label>
                    <input type="text" class="form-control" id="text" v-model="temario" placeholder="aprendiendo fraciones">
                </div>
                <div class="form-group">
                     <label for="grado">Seleciona un grado</label>
                     <select class= "form-control" v-model="idgardo">
                         <option v-if="listagardos == null">
                             no hay nada
                         </option>
                             <option v-for="lis in listagardos" v-bind:value="lis.id"  v-bind:key="lis.id">
                                {{ lis.nombregrado }}
                            </option>
                    </select>   
                </div>
                <input type="submit" value="Guardar">
            </form>    
        <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Grado</th>
                        <th scope="col">Temario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody  v-for="lis in listatema" v-bind:key="lis.id">
                        <tr v-for="temas  in lis.temas" v-bind:key="temas.id">
                            <td v-if="lis.temas.length > 0">
                            {{lis.nombregrado}}
                            </td>
                            <td v-if="lis.temas.length > 0" >
                                    {{temas.nombre_tema}}    
                            </td>
                            <td v-if="lis.temas.length > 0" >
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-primary" @click="ModalEditar(temas.id,temas.nombre_tema,lis.id)">Editar</button>
                                            <button type="button" class="btn btn-danger">Eliminar</button>
                                        </div>   
                            </td>
                        </tr>
                    <!-- </span> -->
                </tbody>
            </table>
            
            <div v-if="listatema.length == 0">
                No hay informacion
            </div>    

        <modal name="editar" :width="500" :height="350" :adaptive="true">
            <hr>
                <h3>Editar Tema</h3>
            <hr>
            <form @submit="actulizarForm" method="post">
                <div class="form-group" style="margin:5px;">
                    <label for="tema">Tema</label>
                    <input type="text" name="tema" v-model="temario" class="form-control"/>
                </div>
                <div class="form-group" style="margin:5px;">
                     <label for="grado">Seleciona un grado</label>
                     <select class= "form-control" v-model="idgardo">
                         <option v-if="listagardos == null">
                             no hay nada
                         </option>
                             <option v-for="lis in listagardos" v-bind:value="lis.id"  v-bind:key="lis.id">
                                {{ lis.nombregrado }}
                            </option>
                    </select>   
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
                    temario:"",
                    idgardo:"1",
                    listagardos:[],
                    listatema:[],
                    idtema:0,
                    status:false,
                    mesaje:"",
                    urleditar:"www.google.com"
            }
        },
        methods:{
            getgrado(){
                let me=this;
                let url='/lista';
                axios.get(url).then(function (response) {
                        //creamos un array y guardamos el contenido que nos devuelve el response
                        me.listagardos = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },

            getListatemas(){
                let me=this;
                let url='/listaTemas';
                axios.get(url).then(function (response) {
                        //creamos un array y guardamos el contenido que nos devuelve el response
                        me.listatema = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            checkForm(e){
                e.preventDefault();
                let me=this;
                let url="/guardarTemas";
                axios.post(url,{
                    'tema':me.temario,
                    'idgrado':me.idgardo
                }).then(function(response){
                        if(response.data){
                         me.getListatemas();
                         me.clerar();   
                        }
                }).catch(
                    function(erros) {
                        console.log(erros);
                    }
                );

            },
            clerar(){
                this.temario="";
            },
            ModalEditar(idtema,nombretema,idgrado){
                let me=this;
                me.temario=nombretema;
                me.idgardo=idgrado;
                me.idtema=idtema;
                this.$modal.show("editar");
            },
            Modealcerrar(){
                this.$modal.hide("editar");
                this.clerar();
            },
            actulizarForm(e){
                e.preventDefault();
                let me=this;
                let url='/EditarTema';
                axios.post(url,{
                    'idtema':me.idtema,
                    'tema':me.temario,
                    'idgardo':me.idgardo
                }).then(response=>{
                    if(response.data===1){
                        this.getListatemas(); 
                        me.status=true;
                        me.mesaje="Se ha actualizado Correctamente el tema";
                        me.idgardo=1;
                        this.Modealcerrar();            
                    }
                }).catch(error=>{
                    console.log(error);
                });
            }
        },
        mounted() {
           this.getgrado();
           this.getListatemas();
        }       
    }
</script>
