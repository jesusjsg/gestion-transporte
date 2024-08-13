/* 
Autocompletado para los inputs de tipo texto 
(Cliente, placa vehiculo, municipios) 
*/

export function autocompleteField(url, fieldClass, action){
    $(fieldClass).autocomplete({
        source: function(request, response){
            $.ajax({
                url: url,
                type: 'get',
                data: {
                    term: request.term,
                    action: action
                },
                dataType: 'json',
                success: function(data){
                    response(data)
                }
            })
        },
        minLength: 1,
    })
}
