import { getDatatable } from "./components/datatable.js";
import { autocompleteCliente, autocompleteConductor, autocompleteMunicipio, autocompletePlaca } from "./components/autocomplete.js";
import { AJAX_TABLES, AJAX_AUTOCOMPLETE, AJAX_KILOMETERS } from "./apiAjax.js";
import { alertHandler ,alertSimple } from "./alertMessages.js";
import { getWeekends } from "./weekends.js";
import { rowsDatatable, addRow } from "./components/Row.js";

const forms = document.querySelectorAll('.form-ajax')

// table elements
const tableViaje = document.querySelector('#table-viaje')
const tableConductor = document.querySelector('#table-conductor')
const tableUsuario = document.querySelector('#table-usuario')
const tableGeneral = document.querySelector('#table-general')
const tableVehiculo = document.querySelector('#table-vehiculo')
const tableRuta = document.querySelector('#table-ruta')
const tableMovements = document.querySelector('#table-movements')

// autocomplete municipio elements
const origen = document.querySelector('#origen')
const origenCode = document.querySelector('#codigo-origen')
const destino = document.querySelector('#destino')
const destinoCode = document.querySelector('#codigo-destino')

//autocomplete conductor elements
const conductor = document.querySelector('#nombre-conductor')
const conductorCode = document.querySelector('#ficha-conductor')
const vehiculo = document.querySelector('#placa-vehiculo')

// autocomplete cliente elements
const cliente = document.querySelector('#cliente')
const clienteCode = document.querySelector('#codigo-cliente')

//date elements
const startDate = document.querySelector('#fecha-inicio')
const endDate = document.querySelector('#fecha-cierre')
const countSaturdays = document.querySelector('#cantidad-sabados')
const countSundays = document.querySelector('#cantidad-domingos')

// movements elements
/* const origenClass = $('.origen')
const destinoClass = $('.destino')
const idOrigenClass = $('.id-origen')
const idDestinoClass = $('.id-destino') */
const addMovementsButton = document.querySelector('#add-row')



function main(){
    alertHandler(forms) // handle alert messages
    renderTables()
    renderAutocomplete()

    startDate?.addEventListener('change', calculateWeekends)
    endDate?.addEventListener('change', calculateWeekends)
    addMovementsButton?.addEventListener('click', addRow)
}

function renderTables(){ // render all tables
    initConductorTable()
    initUsuarioTable()
    initGeneralTable()
    initVehiculoTable()
    initRutaTable()
    initViajeTable()
    initMovimientoTable()
}

function renderAutocomplete(){

    autocompletePlaca(vehiculo, AJAX_AUTOCOMPLETE.placaVehiculo)
    autocompleteConductor(conductor, AJAX_AUTOCOMPLETE.conductor, conductorCode, vehiculo)

    autocompleteCliente({
        inputName: cliente,
        ajaxUrl: AJAX_AUTOCOMPLETE.cliente,
        hiddenInput: clienteCode,
    })

    autocompleteMunicipio({
        inputName: origen,
        ajaxUrl: AJAX_AUTOCOMPLETE.municipio,
        hiddenInput: origenCode,
    })

    autocompleteMunicipio({
        inputName: destino,
        ajaxUrl: AJAX_AUTOCOMPLETE.municipio,
        hiddenInput: destinoCode,
    })
}


export function initializeNewRowAutocomplete(rowIndex) {
    const origenInput = document.querySelector(`#origen-${rowIndex}`)
    const destinoInput = document.querySelector(`#destino-${rowIndex}`);
    const idOrigenInput = document.querySelector(`#id-origen-${rowIndex}`)
    const idDestinoInput = document.querySelector(`#id-destino-${rowIndex}`)

    autocompleteMunicipio({
        inputName: origenInput,
        ajaxUrl: AJAX_AUTOCOMPLETE.municipio,
        hiddenInput: idOrigenInput
    });

    autocompleteMunicipio({
        inputName: destinoInput,
        ajaxUrl: AJAX_AUTOCOMPLETE.municipio,
        hiddenInput: idDestinoInput
    });

    $(idOrigenInput).on('change', () => {
        concatCodes(rowIndex)
    })
        
    $(idDestinoInput).on('change', () => {
        concatCodes(rowIndex)
    })

    concatCodes(rowIndex)
}

function concatCodes(rowIndex) {
    const idOrigenInput = document.querySelector(`#id-origen-${rowIndex}`)
    const idDestinoInput = document.querySelector(`#id-destino-${rowIndex}`)
    const idRutaInput = document.querySelector(`#id-ruta-${rowIndex}`)

    if (idOrigenInput && idDestinoInput) {
        const idOrigenValue = idOrigenInput.value
        const idDestinoValue = idDestinoInput.value

        if (idOrigenValue && idDestinoValue) {
            idRutaInput.value = `${idOrigenValue}-${idDestinoValue}`
        } else {
            idRutaInput.value = ''
        }

        getKilometers(idRutaInput.value, rowIndex)
    }
}

function getKilometers(idRuta, rowIndex) {
    $.ajax({
        url: AJAX_KILOMETERS.ruta,
        type: 'get',
        data: {id_ruta: idRuta},
        success: function(response) {
            if (response !== null) {
                document.querySelector(`#kilometros-movimiento-${rowIndex}`).value = response
            } else {
                document.querySelector(`#kilometros-movimiento-${rowIndex}`).value = ''
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Ajax error: ', errorThrown)
        }
    })
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

function initConductorTable(){
    const title = 'Conductores registrados'
    getDatatable(tableConductor, AJAX_TABLES.conductor, title, [ // conductor table
        {'data': 'id_conductor'},
        {'data': 'nombre_conductor'},
        {'data': 'cedula_conductor'},
        {'data': 'telefono_conductor'},
        {'data': 'id_vehiculo'},
        {'data': 'tipo_nomina'},
        {'data': 'opciones', 'className': 'dt-center noExport'}
    ])
}

function initUsuarioTable(){
    const title = 'Usuarios registrados'
    getDatatable(tableUsuario, AJAX_TABLES.usuario, title, [
        {'data': 'nombre_apellido'},
        {'data': 'nombre_usuario'},
        {'data': 'nombre_rol', 'className':'dt-center'},
        {'data': 'opciones', 'className':'dt-center noExport'},
    ])
}

function initGeneralTable(){
    const title = 'Entidades registrados'
    getDatatable(tableGeneral, AJAX_TABLES.general, title, [ // general table
        {'data': 'id_registro'},
        {'data': 'id_entidad'},
        {'data': 'descripcion1'},
        {'data': 'descripcion2'},
        {'data': 'descripcion3'},
        {'data': 'valor', 'className':'dt-right'},
        {'data': 'opciones', 'className':'dt-center noExport'}
    ])
}

function initVehiculoTable(){
    const title = 'Vehiculos registrados'
    getDatatable(tableVehiculo, AJAX_TABLES.vehiculo, title, [ // vehiculo table
        {'data': 'id_vehiculo'},
        {'data': 'tipo_vehiculo'},
        {'data': 'propiedad'},
        {'data': 'marca'},
        {'data': 'uso'},
        {'data': 'estatus_vehiculo', 'className': 'dt-center'},
        {'data': 'opciones', 'className': 'dt-center noExport'}
    ])
}

function initRutaTable(){
    const title = 'Rutas registradas'
    getDatatable(tableRuta, AJAX_TABLES.ruta, title, [ // ruta table
        {'data': 'id_ruta'},
        {'data': 'nombre_ruta'},
        {'data': 'origen'},
        {'data': 'destino'},
        {'data': 'kilometros'},
        {'data': 'opciones', 'className': 'dt-center noExport'}
    ])
}

function initViajeTable(){
    const title = 'Viajes registrados'
    getDatatable(tableViaje, AJAX_TABLES.viaje, title, [
        {'data': 'nombre_conductor'},
        {'data': 'id_vehiculo'},
        {'data': 'id_tipo_operacion'},
        {'data': 'id_tipo_carga'},
        {'data': 'aviso'},
        {'data': 'id_cliente'},
        {'data': 'nombre_ruta'},
        {'data': 'fecha_inicio'},
        {'data': 'fecha_cierre'},
        {'data': 'nro_nomina'},
        {'data': 'sabados'},
        {'data': 'domingos'},
        {'data': 'feriados'},
        {'data': 'opciones', 'className': 'dt-center noExport'}
    ])
}

function initMovimientoTable(){
    rowsDatatable(tableMovements)
}



document.addEventListener('DOMContentLoaded', main)