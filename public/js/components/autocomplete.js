export function getPlaca(field, url){
    $(field).autocomplete({
        source: function(request, response){
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data:{
                    term: request.term
                },
                success: function(data){
                    console.log(data)
                    response(data)
                }
            })
        }
    })
}

export function autocompleteMunicipio(inputName, url, hiddenInput){
    $(inputName).autocomplete({
        source: function(request, response){
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data){
                    const suggestions = $.map(data, function(value){
                        return {
                            label: value.estado_nombre_municipio,
                            id: value.id_entidad,
                            municipio: descripcion1
                        }
                    })
                    response(suggestions)
                },
                error: function(xhr, status, error){
                    console.error('Ajax error: ', status, error)
                }
            })
        },
        select: function(event, ui){
            $(inputName).val(ui.item.label)
            $(hiddenInput).val(ui.item.id)
        },
        focus: function(event, ui){
            $(inputName).val(ui.item.municipio)
        }
    })
}

export function autocompleteCliente(inputName, url, hiddenInput){
    $(inputName).autocomplete({
        source: function(request, response){
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data){
                    const suggestions = $.map(data, function(value){
                        return {
                            label: value.descripcion1,
                            id: value.id_entidad
                        }
                    })
                    response(suggestions)
                }
            })
        },
        select: function(event, ui){
            $(inputName).val(ui.item.label)
            $(hiddenInput).val(ui.item.id)
        },
        focus: function(event, ui){
            $(inputName).val(ui.item.label)
        }
    })
    if($(inputName).val() === ''){
        $(hiddenInput).val('')
    }
}

export function autocompleteConductor(inputName, url, ...other){
    $(inputName).autocomplete({
        source: function(request, response){
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data){
                    const suggestions = $.map(data, function(value){
                        return {
                            label: value.nombre_conductor,
                            id: value.id_conductor,
                            placa: value.id_vehiculo
                        }
                    })
                    response(suggestions)
                }
            })
        },
        select: function(event, ui){
            $(inputName).val(ui.item.label)
            if(other.length > 0){
                $(other[0]).val(ui.item.id)
            }
            if(other.length > 1){
                $(other[1]).val(ui.item.placa)
            }
        },
        focus: function(event, ui){
            $(inputName).val(ui.item.label)
            if(other.length > 1){
                $(other[1]).val(ui.item.placa)
            }
        }
    })
}