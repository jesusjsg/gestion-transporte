import { getDatatable } from "../components/datatable.js";
import { getPlaca } from "../components/autocomplete.js";

const tableUrl = 'http://localhost/gestion-transporte/ajax/conductor?action=load_conductores'
const tableId = document.querySelector('#table-conductor')

const autocompleteUrl = 'http://localhost/gestion-transporte/ajax/conductor?action=get_placa'
const inputId = document.querySelector('#vehiculo-conductor')

function main(){
    getDatatable(tableId ,tableUrl, [
        {'data': 'id_conductor'},
        {'data': 'nombre_conductor'},
        {'data': 'cedula_conductor'},
        {'data': 'telefono_conductor'},
        {'data': 'id_vehiculo'},
        {'data': 'vencimiento_cedula'},
        {'data': 'vencimiento_licencia'},
        {'data': 'vencimiento_certificadoMedico'},
        {'data': 'vencimiento_mppps'},
        {'data': 'vencimiento_saberes'},
        {'data': 'vencimiento_manejoSeguro'},
        {'data': 'vencimiento_alimento'},
        {'data': 'tipo_nomina'}
    ])

    getPlaca(inputId, autocompleteUrl)
}

document.addEventListener('DOMContentLoaded', main)
