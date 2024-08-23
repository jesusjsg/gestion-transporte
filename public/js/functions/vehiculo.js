import { getDatatable } from "../components/datatable.js";

const url = 'http://localhost/gestion-transporte/ajax/vehiculo?action=load_vehiculos'

function main(){
    getDatatable(url, [
        {'data': 'id_vehiculo', 'className': 'dt-left'},
        {'data': 'tipo_vehiculo', 'className': 'dt-center'},
        {'data': 'propiedad', 'className': 'dt-left'},
        {'data': 'unidad_negocio'},
        {'data': 'marca'},
        {'data': 'modelo'},
        {'data': 'year_vehiculo',visible:false},
        {'data': 'serial_carroceria', visible:false},
        {'data': 'serial_motor', visible:false},
        {'data': 'numero_ejes',visible:false},
        {'data': 'capacidad_carga'},
        {'data': 'uso'},
        {'data': 'vencimiento_poliza',visible:false},
        {'data': 'vencimiento_racda',visible:false},
        {'data': 'vencimiento_sanitario',visible:false},
        {'data': 'vencimiento_rotc',visible:false},
        {'data': 'fecha_fumigacion',visible:false},
        {'data': 'fecha_impuesto'},
        {'data': 'bolipuertos'},
        {'data': 'gps'},
        {'data': 'link_gps', visible:false},
        {'data': 'estatus'},
    ])
}

document.addEventListener('DOMContentLoaded', main())

