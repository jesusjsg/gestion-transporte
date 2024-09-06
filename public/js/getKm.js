import { AJAX_TABLES } from "../apiAjax.js";

export function getKm(rutaCode){
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '',
            type: 'post',
            data: {id_ruta: rutaCode},
            dataType: 'json',
            success: function(response){
                if(response.length > 0){
                    resolve(response[0].kilometros)
                    console.log('Kilometros de la ruta: ' + response[0].kilometros)
                }else{
                    resolve(0)
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('Error en AJAX: ' + errorThrown)
                reject(errorThrown)
            }
        })
    })
}