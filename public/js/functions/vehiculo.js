import { getDatatable } from "../components/datatable.js";
import { AJAX_TABLES } from "../apiAjax.js";

const fieldId = document.querySelector('#table-vehiculo')

function main(){
    getDatatable(fieldId, AJAX_TABLES.vehiculo, [
        {'data': 'id_vehiculo'},
        {'data': 'tipo_vehiculo'},
        {'data': 'propiedad'},
        {'data': 'unidad_negocio'},
        {'data': 'marca'},
        {'data': 'modelo'},
        {'data': 'year_vehiculo', visible:false},
        {'data': 'serial_carroceria', visible:false},
        {'data': 'serial_motor', visible:false},
        {'data': 'numero_ejes', visible:false},
        {'data': 'capacidad_carga', visible:false},
        {'data': 'uso'},
        {'data': 'vencimiento_poliza', visible:false},
        {'data': 'vencimiento_racda', visible:false},
        {'data': 'vencimiento_sanitario', visible:false},
        {'data': 'vencimiento_rotc', visible:false},
        {'data': 'fecha_fumigacion', visible:false},
        {'data': 'fecha_impuesto', visible:false},
        {'data': 'bolipuertos', visible:false},
        {'data': 'gps', visible:false},
        {'data': 'link_gps', visible:false},
        {'data': 'estatus_vehiculo'},
        {'data': 'id_municipio', visible:false},
        {'data': 'activo_uno'},
        {'data': 'activo_dos'},
        {'data': 'activo_tres'},
        {'data': 'opciones'}
    ])
}

document.addEventListener('DOMContentLoaded', main)

