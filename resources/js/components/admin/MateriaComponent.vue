<template>
    <div class="card">

        <!-- alertas  -->
        <div class="alert alert-success alert-block" v-if="band">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{  mesaje }}</strong>
        </div>
        <div class="alert alert-danger alert-block" v-if="bandE">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ mesaje }}</strong>
        </div>
        <!-- fin de las alertas -->
        
        <div class="card-header">
            <h2>MATERIAS</h2>
        </div>
        <div class="card-body">
            <form @submit="GuardarMateria">
                <div class="form-group">
                    <label for="materia" >Nombre de la materia</label>
                    <input type="text" name="materia" id="materia" class="form-control" v-model="materias" required maxlength="20" minlength="2"/>
                    <label for="abrebiatura">Abreviatura de la materia</label>
                    <input type="text" name="abrebiatura" id="abrebiatura" class="form-control" v-model="abreviatura" required maxlength="4" minlength="2"/>
                    <label for="listagardos">Selecciona el gardo</label>
                    <select name="listagardos" id="listagardos" class="form-control" v-model="idgrado" required>
                        <option v-for="(item, index) in listagardo" :key="index" v-bind:value="item.id">
                            {{item.nombregrado}}
                            </option>
                    </select>
                </div>
                <input type="submit" value="Guardar" class="btn btn-outline-primary">
            </form>

            <hr>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <TD scope="col">MATERIA</TD>
                        <td scope="col">ABREVITURA</td>
                        <td scope="col">GRADO</td>
                        <TD scope='col' >ACCIONES</TD>
                    </thead>
                    <Tbody>
                        <tr v-for="(item, index) in Materiaslis" :key="index">
                            <td>
                                {{item.nombremateria}}
                            </td>
                            <td>
                                {{item.siglasmaterias}}
                            </td>
                            <td>
                                {{item.nombregrado}}
                            </td>
                            <td>
                                <button class="btn btn-outline-primary" @click="editarMa(item.id,item.grados_id,item.siglasmaterias,item.nombremateria)">Editar</button>
                                <button class="btn btn-outline-danger">Eliminar</button>
                            </td>
                        </tr>
                    </Tbody>
                </table>
                <!-- modal para editar -->
                <modal name="editar" :width="500" :height="400" :adaptive="true">
                    <!-- formulario -->
                    <form @submit="editarMateria">
                        <hr>
                            <div class="form-group" style="margin:5px;">
                                <h4>Editar Materia</h4>
                            </div>
                        <hr>
                        <div class="form-group" style="margin:5px;">
                            <label for="nombre">Nombre de la materia</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" v-model="materias" required/>
                            <input type="hidden" name="istema" v-model="idtema">
                        </div>
                        <div class="form-group" style="margin:5px;">
                            <label for="materia">Abreviatura de la materia</label>
                            <input type="text" name="materia" id="materia" class="form-control" v-model="abreviatura" required/>
                        </div>
                        <div class="form-group" style="margin:5px;">
                            <label for="grados">Seleccionar grado</label>
                            <select name="grado" id="grado" class="form-control" v-model="idgrado" required>
                                <option v-for="(item, index) in listagardo" :key="index" v-bind:value="item.id">
                                    {{item.nombregrado}}
                                </option>
                            </select>
                        </div> 
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                            <button type="button" class="btn btn-outline-danger" @click="censelar">Cancelar</button>
                        </div>    
                    </form>
                    <!-- fi del formulario -->
                </modal>
                <!-- modal de eliminar -->
            </div>        
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            materias:"",
            abreviatura:"",
            listagardo:"",
            idgrado:1,
            band:false,
            bandE:false,
            mesaje:"",
            Materiaslis:[],
            idtema:0,
            idanterior:0
        }
    },
    methods:{
        GuardarMateria(e){
            e.preventDefault();
            let url='/guardarmateria';
            let me=this;
            axios.post(url,{'nombreMateria':me.materias, 'abreviatura':me.abreviatura,'idgrado':me.idgrado})
            .then(response=>{
                if(response.data === true){
                    me.band=true;
                    me.mesaje="Se ha guardado correctamente la materias";
                    this.clear();
                    this.listaMaterias();
                }else if(response.data === false){
                    me.bandE=true;
                    me.mesaje="Ha ocurrido un error al guardar la materia";
                }

            }).catch(error=>{
                console.log(error);
            });
        },
        opcione(){
            let url='/agregarmaterisa';
            let me=this;
            axios.get(url).then(response=>{
                me.listagardo=response.data;
            }).catch(
                error=>{
                    console.log(error);
                }
            );
        },
        listaMaterias(){
            let url="/listamateria";
            let me=this;
            axios.get(url).then(response=>{
                me.Materiaslis=response.data;
            }).catch(
                error=>{
                    console.log(error);
                }
            );
        },
        editarMa(id,idgrado,siglas,nombre){
            let me=this;
            me.materias=nombre;
            me.abreviatura=siglas;
            me.idgrado=idgrado;
            me.idtema=id;
            me.idanterior=idgrado;
            this.$modal.show('editar');

        },
        censelar(){
            this.$modal.hide('editar');
            this.clear();
        },
        clear(){
            let me=this;
            me.materias="";
            me.abreviatura="";
            me.idgrado=1;
        },
        editarMateria(e){
            e.preventDefault();
            let me=this;
            let url="/ActulizarMaterias";
            axios.post(url,{'nombremateria':me.materias,'idmateria':me.idtema,
                            'abreviatura':me.abreviatura,'idgrado':me.idgrado,
                            'idgradoanterior':me.idanterior}).then(
            response =>{
                console.log(response);
                if(response.data == true){
                    me.band=true;
                    me.mesaje="Se ha actualizado correctamente la materias";
                    this.listaMaterias();
                    this.censelar();
                }else{
                    me.bandE=true;
                    me.mesaje="Ha ocurrido un error al actualizar la materia";
                }
            }).catch(error=>{
                console.log(error);
            });
        },
    },
    mounted(){
        this.opcione();
        this.listaMaterias();
    }

}
</script>