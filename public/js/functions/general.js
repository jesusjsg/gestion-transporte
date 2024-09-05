import { getDatatable } from "../components/datatable.js"
import { AJAX_TABLES } from "../apiAjax.js"

const tableId = document.querySelector('#table-general')

function main(){
    getDatatable(tableId, AJAX_TABLES.general, [
        {'data': 'id_registro'},
        {'data': 'id_entidad'},
        {'data': 'descripcion1'},
        {'data': 'descripcion2'},
        {'data': 'descripcion3'},
        {'data': 'valor', 'className':'dt-right'},
        {'data': 'opciones'}
    ])
}

document.addEventListener('DOMContentLoaded', main)