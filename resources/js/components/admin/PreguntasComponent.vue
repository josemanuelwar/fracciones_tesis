<template>
    <div class="card">
        <div class="card-header">
           <h1>Preguntas</h1>
        </div>
        <div class="card-body">
            <form action="">
                <div class="mb-3">
                    <label for="grado" class="form-label">Selecionar grados</label>
                    <select name="grado" id="grado" class= "form-control" v-model="idgrado" v-on:change="signalChange">
                        <option v-for="index in listagardos" v-bind:value="index.id" v-bind:key="index.id">
                                {{index.nombregrado}}
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tema" class="form-label">Selecionar tema</label>
                    <select name="tema" id="tema" class= "form-control">
                        <option></option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="preguntas" class="form-label">Ingresa la Preguntas</label>
                    <!-- <textarea id="preguntas" name="preguntas" class="form-control"></textarea> -->
                    <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
                </div>

                <div class="mb-3">
                    <label for="audio" class="form-label">Selecciona Audio o Video</label>
                    <input type="file" id="audio" name="audio" class="form-control">
                </div>
                <input type="submit"  value="Guardar">
            </form>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Tema</th>
                    <th scope="col">Preguntas</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>    
</template>
<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    
    export default {
        data(){
            return{
                idgrado:1,
                listagardos:[],
                idtema:0,
                audio:"",
                preguntas:"",
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {      
                }
            }    
        },
        methods:{
            getgrado(){
                let me=this;
                let url='/lista';
                axios.get(url).then(function (response) {
                        //creamos un array y guardamos el contenido que nos devuelve el response
                        me.listagardos = response.data;
                        console.log(me.listagardos);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    });
            },
            signalChange(){
                let me=this;
                let url='/listatemasgrado';
                axios.get(url,{'idgrado':me.idgrado}).then(function(response) {
                    console.log(response.data);
                }).catch(function (error){
                      console.log(error);  
                });
            }

        },
        mounted() {
            this.getgrado();
            this.signalChange();
        }
    }
</script>