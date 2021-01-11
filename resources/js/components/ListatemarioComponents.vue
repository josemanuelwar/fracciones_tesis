<template>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Temario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="listatema.length > 0" v-for="lis in listatema">
                        <td>

                        </td>
                        <td>
                            {{list.nombre_tema}}
                        </td>
                        <td>
                            <button>agregar preguntas</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-if="listatema.length == 0">
                No hay informacion
            </div>    
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                listatema:[]
            }

        },
        methods:{
            getListatemas(){
                let me=this;
                let url='/listaTemas';
                axios.get(url).then(function (response) {
                        //creamos un array y guardamos el contenido que nos devuelve el response
                        me.listatema = response.data;
                       console.log(me.listatema);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
        },
        mounted(){
            this.getListatemas();
        }
    }
</script>