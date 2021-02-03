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
                    <input type="text" class="form-control" id="text" v-model="temario" placeholder="aprendiendo fraciones" required>
                </div>
                <div class="form-group">
                     <label for="grado">Seleciona un materia</label>
                     <select class= "form-control" v-model="idgardo" required>
                         <option v-if="listagardos == null">
                             no hay nada
                         </option>
                             <option v-for="lis in listagardos" v-bind:value="lis.id"  v-bind:key="lis.id">
                                {{ lis.nombremateria }}--{{lis.nombregrado}}
                            </option>
                    </select>   
                </div>
                <div class="form-group">
                    <label for="numero">Ingresa el numero de preguntas</label>
                    <input type="number" name="numero" class="form-control" v-model="numpregun" max="100" min="1" required/>
                        {{numpregun}}
                </div>
                <input type="submit" value="Guardar" class="btn btn-outline-primary">
            </form>    
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Grado</th>
                        <th scope="col">Temario</th>
                        <th scope="col">Numero pregunta</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in listatema" :key="index">
                        <td>{{item.nombregrado}}</td>
                        <td>{{item.nombre_tema}}</td>
                        <td>{{item.numerodepreguntas}}</td>
                        <td>
                            <a :href="urlpre+item.id" class="btn btn-outline-success">Agregar pregunta</a>
                            <button class="btn btn-outline-primary">Editar</button>
                            <button class="btn btn-outline-danger">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>    
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
                     <label for="grado">Seleciona un materia</label>
                     <select class= "form-control" v-model="idgardo">
                         <option v-if="listagardos == null">
                             no hay nada
                         </option>
                             <option v-for="lis in listagardos" v-bind:value="lis.id"  v-bind:key="lis.id">
                                {{ lis.nombremateria }}--{{lis.nombregrado}}
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
                    idgardo:1,
                    listagardos:[],
                    listatema:[],
                    idtema:0,
                    status:false,
                    mesaje:"",
                    numpregun:"",
                    urlpre:"/Agregarpreguntas/",
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
                        // console.log(me.listatema);
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
                    'idgrado':me.idgardo,
                    'pregnum':me.numpregun
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
