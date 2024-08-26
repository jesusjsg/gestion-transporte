import { getDatatable } from "../components/datatable.js";

const tableUrl = 'http://localhost/gestion-transporte/ajax/ruta?action=load_ruta'
const tableId = document.querySelector('#table-ruta')
const origen = document.querySelector('#origen')
const codeOrigen = document.querySelector('#codigo-origen')
const destino = document.querySelector('#destino')
const codeDestino = document.querySelector('#codigo-destino')
const autocompleteUrl = 'http://localhost/gestion-transporte/ajax/ruta?action=get_municipio'

function main(){
    getDatatable(tableId, tableUrl, [
        {'data': 'id_ruta'},
        {'data': 'nombre_ruta'},
        {'data': 'origen'},
        {'data': 'destino'},
        {'data': 'kilometros'}
    ])

    autocompleteMunicipio(origen, autocompleteUrl, codeOrigen)
    autocompleteMunicipio(destino, autocompleteUrl, codeDestino)
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
                            label: value.estado_nombre_municipio
                        };
                    });
                    console.log(aData);
                    response(aData);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', status, error);
                }
            });
        },
        select: function(event, ui) {
            $(fieldId).val(ui.item.label);
            $(hiddenField).val(ui.item.id);
            return false;
        },
        focus: function(event, ui) {
            $(fieldId).val(ui.item.label);
            return false;
        }
    });
}

document.addEventListener('DOMContentLoaded', main)