require('./bootstrap');
import CKEditor from '@ckeditor/ckeditor5-vue2';
import VuePaginate  from 'vue-paginate';
// import VModal from 'vue-js-modal';
import VModal from 'vue-js-modal/dist/index.nocss.js';
import 'vue-js-modal/dist/styles.css';

window.Vue = require('vue');
Vue.use(VuePaginate);
Vue.use(CKEditor);
Vue.use(VModal);
// Vue.use(MathType);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('temario-component', require('./components/AgregartemarioComponet.vue').default);
Vue.component('lista-component',require('./components/ListatemarioComponents.vue').default);
Vue.component('pregunta-component',require('./components/admin/PreguntasComponent.vue').default);
Vue.component('alumno-component',require('./components/admin/AlumnoslisComponent.vue').default);
Vue.component('escuela-component',require('./components/admin/RegistarEscuelaComponent.vue').default);
Vue.component('materia-component',require('./components/admin/MateriaComponent.vue').default);
// Vue.component('varibles-componet',{props:['commentIds'],
// template:'<pregunta-component></pregunta-component>'},require('./components/admin/varibles/variblesComponent.vue').default);
// Vue.component('alumnos-component',require('./components/admin/listaalumnosComponent.vue').default);
const app = new Vue({
    el: '#app',
});
