/* 
Autocompletado para los inputs de tipo texto 
(Cliente, placa vehiculo, municipios) 
*/

export function autocomplete(fieldId, url){
    $(fieldId).autocomplete({
        source: function(request, response){
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data){
                    response(data)
                }
            })
        }
    })
}
