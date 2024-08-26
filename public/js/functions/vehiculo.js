import { getDatatable } from "../components/datatable.js";

const url = 'http://localhost/gestion-transporte/ajax/vehiculo?action=load_vehiculos'
const fieldId = document.querySelector('#table-vehiculo')

function main(){
    getDatatable(fieldId, url, [
        {'data': 'id_vehiculo'},
        {'data': 'tipo_vehiculo'},
        {'data': 'propiedad'},
        {'data': 'unidad_negocio'},
        {'data': 'marca'},
        {'data': 'modelo'},
        {'data': 'year_vehiculo'},
        {'data': 'serial_carroceria'},
        {'data': 'serial_motor'},
        {'data': 'numero_ejes'},
        {'data': 'capacidad_carga'},
        {'data': 'uso'},
        {'data': 'vencimiento_poliza'},
        {'data': 'vencimiento_racda'},
        {'data': 'vencimiento_sanitario'},
        {'data': 'vencimiento_rotc'},
        {'data': 'fecha_fumigacion'},
        {'data': 'fecha_impuesto'},
        {'data': 'bolipuertos'},
        {'data': 'gps'},
        {'data': 'link_gps'},
        {'data': 'estatus'},
    ])
}

document.addEventListener('DOMContentLoaded', main)

