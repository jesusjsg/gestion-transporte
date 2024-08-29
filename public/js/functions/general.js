import { getDatatable } from "../components/datatable.js"

const tableUrl = 'http://localhost/gestion-transporte/ajax/general?action=load_general';
const tableId = document.querySelector('#table-general')

function main(){
    getDatatable(tableId, tableUrl, [
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