import { autocompleteCliente, autocompleteConductor, autocompleteMunicipio } from "../components/autocomplete.js";
import { getDatatable } from "../components/datatable.js";

const tableUrl = 'http://localhost/gestion-transporte/ajax/viaje?action=load_viaje'
const municipioUrl = 'http://localhost/gestion-transporte/ajax/viaje?action=get_municipio'
const clienteUrl = 'http://localhost/gestion-transporte/ajax/viaje?action=get_cliente'
const conductorUrl = 'http://localhost/gestion-transporte/ajax/viaje?action=get_conductor'
const placaUrl = 'http://localhost/gestion-transporte/ajax/viaje?action=get_placa'

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

    autocompleteConductor(nombreConductor, conductorUrl, fichaConductor, placa)
    autocompleteCliente(cliente, clienteUrl, clienteId)

}



document.addEventListener('DOMContentLoaded', main)