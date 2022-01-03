require('./bootstrap');

import Vue from 'vue';
window.Vue = Vue;

import JQuery from 'jquery';
window.$ = JQuery;

require('bootstrap/dist/js/bootstrap.bundle');


import modalAdicionarProduto from "./componentes/modal-adicionar-produto.vue";
Vue.component('modal-adicionar-produto', modalAdicionarProduto);


// Header for post request in all POSTS Forms Requests
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
