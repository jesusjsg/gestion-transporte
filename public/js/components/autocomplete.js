export function autocompletePlaca(inputName, ajaxUrl){
    $(inputName).autocomplete({
        source: function(request, response){
            $.ajax({
                url: ajaxUrl,
                type: 'get',
                dataType: 'json',
                data:{
                    term: request.term
                },
                success: function(data){
                    response(data)
                },
                error: function(xhr, status, error){
                    console.error('Ajax error: ', status, error)
                }
            })
        }
    })
}

export function autocompleteMunicipio({inputName, ajaxUrl, hiddenInput}){
    $(inputName).autocomplete({
        source: function(request, response){
            $.ajax({
                url: ajaxUrl,
                type: 'get',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data){
                    const suggestions = data.map(value => ({
                        label: value.estado_nombre_municipio,
                        id: value.id_entidad,
                        municipio: value.descripcion1
                    }))
                    response(suggestions)
                },
                error: function(xhr, status, error){
                    console.error('Ajax error: ', status, error)
                }
            })
        },
        minLength: 2,
        select: function(event, ui){
            $(inputName).val(ui.item.label)
            $(hiddenInput).val(ui.item.id).trigger('change')
            $(inputName).val(ui.item.municipio)
            return false
        },
        focus: function(event, ui){
            $(inputName).val(ui.item.municipio)
            return false
        }
    })
}

export function autocompleteCliente({inputName, ajaxUrl, hiddenInput}){
    $(inputName).autocomplete({
        source: function(request, response){
            $.ajax({
                url: ajaxUrl,
                type: 'get',
                dataType: 'json',
                data: {
                    term: request.term
                },
                success: function(data){
                    const suggestions = data.map(value => ({
                        label: value.descripcion1,
                        id: value.id_entidad,
                    }))
                    response(suggestions)
                },
                error: function(xhr, status, error){
                    console.error('Ajax error: ', status, error)
                }
            })
        },
        minLength: 2,
        select: function(event, ui){
            $(inputName).val(ui.item.label)
            $(hiddenInput).val(ui.item.id)
        },
        focus: function(event, ui){
            $(inputName).val(ui.item.label)
        }
    })
    $(inputName).on('input', function(){
        if($(this).val() === ''){
            $(hiddenInput).val('')
        }
    })
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
                    const suggestions = data.map(value => ({
                        label: value.nombre_conductor,
                        id: value.id_conductor,
                        placa: value.id_vehiculo,
                    }))
                    response(suggestions)
                },
                error: function(xhr, status, error){
                    console.error('Ajax error: ', status, error)
                }
            })
        },
        minLength: 2,
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

    $(inputName).on('input', function(){
        if($(this).val() === ''){
            other.forEach(input => {
                $(input).val('')
            })
        }
    })
}