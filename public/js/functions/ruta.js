import { getDatatable } from "../components/datatable.js";
import { AJAX_AUTOCOMPLETE, AJAX_TABLES } from "../apiAjax.js"

const tableId = document.querySelector('#table-ruta')
const origen = document.querySelector('#origen')
const codeOrigen = document.querySelector('#codigo-origen')
const destino = document.querySelector('#destino')
const codeDestino = document.querySelector('#codigo-destino')

function main(){
    getDatatable(tableId, AJAX_TABLES.ruta, [
        {'data': 'id_ruta'},
        {'data': 'nombre_ruta'},
        {'data': 'origen'},
        {'data': 'destino'},
        {'data': 'kilometros'},
        {'data': 'opciones'}
    ])

    autocompleteMunicipio(origen, AJAX_AUTOCOMPLETE.municipio, codeOrigen)
    autocompleteMunicipio(destino, AJAX_AUTOCOMPLETE.municipio, codeDestino)
}

function autocompleteMunicipio(fieldId, url, hiddenField) {
    $(fieldId).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data) {
                    const aData = $.map(data, function(value) {
                        return {
                            id: value.id_entidad,
                            label: value.estado_nombre_municipio,
                            descripcion1: value.descripcion1
                        }
                    })
                    response(aData)
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', status, error)
                }
            })
        },
        select: function(event, ui) {
            $(fieldId).val(ui.item.label)
            $(hiddenField).val(ui.item.id)
            $(fieldId).val(ui.item.descripcion1)
            return false
        },
        focus: function(event, ui) {
            $(fieldId).val(ui.item.descripcion1)
            return false
        }
    })
}

document.addEventListener('DOMContentLoaded', main)