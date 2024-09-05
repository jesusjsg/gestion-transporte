import { getDatatable } from "../components/datatable.js";
import { AJAX_TABLES } from "../apiAjax.js";

const tableUsuario = document.querySelector('#table-usuario')

function main(){
    getDatatable(tableUsuario, AJAX_TABLES.usuario, [
        {'data': 'id_usuario', visible:false},
        {'data': 'nombre_apellido'},
        {'data': 'nombre_usuario'},
        {'data': 'nombre_rol', 'className':'dt-center'},
        {'data': 'opciones', 'className':'dt-center'},
    ])
}

document.addEventListener('DOMContentLoaded', main)