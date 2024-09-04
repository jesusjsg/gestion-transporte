import { alertMessages} from "../alertMessages.js";
import { AJAX_AUTOCOMPLETE } from "../apiAjax.js";
import { autocompleteCliente, autocompleteConductor, autocompleteMunicipio } from "../components/autocomplete.js";
import { getDatatable } from "../components/datatable.js";
import { getWeekends } from "../getDay.js";

const tableUrl = 'http://localhost/gestion-transporte/ajax/viaje?action=load_viaje'
const tableId = document.querySelector('#table-viaje')
const cliente = document.querySelector('#cliente')
const clienteId = document.querySelector('#id-cliente')
const origen = document.querySelector('#origen')
const origenId = document.querySelector('#id-origen')
const destino = document.querySelector('#destino')
const destinoId = document.querySelector('#id-destino')
const nombreConductor = document.querySelector('#nombre-conductor')
const fichaConductor = document.querySelector('#ficha-conductor')
const placa = document.querySelector('#placa-vehiculo')
const startDate = document.querySelector('#fecha-inicio')
const endDate = document.querySelector('#fecha-cierre')
const countSaturday = document.querySelector('#cantidad-sabados')
const countSundays = document.querySelector('#cantidad-domingos')


function main(){
    getDatatable(tableId, tableUrl, [
        {'data': 'id_conductor'},
        {'data': 'id_vehiculo'},
        {'data': 'id_tipo_operacion'},
        {'data': 'id_tipo_carga'},
        {'data': 'aviso'},
        {'data': 'id_cliente'},
        {'data': 'id_ruta'},
        {'data': 'fecha_inicio'},
        {'data': 'fecha_cierre'},
        {'data': 'sabados'},
        {'data': 'domingos'},
        {'data': 'feriados'},
        {'data': 'tasa_cambio'},
        {'data': 'monto_usd'},
        {'data': 'monto_ves'},
        {'data': 'origen'},
        {'data': 'destino'},
        {'data': 'id_nomina'},
        {'data': 'total_kilometros'},
        {'data': 'opciones'}
    ])

    autocompleteConductor(nombreConductor, AJAX_AUTOCOMPLETE.conductor, fichaConductor, placa)
    autocompleteCliente(cliente, AJAX_AUTOCOMPLETE.cliente, clienteId)

    startDate.addEventListener('change', calculateWeekends)
    endDate.addEventListener('change', calculateWeekends)

}

function calculateWeekends(){
    const start = dayjs(startDate.value)
    const end = dayjs(endDate.value)
    
    if(start & end){
        if(start.isBefore(end) || start.isSame(end)){
            const weeekends = getWeekends({
                startDate: start,
                endDate: end,
            })

            const totalSaturdays = weeekends.filter(date => dayjs(date).day() === 6).length
            const totalSundays = weeekends.filter(date => dayjs(date).day() === 0).length

            countSaturday.value = totalSaturdays
            countSundays.value = totalSundays
        }else{
            alertMessages({
                icon: 'warning',
                title: 'Ocurrió un error',
                text: 'La fecha de inicio debe ser anterior a la fecha de cierre.',
                confirmButtonText: 'Aceptar',
            })
        }
    }
}

function 

function renderMovements(){}




document.addEventListener('DOMContentLoaded', main)