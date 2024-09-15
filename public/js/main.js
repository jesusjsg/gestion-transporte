import { getDatatable } from "./components/datatable.js";
import { autocompleteMunicipio, autocompletePlaca } from "./components/autocomplete.js";
import { AJAX_TABLES, AJAX_AUTOCOMPLETE } from "./apiAjax.js";
import { alertHandler, alertSimple } from "./alertMessages.js";
import { getWeekends } from "./weekends.js";

// table elements
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
const municipioCode = document.querySelector('#id-municipio') // input para el municipio del vehiculo

//date elements
const startDate = document.querySelector('#fecha-inicio')
const endDate = document.querySelector('#fecha-cierre')
const countSaturdays = document.querySelector('#cantidad-sabados')
const countSundays = document.querySelector('#cantidad-domingos')



function main(){
    renderTables()
    renderAutocomplete()
    alertHandler(forms) // handle alert messages

    startDate?.addEventListener('change', calculateWeekends)
    endDate?.addEventListener('change', calculateWeekends)
}

function renderTables(){ // render all tables
    initConductorTable()
    initUsuarioTable()
    initGeneralTable()
    initVehiculoTable()
    initRutaTable()
}

function renderAutocomplete(){
    autocompleteMunicipio({
        inputName: origen,
        ajaxUrl: AJAX_AUTOCOMPLETE.municipio,
        hiddenInput: origenCode,
    })

    autocompleteMunicipio({
        inputName: destino,
        ajaxUrl: AJAX_AUTOCOMPLETE.municipio,
        hiddenInput: destinoCode
    })
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

function calculateWeekends(){
    const start = dayjs(startDate.value)
    const end = dayjs(endDate.value)

    if(start & end){
        if(start.isBefore(end) || start.isSame(end)){
            const weekends = getWeekends({
                startDate: start,
                endDate: end,
            })

            const totalSaturdays = weekends.filter(date => dayjs(date).day() === 6).length

            const totalSundays = weekends.filter(date => dayjs(date).day() === 0).length

            countSaturdays.value = totalSaturdays
            countSundays.value = totalSundays
        }else{
            const alertInfo = {
                type: 'simple',
                icon: 'error',
                title: 'Ocurrió un error',
                text: 'La fecha de inicio debe ser anterior a la fecha de cierre.'
            }
            alertSimple(alertInfo)
        }
    }
}

document.addEventListener('DOMContentLoaded', main)