import { getDatatable } from "../components/datatable.js";

const url = 'http://localhost/gestion-transporte/ajax/usuarios?action=load_users'

function main(){
    getDatatable(url, [
        {'data': 'id_usuario', visible:false},
        {'data': 'nombre_apellido'},
        {'data': 'nombre_usuario'},
        {'data': 'nombre_rol', 'className':'dt-center'},
        {'data': 'opciones', 'className':'dt-center'},
    ])
}

document.addEventListener('DOMContentLoaded', main())