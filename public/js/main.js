import { getDatatable } from "./components/datatable.js";
import { autocompleteMunicipio, autocompletePlaca } from "./components/autocomplete.js";
import { AJAX_TABLES, AJAX_AUTOCOMPLETE } from "./apiAjax.js";
import { alertHandler } from "./alertMessages.js";


const tableConductor = document.querySelector('#table-conductor')
const tableUsuario = document.querySelector('#table-usuario')
const tableGeneral = document.querySelector('#table-general')
const tableVehiculo = document.querySelector('#table-vehiculo')
const tableRuta = document.querySelector('#table-ruta')
const forms = document.querySelectorAll('.form-ajax')

// autocomplete elements
const origen = document.querySelector('#origen')
const origenCode = document.querySelector('#codigo-origen')
const destino = document.querySelector('#destino')
const destinoCode = document.querySelector('#codigo-destino')
const placaVehiculo = document.querySelector('#placa-vehiculo')
const municipioCode = document.querySelector('#id-municipio')


function main(){
    renderTables()
    renderAutocomplete()
    alertHandler(forms) // handle alert messages
}

function renderTables(){ // render all tables
    initConductorTable()
    initUsuarioTable()
    initGeneralTable()
    initVehiculoTable()
    initRutaTable()
}

function renderAutocomplete(){
    autocompleteMunicipio(origen, AJAX_AUTOCOMPLETE.municipio, origenCode)
    autocompleteMunicipio(destino, AJAX_AUTOCOMPLETE.municipio, destinoCode)
    autocompleteMunicipio(origen, AJAX_AUTOCOMPLETE.municipio, municipioCode)
    autocompletePlaca(placaVehiculo, AJAX_AUTOCOMPLETE.placaVehiculo)
}

function initConductorTable(){
    getDatatable(tableConductor, AJAX_TABLES.conductor, [ // conductor table
        {'data': 'id_conductor'},
        {'data': 'nombre_conductor'},
        {'data': 'cedula_conductor'},
        {'data': 'telefono_conductor'},
        {'data': 'id_vehiculo'},
        {'data': 'tipo_nomina'},
        {'data': 'opciones', 'className': 'dt-center'}
    ])
}

function initUsuarioTable(){
    getDatatable(tableUsuario, AJAX_TABLES.usuario, [ // usuario table
        {'data': 'nombre_apellido'},
        {'data': 'nombre_usuario'},
        {'data': 'nombre_rol', 'className':'dt-center'},
        {'data': 'opciones', 'className':'dt-center'},
    ])
}

function initGeneralTable(){
    getDatatable(tableGeneral, AJAX_TABLES.general, [ // general table
        {'data': 'id_registro'},
        {'data': 'id_entidad'},
        {'data': 'descripcion1'},
        {'data': 'descripcion2'},
        {'data': 'descripcion3'},
        {'data': 'valor', 'className':'dt-right'},
        {'data': 'opciones', 'className':'dt-center'}
    ])
}

function initVehiculoTable(){
    getDatatable(tableVehiculo, AJAX_TABLES.vehiculo, [ // vehiculo table
        {'data': 'id_vehiculo'},
        {'data': 'tipo_vehiculo'},
        {'data': 'propiedad'},
        {'data': 'marca'},
        {'data': 'uso'},
        {'data': 'estatus_vehiculo', 'className': 'dt-center'},
        {'data': 'opciones', 'className': 'dt-center'}
    ])
}

function initRutaTable(){
    getDatatable(tableRuta, AJAX_TABLES.ruta, [ // ruta table
        {'data': 'id_ruta'},
        {'data': 'nombre_ruta'},
        {'data': 'origen'},
        {'data': 'destino'},
        {'data': 'kilometros'},
        {'data': 'opciones', 'className': 'dt-center'}
    ])
}


function initAutocomplete(){

}

document.addEventListener('DOMContentLoaded', main)