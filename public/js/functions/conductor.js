import { getDatatable } from "../components/datatable.js";
import { getPlaca } from "../components/autocomplete.js";
import { AJAX_AUTOCOMPLETE, AJAX_TABLES } from "../apiAjax.js";

const tableConductor = document.querySelector('#table-conductor')
const placa = document.querySelector('#vehiculo-conductor')

function main(){
    getDatatable(tableConductor, AJAX_TABLES.conductor, [
        {'data': 'id_conductor'},
        {'data': 'nombre_conductor'},
        {'data': 'cedula_conductor'},
        {'data': 'telefono_conductor'},
        {'data': 'id_vehiculo'},
        {'data': 'vencimiento_cedula', visible:false},
        {'data': 'vencimiento_licencia', visible:false},
        {'data': 'vencimiento_certificado_medico', visible:false},
        {'data': 'vencimiento_mppps', visible:false},
        {'data': 'vencimiento_saberes', visible:false},
        {'data': 'vencimiento_manejo_seguro', visible:false},
        {'data': 'vencimiento_alimento', visible:false},
        {'data': 'tipo_nomina'},
        {'data': 'opciones', 'className': 'dt-center'}
    ])

    getPlaca(placa, AJAX_AUTOCOMPLETE.placaVehiculo)
}

document.addEventListener('DOMContentLoaded', main)
