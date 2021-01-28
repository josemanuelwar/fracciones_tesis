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
                                <button class="btn btn-outline-primary">Editar</button>
                                <button class="btn btn-outline-danger">Eliminar</button>
                            </td>
                        </tr>
                    </Tbody>
                </table>
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
        }
    },
    mounted(){
        this.opcione();
        this.listaMaterias();
    }

}
</script>