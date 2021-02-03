<template>
        
</template>
<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    // import MathType from '@wiris/mathtype-ckeditor5';
    export default {
        props: ['initialCounter'],
        data(){
            return{
                Temas:[],       
            }    
        },
        methods:{
         getTemas(){
           let me=this;
           let url="/Agregarpreguntas";

           axios.get(url).then(response=>{
               console.log(response);
           }).catch(error=>{
               console.log(error);
           });

         }   
        },
        mounted() {
            this.getTemas();
        }
    }
</script>