
require('./bootstrap');
import CKEditor from '@ckeditor/ckeditor5-vue2';
window.Vue = require('vue');
Vue.use(CKEditor);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('temario-component', require('./components/AgregartemarioComponet.vue').default);
Vue.component('lista-component',require('./components/ListatemarioComponents.vue').default);
Vue.component('pregunta-component',require('./components/admin/PreguntasComponent.vue').default);
Vue.component('alumno-component',require('./components/admin/AlumnoslisComponent.vue').default);
// Vue.component('alumnos-component',require('./components/admin/listaalumnosComponent.vue').default);
const app = new Vue({
    el: '#app',
});
