const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success m-1',
        cancelButton: 'btn btn-danger m-1'
    },
    buttonsStyling: false
})

export function alertHandler(forms){
    forms.forEach(form => {
        form.addEventListener("submit", function(event){
            event.preventDefault()

            swalWithBootstrapButtons.fire({
                icon: 'question',
                title: '¿Estás seguro?',
                text: '¿Deseas realizar la siguiente operación?',
                showCancelButton: true,
                confirmButtonText: "Sí, Aceptar",
                cancelButtonText: "No, Cancelar",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed){
                    let data = new FormData(this)
                    let method = this.getAttribute('method')
                    let action = this.getAttribute('action')

                    let config = configHeaders(method, action, data)

                    fetch(config.action, config)
                    .then(response => {
                        if(!response.ok){
                            throw new Error('Network response was not ok')
                        }
                        return response.json()
                    })
                    .then(response => {
                        return alertSimple(response)
                    })
                    .catch(error => {
                        console.error('Hubo un problema con el fetch: ', error)
                        swalWithBootstrapButtons.fire({
                            icon: 'error',
                            title: 'Ocurrió un error',
                            text: 'Hubo un problema al procesar la solicitud.'
                        })
                    })
                }
            })
        })
    });
}

function configHeaders(method, action, data){
    let headers = new Headers()

    return {
        method: method,
        headers: headers,
        mode: 'cors',
        cache: 'no-cache',
        body: data,
        action: action
    }
}

export function alertSimple(alert){

    if(!alert || !alert.type || !alert.title || !alert.icon || !alert.text){
        console.error('Alert object is missing required properties')
        return
    }

    const configAlert = {
        icon: alert.icon,
        title: alert.title,
        text: alert.text,
        confirmButtonText: 'Aceptar'
    }

    switch(alert.type){
        case 'simple':
            swalWithBootstrapButtons.fire(configAlert)
            break
        case 'reload':
            swalWithBootstrapButtons.fire(configAlert)
            .then((result) => {
                if(result.isConfirmed){
                    location.reload()
                }
            })
            break
    }
}