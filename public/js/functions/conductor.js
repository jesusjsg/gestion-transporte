import { getDatatable } from "../components/datatable.js";
import { getPlaca } from "../components/autocomplete.js";

const tableUrl = 'http://localhost/gestion-transporte/ajax/conductor?action=load_conductores'
const autocompleteUrl = 'http://localhost/gestion-transporte/ajax/conductor?action=get_placa'
const fieldId = document.querySelector('#table-conductor')

function main(){
    getDatatable(fieldId ,tableUrl, [
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

    getPlaca(fieldId, autocompleteUrl)
}

document.addEventListener('DOMContentLoaded', main)
